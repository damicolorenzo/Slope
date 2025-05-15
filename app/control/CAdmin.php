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
   
    /* SEARCH FUNCTIONS */

    public static function searchUsers() : void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            if(UHTTPMethods::post("name") !== NULL || UHTTPMethods::post("surname") !== NULL
            || UHTTPMethods::post("username") !== NULL) {
                $name = (UHTTPMethods::post("name") !== NULL) ? UHTTPMethods::post("name") : "";
                $surname = (UHTTPMethods::post("surname") !== NULL) ? UHTTPMethods::post("surname") : "";
                $username = (UHTTPMethods::post("username") !== NULL) ? UHTTPMethods::post("username") : "";
                $users = FPersistentManager::getInstance()->retriveUsersForSearch($username, $name, $surname);
                $view->searchUsers($users);
            } else {
                $users = FPersistentManager::getInstance()->retriveAllUsers();
                $view->searchUsers($users);
            }
        } else {
            CAdmin::dashboard();
        }
    }

    //SI POSSONO AGGIUNGERE FILTRI O ALTRI PARAMETRI PER LA RICERCA
    public static function searchStructures() : void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            if(UHTTPMethods::post("nameSkiFacility") !== NULL || UHTTPMethods::post("nameSkiRun") !== NULL
            || UHTTPMethods::post("nameLiftStructure") !== NULL) {
                $nameSkiFacility = (UHTTPMethods::post("nameSkiFacility") !== NULL) ? UHTTPMethods::post("nameSkiFacility") : "";
                $nameSkiRun = (UHTTPMethods::post("nameSkiRun") !== NULL) ? UHTTPMethods::post("nameSkiRun") : "";
                $nameLiftStructure = (UHTTPMethods::post("nameLiftStructure") !== NULL) ? UHTTPMethods::post("nameLiftStructure") : "";
                $structures = FPersistentManager::getInstance()->retriveStructureForSearch($nameSkiFacility, $nameSkiRun, $nameLiftStructure);
                $view->searchStructure($structures);
            } else {
                $result = FPersistentManager::getInstance()->retriveAllSkiStructures();
                $view->searchStructure($result);
            }
        } else {
            CAdmin::dashboard();
        }
    }

    public static function searchSkipassObjs() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            if(UHTTPMethods::post("nameSkiFacility") !== NULL || UHTTPMethods::post("type") !== NULL
            || UHTTPMethods::post("price") !== NULL) {
                $nameSkiFacility = (UHTTPMethods::post("nameSkiFacility") !== NULL) ? UHTTPMethods::post("nameSkiFacility") : "";
                $type = (UHTTPMethods::post("type") !== NULL) ? UHTTPMethods::post("type") : "";
                $price = (UHTTPMethods::post("price") !== NULL) ? UHTTPMethods::post("price") : "";
                $skipassObjs = FPersistentManager::getInstance()->retriveSkipassObjForSearch($nameSkiFacility, $type, $price);
                $view->searchSkipassObjs($skipassObjs);
            }else {
                $result = FPersistentManager::getInstance()->retriveAllSkipassObj();
                $result1 = [];
                foreach ($result as $object) {
                    $idSkiFacility = $object->getIdSkiFacility();
                    $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($idSkiFacility);
                    $idSkipassTemp = $object->getIdSkipassTemp();
                    $skipassTemp = FPersistentManager::getInstance()->retriveSkipassTempOnId($idSkipassTemp);
                    $result1[] = [$object, $skiFacility[0], $skipassTemp[0]];
                }
                $view->searchSkipassObjs($result1);
            }
        } else {
            $view = new VAdmin();
            $view->showLoginForm();
        }
    }

    public static function searchSkipassBooking() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            if(UHTTPMethods::post("nameSkiFacility") !== NULL || UHTTPMethods::post("type") !== NULL
            || UHTTPMethods::post("price") !== NULL) {
                $nameSkiFacility = (UHTTPMethods::post("nameSkiFacility") !== NULL) ? UHTTPMethods::post("nameSkiFacility") : "";
                $type = (UHTTPMethods::post("type") !== NULL) ? UHTTPMethods::post("type") : "";
                $price = (UHTTPMethods::post("price") !== NULL) ? UHTTPMethods::post("price") : "";
                $skipassObjs = FPersistentManager::getInstance()->retriveSkipassObjForSearch($nameSkiFacility, $type, $price);
                $view->searchSkipassObjs($skipassObjs);
            }else {
                $result = FPersistentManager::getInstance()->retriveAllSkipassBookingAllUsers();
                $view->searchSkipassBooking($result);
            }
        } else {
            $view = new VAdmin();
            $view->showLoginForm();
        }
    }

    public static function searchSkipassTemplate() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            if(UHTTPMethods::post("description") !== NULL || UHTTPMethods::post("period") !== NULL
            || UHTTPMethods::post("type") !== NULL) {
                $description = (UHTTPMethods::post("description") !== NULL) ? UHTTPMethods::post("description") : "";
                $period = (UHTTPMethods::post("period") !== NULL) ? UHTTPMethods::post("period") : "";
                $type = (UHTTPMethods::post("type") !== NULL) ? UHTTPMethods::post("type") : "";
                $$skipassTemps = FPersistentManager::getInstance()->retriveSkipassTempForSearch($description, $period, $type);
                $view->searchSkipassTemps($skipassTemps);
            }else {
                $result = FPersistentManager::getInstance()->retriveAllSkipassTemp();
                $view->searchSkipassTemps($result);
            }
        } else {
            $view = new VAdmin();
            $view->showLoginForm();
        }
    }

    public static function searchInsuranceTemplate() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            if(UHTTPMethods::post("value") !== NULL || UHTTPMethods::post("type") !== NULL) {
                $value = (UHTTPMethods::post("value") !== NULL) ? UHTTPMethods::post("value") : "";
                $type = (UHTTPMethods::post("type") !== NULL) ? UHTTPMethods::post("type") : "";
                $insuranceTemps = FPersistentManager::getInstance()->retriveInsuranceTempForSearch($value, $type);
                $view->searchInsuranceTemps($insuranceTemps);
            }else {
                $result = FPersistentManager::getInstance()->retriveAllInsuranceTemp();
                $view->searchInsuranceTemps($result);
            }
        } else {
            $view = new VAdmin();
            $view->showLoginForm();
        }
    }







    /* ADD FUNCTIONS */

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

    public static function addSkipassObj() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $allSkiFacilities = FPersistentManager::getInstance()->retriveAllSkiFacilities();
            $templates = FPersistentManager::getInstance()->retriveAllSkipassTemp();
            $view->addSkipassObj($allSkiFacilities, $templates);
        } else {
            CAdmin::dashboard();
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

    public static function addImageSkiFacility() {
        if(CAdmin::isLogged()) {
            $idImage = UHTTPMethods::post('idImage');
            if(UHTTPMethods::files('image','size') > 0){
                $uploadedImage = UHTTPMethods::files('image');
                $check = FPersistentManager::getInstance()->checkImage($uploadedImage);
                if($check == 'UPLOAD_ERROR_OK' || $check == 'TYPE_ERROR' || $check == 'SIZE_ERROR') {
                    $checkImageError = true;
                } else {
                    $checkImageError = false;
                }
                if(!$checkImageError) {
                    FPersistentManager::getInstance()->uploadObj($check);
                    $image = FPersistentManager::getInstance()->retriveSkiFacilityImageOnId($idImage);
                    if($image == []){
                        $image = new ESkiFacilityImage($check->getId());
                        $image->setIdSkiFacility($idImage);
                        FPersistentManager::getInstance()->uploadSkiFacilityImage($image);
                        CAdmin::dashboard();
                    }else{
                        $image[0]->setIdImage($check->getId());
                        FPersistentManager::getInstance()->updateIdSkiFacilityImage($image[0]);
                        CAdmin::dashboard();
                    }
                } else {
                    CAdmin::dashboard();
                }
            } else {
                CAdmin::dashboard();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    public static function addImageLandingPage() {
        if(CAdmin::isLogged()) {
            $idImage = UHTTPMethods::post('idImage');
            if(UHTTPMethods::files('image','size') > 0){
                $uploadedImage = UHTTPMethods::files('image');
                $check = FPersistentManager::getInstance()->checkImage($uploadedImage);
                if($check == 'UPLOAD_ERROR_OK' || $check == 'TYPE_ERROR' || $check == 'SIZE_ERROR') {
                    $checkImageError = true;
                } else {
                    $checkImageError = false;
                }
                if(!$checkImageError) {
                    FPersistentManager::getInstance()->uploadObj($check);
                    $image = FPersistentManager::getInstance()->retriveLandingImageOnId($idImage);
                    if($image[0]->getIdImage() != 0){
                        if(FPersistentManager::getInstance()->deleteLandingImage($image[0])){
                            $image[0]->setIdImage($check->getId());
                            FPersistentManager::getInstance()->updateIdLandingImage($image[0]);
                        }
                        CAdmin::dashboard();
                    }else{
                        $image[0]->setIdImage($check->getId());
                        FPersistentManager::getInstance()->updateIdLandingImage($image[0]);
                        CAdmin::dashboard();
                    }
                } else {
                    CAdmin::dashboard();
                }
            } else {
                CAdmin::dashboard();
            }
        } else {
            CAdmin::dashboard();
        }
    }


















    /* MODIFY FUNCTIONS */

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
            $view->modifyProfile($userId, $username, $name, $surname, $email, $phoneNumber, $birthDate, false, false);
        } else {
            CAdmin::dashboard();
        }
    }

    public static function modifyProfileImage() : void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $userId = UHTTPMethods::post('userId');
            $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
            $idImage = $user[0]->getIdImage();
            $image = FPersistentManager::getInstance()->retriveImageOnId($idImage);
            if($idImage == 0)
                $view->modifyProfileImage($userId, false, $image);
            else    
                $view->modifyProfileImage($userId, true, $image);
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
            $allnameSkiFacility = FPersistentManager::getInstance()->nameAllSkiFacility();
            //$idImage = $user->getIdImage();
            //$image = FPersistentManager::getInstance()->retriveImageOnId($idImage);
            $view->modifySkiRun($idSkiRun, $name, $type, $status, $nameSkiFacility[0], $allnameSkiFacility, $idSkiFacility);
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
            $allnameSkiFacility = FPersistentManager::getInstance()->nameAllSkiFacility();
            //$idImage = $user->getIdImage();
            //$image = FPersistentManager::getInstance()->retriveImageOnId($idImage);
            $view->modifyLiftStructure($idLiftStructure, $name, $type, $status, $seats, $nameSkiFacility[0], $allnameSkiFacility, $idSkiFacility);
        } else {
            CAdmin::dashboard();
        }
    }

    public static function modifySkipassBooking() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $idSkipassBooking = UHTTPMethods::post('idSkipassBooking');
            $skipassBooking = FPersistentManager::getInstance()->retriveSkipassBookingOnId($idSkipassBooking);
            $today = new DateTime();
            $view->modifySkipassBooking($skipassBooking[0], $today->format('Y-m-d'));
        } else {
            CAdmin::dashboard();
        }
    }

    public static function modifySkipassObj() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $idSkipassObj = UHTTPMethods::post('idSkipassObj');
            $skipassObj = FPersistentManager::getInstance()->retriveSkipassObjOnId($idSkipassObj);
            $description = $skipassObj[0]->getDescription();
            $value = $skipassObj[0]->getValue();
            $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($skipassObj[0]->getIdSkiFacility());
            $skipassTemp = FPersistentManager::getInstance()->retriveSkipassTempOnId($skipassObj[0]->getIdSkipassTemp());
            $view->modifySkipassObj($idSkipassObj, $description, $value, $skiFacility[0], $skipassTemp[0]);
        } else {
            $view = new VAdmin();
            $view->showLoginForm();
        }
    }

    public static function modifySkiFacilityImage() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $allSkiFacilities = FPersistentManager::getInstance()->retriveAllSkiFacilities();
            foreach ($allSkiFacilities as $i) {
                $map[$i->getIdSkiFacility()] = [];
            }
            $skiFacilityImage = FPersistentManager::retriveAllSkiFacilityImage();
            foreach ($skiFacilityImage as $i) {
                if($i->getIdImage() != 0)
                    $map[$i->getIdSkiFacility()][] = FPersistentManager::retriveImageOnId($i->getIdImage());
                else
                    $map[$i->getIdSkiFacility()][] = [];
            }
            $view->modifySkiFacilitiesImages($allSkiFacilities, $map);
        } else {
            CAdmin::dashboard();
        }
    }

    public static function modifyLandingPage() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $landingImage = FPersistentManager::retriveAllLandingImage();
            $landingImage1 = $landingImage[0];
            $image1 = FPersistentManager::retriveImageOnId($landingImage1->getIdImage());
            $landingImage2 = $landingImage[1];
            $image2 = FPersistentManager::retriveImageOnId($landingImage2->getIdImage());
            $landingImage3 = $landingImage[2];
            $image3 = FPersistentManager::retriveImageOnId($landingImage3->getIdImage());
            $landingImage4 = $landingImage[3];
            $image4 = FPersistentManager::retriveImageOnId($landingImage4->getIdImage());
            $landingImage5 = $landingImage[4];
            $image5 = FPersistentManager::retriveImageOnId($landingImage5->getIdImage());
            $view->modifyLandingPage($image1, $image2, $image3, $image4, $image5);
        } else {
            CAdmin::dashboard();
        }
    }

    public static function modifyInsuranceTemp() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $idInsuranceTemp = UHTTPMethods::post('idInsuranceTemp');
            $insuranceTemp = FPersistentManager::getInstance()->retriveInsuranceTempFromIdInsurance($idInsuranceTemp);    
            $value = $insuranceTemp[0]->getValue();
            $type = $insuranceTemp[0]->getType();
            $view->modifyInsuranceTemp($idInsuranceTemp, $value, $type);
        } else {
            $view = new VAdmin();
            $view->showLoginForm();
        }
    }

    public static function modifySkipassTemp() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $idSkipassTemp = UHTTPMethods::post('idSkipassTemp');
            $skipassTemp = FPersistentManager::getInstance()->retriveSkipassTempOnId($idSkipassTemp);
            $description = $skipassTemp[0]->getDescription();
            $period = $skipassTemp[0]->getPeriod();
            $type = $skipassTemp[0]->getType();
            $view->modifySkipassTemplate($idSkipassTemp, $description, $period, $type);
        } else {
            $view = new VAdmin();
            $view->showLoginForm();
        }
    }

    public static function modifyImage() {
        $userId = UHTTPMethods::post('userId');
        $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
        if(UHTTPMethods::files('image','size') > 0){
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
                    CAdmin::dashboard();
                }else{
                    $user[0]->setIdImage($check->getId());
                    FPersistentManager::getInstance()->updateUserIdImage($user[0]);
                    CAdmin::dashboard();
                }
            }
        } else {
            $view = new VAdmin();
            $image = UHTTPMethods::files('image');
            $view->modifyProfileImage($userId, false, $image);
        }
    }
















    /* CONFIRM FUNCTIONS */

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
            $idImage = $user->getIdImage();
            $image = FPersistentManager::getInstance()->retriveImageOnId($idImage);
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
                $view->modifyProfile($username, $name, $surname, $email, $phoneNumber, $birthDate, $image, $phoneError, $dateError); 
            }
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

    /**
     * Method to verify all the data in the modify ski run form 
     * @return void
     */
    public static function confirmModifySkiRun() : void{
        if(CAdmin::isLogged()) {
            $idSkiRun = UHTTPMethods::post('idSkiRun');
            $idSkiFacility = UHTTPMethods::post('idSkiFacility');
            $skiRun = new ESkiRun(UHTTPMethods::post('name'), UHTTPMethods::post('type'), UHTTPMethods::post('status'));
            $skiRun->setIdSkiRun($idSkiRun);
            $skiRun->setIdSkiFacility($idSkiFacility);
            FPersistentManager::getInstance()->updateSkiRunInfo($skiRun);
            CAdmin::dashboard();
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
            $liftStructure = new ELiftStructure(UHTTPMethods::post('name'), UHTTPMethods::post('type'), UHTTPMethods::post('status'), UHTTPMethods::post('seats'));
            $liftStructure->setIdLift($idLiftStructure);
            $liftStructure->setIdSkiFacility($idSkiFacility);
            FPersistentManager::getInstance()->updateLiftStructureInfo($liftStructure);
            CAdmin::dashboard();
        } else {
            CAdmin::dashboard();
        }
    }

    public static function confirmSkipassObj() {
        if(CAdmin::isLogged()) {
            $description = UHTTPMethods::post('description');
            $value = UHTTPMethods::post('value');
            $idSkiFacility = UHTTPMethods::post('idSkiFacility');
            $idSkipassTemplate = UHTTPMethods::post('idSkipassTemplate');
            $skipass = new ESkipassObj($description, $value);
            $skipass->setIdSkiFacility($idSkiFacility);
            $skipass->setIdSkipassTemp($idSkipassTemplate);
            FPersistentManager::getInstance()->uploadObj($skipass);
            header('Location: /Slope/Admin/dashboard'); 
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

    public static function confirmModifyInsuranceTemp() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $idInsuranceTemp = UHTTPMethods::post('idInsuranceTemp');
            $insuranceTemp = new EInsuranceTemp(UHTTPMethods::post('type'), UHTTPMethods::post('value'));
            $insuranceTemp->setIdInsuranceTemp($idInsuranceTemp);
            FPersistentManager::getInstance()->updateInsuranceTemp($insuranceTemp);
            header('Location: /Slope/Admin/dashboard'); 
        } else {
            $view = new VAdmin();
            $view->showLoginForm();
        }
    }

    public static function confirmModifySkipassTemp() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $idSkipassTemp = UHTTPMethods::post('idSkipassTemp');
            $skipassTemp = new ESkipassTemplate(UHTTPMethods::post('description'), UHTTPMethods::post('period'), UHTTPMethods::post('type'));
            $skipassTemp->setIdSkipassTemplate($idSkipassTemp);
            FPersistentManager::getInstance()->updateSkipassTemplate($skipassTemp);
            header('Location: /Slope/Admin/dashboard'); 
        } else {
            $view = new VAdmin();
            $view->showLoginForm();
        }
    }

    public static function confirmModifySkipassObj() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $idSkipassObj = UHTTPMethods::post('idSkipassObj');
            $skipassObj = new ESkipassObj(UHTTPMethods::post('description'), UHTTPMethods::post('value'));
            $skipassObj->setIdSkipassObj($idSkipassObj);
            FPersistentManager::getInstance()->updateSkipassObj($skipassObj);
            header('Location: /Slope/Admin/dashboard'); 
        } else {
            $view = new VAdmin();
            $view->showLoginForm();
        }
    }

    public static function confirmModifyBooking() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $idSkipassBooking = UHTTPMethods::post('idSkipassBooking');
            $userId = UHTTPMethods::post("userId");
            $oldSkipassBooking = FPersistentManager::getInstance()->retriveSkipassBookingOnId($idSkipassBooking);
            $value = $oldSkipassBooking[0]->getValue();
            $idSkipassObj = $oldSkipassBooking[0]->getIdSkipassObj();
            $skipassBooking = new ESkipassBooking(UHTTPMethods::post('name'), UHTTPMethods::post('surname'), UHTTPMethods::post('date'), UHTTPMethods::post('type'), UHTTPMethods::post('email'), UHTTPMethods::post('period'), $value); 
            $skipassBooking->setIdSkipassBooking($idSkipassBooking);
            $skipassBooking->setIdSkipassObj($idSkipassObj);
            $skipassBooking->setIdUser($userId);
            FPersistentManager::getInstance()->updateSkipassBookingInfo($skipassBooking);
            header('Location: /Slope/Admin/dashboard'); 
        } else {
            $view = new VAdmin();
            $view->showLoginForm();
        }
    }











    /* DELETE FUNCTIONS */

    public static function deleteSkiFacility() : void{
        if(CAdmin::isLogged()) {
            $idSkiFacility = UHTTPMethods::post('idSkiFacility');
            $view = new VAdmin();
            $view->deletePage();
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

    public static function deleteLiftStructure() {
        if(CAdmin::isLogged()) {
            $idSkiRun = UHTTPMethods::post('idLiftStructure');
            $view = new VAdmin();
            $view->deletePage();
        } else {
            CAdmin::dashboard();
        }
    }

    

    

    /* public static function manageInterface() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $view->manageInterface($landingImage1);
        }
    } */

    /**
     * Method to retrive all the data in the add lift structure form 
     * @return void
     */
    /* public static function addPrice() {
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
    } */

    /* public static function confirmPrice() {
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
    } */

    /* public static function modifyPrice() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $idPrice = UHTTPMethods::post('idPrice');
            $price = FPersistentManager::getInstance()->retrivePriceOnId($idPrice);
            $description = $price[0]->getDescription();
            $value = $price[0]->getValue();
            $idExtObj = $price[0]->getIdExtObj();
            $extClass = $price[0]->getExtClass();
            $class = substr($extClass, 1);
            $obj = FPersistentManager::getInstance()->retriveObj($class, $idExtObj);
            $view->modifyPrice($idPrice, $description, );
        } else {
            $view = new VAdmin();
            $view->showLoginForm();
        }
    } */

    /* public static function confirmModifyPrice() {
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
    } */

    /* public static function searchPrices() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            if(UHTTPMethods::post("description") !== NULL) {
                $description = (UHTTPMethods::post("description") !== NULL) ? UHTTPMethods::post("description") : "";
                $prices = FPersistentManager::getInstance()->retrivePriceFromDesc($description);
                $view->searchPrices($prices);
            } else {
                $prices = FPersistentManager::getInstance()->retriveAllPricesForSearch();
                $view->searchPrices($prices);
            }
        } else {
            $view = new VAdmin();
            $view->showLoginForm();
        }
    } */

    

    

    

    

    

    

    

    

    

    

    

}

/* 

 */
?>