<?php

/*
richiede il file nella posizione __DIR__ [ovvero posizione di questo specifico file (CUser.php)] concatenata con 
"\\..\\config\\autoloader.php" per arrivare alla posizione finale partendo da __DIR__.
I doppi punti sono utilizzati per andare indietro di una cartella quindi da control uscire ed andare a app
*/


require_once (__DIR__ . '/../config/autoloader.php');

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
        } else {
            $view = new VUser();
            $view->showLoginForm(false);
        }
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
        CUser::home();
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
            if(!is_null(UHTTPMethods::post('username')) && !is_null(UHTTPMethods::post('password'))) {
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
        if(!CUser::isLogged()) {
            $view = new VUser();
            $view->showRegistrationForm();
        } else {
            CUser::home();
        }
    }

    /**
     * Method to verify all the data in the login form 
     * @return void
     */
    public static function checkRegistration() : void{
        if(!CUser::isLogged()) {
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
                $app['name'] = $skiFacility->getName();    
                $app['status'] = $skiFacility->getStatus();
                $app['countSkiRun'] = FPersistentManager::getInstance()->typeAndNumberSkiRun($idSkiFacility); 
                $app['countLift'] = FPersistentManager::getInstance()->typeAndNumberLiftStructure($idSkiFacility);
                $skiFacilityImages = FPersistentManager::getInstance()->retriveSkiFacilityImageOnId($idSkiFacility);
                foreach ($skiFacilityImages as $i) {
                    $images = FPersistentManager::getInstance()->retriveImageOnId($i->getIdImage());
                    $app1[] = $images[0];
                }
                $app['image'] = $app1;
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
                $skipassObjs = FPersistentManager::getInstance()->retriveSkipassObjOnSkiFacility($allSkiFacilities[0]->getIdSkiFacility());
                foreach ($skipassObjs as $i) {
                    $idSkipassTemp = $i->getIdSkipassTemp();
                    $skipassTemps = FPersistentManager::getInstance()->retriveSkipassTempOnId($idSkipassTemp);
                    if($skipassTemps[0]->getType() == 'intero')
                        $skipassObj[] = $i;
                }
            } else {
                $skiFacility = UHTTPMethods::post('skiFacilities');
                $idSkiFacility = FPersistentManager::getInstance()->retriveIdSkiFacilityFromName($skiFacility);
                $skipassObjs = FPersistentManager::getInstance()->retriveSkipassObjOnSkiFacility($idSkiFacility[0]);
                foreach ($skipassObjs as $i) {
                    $idSkipassTemp = $i->getIdSkipassTemp();
                    $skipassTemps = FPersistentManager::getInstance()->retriveSkipassTempOnId($idSkipassTemp);
                    if($skipassTemps[0]->getType() == 'intero')
                        $skipassObj[] = $i;
                }
            }
            $view->home($allSkiFacility, $skipassObj, $images);
        }
    }
}

?>