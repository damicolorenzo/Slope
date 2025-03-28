<?php

require_once (__DIR__."\\..\\config\\autoloader.php");

class CAdmin {

    /**
     * Method to retrive the login form
     * Call the showLoginForm() method from VAdmini
     * @return void
     */
    public static function login() : void{
        if(USession::getSessionStatus() == PHP_SESSION_NONE){
            USession::getInstance();
        }
        if(USession::isSetSessionElement('ad')){
            header('Location: /Slope/Admin/dashboard');
        }
        $view = new VAdmin();
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
     * Method to check if an admin is logged
     * Check in the session array
     * @return bool
     */
    public static function isLogged() : bool{
        if(USession::getSessionStatus() == PHP_SESSION_NONE) {
            USession::getInstance(); 
        }
        return USession::isSetSessionElement('ad');
    }

    /**
     * Method to verify all the data in the login form
     * @return void
     */
    public static function checkLogin() : void{
        $view = new VAdmin();
        $username = FPersistentManager::getInstance()->verifyUserUsername(UHTTPMethods::post('username'));
        $user = FPersistentManager::getInstance()->retriveUserOnUsername(UHTTPMethods::post('username'));
        $admin = FPersistentManager::getInstance()->verifyAdmin($user[0]->getIdUser());
        if($username && $admin) {
            if(password_verify(UHTTPMethods::post('password'), $user[0]->getPassword())) {
                if(USession::getSessionStatus() == PHP_SESSION_NONE) {
                    USession::getInstance();
                    USession::setSessionElement('ad', $user[0]->getId());
                    header('Location: /Slope/Admin/dashboard');
                }
            } else {
                $view->showLoginForm(true);
            }
        } else {
            $view->showLoginForm(true);
        }
    }

    /**
     * Method to retrive from the database all the data showed in the dashboard
     * @return void
     */
    public static function dashboard() : void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $view->dashboard();
        }
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
                    $view->searchUsers($user);
                }
            } else {
                $users = FPersistentManager::getInstance()->retriveAllUsers();
                $view->searchUsers($users);
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to show a page to modify user data
     * @return void
     */
    public static function modifyProfile() : void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $userId = UHTTPMethods::post('userId');
            $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
            $user = $user[0];
            $username = $user->getUsername(); 
            $name = $user->getName();
            $surname = $user->getSurname();
            $email = $user->getEmail();
            $phoneNumber = $user->getPhoneNumber();
            $birthDate = $user->getBirthDate();
            //$idImage = $user->getIdImage();
            //$image = FPersistentManager::getInstance()->retriveImageOnId($idImage);
            $view->modifyProfile($username, $name, $surname, $email, $phoneNumber, $birthDate, false, false);
        } else {
            CAdmin::dashboard();
        }

    }

    /**
     * Method to verify all the data in the modify form 
     * @return void
     */
    public static function confirmModify() : void{
        if(CAdmin::isLogged()){
            $view = new VAdmin();
            $username = UHTTPMethods::post('username');
            $user = FPersistentManager::getInstance()->retriveUserOnUsername($username);
            $user = $user[0];
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
                FPersistentManager::getInstance()->updatePersonInfo($updatedUser);
                header('Location: /Slope/Admin/dashboard');
            }
            else {
                $view->modifyProfile($username, $name, $surname, $email, $phoneNumber, $birthDate, $phoneError, $dateError); 
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to retrive all the data in the add ski run form 
     * @return void
     */
    public static function addSkiRun() : void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $nameSkiFacility = FPersistentManager::getInstance()->nameAllSkiFacility();
            $view->addSkiRun($nameSkiFacility);
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to verify all the data in the add ski run form 
     * @return void
     */
    public static function confirmSkiRun() : void{
        if(CAdmin::isLogged()) {
            //print_r(UHTTPMethods::allPost());
            $view = new VAdmin();
            $idSkiFacility = FPersistentManager::getInstance()->retriveIdSkiFacilityFromName(UHTTPMethods::post('skiFacility'));
            $skiRunName = FPersistentManager::getInstance()->verifySkiRunName(UHTTPMethods::post('name'), $idSkiFacility[0]);
            if(!$skiRunName) {
                $skiRun = new ESkiRun(UHTTPMethods::post('name'), UHTTPMethods::post('type'), UHTTPMethods::post('status'));
                $skiRun->setIdSkiFacility($idSkiFacility[0]);
                FPersistentManager::getInstance()->uploadObj($skiRun);
                header('Location: /Slope/Admin/dashboard'); 
            } else {
                $view->skiRunAlreadyExist();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to retrive all the data in the add ski facility form 
     * @return void
     */
    public static function addSkiFacility() : void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $view->addSkiFacility();
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to verify all the data in the add ski facility form 
     * @return void
     */
    public static function confirmSkiFacility() : void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $skiFacility = FPersistentManager::getInstance()->verifySkiRunName(UHTTPMethods::post('name'), UHTTPMethods::post('idSkiFacility'));
            if(!$skiFacility) {
                $skiFacility = new ESkiFacility(UHTTPMethods::post('name'), UHTTPMethods::post('status'), UHTTPMethods::post('description'), UHTTPMethods::post('price'));
                FPersistentManager::getInstance()->uploadObj($skiFacility);
                header('Location: /Slope/Admin/dashboard'); 
            } else {
                $view->skiFacilityAlreadyExist();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to retrive all the data in the add lift structure form 
     * @return void
     */
    public static function addLiftStructure() : void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $nameSkiFacility = FPersistentManager::getInstance()->nameAllSkiFacility();
            $view->addLiftStructure($nameSkiFacility);
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to verify all the data in the add lift structure form 
     * @return void
     */
    public static function confirmLiftStructure() : void{
        if(CAdmin::isLogged()) {
            //print_r(UHTTPMethods::allPost());
            $view = new VAdmin();
            $idSkiFacility = FPersistentManager::getInstance()->retriveIdSkiFacilityFromName(UHTTPMethods::post('skiFacility'));
            $liftStructureName = FPersistentManager::getInstance()->verifyLiftStructureName(UHTTPMethods::post('name'), $idSkiFacility[0]);
            if(!$liftStructureName) {
                $liftStructure = new ELiftStructure(UHTTPMethods::post('name'), UHTTPMethods::post('type'), UHTTPMethods::post('status'), UHTTPMethods::post('seats'));
                $liftStructure->setIdSkiFacility($idSkiFacility[0]);
                FPersistentManager::getInstance()->uploadObj($liftStructure);
                //header('Location: /Slope/Admin/dashboard'); 
            } else {
                $view->liftStructureAlreadyExist();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    //SI POSSONO AGGIUNGERE FILTRI O ALTRI PARAMETRI PER LA RICERCA
    public static function searchStructures() : void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            if(UHTTPMethods::post("search-input") !== null) {
                $searchInput = UHTTPMethods::post("search-input");
                $result = FPersistentManager::getInstance()->retriveForStructureSearch($searchInput); 
                $view->searchStructure($result);
            } else {
                $result = FPersistentManager::getInstance()->retriveAllSkiStructures();
                $view->searchStructure($result);
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to show a page to modify ski facility data
     * @return void
     */
    public static function modifySkiFacility() : void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $idSkiFacility = UHTTPMethods::post('idSkiFacility');
            $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($idSkiFacility);
            $skiFacility = $skiFacility[0];
            $name = $skiFacility->getName();
            $status = $skiFacility->getStatus();
            $description = $skiFacility->getDescription();
            //$idImage = $user->getIdImage();
            //$image = FPersistentManager::getInstance()->retriveImageOnId($idImage);
            $view->modifySkiFacility($idSkiFacility, $name, $status, $description);
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to verify all the data in the modify ski facility form 
     * @return void
     */
    public static function confirmModifySkiFacility() : void{
        if(CAdmin::isLogged()) {
            //print_r(UHTTPMethods::allPost());
            $view = new VAdmin();
            $idSkiFacility = UHTTPMethods::post('idSkiFacility');
            $skiFacilityName = FPersistentManager::getInstance()->verifySkiFacilityName('name', UHTTPMethods::post('name')); 
            if(!$skiFacilityName) {
                $skiFacility = new ESkiFacility(UHTTPMethods::post('name'), UHTTPMethods::post('status'), UHTTPMethods::post('description'));
                $skiFacility->setIdSkiFacility($idSkiFacility);
                FPersistentManager::getInstance()->updateSkiFacilityInfo($skiFacility);
                header('Location: /Slope/Admin/dashboard'); 
            } else {
                $view->skiFacilityAlreadyExist();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    public static function deleteSkiFacility() : void{
        if(CAdmin::isLogged()) {
            $idSkiFacility = UHTTPMethods::post('idSkiFacility');
            $view = new VAdmin();
            $view->deletePage();
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to show a page to modify ski run data
     * @return void
     */
    public static function modifySkiRun(): void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $idSkiRun = UHTTPMethods::post('idSkiRun');
            $skiRun = FPersistentManager::getInstance()->retriveSkiRunOnId($idSkiRun);
            $skiRun = $skiRun[0];
            $name = $skiRun->getName();
            $type = $skiRun->getType();
            $status = $skiRun->getStatus();
            $idSkiFacility = $skiRun->getIdSkiFacility();
            $nameSkiFacility = FPersistentManager::getInstance()->nameSkiFacility($idSkiFacility);
            //$idImage = $user->getIdImage();
            //$image = FPersistentManager::getInstance()->retriveImageOnId($idImage);
            $view->modifySkiRun($idSkiRun, $name, $type, $status, $nameSkiFacility[0], $idSkiFacility);
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to verify all the data in the modify ski run form 
     * @return void
     */
    public static function confirmModifySkiRun() : void{
        if(CAdmin::isLogged()) {
            //print_r(UHTTPMethods::allPost());
            $view = new VAdmin();
            $idSkiRun = UHTTPMethods::post('idSkiRun');
            $newName = UHTTPMethods::post('name');
            $idSkiFacility = UHTTPMethods::post('idSkiFacility');
            $skiRunName = FPersistentManager::getInstance()->verifySkiRunName($newName, $idSkiFacility);
            if($skiRunName) {
                $skiRun = new ESkiRun(UHTTPMethods::post('name'), UHTTPMethods::post('type'), UHTTPMethods::post('status'));
                $skiRun->setIdSkiRun($idSkiRun);
                $skiRun->setIdSkiFacility($idSkiFacility);
                FPersistentManager::getInstance()->updateSkiRunInfo($skiRun);
                header('Location: /Slope/Admin/dashboard'); 
            } else {
                $view->skiRunAlreadyExist();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    public static function deleteSkiRun() : void{
        if(CAdmin::isLogged()) {
            $idSkiRun = UHTTPMethods::post('idSkiRun');
            $view = new VAdmin();
            $view->deletePage();
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to show a page to modify ski run data
     * @return void
     */
    public static function modifyLiftStructure() : void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $idLiftStructure = UHTTPMethods::post('idLift');
            $liftStructure = FPersistentManager::getInstance()->retriveLiftStructureOnId($idLiftStructure);
            $liftStructure = $liftStructure[0];
            $name = $liftStructure->getName();
            $type = $liftStructure->getType();
            $status = $liftStructure->getStatus();
            $seats = $liftStructure->getSeats();
            $idSkiFacility = $liftStructure->getIdSkiFacility();
            $nameSkiFacility = FPersistentManager::getInstance()->nameSkiFacility($idLiftStructure);
            //$idImage = $user->getIdImage();
            //$image = FPersistentManager::getInstance()->retriveImageOnId($idImage);
            $view->modifyLiftStructure($idLiftStructure, $name, $type, $status, $seats, $nameSkiFacility[0], $idSkiFacility);
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to verify all the data in the modify lift structure form 
     * @return void
     */
    public static function confirmModifyLiftStructure() : void{
        if(CAdmin::isLogged()) {
            //print_r(UHTTPMethods::allPost());
            $view = new VAdmin();
            $idLiftStructure = UHTTPMethods::post('idLiftStructure');
            $newName = UHTTPMethods::post('name');
            $idSkiFacility = UHTTPMethods::post('idSkiFacility');
            $liftStructure = FPersistentManager::getInstance()->verifyLiftStructureName($newName, $idSkiFacility);
            if(!$liftStructure) {
                $liftStructure = new ELiftStructure(UHTTPMethods::post('name'), UHTTPMethods::post('type'), UHTTPMethods::post('status'), UHTTPMethods::post('seats'));
                $liftStructure->setIdLift($idLiftStructure);
                $liftStructure->setIdSkiFacility($idSkiFacility);
                FPersistentManager::getInstance()->updateLiftStructureInfo($liftStructure);
                header('Location: /Slope/Admin/dashboard'); 
            } else {
                $view->liftStructureAlreadyExist();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    public static function deleteLiftStructure() {
        if(CAdmin::isLogged()) {
            $idSkiRun = UHTTPMethods::post('idLiftStructure');
            $view = new VAdmin();
            $view->deletePage();
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to retrive all the data in the add skipass template form 
     * @return void
     */
    public static function addSkipassTemplate() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $view->addSkipassTemplate();
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to retrive all the data in the add insurance template form 
     * @return void
     */
    public static function addInsuranceTemplate() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $view->addInsuranceTemplate();
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to retrive all the data in the add lift structure form 
     * @return void
     */
    public static function addPrice() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $allSkipassTemp = FPersistentManager::getInstance()->retriveAllSkipassTemp();
            $allInsuranceTemp = FPersistentManager::getInstance()->retriveAllInsuranceTemp();
            $allSkiFacilities = FPersistentManager::getInstance()->retriveAllSkiFacilities();
            $object['skipassTemp'] = $allSkipassTemp;
            $object['insuranceTemp'] = $allInsuranceTemp;
            $object['skiFacility'] = $allSkiFacilities;
            $view->addPrice($object);
        } else {
            CAdmin::dashboard();
        }
    }

    public static function confirmPrice() {
        if(CAdmin::isLogged()) {
            $description = UHTTPMethods::post('description');
            $skipassObj = FPersistentManager::getInstance()->retriveIdSkipassObj($description, UHTTPMethods::post('period'), UHTTPMethods::post('type'));
            $idSkipassObj = $skipassObj->getIdSkipassObj();
            $skiFacilityName = UHTTPMethods::post('skiFacility');
            $price = UHTTPMethods::post('price');
            $idSkiFacility = FPersistentManager::getInstance()->retriveIdSkiFacilityFromName($skiFacilityName);
            $description = $description . " " . $skiFacilityName;
            $price = new EPrice($description, $price);
            $price->setIdSkiFacility($idSkiFacility);
            $price->setIdSkipassObj($idSkipassObj);
            FPersistentManager::getInstance()->uploadObj($price);
            header('Location: /Slope/Admin/dashboard'); 
        } else {
            $view = new VAdmin();
            $view->showLoginForm();
        }
    }

    public static function modifyPrice() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $idPrice = UHTTPMethods::post('idPrice');
            $price = FPersistentManager::getInstance()->retrivePriceOnId($idPrice);
            $description = $price->getDescription();
            $full = $price->getFull();
            $reduced = $price->getReduced();
            $idSkiFacility = $price->getIdSkiFacility();
            $nameSkiFacility = FPersistentManager::getInstance()->nameSkiFacility($idSkiFacility);
            $allSkiFacilities = FPersistentManager::getInstance()->retriveAllSkiFacilities();
            $allSkiFacilityNames = array();
            foreach ($allSkiFacilities as $i) {
                $allSkiFacilityNames[] = $i->getName();
            }
            $view->modifyPrice($idPrice, $description, $full, $reduced, $nameSkiFacility, $idSkiFacility, $allSkiFacilityNames);
        } else {
            $view = new VAdmin();
            $view->showLoginForm();
        }
    }

    public static function confirmModifyPrice() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $idPrice = UHTTPMethods::post('idPrice');
            $idSkiFacility = UHTTPMethods::post('idSkiFacility');
            $price = new EPrice(UHTTPMethods::post('description'), UHTTPMethods::post('full'), UHTTPMethods::post('reduced'));
            $price->setIdPrice($idPrice);
            $price->setIdSkiFacility($idSkiFacility);
            FPersistentManager::getInstance()->updatePrice($price);
            header('Location: /Slope/Admin/dashboard'); 
        } else {
            $view = new VAdmin();
            $view->showLoginForm();
        }
    }

    public static function searchPrices() {
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
                    $view->searchUsers($user);
                }
            } else {
                $prices = FPersistentManager::getInstance()->retriveAllPricesForSearch();
                $view->searchPrices($prices);
            }
        } else {
            $view = new VAdmin();
            $view->showLoginForm();
        }
    }

    public static function addSkipass() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $view->addSkipass();
        } else {
            $view = new VAdmin();
            $view->showLoginForm();
        }
    }

    public static function confirmSkipass() {
        if(CAdmin::isLogged()) {
            $description = UHTTPMethods::post('description');
            $period = UHTTPMethods::post('period');
            $type = UHTTPMethods::post('type');
            $skipass = new ESkipassObj($description, $period, $type);
            FPersistentManager::getInstance()->uploadObj($skipass);
            header('Location: /Slope/Admin/dashboard'); 
        } else {
            $view = new VAdmin();
            $view->showLoginForm();
        }
    }

    public static function searchSkipassObjs() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            if(UHTTPMethods::post("search-input") !== null) {
                $searchInput = UHTTPMethods::post("search-input");
                $result = FPersistentManager::getInstance()->retriveForStructureSearch($searchInput); 
                $view->searchStructure($result);
            } else {
                $result = FPersistentManager::getInstance()->retriveAllSkipassObjs();
                $view->searchSkipassObjs($result);
            }
        } else {
            $view = new VAdmin();
            $view->showLoginForm();
        }
    }

    public static function modifySkipass() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $idSkipassObj = UHTTPMethods::post('idSkipassObj');
            $skipassObj = FPersistentManager::getInstance()->retriveSkipassObjOnId($idSkipassObj);
            $description = $skipassObj[0]->getDescription();
            $period = $skipassObj[0]->getPeriod();
            $type = $skipassObj[0]->getType();
            $view->modifySkipassObj($idSkipassObj, $description, $period, $type);
        } else {
            $view = new VAdmin();
            $view->showLoginForm();
        }
    }

    public static function confirmModifySkipass() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $idSkipassObj = UHTTPMethods::post('idSkipassObj');
            $skipass = new ESkipassObj(UHTTPMethods::post('description'), UHTTPMethods::post('period'), UHTTPMethods::post('type'));
            $skipass->setIdSkipassObj($idSkipassObj);
            FPersistentManager::getInstance()->updateSkipassObj($skipass);
            header('Location: /Slope/Admin/dashboard'); 
        } else {
            $view = new VAdmin();
            $view->showLoginForm();
        }
    }

}

/* 

 */
?>