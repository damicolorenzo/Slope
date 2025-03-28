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
            header('Location: /Slope/User/home');
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
        USession::unsetSession();
        USession::destroySession();
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
        $username = FPersistentManager::getInstance()->verifyUserUsername(UHTTPMethods::post('username'));                                            
        if($username){
            $user = FPersistentManager::getInstance()->retriveUserOnUsername(UHTTPMethods::post('username'));
            if(password_verify(UHTTPMethods::post('password'), $user[0]->getPassword())){
                if(USession::getSessionStatus() == PHP_SESSION_NONE){
                    USession::getInstance();
                    USession::setSessionElement('user', $user[0]->getId());
                    header('Location: /Slope/User/loggedHome');
                }
            }else{
                $view->showLoginForm(true);
            }
        }else{
            $view->showLoginForm(true);
        }
    }

    /**
     * Method to retrive from the database all the data showed in the home of a logged user
     * @return void
     */
    public static function loggedH() : array{
        print_r(USession::getAllSessionElements());
        USession::unsetSessionElement('cart');
        $result = array();
        $allSkiFacilities = FPersistentManager::getInstance()->retriveAllSkiFacilities();
        foreach ($allSkiFacilities as $skiFacility) {
           $app = array();
           $idskiFacility = $skiFacility->getIdSkiFacility();
           $app[] = $skiFacility->getName();    
           $app[] = FPersistentManager::getInstance()->typeAndNumberSkiRun($idskiFacility); // Tabella con tipologia_pista e numero per ogni impianto 
           $app[] = FPersistentManager::getInstance()->retriveNLiftStructures($idskiFacility);
           $result[] = $app;
        }
        return $result;
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
            $viewA = new VAdmin();
            $viewA->dashboard();
        } else {
            $allSkiFacilities = FPersistentManager::getInstance()->retriveAllSkiFacilities();
            $view->home($allSkiFacilities);
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
        if(FPersistentManager::getInstance()->verifyUserEmail(UHTTPMethods::post('email')) == false && FPersistentManager::getInstance()->verifyUserUsername(UHTTPMethods::post('username')) == false) {
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
            if (!$phoneError && !$dateError && !$passwordError) {
                $user = new EUser(UHTTPMethods::post('name'), UHTTPMethods::post('surname'), UHTTPMethods::post('email'), $phoneNumber, UHTTPMethods::post('birthDate'), UHTTPMethods::post('username'), password_hash(UHTTPMethods::post('password'), PASSWORD_DEFAULT));
                $user->setIdImage(0);
                FPersistentManager::getInstance()->uploadObj($user);
                $map = CUser::loggedH();
                $view->loggedHome($map);
            } else {
                $view->someError($phoneError, $dateError, $passwordError, UHTTPMethods::allPost());
            }
        } else {
            $view->userAlreadyExist();
        }
    }

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
            $insuranceImage = false;
            $subscriptionImage = false;
            $view->profileInfo($username, $name, $surname, $email, $phoneNumber, $birthDate, $image, $insuranceImage, $subscriptionImage);
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
            $idImage = $user[0]->getIdImage();
            if($idImage == 0) 
                $view->modifyProfile($username, $name, $surname, $email, $phoneNumber, $birthDate, false, false, false);
            else 
                $view->modifyProfile($username, $name, $surname, $email, $phoneNumber, $birthDate, false, false, true);
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
            $view = new VUser();
            $userId = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
            $username = $user[0]->getUsername(); 
            $name = $user[0]->getName();
            $surname = $user[0]->getSurname();
            $birthDate = $user[0]->getBirthDate();
            $idImage = $user[0]->getIdImage();
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
            if($idImage == 0)
                $image = false;
            else    
                $image = true;
            if($phoneError) 
                $view->modifyProfile($username, $name, $surname, $modifiedEmail, $modifiedPhoneNumber, $birthDate, $phoneError, false, $image);
            else {
                $person = new EPerson($name, $surname, $modifiedEmail, $modifiedPhoneNumber, $birthDate);
                $person->setId($userId);
                FPersistentManager::getInstance()->updatePersonInfo($person);
                header('Location: /Slope/User/profile');
            }
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
            if(UHTTPMethods::files('imageFile','size') > 0){
                $uploadedImage = UHTTPMethods::files('imageFile');
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
                        header('Location: /Slope/User/profile');
                    }else{
                        $user[0]->setIdImage($check->getId());
                        FPersistentManager::getInstance()->updateUserIdImage($user[0]);
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
            header('Location: /Slope/User/profile');
        } else {
            CUser::home();
        }
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
            /* 
            ESkipassObj Object ( 
                [idSkipassObj:ESkipassObj:private] => 1 
                [description:ESkipassObj:private] => giornaliero Roccaraso 
                [value:ESkipassObj:private] => 35 
                [idSkiFacility:ESkipassObj:private] => 1 
                [idSkipassTemp:ESkipassObj:private] => 1 
            ) */
            $skipassTemps_period = [];
            $skipassTemps_type = []; 
            foreach ($skipassObjs as $element) {
                $id = $element->getIdSkipassTemp();
                $skipassTemps = FPersistentManager::getInstance()->retriveSkipassTempOnId($id);
                $skipassTemps_period[] = $skipassTemps[0]->getPeriod();
                $skipassTemps_type[] = $skipassTemps[0]->getType();
            }
            $view->makeABookingForm($idSkiFacility, $user[0], $today, $skipassTemps_period, $skipassTemps_type, false);
        } else {
            CUser::home();
        }
    }

    //DA MODIFICARE in base ai prezzi e ai pagamenti
    public static function confirmBooking() {
        if(CUser::isLogged()){
            $view = new VUser();  
            $userId = USession::getInstance()->getSessionElement('user');
            $idSkiFacility = UHTTPMethods::post('idSkiFacility');
            $user = FPersistentManager::getInstance()->retriveObj(EUser::getEntity(), $userId);
            $today = date("Y-m-d");  
            $selectedDate = UHTTPMethods::post('date');
            
            if(!self::verifyaDate($selectedDate)) {
                $skipassObjs = FPersistentManager::getInstance()->retriveSkipassObjOnSkiFacility($idSkiFacility);
                $skipassTemps_period = [];
                $skipassTemps_type = []; 
                foreach ($skipassObjs as $element) {
                    $id = $element->getIdSkipassTemp();
                    $skipassTemps = FPersistentManager::getInstance()->retriveSkipassTempOnId($id);
                    $skipassTemps_period[] = $skipassTemps[0]->getPeriod();
                    $skipassTemps_type[] = $skipassTemps[0]->getType();
                }
                $view->makeABookingForm($idSkiFacility, $user[0], $today, $skipassTemps_period, $skipassTemps_type, true);
            }
            $name = UHTTPMethods::post('name');
            $surname = UHTTPMethods::post('surname');
            $type = UHTTPMethods::post('type');
            $period = UHTTPMethods::post('period');
            $email = UHTTPMethods::post('email');
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
            $totalPrice = $skipassBooking->getValue(); 
            if(UHTTPMethods::post('insurance') == 'on') {
                $insuranceTemp = FPersistentManager::getInstance()->retriveInsuranceTempFromType($type);  
                $price = $insuranceTemp[0]->getValue();
                $insurance = new EInsurance($name, $surname, $email, $type, $period, $price, $selectedDate);
                $insurance->setIdUser($userId);
                //USession::getInstance()->setSessionElement('insurance', $insurance);
                $cart = [$skipassBooking, $insurance];
                $totalPrice = $totalPrice + $price;
            } else {
                $cart = [$skipassBooking];
            }
            $verifyPreferredCreditCard = FPersistentManager::getInstance()->verifyPCreditCard($userId);
            USession::getInstance()->setSessionElement('cart', $cart);
            if($verifyPreferredCreditCard) {
                $creditCard = FPersistentManager::getInstance()->retriveCreditCardFromUserId($userId);
                $view->paymentSection($cart, $totalPrice, $creditCard[0]);
            } else {
                $view->paymentSection($cart, $totalPrice, null);
            }
            /* if(FPersistentManager::getInstance()->verifyBooking()) {
                
            } else {
                $view->bokkingError();
            } */
        

        } else {
            CUser::home();
        }
    }
    
    public static function verifyaDate($selectedDate) {
        $selectedDate = new DateTime($selectedDate);
        // Ottieni la data attuale
        $today = new DateTime();
        $currentMonth = (int)$today->format('m');
        $currentYear = (int)$today->format('Y');
        // Determina il range valido
        if ($currentMonth >= 10) { // Tra Ottobre e Dicembre
            $base = new DateTime("$currentYear-10-01"); // 1 Ottobre anno corrente
            $end = new DateTime(($currentYear + 1) . "-03-31"); // 31 Marzo anno successivo
        } else { // Tra Gennaio e Marzo
            $base = new DateTime(($currentYear - 1) . "-10-01"); // 1 Ottobre anno precedente
            $end = new DateTime("$currentYear-03-31"); // 31 Marzo anno corrente
        }
        
        if ($selectedDate >= $base && $selectedDate <= $end) {
            return true;
        } else {
            return false;
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
                $payment = new EPayment(get_class($skipassBooking), $skipassBooking->getValue(), $today->format('Y-m-d'));
                FPersistentManager::getInstance()->uploadObj($skipassBooking);
                $retrivedSkipassBooking = FPersistentManager::getInstance()->retriveSkipassBooking($skipassBooking);
                $idSkipassBooking = $retrivedSkipassBooking[0]->getIdSkipassBooking();
                $retrivedCreditCard = FPersistentManager::getInstance()->retriveCreditCard($creditCard[0]);
                $idCreditCard = $retrivedCreditCard[0]->getIdCreditCard();
                $creditCard[0]->setIdCreditCard($idCreditCard);
                $payment->setIdExternalObj($idSkipassBooking);
                $payment->setIdCreditCard($retrivedCreditCard[0]->getIdCreditCard());
                FPersistentManager::getInstance()->uploadObj($payment); 

                if($cart[1] != null) {
                    $insurance = $cart[1];
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
            } elseif (count($allBookings) > 0) {
                foreach ($allBookings as $element) {
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
            $view->showBookings($bookings);
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
                $newInsurance = new EInsurance($insurance[0]->getName(), $insurance[0]->getSurname(), $insurance[0]->getEmail(), $insurance[0]->getType(), $insurance[0]->getPeriod(), $insurance[0]->getPrice(), UHTTPMethods::post('date'));
                $newInsurance->setIdInsurance($insurance[0]->getIdInsurance());
                $newInsurance->setIdUser($skipassBooking[0]->getIdUser());
                FPersistentManager::getInstance()->updateInsuranceInfo($newInsurance);
                USession::getInstance()->unsetSessionElement('skipassBooking');

                header('Location: /Slope/User/home');
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
            $today = date("Y-m-d");
            $view->makeASubscriptionForm($user[0], $today, false);
        } else {
            CUser::home();
        }
    }

    public static function confirmSubscription() {
        if(CUser::isLogged()) {
            
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
            USession::setSessionElement('idSkipassBooking', $idSkipassBooking);
            $today = date("Y-m-d");
            $view->makeAInsuranceForm($user[0], $today, false);
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
            $today = date("Y-m-d");
            $name = UHTTPMethods::post('name');
            $surname = UHTTPMethods::post('surname');
            $email = UHTTPMethods::post('email');
            $idSkipassBooking = USession::getSessionElement('idSkipassBooking');
            USession::unsetSessionElement('idSkipassBooking');
            $skipassBooking = FPersistentManager::getInstance()->retriveSkipassBookingOnId($idSkipassBooking);
            $type = $skipassBooking[0]->getType();
            $period = $skipassBooking[0]->getPeriod();
            if(!self::verifyaDate($selectedDate)) {
                $view->makeAInsuranceForm($user[0], $today, false);
            }
            $insuranceTemp = FPersistentManager::getInstance()->retriveInsuranceTempFromType($type);  
            $price = $insuranceTemp[0]->getValue();
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
    
}

?>