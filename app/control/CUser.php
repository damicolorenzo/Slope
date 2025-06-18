<?php

/*
richiede il file nella posizione __DIR__ [ovvero posizione di questo specifico file (CUser.php)] concatenata con 
"\\..\\config\\autoloader.php" per arrivare alla posizione finale partendo da __DIR__.
I doppi punti sono utilizzati per andare indietro di una cartella quindi da control uscire ed andare a app
*/


require_once (__DIR__."\\..\\config\\autoloader.php");

class CUser {

    /**
     * Method to retrive the login form
     * Call the showLoginForm() method from VUser
     * @return void
     */
    public static function login() : void{
        if(USession::getSessionStatus() == PHP_SESSION_NONE){
            USession::getInstance();
        }
        if(USession::isSetSessionElement('user')){
            CUser::home();
        }
        $view = new VUser();
        $view->showLoginForm(false);
    }

    /**
     * Method to logout
     * Unset the session
     * @return void
     */
    public static function logout() : void{
        USession::getInstance();
        if(USession::isSetSessionElement('user'))  {
            USession::unsetSessionElement('user');
            USession::unsetSession();
            USession::destroySession();
        } 
        header('Location: /Slope/');
    }

    /**
     * Method to check if a user is logged
     * Check in the session array
     * @return bool
     */
    public static function isLogged() : bool{
        if(USession::getSessionStatus() == PHP_SESSION_NONE) {
            USession::getInstance(); 
        }
        return USession::isSetSessionElement('user');
    }

    /**
     * Method to verify all the data in the login form
     * Call the loggedHome() method from VUser if everything is fine
     * @return void
     */
    public static function checkLogin() : void{
        $view = new VUser();
        if(!CUser::isLogged()) {
            if(!empty(UHTTPMethods::post('username')) && !empty(UHTTPMethods::post('password'))) {
                $username = FPersistentManager::getInstance()->verifyUserUsername(UHTTPMethods::post('username'));                                            
                if($username)
                    $user = FPersistentManager::getInstance()->retriveUserOnUsername(UHTTPMethods::post('username'));
                else    
                    $user = [];
                if($username && count($user) > 0) {
                    if(password_verify(UHTTPMethods::post('password'), $user[0]->getPassword())){
                        if(USession::getSessionStatus() == PHP_SESSION_NONE){
                            USession::getInstance();
                            USession::setSessionElement('user', $user[0]->getId());
                            CUser::home();
                        } else {
                            USession::setSessionElement('user', $user[0]->getId());
                            CUser::home();
                        }
                    }else{
                        $view->showLoginForm(true);
                    }
                }else{
                    $view->showLoginForm(true);
                }
            } else {
                CUser::login();
            }
        } else {
            CUser::home();
        } 
    }

    /**
     * Method to visualize the registration form
     * Call the showRegistrationForm method from VUser
     * @return void
     */
    public static function registration() {
        $view = new VUser();
        $view->showRegistrationForm();
    }

    /**
     * Method to verify all the data in the login form 
     * @return void
     */
    public static function checkRegistration() : void{
        $view = new VUser();
        if(!is_null(UHTTPMethods::post('email')) && !is_null(UHTTPMethods::post('username')) && 
        !is_null(UHTTPMethods::post('phoneNumber')) && !is_null(UHTTPMethods::post('name')) && 
        !is_null(UHTTPMethods::post('birthDate')) && !is_null(UHTTPMethods::post('password')) && 
        !is_null(UHTTPMethods::post('surname'))) {
            if(!FPersistentManager::getInstance()->verifyUserEmail(UHTTPMethods::post('email')) && !FPersistentManager::getInstance()->verifyUserUsername(UHTTPMethods::post('username'))) {
                $phone_number_validation_regex = "/^\\+?[1-9][0-9]{7,14}$/"; 
                $password_validaiton = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/"; 
                if(!preg_match($phone_number_validation_regex, UHTTPMethods::post('phoneNumber'))) {
                    $phoneError = true;
                } else {
                    $phoneError = false;
                    $extract_phone_number_pattern = "/\\+?[1-9][0-9]{7,14}/";
                    preg_match_all($extract_phone_number_pattern, UHTTPMethods::post('phoneNumber'), $matches);
                    $phoneNumber = implode($matches[0]);
                }
                if(!(date("Y-m-d") > UHTTPMethods::post('birthDate'))){
                    $dateError = true;
                } else {
                    $dateError = false;
                } 
                if(!preg_match($password_validaiton, UHTTPMethods::post('password'))) {
                    $passwordError = true;
                } else {
                    $passwordError = false;
                }
                if(!$phoneError && !$dateError && !$passwordError) {
                    $user = new EUser(UHTTPMethods::post('name'), UHTTPMethods::post('surname'), UHTTPMethods::post('email'), $phoneNumber, UHTTPMethods::post('birthDate'), UHTTPMethods::post('username'), password_hash(UHTTPMethods::post('password'), PASSWORD_DEFAULT));
                    $user->setIdImage(0);
                    FPersistentManager::getInstance()->uploadObj($user);
                    if(USession::getSessionStatus() == PHP_SESSION_NONE){
                        USession::getInstance();
                        USession::setSessionElement('user', $user->getId());
                    }
                    $map = CUser::loggedH();
                    $view->loggedHome($map);
                } else {
                    $view->showRegistrationForm($phoneError, $dateError, $passwordError, UHTTPMethods::allPost(), false);
                }
            } else {
                $view->showRegistrationForm(false, false, false, UHTTPMethods::allPost(), true);
            }
        } else {
            CUser::home();
        }
    }

    /**
     * Method to retrive from the database all the data showed in the home of a logged user
     * @return void
     */
    public static function loggedH() : array{
        if(CUser::isLogged()) {
            $result = [];
            $allSkiFacilities = FPersistentManager::getInstance()->retriveAllSkiFacilities();
            foreach ($allSkiFacilities as $skiFacility) {
                $app = [];
                $app1 = [];
                $idSkiFacility = $skiFacility->getIdSkiFacility();
                $app[] = $skiFacility->getName();    
                $app[] = $skiFacility->getStatus();
                $app[] = FPersistentManager::getInstance()->typeAndNumberSkiRun($idSkiFacility); 
                $app[] = FPersistentManager::getInstance()->typeAndNumberLiftStructure($idSkiFacility);
                $skiFacilityImages = FPersistentManager::getInstance()->retriveSkiFacilityImageOnId($idSkiFacility);
                foreach ($skiFacilityImages as $i) {
                    $images = FPersistentManager::getInstance()->retriveImageOnId($i->getIdImage());
                    $app1[] = $images[0];
                }
                $app[] = $app1;
                $result[] = $app;
            }
            return $result;
        } else {
            CUser::home();
            return [];
        }
    }

    /**
     * Method to manage the home visualization if user is logged or not
     * @return void
     */
    public static function home() : void{
        $view = new VUser();
        if(CUser::isLogged()){
            $map = CUser::loggedH();
            $view->loggedHome($map); 
        } else if (CAdmin::isLogged()) {
            CAdmin::dashboard();
        } else {
            $allSkiFacilities = FPersistentManager::getInstance()->retriveAllSkiFacilities();
            $allSkiFacility = [];
            foreach ($allSkiFacilities as $i) {
                $idSkiFacility = $i->getIdSkiFacility();
                $app = [];
                $app[] = $i;
                $skiFacilityImage = FPersistentManager::getInstance()->retriveSkiFacilityImageOnId($idSkiFacility);
                if($skiFacilityImage != [])
                    $app[] = FPersistentManager::retriveImageOnId($skiFacilityImage[0]->getIdImage());
                else 
                    $app[] = FPersistentManager::retriveImageOnId("53");
                $allSkiFacility[] = $app;
            }
            $allLandingImages = FPersistentManager::getInstance()->retriveAllLandingImage();
            foreach ($allLandingImages as $i) {
                $image = FPersistentManager::retriveImageOnId($i->getIdImage());
                $images[] = $image;
            }
            if(is_null(UHTTPMethods::post('skiFacilities'))) {
                $skipassObj = FPersistentManager::getInstance()->retriveSkipassObjOnSkiFacility($allSkiFacilities[0]->getIdSkiFacility());
            } else {
                $skiFacility = UHTTPMethods::post('skiFacilities');
                $idSkiFacility = FPersistentManager::getInstance()->retriveIdSkiFacilityFromName($skiFacility);
                $skipassObj = FPersistentManager::getInstance()->retriveSkipassObjOnSkiFacility($idSkiFacility[0]);
            }
            $view->home($allSkiFacility, $skipassObj, $images);
        }
    }

    public static function sendMail() {
        $name = UHTTPMethods::post('name');
        $email = UHTTPMethods::post('email');
        $subject = UHTTPMethods::post('subject');
        $message = UHTTPMethods::post('message');
        //salvataggio sul db del messaggio scritto dall'utente
        $mail = PMail::invia(
            $email,
            $name,
            "Conferma invio mail a Slope",
            "Grazie per aver condiviso la sua idea"
        );
    }


  
    /* $mail = PMail::invia(
        $user[0]->getEmail(),
        $user[0]->getName() . $user[0]->getSurname(),
        "Mail da Slope",
        "Ciao Benvenuto su Slope"
    );
    if($mail)
        header('Location: /Slope/User/loggedHome');
    else 
        print("Errore"); */

    /* public static function confirmPage() : void {
        $view = new Vuser();
        if(CUser::isLogged()) {
            $view->confirmPage();
        } else {
            CUser::home();
        }
    } */

    /**
     * Method to show the informations about the user 
     * @return void
     */
    public static function profile() : void{
        if(CUser::isLogged()){
            $view = new VUser();
            $userId = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
            $username = $user[0]->getUsername(); 
            $name = $user[0]->getName();
            $surname = $user[0]->getSurname();
            $email = $user[0]->getEmail();
            $phoneNumber = $user[0]->getPhoneNumber();
            $birthDate = $user[0]->getBirthDate();
            $idImage = $user[0]->getIdImage();
            $image = FPersistentManager::getInstance()->retriveImageOnId($idImage);
            $insurances = FPersistentManager::getInstance()->retriveInsuranceFromIdUser($userId);
            $insurance = [];
            $creditCard = FPersistentManager::getInstance()->retriveCreditCardFromUserId($userId);
            foreach ($insurances as $i) {
                if($i->getPeriod() > 1)
                    $insurance[] = $i;
            }
            $subscription = FPersistentManager::getInstance()->retriveSubscriptionFromUserId($userId);
            $insuranceImage = false;
            $subscriptionImage = false;
            $view->profileInfo($username, $name, $surname, $email, $phoneNumber, $birthDate, $image, $insuranceImage, $subscriptionImage, $insurance, $creditCard, $subscription);
        } else {
            CUser::home();
        }
    }

    /**
     * Method to show a page to modify user data
     * @return void
     */
    public static function modifyProfile() : void{
        if(CUser::isLogged()){
            $view = new VUser();
            $userId = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
            $username = $user[0]->getUsername(); 
            $name = $user[0]->getName();
            $surname = $user[0]->getSurname();
            $email = $user[0]->getEmail();
            $phoneNumber = $user[0]->getPhoneNumber();
            $birthDate = $user[0]->getBirthDate();
            $view->modifyProfile($username, $name, $surname, $email, $phoneNumber, $birthDate, false);
        } else {
            CUser::home();
        }
    }

    /**
     * Method to verify all the data in the modify form 
     * @return void
     */
    public static function confirmModify() : void{
        if(CUser::isLogged()){
            if(!is_null(UHTTPMethods::post('email')) && !is_null(UHTTPMethods::post('phoneNumber'))) {
                $view = new VUser();
                $userId = USession::getInstance()->getSessionElement('user');
                $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
                $username = $user[0]->getUsername(); 
                $name = $user[0]->getName();
                $surname = $user[0]->getSurname();
                $birthDate = $user[0]->getBirthDate();
                $modifiedEmail = UHTTPMethods::post('email');
                $phone_number_validation_regex = "/^\\+?[1-9][0-9]{7,14}$/"; 
                if(!preg_match($phone_number_validation_regex, UHTTPMethods::post('phoneNumber'))) {
                    $phoneError = true;
                } else {
                    $phoneError = false;
                    $extract_phone_number_pattern = "/\\+?[1-9][0-9]{7,14}/";
                    preg_match_all($extract_phone_number_pattern, UHTTPMethods::post('phoneNumber'), $matches);
                    $modifiedPhoneNumber = implode($matches[0]);
                }
                if($phoneError) 
                    $view->modifyProfile($username, $name, $surname, $modifiedEmail, $modifiedPhoneNumber, $birthDate, $phoneError, false);
                else {
                    if($user[0]->getEmail() != $modifiedEmail && $user[0]->getPhoneNumber() != $modifiedPhoneNumber) {
                        $now = date('Y-m-d H:i:s');
                        $modify = "";
                        if($user[0]->getEmail() != $modifiedEmail)
                            $modify = "Email";
                        if($user[0]->getPhoneNumber() != $modifiedPhoneNumber)
                            $modify = $modify + "Numero di telefono";

                        $mail = PMail::invia(
                            $modifiedEmail,
                            $name,
                            "Conferma modifica della email sul suo account Slope",
                            "Ciao $name,
                            Le modifiche al tuo profilo sono state salvate con successo.
                            Dettagli aggiornati:

                            Data modifica: $now
                            Modifiche effettuate: $modify

                            Se non hai effettuato tu queste modifiche, contattaci immediatamente.
                            Grazie,
                            Il team di Slope"
                        );
                        $person = new EPerson($name, $surname, $modifiedEmail, $modifiedPhoneNumber, $birthDate);
                        $person->setId($userId);
                        FPersistentManager::getInstance()->updatePersonInfo($person);
                        CUser::profile();
                    } else {
                        CUser::profile();
                    }   
                }
            } else {
                CUser::home();
            }
        } else {
            CUser::home();
        }
    }

    /* public static function confirmModifyProfileCode() {
        $view = new VUser();
        $view
        
    } */

    public static function modifyProfileImage() {
        if(CUser::isLogged()){
            $view = new VUser();
            $userId = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
            $idImage = $user[0]->getIdImage();
            $image = FPersistentManager::getInstance()->retriveImageOnId($idImage);
            if($idImage == 0)
                $view->modifyProfileImage(false, $image);
            else    
                $view->modifyProfileImage(true, $image);
        } else {
            CUser::home();
        }
    }
 
    /**
     * Method to modify the user image
     * @return void
     */
    public static function modifyImage() : void{
        if(CUser::isLogged()){
            $userId = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
            if(!is_null(UHTTPMethods::files('image','size'))){
                $uploadedImage = UHTTPMethods::files('image');
                $check = FPersistentManager::getInstance()->checkImage($uploadedImage);
                if($check == 'UPLOAD_ERROR_OK' || $check == 'TYPE_ERROR' || $check == 'SIZE_ERROR') {
                    $checkImageError = true;
                } else {
                    $checkImageError = false;
                }
                if(!$checkImageError) {
                    FPersistentManager::getInstance()->uploadObj($check);
                    if($user[0]->getIdImage() != 0){
                        if(FPersistentManager::getInstance()->deleteImage($user[0]->getIdImage())){
                            $user[0]->setIdImage($check->getId());
                            FPersistentManager::getInstance()->updateUserIdImage($user[0]);
                        }
                        CUser::profile();
                    }else{
                        $user[0]->setIdImage($check->getId());
                        FPersistentManager::getInstance()->updateUserIdImage($user[0]);
                        CUser::home();
                    }
                } else {
                    $view = new VUser();
                    $userId = USession::getInstance()->getSessionElement('user');
                    $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
                    $username = $user[0]->getUsername(); 
                    $name = $user[0]->getName();
                    $surname = $user[0]->getSurname();
                    $email = $user[0]->getEmail();
                    $phoneNumber = $user[0]->getPhoneNumber();
                    $birthDate = $user[0]->getBirthDate();
                    if($user[0]->getIdImage() == 0)
                        $image = false;
                    else    
                        $image = true;
                    $view->modifyProfile($username, $name, $surname, $email, $phoneNumber, $birthDate, false, true, $image);
                }
            } else {
                $view = new VUser();
                $userId = USession::getInstance()->getSessionElement('user');
                $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
                $username = $user[0]->getUsername(); 
                $name = $user[0]->getName();
                $surname = $user[0]->getSurname();
                $email = $user[0]->getEmail();
                $phoneNumber = $user[0]->getPhoneNumber();
                $birthDate = $user[0]->getBirthDate();
                if($user[0]->getIdImage() == 0)
                    $image = false;
                else    
                    $image = true;
                $view->modifyProfile($username, $name, $surname, $email, $phoneNumber, $birthDate, false, true, $image);
            }
        } else {
            CUser::home();
        }
    }

    /**
     * Method to delete the user image
     * @return void
     */
    public static function deleteImage() {
        if(CUser::isLogged()){
            $userId = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
            FPersistentManager::getInstance()->deleteImage($user[0]->getIdImage());
            $user[0]->setIdImage(0);
            FPersistentManager::getInstance()->updateUserIdImage($user[0]);
            CUser::profile();
        } else {
            CUser::home();
        }
    }

    public static function confirmDeleteImage() {

    }

    /**
     * Method to modify the password
     * @return void
     */
    public static function modifyPassword() : void{
        if(CUser::isLogged()){
            $view = new VUser();
            $view->modifyPassword(false);
        } else {
            CUser::home();
        }
    }

    public static function modifyCreditCard() :void {
        if(CUser::isLogged()){
            $view = new VUser();
            $userId = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
            $creditCard = FPersistentManager::getInstance()->retriveCreditCardFromUserId($userId);
            $cardHName = $creditCard[0]->getCardHolderName();
            $cardHSurname = $creditCard[0]->getCardHolderSurname();
            $cardNumber = substr($creditCard[0]->getCardNumber(), -4);
            $expirtDate = $creditCard[0]->getExpiryDate();
            $view->modifyCreditCard($cardHName, $cardHSurname, $cardNumber, $expirtDate);
        } else {
            CUser::home();
        }
    }

    public static function deleteCreditCard() {
        if(CUser::isLogged()){
            $userId = USession::getInstance()->getSessionElement('user');
            FPersistentManager::getInstance()->deleteCreditCard($userId);
            CUser::home();
        } else {
            CUser::home();
        }
    }

    /**
     * Method to verify the data from modify password form
     * @return void
     */
    public static function setPassword() : void{
        if(CUser::isLogged()){
            $view = new VUser();
            $password_validaiton = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/"; 
            if(!preg_match($password_validaiton, UHTTPMethods::post('password'))) {
                $passwordError = true;
            } else {
                $passwordError = false;
            }
            if($passwordError) {
                $view->modifyPassword($passwordError);
            } else {
                $userId = USession::getInstance()->getSessionElement('user');
                $user = FPersistentManager::getInstance()->retriveObj(EUser::getEntity(), $userId);
                $newPass = password_hash(UHTTPMethods::post('password'), PASSWORD_DEFAULT);
                $user->setPassword($newPass);
                $result = FPersistentManager::getInstance()->updateUserPassword($user);
                if($result) {
                    header('Location: /Slope/User/profile');
                } else {
                    $view->modifyPassword($passwordError);
                }
            }   
        } else {
            CUser::home();
        }
    }

    /**
     * Method to retrive details of a ski facility
     * @return void
     */
    public static function skiFacilityDetails() : void{
        if(CUser::isLogged()){
            $view = new VUser();
            if(UHTTPMethods::allPost() == []) {
                header('Location: /Slope/User/');
            } else {
                $nameSkiFacility = UHTTPMethods::post('nameSkiFacility');
                $idSkiFacility = FPersistentManager::getInstance()->retriveIdSkiFacilityFromName($nameSkiFacility);
                $skiRuns = FPersistentManager::getInstance()->retriveAllSkiRun($idSkiFacility[0]);
                $liftStructures = FPersistentManager::getInstance()->retriveAllLiftStructures($idSkiFacility[0]);
                $view->showDetails($idSkiFacility[0], $nameSkiFacility, $skiRuns, $liftStructures);
            }
        } else {
            CUser::home();
        }
    }

    public static function makeABookingPage() {
        if(CUser::isLogged()){
            $view = new VUser();
            $userId = USession::getInstance()->getSessionElement('user');
            $idSkiFacility = UHTTPMethods::post('idSkiFacility');
            $user = FPersistentManager::getInstance()->retriveObj(EUser::getEntity(), $userId);
            $today = date("Y-m-d");
            $skipassObjs = FPersistentManager::getInstance()->retriveSkipassObjOnSkiFacility($idSkiFacility);
            $mapSkipassTemp = [];
            foreach ($skipassObjs as $element) {
                $id = $element->getIdSkipassTemp();
                $skipassTemps = FPersistentManager::getInstance()->retriveSkipassTempOnId($id);
                $mapSkipassTemp[] =  [$skipassTemps[0]->getPeriod(), $skipassTemps[0]->getType()];
            }
            $view->makeABookingForm($idSkiFacility, $user[0], $today, $mapSkipassTemp, false);
        } else {
            CUser::home();
        }
    }

    public static function verifyaDate($selectedDate) {
        $selectedDate = new DateTime($selectedDate);
        $today = new DateTime();
        $currentYear = (int)$today->format('Y');
        $currentMonth = (int)$today->format('m');
    
        if($currentMonth >= 1 && $currentMonth <=3) {
            // Calcola i due range accettabili:
            // 1. Stagione invernale attuale (ottobre anno corrente -> marzo anno successivo)
            $startCurrentSeason = new DateTime(($currentYear - 1). "-10-01");
            $endCurrentSeason = new DateTime(($currentYear) . "-03-31");
        
            if (($selectedDate >= $startCurrentSeason && $selectedDate <= $endCurrentSeason)) {
                return true;
            } else 
                return false;
        } elseif($currentMonth >= 4 && $currentMonth <= 12) {
            $startCurrentSeason = new DateTime(($currentYear). "-10-01");
            $endCurrentSeason = new DateTime(($currentYear + 1) . "-03-31");
        
            if (($selectedDate >= $startCurrentSeason && $selectedDate <= $endCurrentSeason)) {
                return true;
            } else 
                return false;
        }
    }

    public static function warningToday($selectedDate, $idSkiFacility) {
        $today = new DateTime();
        if($selectedDate == $today) {
            $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($idSkiFacility);
            $status = $skiFacility[0]->getStatus();
            //0 è true per il php ma è chiuso per il database
            //se $status è 0 ovvero chiuso warningToday ritorna true
            //se $status è 1 ovvero aperto warningToday ritorna false
            return $status;
        } else {
            return false;
        }
    }

    public static function verifySubscription($selectedDate, $userId) {
        $subscriptionV = FPersistentManager::getInstance()->verifySubscriptionFromUserId($userId);
        if($subscriptionV) {
            $subscription = FPersistentManager::getInstance()->retriveSubscriptionFromUserId($userId);
            $startSubscription = $subscription[0]->getStartDate();
            $endSubscription = $subscription[0]->getEndDate();
            if($selectedDate >= $startSubscription && $selectedDate <= $endSubscription)
                return true;
            else    
                return false;
        } else 
            return false;
    }

    //DA MODIFICARE in base ai prezzi e ai pagamenti
    public static function confirmBooking() {
        if(CUser::isLogged()) {
            //controllare se la data scelta per la prenotazione appartiene alla finestra delle stagioni (verifyDate)
            //se la data scelta è oggi bisogna avvisare l'utente nel caso l'impianto scelto sia chiuso 
            //controllare se la copertura dell'abbonamento copre la data scelta e applicare lo sconto

            $view = new VUser();  
            $userId = USession::getInstance()->getSessionElement('user');
            $idSkiFacility = UHTTPMethods::post('idSkiFacility');
            $user = FPersistentManager::getInstance()->retriveObj(EUser::getEntity(), $userId);
            $today = date("Y-m-d");  
            $selectedDate = UHTTPMethods::post('date');
            
            if(!self::verifyaDate($selectedDate) || self::warningToday($selectedDate, $idSkiFacility)) {
                $skipassObjs = FPersistentManager::getInstance()->retriveSkipassObjOnSkiFacility($idSkiFacility);
                $mapSkipassTemp = [];
                foreach ($skipassObjs as $element) {
                    $id = $element->getIdSkipassTemp();
                    $skipassTemps = FPersistentManager::getInstance()->retriveSkipassTempOnId($id);
                    $mapSkipassTemp[] =  [$skipassTemps[0]->getPeriod(), $skipassTemps[0]->getType()];
                }
                $view->makeABookingForm($idSkiFacility, $user[0], $today, $mapSkipassTemp, true);
            } else {
                $name = UHTTPMethods::post('name');
                $surname = UHTTPMethods::post('surname');
                $email = UHTTPMethods::post('email');
                $period = UHTTPMethods::post('period');
                $type = UHTTPMethods::post('type');
                $skipassObjs = FPersistentManager::getInstance()->retriveSkipassObjOnSkiFacility($idSkiFacility);
                foreach ($skipassObjs as $element) {
                    $skipassTemp = FPersistentManager::getInstance()->retriveSkipassTempOnId($element->getIdSkipassTemp());
                    if($skipassTemp[0]->getType() == UHTTPMethods::post('type') && $skipassTemp[0]->getPeriod() == UHTTPMethods::post('period')) {
                        $value = $element->getValue();
                        $idSkipassObj = $element->getIdSkipassObj();
                    }
                }
                $skipassBooking = new ESkipassBooking($name, $surname, $selectedDate, $type, $email, $period, $value);
                $skipassBooking->setIdUser($userId);
                $skipassBooking->setIdSkipassObj($idSkipassObj);
                $cart[] = $skipassBooking;
                $totalPrice = $skipassBooking->getValue(); 
                $subscriptionV = FPersistentManager::getInstance()->verifySubscriptionFromUserId($userId);
                if($subscriptionV && self::verifySubscription($selectedDate, $userId)) {
                    $subscription = FPersistentManager::getInstance()->retriveSubscriptionFromUserId($userId);
                    $subscriptionTemp = FPersistentManager::getInstance()->retriveSubscriptionTempFromId($subscription[0]->getIdSubscriptionTemp());
                    $discount = $subscriptionTemp[0]->getDiscount();
                    $totalPrice = $totalPrice - (($totalPrice * $discount)/100);
                    $cart[] = $subscriptionTemp[0];
                }
                if(UHTTPMethods::post('insurance') == 'on') {
                    $insuranceTemp = FPersistentManager::getInstance()->retriveInsuranceTempFromType($type);  
                    $price = $insuranceTemp[0]->getValue();
                    if($period > 1)
                        $price = $price * $period;
                    $insurance = new EInsurance($name, $surname, $email, $type, $period, $price, $selectedDate);
                    $insurance->setIdUser($userId);
                    $totalPrice = $totalPrice + $price;
                    $cart[] = $insurance;
                }
                $verifyPreferredCreditCard = FPersistentManager::getInstance()->verifyPCreditCard($userId);
                USession::getInstance()->setSessionElement('cart', $cart);
                if($verifyPreferredCreditCard) {
                    $creditCard = FPersistentManager::getInstance()->retriveCreditCardFromUserId($userId);
                    $view->paymentSection($cart, $totalPrice, $creditCard[0], null);
                } else {
                    $today = date('YYYY-mm');
                    $view->paymentSection($cart, $totalPrice, null, $today);
                }
            }
            /* if(FPersistentManager::getInstance()->verifyBooking()) {
                
            } else {
                $view->bokkingError();
            } */
        } else {
            CUser::home();
        }
    }
    

    public static function payment() {
        if(CUser::isLogged()){ 
            $userId = USession::getInstance()->getSessionElement('user');
            $verifyPreferredCreditCard = FPersistentManager::getInstance()->verifyPCreditCard($userId);
            if($verifyPreferredCreditCard) { 
                $creditCard = FPersistentManager::getInstance()->retriveCreditCardFromUserId($userId);
                $cond = UHTTPMethods::post('cardHolderName') == $creditCard[0]->getCardHolderName() &&
                UHTTPMethods::post('cardHolderSurname') == $creditCard[0]->getCardHolderSurname() &&
                UHTTPMethods::post('expiryDate') == $creditCard[0]->getExpiryDate() && 
                UHTTPMethods::post('cardNumber') == $creditCard[0]->getCardNumber() &&
                UHTTPMethods::post('cvv') == $creditCard[0]->getCvv();
                if(!$cond) {
                    $creditCard = new ECreditCard(UHTTPMethods::post('cardHolderName'), UHTTPMethods::post('cardHolderSurname'), UHTTPMethods::post('expiryDate'), UHTTPMethods::post('cardNumber'), UHTTPMethods::post('cvv'));
                    if(UHTTPMethods::post('preferred') == 'on') 
                        $creditCard->setIdUser($userId);
                    else 
                        $creditCard->setIdUser(0);
                    FPersistentManager::getInstance()->updateCreditCard($creditCard);
                } else {
                    $creditCard = $creditCard[0];
                } 
            } else { 
                $creditCard = new ECreditCard(UHTTPMethods::post('cardHolderName'), UHTTPMethods::post('cardHolderSurname'), UHTTPMethods::post('expiryDate'), UHTTPMethods::post('cardNumber'), UHTTPMethods::post('cvv'));
                if(UHTTPMethods::post('preferred') == 'on')
                    $creditCard->setIdUser($userId);
                else 
                    $creditCard->setIdUser(0);
                FPersistentManager::getInstance()->uploadObj($creditCard);
            }
            if(USession::getInstance()->isSetSessionElement('cart')) {
                $cart = USession::getInstance()->getSessionElement('cart');
                $skipassBooking = $cart[0];
                $today = new DateTime();
                $price = $skipassBooking->getValue();
                if($cart[1] instanceof ESubscriptionTemp) {
                    $subscription = $cart[1];
                    $discount = $subscription->getDiscount();
                    $price = $price - (($price * $discount)/100);
                }
                $payment = new EPayment(get_class($skipassBooking), $price, $today->format('Y-m-d'));
                FPersistentManager::getInstance()->uploadObj($skipassBooking);
                $retrivedSkipassBooking = FPersistentManager::getInstance()->retriveSkipassBooking($skipassBooking);
                $idSkipassBooking = $retrivedSkipassBooking[0]->getIdSkipassBooking();
                $retrivedCreditCard = FPersistentManager::getInstance()->retriveCreditCard($creditCard);
                $idCreditCard = $retrivedCreditCard[0]->getIdCreditCard();
                $creditCard->setIdCreditCard($idCreditCard);
                $payment->setIdExternalObj($idSkipassBooking);
                $payment->setIdCreditCard($retrivedCreditCard[0]->getIdCreditCard());
                FPersistentManager::getInstance()->uploadObj($payment); 

                if($cart[2] != null && $cart[2] instanceof EInsurance) {
                    $insurance = $cart[2];
                    $payment = new EPayment(get_class($insurance), $insurance->getPrice(), $today->format('Y-m-d'));
                    FPersistentManager::getInstance()->uploadObj($insurance);
                    $insurance = FPersistentManager::getInstance()->retriveInsurance($insurance);
                    $payment->setIdExternalObj($insurance[0]->getIdInsurance());
                    $payment->setIdCreditCard($retrivedCreditCard[0]->getIdCreditCard());
                    FPersistentManager::getInstance()->uploadObj($payment);
                }
                
                USession::getInstance()->unsetSessionElement('cart');
            } 
            header('Location: /Slope/User/home');
        } else {
            CUser::home();
        }
    }

    public static function showBookings() {
        if(CUser::isLogged()){ 
            $bookedArray = [];
            $view = new VUser();  
            $userId = USession::getInstance()->getSessionElement('user');
            $allBookings = FPersistentManager::getInstance()->retriveAllSkipassBooking($userId);
           
            $bookings = [];
            if($allBookings instanceof ESkipassBooking) {
                $skipassObj = FPersistentManager::getInstance()->retriveSkipassObjOnId($allBookings->getIdSkipassObj());
                $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($skipassObj[0]->getIdSkiFacility());
                $idUser = $allBookings->getIdUser();
                $insurance = FPersistentManager::getInstance()->retriveInsuranceFromIdUserAndDate($idUser, $allBookings->getStartDate());
                $bookings[]['bookings'] = [$allBookings, $skiFacility[0], $insurance[0]]; 
                $bookedArray[] = $allBookings->getStartDate();
            } elseif (count($allBookings) > 0) {
                foreach ($allBookings as $element) {
                    $bookedArray[] = $element->getStartDate();
                    $skipassObj = FPersistentManager::getInstance()->retriveSkipassObjOnId($element->getIdSkipassObj());
                    $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($skipassObj[0]->getIdSkiFacility());
                    $idUser = $element->getIdUser();
                    $insurance = FPersistentManager::getInstance()->retriveInsuranceFromIdUserAndDate($idUser, $element->getStartDate());
                    if(count($insurance) > 0)
                    $bookings[]['bookings'] = [$element, $skiFacility[0], $insurance[0]]; 
                    else   
                    $bookings[]['bookings'] = [$element, $skiFacility[0], $insurance]; 
                }
            }
            
            $month = isset($_POST['month']) ? $_POST['month'] : date('m');
            $year = isset($_POST['year']) ? $_POST['year'] : date('Y');

            // Converto a interi
            $month = (int)$month;
            $year = (int)$year;

            // Mese precedente
            $prevMonth = $month - 1;
            $prevYear = $year;
            if ($prevMonth < 1) {
                $prevMonth = 12;
                $prevYear--;
            }

            // Mese successivo
            $nextMonth = $month + 1;
            $nextYear = $year;
            if ($nextMonth > 12) {
                $nextMonth = 1;
                $nextYear++;
            }

            // Genera calendario
            $firstDay = mktime(0, 0, 0, $month, 1, $year);
            $daysInMonth = date('t', $firstDay);

            // Inizia da lunedì: trasformiamo il valore di date('w')
            $startDay = date('w', $firstDay); // 0 = Sunday, ..., 6 = Saturday
            $startDay = ($startDay == 0) ? 6 : $startDay - 1; // Ora 0 = Monday, ..., 6 = Sunday

            $monthName = date('F', $firstDay);

            // Calcola i giorni del mese precedente
            $daysInPrevMonth = date('t', mktime(0, 0, 0, $prevMonth, 1, $prevYear));

            $calendar = [];
            $week = array_fill(0, 7, '');

            // Aggiungi i giorni del mese precedente (es. 28, 29, 30...)
            for ($i = $startDay - 1; $i >= 0; $i--) {
                $week[$i] = $daysInPrevMonth - ($startDay - 1 - $i);
            }

            // Aggiungi i giorni del mese corrente
            $day = 1;
            for ($i = $startDay; $day <= $daysInMonth; $i++) {
                $week[$i % 7] = $day++;

                // Quando raggiungi domenica (indice 6), aggiungi la settimana e ricomincia
                if ($i % 7 == 6 || $day > $daysInMonth) {
                    $calendar[] = $week;
                    $week = array_fill(0, 7, '');
                }
            }

            $highlightDays = [];
            $idForDate = [];
            
            foreach ($bookedArray as $dateStr) {
                $timestamp = strtotime($dateStr);
                $inputYear = (int)date('Y', $timestamp);
                $inputMonth = (int)date('m', $timestamp);
                $inputDay = (int)date('d', $timestamp);

                // Se è nel mese/anno visualizzato, aggiungi il giorno da evidenziare
                if ($inputYear === $year && $inputMonth === $month) {
                    $highlightDays[] = $inputDay;
                    $idForDate[$inputDay] = [];
                    foreach ($bookings as $i) {
                        $booking = $i['bookings'][0];
                        $bookingYear = substr($booking->getStartDate(), 0, 4);
                        $bookingMonth = substr($booking->getStartDate(), 5, 2);
                        $bookingDay = substr($booking->getStartDate(), 8, 2);
                        if($inputDay == $bookingDay && $inputMonth == $bookingMonth && $inputYear == $bookingYear) {
                            $skipassObj = FPersistentManager::getInstance()->retriveSkipassObjOnId($booking->getIdSkipassObj());
                            $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($skipassObj[0]->getIdSkiFacility());
                            $idForDate[$inputDay] = [$booking->getIdSkipassBooking(), $skiFacility[0]->getName()];
                        }
                        
                    }
                }
            }
            $today = new DateTime();
            $oldBookings = [];
            $futureBookings = [];
            foreach ($bookings as $element) {
                if(new DateTime($element['bookings'][0]->getStartDate()) >= $today)
                    $futureBookings[] = $element;
                else
                    $oldBookings[] = $element;
            }
        //print_r($highlightDays);
        $view->showBookings($futureBookings, $monthName, $year, $calendar, $prevMonth, $prevYear, $nextMonth, $nextYear, $highlightDays, $idForDate, $oldBookings);
        } else {
            CUser::home();
        }
    }







    public static function modifySkipassBooking() {
        if(CUser::isLogged()) {
            $view = new VUser();
            $userId = USession::getInstance()->getSessionElement('user');
            $idSkipassBooking = UHTTPMethods::post('idSkipassBooking');
            $skipassBooking = FPersistentManager::getInstance()->retriveSkipassBookingOnId($idSkipassBooking);
            $insurance = FPersistentManager::getInstance()->retriveInsuranceFromIdUSerAndDate($userId, $skipassBooking[0]->getStartDate());
            $today = new DateTime();
            if($skipassBooking !== null)
            USession::getInstance()->setSessionElement('skipassBooking', $skipassBooking);
            $view->modifySkipassBooking($skipassBooking[0], $today->format('Y-m-d'), false, $insurance);
        } else {
            CUser::home();
        }
    }

    public static function confirmModifyBooking() : void{
        if(CUser::isLogged()){
            $view = new VUser();
            $userId = USession::getInstance()->getSessionElement('user');
            if(self::verifyaDate(UHTTPMethods::post('date'))) {
                $skipassBooking = USession::getSessionElement('skipassBooking');
                //bisogna modificare questo oggetto sul db
                $newSkipassBooking = new ESkipassBooking($skipassBooking[0]->getName(), $skipassBooking[0]->getSurname(), UHTTPMethods::post('date'), $skipassBooking[0]->getType(), $skipassBooking[0]->getEmail(), $skipassBooking[0]->getPeriod(), $skipassBooking[0]->getValue());
                $newSkipassBooking->setIdSkipassBooking($skipassBooking[0]->getIdSkipassBooking());
                $newSkipassBooking->setIdSkipassObj($skipassBooking[0]->getIdSkipassObj());
                $newSkipassBooking->setIdUser($skipassBooking[0]->getIdUser());
                FPersistentManager::getInstance()->updateSkipassBookingInfo($newSkipassBooking);
                
                $insurance = FPersistentManager::getInstance()->retriveInsuranceFromIdUSerAndDate($userId, $skipassBooking[0]->getStartDate());
                if(count($insurance) > 0) {
                    $newInsurance = new EInsurance($insurance[0]->getName(), $insurance[0]->getSurname(), $insurance[0]->getEmail(), $insurance[0]->getType(), $insurance[0]->getPeriod(), $insurance[0]->getPrice(), UHTTPMethods::post('date'));
                    $newInsurance->setIdInsurance($insurance[0]->getIdInsurance());
                    $newInsurance->setIdUser($skipassBooking[0]->getIdUser());
                    FPersistentManager::getInstance()->updateInsuranceInfo($newInsurance);
                }
                USession::getInstance()->unsetSessionElement('skipassBooking');
                CUser::home();
            } else {
                $view = new VUser();
                $userId = USession::getInstance()->getSessionElement('user');
                $skipassBooking = USession::getSessionElement('skipassBooking');
                $idSkipassBooking = $skipassBooking[0]->getIdSkipassBooking();
                $skipassBooking = FPersistentManager::getInstance()->retriveSkipassBookingOnId($idSkipassBooking);
                $insurance = FPersistentManager::getInstance()->retriveInsuranceFromIdUSerAndDate($userId, $skipassBooking[0]->getStartDate());
                $today = new DateTime();
                $view->modifySkipassBooking($skipassBooking[0], $today->format('Y-m-d'), false, $insurance);
            }
        } else {
            CUser::home();
        }
    }

    public static function deleteSkipassBooking() {
        if(CUser::isLogged()) {
            FPersistentManager::getInstance()->deleteSkipassBooking(UHTTPMethods::post('idSkipassBooking'));
            header('Location: /Slope/User/home');
        } else {
            CUser::home();
        }
    }   

    public static function buySubscription() {
        if(CUser::isLogged()) {
            $view = new VUser();
            $userId = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveObj(EUser::getEntity(), $userId);
            $today = new DateTime();
            $currentYear = (int)$today->format('Y');
            $currentMonth = (int)$today->format('m');
        
            if($currentMonth >= 1 && $currentMonth <=3) {
                // Calcola i due range accettabili:
                // 1. Stagione invernale attuale (ottobre anno precedente -> marzo anno corrente)
                $startCurrentSeason = new DateTime(($currentYear - 1). "-10-01");
                $endCurrentSeason = new DateTime(($currentYear) . "-03-31");
            
            } elseif($currentMonth >= 4 && $currentMonth <= 12) {
                // 1. Stagione invernale successiva o attuale  (ottobre anno corrente-> marzo anno successivo)
                $startCurrentSeason = new DateTime(($currentYear). "-10-01");
                $endCurrentSeason = new DateTime(($currentYear + 1) . "-03-31");
            
            }
            $view->makeASubscriptionForm($user[0], $startCurrentSeason->format("d-m-y"), $endCurrentSeason->format("d-m-y"));
        } else {
            CUser::home();
        }
    }

    public static function confirmSubscription() {
        if(CUser::isLogged()) {
            $view = new VUser();
            $userId = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveObj(EUser::getEntity(), $userId);
            $name = UHTTPMethods::post('name');
            $surname = UHTTPMethods::post('surname');
            $email = UHTTPMethods::post('email');
            $startDate = UHTTPMethods::post('startDate');
            $endDate = UHTTPMethods::post('endDate');
            $subscription = new ESubscription($name, $surname, $email, $startDate, $endDate);
            $subscription->setIdUser($userId);
            $subscription->setIdSubscription(1);
            $verifyPreferredCreditCard = FPersistentManager::getInstance()->verifyPCreditCard($userId);
            $subscriptionTemp = FPersistentManager::getInstance()->retriveSubscriptionTempFromId(1);
            USession::getInstance()->setSessionElement('subscription', $subscription);
            if($verifyPreferredCreditCard) {
                $creditCard = FPersistentManager::getInstance()->retriveCreditCardFromUserId($userId);
                $view->subscriptionPaymentSection($subscription, $subscriptionTemp[0]->getValue(), $creditCard[0]);
            } else {
                $view->subscriptionPaymentSection($subscription, $subscriptionTemp[0]->getValue(), null);
            }
        } else {
            CUser::home();
        }
    } 

    public static function buyInsurance() {
        if(CUser::isLogged()) {
            $view = new VUser();
            $userId = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveObj(EUser::getEntity(), $userId);
            $idSkipassBooking = UHTTPMethods::post('idSkipassBooking');
            $skipassBooking  = FPersistentManager::getInstance()->retriveSkipassBookingOnId($idSkipassBooking);
            USession::setSessionElement('idSkipassBooking', $idSkipassBooking);
            $date = $skipassBooking[0]->getStartDate();
            $period = $skipassBooking[0]->getPeriod();
            $view->makeAInsuranceForm($user[0], $date, $period, false);
        } else {
            CUser::home();
        }
    }

    public static function confirmInsurance() {
        if(CUser::isLogged()) {
            $view = new VUser();
            $userId = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveObj(EUser::getEntity(), $userId);
            $selectedDate = UHTTPMethods::post('date');
            $name = UHTTPMethods::post('name');
            $surname = UHTTPMethods::post('surname');
            $email = UHTTPMethods::post('email');
            $idSkipassBooking = USession::getSessionElement('idSkipassBooking');
            USession::unsetSessionElement('idSkipassBooking');
            $skipassBooking = FPersistentManager::getInstance()->retriveSkipassBookingOnId($idSkipassBooking);
            $type = $skipassBooking[0]->getType();
            $period = $skipassBooking[0]->getPeriod();
            if(!self::verifyaDate($selectedDate)) {
                $view->makeAInsuranceForm($user[0], $selectedDate, $period, true);
            }
            $insuranceTemp = FPersistentManager::getInstance()->retriveInsuranceTempFromType($type);  
            $price = $insuranceTemp[0]->getValue();
            if($period > 1)
                $price = $price * $period;
            $insurance = new EInsurance($name, $surname, $email, $type, $period, $price, $selectedDate);
            $insurance->setIdUser($userId);
            USession::getInstance()->setSessionElement('insurance', $insurance);
            $verifyPreferredCreditCard = FPersistentManager::getInstance()->verifyPCreditCard($userId); 
            if($verifyPreferredCreditCard) {
                $creditCard = FPersistentManager::getInstance()->retriveCreditCardFromUserId($userId);
                $view->insurancePaymentSection($insurance, $price, $creditCard[0]);
            } else {
                $view->insurancePaymentSection($insurance, $price, null);
            }
        } else {
            CUser::home();
        }
    }

    public static function insurancePayment() {
        if(CUser::isLogged()){ 
            $userId = USession::getInstance()->getSessionElement('user');
            $verifyPreferredCreditCard = FPersistentManager::getInstance()->verifyPCreditCard($userId);
            if($verifyPreferredCreditCard) { 
                $creditCard = FPersistentManager::getInstance()->retriveCreditCardFromUserId($userId);
                $cond = UHTTPMethods::post('cardHolderName') == $creditCard[0]->getCardHolderName() &&
                UHTTPMethods::post('cardHolderSurname') == $creditCard[0]->getCardHolderSurname() &&
                UHTTPMethods::post('expiryDate') == $creditCard[0]->getExpiryDate() && 
                UHTTPMethods::post('cardNumber') == $creditCard[0]->getCardNumber() &&
                UHTTPMethods::post('cvv') == $creditCard[0]->getCvv();
                if(!$cond) {
                    $creditCard = new ECreditCard(UHTTPMethods::post('cardHolderName'), UHTTPMethods::post('cardHolderSurname'), UHTTPMethods::post('expiryDate'), UHTTPMethods::post('cardNumber'), UHTTPMethods::post('cvv'));
                    if(UHTTPMethods::post('preferred') == 'on') 
                        $creditCard->setIdUser($userId);
                    else 
                        $creditCard->setIdUser(0);
                    FPersistentManager::getInstance()->updateCreditCard($creditCard);
                } 
            } else { 
                $creditCard = new ECreditCard(UHTTPMethods::post('cardHolderName'), UHTTPMethods::post('cardHolderSurname'), UHTTPMethods::post('expiryDate'), UHTTPMethods::post('cardNumber'), UHTTPMethods::post('cvv'));
                if(UHTTPMethods::post('preferred') == 'on')
                    $creditCard->setIdUser($userId);
                else 
                    $creditCard->setIdUser(0);
                FPersistentManager::getInstance()->uploadObj($creditCard);
            }
            $today = new DateTime();
            $insurance = USession::getSessionElement('insurance');
            $payment = new EPayment(get_class($insurance), $insurance->getPrice(), $today->format('Y-m-d'));
            FPersistentManager::getInstance()->uploadObj($insurance);
            $retrivedInsurance = FPersistentManager::getInstance()->retriveInsurance($insurance);
            $payment->setIdExternalObj($retrivedInsurance[0]->getIdInsurance());
            $payment->setIdCreditCard($creditCard[0]->getIdCreditCard());
            FPersistentManager::getInstance()->uploadObj($payment);
            USession::unsetSessionElement('insurance');
            header('Location: /Slope/User/home');
        } else {
            CUser::home();
        }
    }

    public static function subscriptionPayment() {
        if(CUser::isLogged()){ 
            $userId = USession::getInstance()->getSessionElement('user');
            $verifyPreferredCreditCard = FPersistentManager::getInstance()->verifyPCreditCard($userId);
            if($verifyPreferredCreditCard) { 
                $creditCard = FPersistentManager::getInstance()->retriveCreditCardFromUserId($userId);
                $cond = UHTTPMethods::post('cardHolderName') == $creditCard[0]->getCardHolderName() &&
                UHTTPMethods::post('cardHolderSurname') == $creditCard[0]->getCardHolderSurname() &&
                UHTTPMethods::post('expiryDate') == $creditCard[0]->getExpiryDate() && 
                UHTTPMethods::post('cardNumber') == $creditCard[0]->getCardNumber() &&
                UHTTPMethods::post('cvv') == $creditCard[0]->getCvv();
                if(!$cond) {
                    $creditCard = new ECreditCard(UHTTPMethods::post('cardHolderName'), UHTTPMethods::post('cardHolderSurname'), UHTTPMethods::post('expiryDate'), UHTTPMethods::post('cardNumber'), UHTTPMethods::post('cvv'));
                    if(UHTTPMethods::post('preferred') == 'on') 
                        $creditCard->setIdUser($userId);
                    else 
                        $creditCard->setIdUser(0);
                    FPersistentManager::getInstance()->updateCreditCard($creditCard);
                } 
            } else { 
                $creditCard = new ECreditCard(UHTTPMethods::post('cardHolderName'), UHTTPMethods::post('cardHolderSurname'), UHTTPMethods::post('expiryDate'), UHTTPMethods::post('cardNumber'), UHTTPMethods::post('cvv'));
                if(UHTTPMethods::post('preferred') == 'on')
                    $creditCard->setIdUser($userId);
                else 
                    $creditCard->setIdUser(0);
                FPersistentManager::getInstance()->uploadObj($creditCard);
            }
            $today = new DateTime();
            $subscription = USession::getSessionElement('subscription');
            $subscriptionTemp = FPersistentManager::getInstance()->retriveSubscriptionTempFromId(1);
            $payment = new EPayment(get_class($subscription), $subscriptionTemp[0]->getValue(), $today->format('Y-m-d'));
            FPersistentManager::getInstance()->uploadObj($subscription);
            $retrivedSubscription = FPersistentManager::getInstance()->retriveSubscription($subscription);
            $payment->setIdExternalObj($retrivedSubscription[0]->getIdSubscription());
            $payment->setIdCreditCard($creditCard[0]->getIdCreditCard());
            FPersistentManager::getInstance()->uploadObj($payment);
            USession::unsetSessionElement('subscription');
            header('Location: /Slope/User/home');
        } else {
            CUser::home();
        }
    }
    
}

?>