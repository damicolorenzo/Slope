<?php

class CAdmin {

    public static function isLogged() {
        $logged = false;

        if(UCookie::isSet('PHPSESSID')){
            if(session_status() == PHP_SESSION_NONE){
                USession::getInstance();
            }
        }
        if(USession::isSetSessionElement('ad')){
            $logged = true;
        }
        if(!$logged){
            header("Location: /Slope/Admin/login");
            exit;
        }
        return true;
    }

    public static function login() {
        if(UCookie::isSet('PHPSESSID')){
            if(session_status() == PHP_SESSION_NONE){
                USession::getInstance();
            }
        }
        if(USession::isSetSessionElement('mod')){
            header('Location: /Slope/Admin/reportList');
        }
        $view = new VAdmin();
        $view->showLoginForm();
    }

    public static function checkLogin() {
        $view = new VAdmin();
        $username = FPersistentManager::getInstance()->verifyUserUsername(UHTTPMethods::post('username'));
        if($username) {
            $user = FPersistentManager::getInstance()->retriveAdminOnUsername(UHTTPMethods::post('username'));
            if(password_verify(UHTTPMethods::post('password'), $user->getPassword())) {
                if(USession::getSessionStatus() == PHP_SESSION_NONE) {
                    USession::getInstance();
                    USession::setSessionElement('ad', $user->getId());
                    header('Location: /Slope/Admin/dashboard');
                } else {
                    $view->loginSessionError();
                }
            } else {
                $view->loginPasswordError();
            }
        } else {
            $view->loginPasswordError();
        }
    }

    public static function dashboard() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $view->dashboard();
        }
    }

    public static function logout(){
        USession::getInstance();
        USession::unsetSession();
        USession::destroySession();
        header('Location: /Slope/');
    }

    /* public static function search() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $users = [];
            $view->search($users);
        }
    } */

    public static function searchUsers() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            if(UHTTPMethods::post("search-input") !== null) {
                $searchInput = UHTTPMethods::post("search-input");
                $searchInput = trim($searchInput);
                $parts = explode(' ', $searchInput);
                if(count($parts) === 1) {
                    $username = $parts[0];
                    $user = FPersistentManager::getInstance()->retriveUsersForSearch($username, '', '');
                } else if(count($parts) === 2) {
                    $name = $parts[0];
                    $surname = $parts[1];
                    $user = FPersistentManager::getInstance()->retriveUsersForSearch('', $name, $surname);
                }
                if(count($user) > 0) {
                    $view->search($user);
                }
            } else {
                $users = FPersistentManager::getInstance()->retriveAllUsers();
                $view->search($users);
            }
        }
    }

    public static function modifyProfile() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $userId = UHTTPMethods::post('userId');
            $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
            $username = $user->getUsername(); 
            $name = $user->getName();
            $surname = $user->getSurname();
            $email = $user->getEmail();
            $phoneNumber = $user->getPhoneNumber();
            $birthDate = $user->getBirthDate();
            //$idImage = $user->getIdImage();
            //$image = FPersistentManager::getInstance()->retriveImageOnId($idImage);
            $view->modifyProfile($username, $name, $surname, $email, $phoneNumber, $birthDate, false, false);
        }

    }

    public static function confirmModify() {
        if(CAdmin::isLogged()){
            $view = new VAdmin();
            $username = UHTTPMethods::post('username');
            $user = FPersistentManager::getInstance()->retriveUserOnUsername($username);
            $userId = $user->getId();
            $name = $user->getName();
            $surname = $user->getSurname();
            $email = $user->getEmail();
            $phoneNumber = $user->getPhoneNumber();
            $birthDate = $user->getBirthDate();
            $phone_number_validation_regex = "/^\\+?[1-9][0-9]{7,14}$/"; 
            if(!preg_match($phone_number_validation_regex, UHTTPMethods::post('phoneNumber'))) {
                $phoneError = true;
            } else {
                $phoneError = false;
                $extract_phone_number_pattern = "/\\+?[1-9][0-9]{7,14}/";
                preg_match_all($extract_phone_number_pattern, UHTTPMethods::post('phoneNumber'), $matches);
                $modifiedPhoneNumber = implode($matches[0]);
            }
            if(!(date("Y-m-d") > UHTTPMethods::post('birthDate'))){
                $dateError = true;
            } else {
                $dateError = false;
            } 
            if(!$phoneError && !$dateError) {
                $updatedUser = new EUser(UHTTPMethods::post('name'), UHTTPMethods::post('surname'), UHTTPMethods::post('email'), $modifiedPhoneNumber, UHTTPMethods::post('birthDate'), UHTTPMethods::post('username'), password_hash(UHTTPMethods::post('password'), PASSWORD_DEFAULT));
                $updatedUser->setId($userId);
                FPersistentManager::getInstance()->updateUserInfo($updatedUser);
                header('Location: /Slope/Admin/dashboard');
            }
            else {
                $view->modifyProfile($username, $name, $surname, $email, $phoneNumber, $birthDate, $phoneError, $dateError); 
            }
        }
    }

    public static function addSkiRun() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $nameSkiFacility = FPersistentManager::getInstance()->nameAllSkiFacility();
            $view->addSkiRun($nameSkiFacility);
        }
    }

    public static function confirmSkiRun() {
        if(CAdmin::isLogged()) {
            //print_r(UHTTPMethods::allPost());
            $view = new VAdmin();
            $idSkiFacility = FPersistentManager::getInstance()->retriveIdSkiFacilityFromName(UHTTPMethods::post('skiFacility'));
            $skiRunName = FPersistentManager::getInstance()->verifySkiRunName(UHTTPMethods::post('name'), $idSkiFacility);
            if(!$skiRunName) {
                $skiRun = new ESkiRun(UHTTPMethods::post('name'), UHTTPMethods::post('type'), UHTTPMethods::post('status'));
                $skiRun->setIdSkiFacility($idSkiFacility);
                FPersistentManager::getInstance()->uploadObj($skiRun);
                header('Location: /Slope/Admin/dashboard'); 
            } else {
                $view->skiRunAlreadyExist();
            }
        }
    }

    public static function addSkiFacility() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $view->addSkiFacility();
        }
    }

    public static function confirmSkiFacility() {

    }

    public static function addLiftStructure() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $nameSkiFacility = FPersistentManager::getInstance()->nameAllSkiFacility();
            $view->addLiftStructure($nameSkiFacility);
        }
    }

    public static function confirmLiftStructure() {
        if(CAdmin::isLogged()) {
            //print_r(UHTTPMethods::allPost());
            $view = new VAdmin();
            $idSkiFacility = FPersistentManager::getInstance()->retriveIdSkiFacilityFromName(UHTTPMethods::post('skiFacility'));
            $liftStructureName = FPersistentManager::getInstance()->verifyLiftStructureName(UHTTPMethods::post('name'), $idSkiFacility);
            if(!$liftStructureName) {
                $liftStructure = new ELiftStructure(UHTTPMethods::post('name'), UHTTPMethods::post('type'), UHTTPMethods::post('status'), UHTTPMethods::post('seats'));
                $liftStructure->setIdSkiFacility($idSkiFacility);
                FPersistentManager::getInstance()->uploadObj($liftStructure);
                //header('Location: /Slope/Admin/dashboard'); 
            } else {
                $view->liftStructureAlreadyExist();
            }
        }
    }

}

/* 

 */
?>