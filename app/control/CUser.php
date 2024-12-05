<?php

/*
richiede il file nella posizione __DIR__ [ovvero posizione di questo specifico file (CUser.php)] concatenata con 
"\\..\\config\\autoloader.php" per arrivare alla posizione finale partendo da __DIR__.
I doppi punti sono utilizzati per andare indietro di una cartella quindi da control uscire ed andare a app
*/ 
require_once (__DIR__."\\..\\config\\autoloader.php");

class CUser {

    /*
    Questa funzione viene chiamata di default dal CFrontController se nella barra di ricerca immettiamo 
    semplicemente Slope.
    La porzione commentata all'intero è un copia e incolla del metodo di Agora-main
    */
    public static function home() {
        //creazione di un oggetto VUser
        $view = new VUser();
        if(CUser::isLogged()){
            /* $userId = USession::getInstance()->getSessionElement('user');
            $userAndPropic = FPersistentManager::getInstance()->loadUsersAndImage($userId);

            //load all the posts of the users who you follow(post have user attribute) and the profile pic of the author of teh post
            $postInHome = FPersistentManager::getInstance()->loadHomePage($userId);
            
            //load the VIP Users, their profile Images and the foillower number
            $arrayVipUserPropicFollowNumb = FPersistentManager::getInstance()->loadVip(); */
        
            /* 
                chiamata loggedH(); che carica i dati sugli impianti da mostrare  
                */
            $map = CUser::loggedH();
            $view->loggedHome($map); 
        } else {
            //chiamata alla funzione home di VUser (prima di andare avanti con questo file saltare al file VUser \view\VUser.php)
            $view->home();
        }
    }

    /*
    Tutte le funzioni presenti qui sotto sono copiate dal progetto Agora-main poiché effettuano dei compiti 
    identici in qualisiasi progetto quindi non hanno bisogno di molta personalizzazione (C'è poca voglia di riscriverle da zero) 
    */

    public static function registration() {
        $view = new VUser();
        $view->showRegistrationForm();
    }

    public static function checkRegistration() {
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
                $user->setIdImage(1);
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

    public static function loggedH() {
        /* Va popolato l'array con gli oggetti non con altri array */
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




        /* $idskiFacilities = FPersistentManager::getInstance()->retriveIdSkiFacilities(); // Array con id impianti 
        foreach($idskiFacilities as $element) {
            $nameSkiFacility = FPersistentManager::getInstance()->nameSkiFacility($element['idSkiFacility']); // Nome dell'impianto 
            $countskiRuns = FPersistentManager::getInstance()->typeAndNumberSkiRun($element['idSkiFacility']); // Tabella con tipologia_pista e numero per ogni impianto 
            //print_r($countskiRuns);
            $countliftStructures = FPersistentManager::getInstance()->retriveNLiftStructures($element['idSkiFacility']);
            //print_r($countliftStructures);
            $map[] = [$nameSkiFacility, $countskiRuns, $countliftStructures];
        }
        //print_r($map); */
        return $result;
    }
    

    public static function login(){
        if(UCookie::isSet('PHPSESSID')){
            if(session_status() == PHP_SESSION_NONE){
                USession::getInstance();
            }
        }
        if(USession::isSetSessionElement('user')){
            header('Location: /Slope/User/home');
        }
        $view = new VUser();
        $view->showLoginForm();
    }

    public static function logout(){
        USession::getInstance();
        USession::unsetSession();
        USession::destroySession();
        header('Location: /Slope/');
    }

    

    public static function isLogged() {
        $logged = false;

        if(UCookie::isSet('PHPSESSID')){
            if(session_status() == PHP_SESSION_NONE){
                USession::getInstance();
            }
        }
        if(USession::isSetSessionElement('user')){
            $logged = true;
        }
        return $logged;
    }

    /**
     * check if exist the Username inserted, and for this username check the password. If is everything correct the session is created and
     * the User is redirected in the homepage
     */
    public static function checkLogin(){
        $view = new VUser();
        $username = FPersistentManager::getInstance()->verifyUserUsername(UHTTPMethods::post('username'));                                            
        if($username){
            $user = FPersistentManager::getInstance()->retriveUserOnUsername(UHTTPMethods::post('username'));
            if(password_verify(UHTTPMethods::post('password'), $user->getPassword())){
                if(USession::getSessionStatus() == PHP_SESSION_NONE){
                    USession::getInstance();
                    USession::setSessionElement('user', $user->getId());
                    header('Location: /Slope/User/loggedHome');
                }
            }else{
                $view->loginError();
            }
        }else{
            $view->loginError();
        }
    }

    public static function profile() {
        if(CUser::isLogged()){
            $view = new VUser();
            $userId = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
            $username = $user->getUsername(); 
            $name = $user->getName();
            $surname = $user->getSurname();
            $email = $user->getEmail();
            $phoneNumber = $user->getPhoneNumber();
            $birthDate = $user->getBirthDate();
            $idImage = $user->getIdImage();
            $image = FPersistentManager::getInstance()->retriveImageOnId($idImage);
            $view->profileInfo($username, $name, $surname, $email, $phoneNumber, $birthDate, $image);
        }
    }

    public static function modifyProfile() {
        if(CUser::isLogged()){
            $view = new VUser();
            $userId = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
            $username = $user->getUsername(); 
            $name = $user->getName();
            $surname = $user->getSurname();
            $email = $user->getEmail();
            $phoneNumber = $user->getPhoneNumber();
            $birthDate = $user->getBirthDate();
            //$idImage = $user->getIdImage();
            $view->modifyProfile($username, $name, $surname, $email, $phoneNumber, $birthDate, false, false);
        }
    }

    public static function confirmModify() {
        if(CUser::isLogged()){
            $view = new VUser();
            $userId = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
            $username = $user->getUsername(); 
            $name = $user->getName();
            $surname = $user->getSurname();
            $email = $user->getEmail();
            $phoneNumber = $user->getPhoneNumber();
            $birthDate = $user->getBirthDate();
            $idImage = $user->getIdImage();
            $modifiedEmail = UHTTPMethods::post('email');
            $modifiedPhoneNumber = UHTTPMethods::post('phoneNumber');
            $phone_number_validation_regex = "/^\\+?[1-9][0-9]{7,14}$/"; 
            if(!preg_match($phone_number_validation_regex, UHTTPMethods::post('phoneNumber'))) {
                $phoneError = true;
            } else {
                $phoneError = false;
                $extract_phone_number_pattern = "/\\+?[1-9][0-9]{7,14}/";
                preg_match_all($extract_phone_number_pattern, UHTTPMethods::post('phoneNumber'), $matches);
                $modifiedPhoneNumber = implode($matches[0]);
            }
            if(UHTTPMethods::files('imageFile','size') > 0){
                $uploadedImage = UHTTPMethods::files('imageFile');
                $check = FPersistentManager::getInstance()->uploadImage($uploadedImage);
                if($check == 'UPLOAD_ERROR_OK' || $check == 'TYPE_ERROR' || $check == 'SIZE_ERROR') {
                    $checkImageError = true;
                } else {
                    $checkImageError = false;
                    $idImage = FPersistentManager::getInstance()->uploadObj($check);
                    if($user->getIdImage() != 1){
                        if(FPersistentManager::getInstance()->deleteImage($user->getIdImage())){
                            $user->setIdImage($idImage);
                            FPersistentManager::getInstance()->updateUserIdImage($user);
                        }
                        header('Location: /Slope/User/profile');
                    }else{
                        $user->setIdImage($idImage);
                        FPersistentManager::getInstance()->updateUserIdImage($user);
                    }
                    header('Location: /Slope/User/profile');
                }
            }
            if(!$phoneError || !$checkImageError)
                $view->modifyProfile($username, $name, $surname, $email, $phoneNumber, $birthDate, $phoneError, $checkImageError);
            else {
                header('Location: /Slope/User/profile');
            }
        }
    }

    public static function modifyPassword() {
        if(CUser::isLogged()){
            $view = new VUser();
            $view->modifyPassword(false);
        }
    }

    public static function setPassword(){
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
        }
    }

    public static function skiFacilitydetails() {
        if(CUser::isLogged()){
            $view = new VUser();
            if(UHTTPMethods::allPost() == array()) {
                header('Location: /Slope/User/');
            } else {
                $nameSkiFacility = UHTTPMethods::post('nameSkiFacility');
                $idSkiFacility = FPersistentManager::getInstance()->retriveIdSkiFacilityFromName($nameSkiFacility);
                $skiRuns = FPersistentManager::getInstance()->retriveAllSkiRun($idSkiFacility);
                $liftStructures = FPersistentManager::getInstance()->retriveAllLiftStructures($idSkiFacility);
                $view->showDetails($idSkiFacility, $nameSkiFacility, $skiRuns, $liftStructures);
            }
        }
    }

    public static function makeABookingPage() {
        if(CUser::isLogged()){
            $view = new VUser();
            $userId = USession::getInstance()->getSessionElement('user');
            $idSkiFacility = UHTTPMethods::post('idSkiFacility');
            $user = FPersistentManager::getInstance()->retriveObj(EUser::getEntity(), $userId);
            $today = date("Y-m-d");
            $view->makeABookingForm($idSkiFacility, $user, $today, false);
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
            //Non può prenotarsi se è già prenotato --> lo stesso oggetto non può esistere
            //Verificare se la mail esiste perché altrimenti non si può inviare la conferma 
            //Controllo sulla data che permetta di segnalare se è stata inserita una data troppo lontana
            $selectedDate = new DateTime(UHTTPMethods::post('date'));
            if(!self::verifyaDate($selectedDate)) {
                $view->makeABookingForm($idSkiFacility, $user, $today, true);
            }
            switch (UHTTPMethods::post('type')) {
                case 'intero':
                    $priceObj = FPersistentManager::getInstance()->retriveObj(FPrice::getClass(), 1);
                    $price = $priceObj->getFull();
                    break;
                case 'ridotto':
                    $priceObj = FPersistentManager::getInstance()->retriveObj(FPrice::getClass(), 1);
                    $price = $priceObj->getReduced();
                    break;
            }
            switch (UHTTPMethods::post('period')) {     
                case 'giornaliero':
                    $dSB = new EDailySkipass(UHTTPMethods::post('name'), UHTTPMethods::post('surname'), UHTTPMethods::post('date'), UHTTPMethods::post('type'), UHTTPMethods::post('email'), $price);
                    $skipassBooking = new ESkipassBooking($dSB->getName(), $dSB->getSurname(), $dSB->getStartDate(), $dSB->getType(), $dSB->getEmail(), $dSB->getPeriod(), $dSB->getTotal());
                    break;
                case 'settimanale':
                    $wSB = new EDailySkipass(UHTTPMethods::post('name'), UHTTPMethods::post('surname'), UHTTPMethods::post('date'), UHTTPMethods::post('type'), UHTTPMethods::post('email'), $price);
                    $skipassBooking = new ESkipassBooking($wSB->getName(), $wSB->getSurname(), $wSB->getStartDate(), $wSB->getType(), $wSB->getEmail(), $wSB->getPeriod(), $wSB->getTotal());
                    break;
                case 'mensile':
                    $mSB = new EDailySkipass(UHTTPMethods::post('name'), UHTTPMethods::post('surname'), UHTTPMethods::post('date'), UHTTPMethods::post('type'), UHTTPMethods::post('email'), $price);
                    $skipassBooking = new ESkipassBooking($mSB->getName(), $mSB->getSurname(), $mSB->getStartDate(), $mSB->getType(), $mSB->getEmail(), $mSB->getPeriod(), $mSB->getTotal());
                    break;  
                case 'stagionale':
                    break;    
            }
            $skipassBooking->setIdUser($userId);
            $skipassBooking->setIdSkiFacility($idSkiFacility);
            USession::getInstance()->setSessionElement('skipassBooking', $skipassBooking);
            $totalPrice = $skipassBooking->getTotal();
            $verifyPreferredCreditCard = FPersistentManager::getInstance()->verifyPCreditCard($userId);
            if($verifyPreferredCreditCard) {
                $creditCard = FPersistentManager::getInstance()->retriveCreditCardFromUserId($userId);
                $view->paymentSection($totalPrice, $creditCard);
            } else {
                $view->paymentSection($totalPrice, null);
            }
            /* if(FPersistentManager::getInstance()->verifyBooking()) {
                
            } else {
                $view->bokkingError();
            } */
        

        }
    }
    
    public static function verifyaDate($selectedDate) {
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
                $cond = UHTTPMethods::post('cardHolderName') == $creditCard->getCardHolderName() &&
                UHTTPMethods::post('cardHolderSurname') == $creditCard->getCardHolderSurname() &&
                UHTTPMethods::post('expiryDate') == $creditCard->getExpiryDate() && 
                UHTTPMethods::post('cardNumber') == $creditCard->getCardNumber() &&
                UHTTPMethods::post('cvv') == $creditCard->getCvv();
                if(!$cond) { //diversa da quella già salvata
                    $creditCard = new ECreditCard(UHTTPMethods::post('cardHolderName'), UHTTPMethods::post('cardHolderSurname'), UHTTPMethods::post('expiryDate'), UHTTPMethods::post('cardNumber'), UHTTPMethods::post('cvv'));
                    if(UHTTPMethods::post('preferred') == 'on')
                        $creditCard->setIdUser($userId);
                    else 
                        $creditCard->setIdUser('NULL');
                    FPersistentManager::getInstance()->updateCreditCard($creditCard);
                }
            } else {
                $creditCard = new ECreditCard(UHTTPMethods::post('cardHolderName'), UHTTPMethods::post('cardHolderSurname'), UHTTPMethods::post('expiryDate'), UHTTPMethods::post('cardNumber'), UHTTPMethods::post('cvv'));
                if(UHTTPMethods::post('preferred') == 'on')
                    $creditCard->setIdUser($userId);
                else 
                    $creditCard->setIdUser('NULL');
                FPersistentManager::getInstance()->uploadObj($creditCard);
            }
            if(USession::getInstance()->isSetSessionElement('skipassBooking') && !USession::getInstance()->isSetSessionElement('insurance')) {
                $skipassBooking = USession::getInstance()->getSessionElement('skipassBooking');
                $today = new DateTime();
                $payment = new EPayment(get_class($skipassBooking), $skipassBooking->getTotal(), $today->format('Y-m-d'));
                FPersistentManager::getInstance()->uploadObj($skipassBooking);
                $idSkipassBooking = FPersistentManager::getInstance()->retriveIdSkipassBooking($skipassBooking);
                $payment->setIdExternalObj($idSkipassBooking);
                $payment->setIdCreditCard($creditCard->getIdCreditCard());
                FPersistentManager::getInstance()->uploadObj($payment);
                self::showBookings();
            } elseif(USession::getInstance()->isSetSessionElement('insurance') && !USession::getInstance()->isSetSessionElement('skipassBooking')) {

            } else {

            }
        }
    }

    public static function showBookings() {
        if(CUser::isLogged()){ 
            $view = new VUser();  
            $userId = USession::getInstance()->getSessionElement('user');
            $allBookings = FPersistentManager::getInstance()->retriveAllSkipassBooking($userId);
            $bookings = array();
            if(count($allBookings) > 0) {
                foreach ($allBookings as $element) {
                    $app = array();
                    $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($element->getIdSkiFacility());
                    $app[] = $element;
                    $app[] = $skiFacility;
                    $bookings[] = $app;
                }
                //print_r($bookings);
                $view->showBookings($bookings);
            } else {
                $view->showBookings($bookings);
            }
        }
    }

    public static function modifySkipassBooking() {
        if(CUser::isLogged()) {
            $view = new VUser();
            $idSkipassBooking = UHTTPMethods::post('idSkipassBooking');
            $skipassBooking = FPersistentManager::getInstance()->retriveSkipassBookingOnId($idSkipassBooking);
            $today = new DateTime();
            $view->modifySkipassBooking($skipassBooking, $today->format('Y-m-d'), false);
        }
    }

    public static function deleteSkipassBooking() {
        if(CUser::isLogged()) {
            $view = new VUser();
            $view->blankPage();
        }
    }   

    public static function buySubscription() {
        if(CUser::isLogged()) {
            $view = new VUser();
            $view->buySubscription();
        }
    }
    
}

?>