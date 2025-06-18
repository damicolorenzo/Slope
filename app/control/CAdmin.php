<?php

require_once (__DIR__."\\..\\config\\autoloader.php");

class CAdmin {

    /**
     * Method to retrive the login form
     * Call the showLoginForm() method from VAdmin
     * @return void
     */
    public static function login() : void{
        if(USession::getSessionStatus() == PHP_SESSION_NONE){
            USession::getInstance();
        }
        if(USession::isSetSessionElement('ad')){
            CAdmin::dashboard();
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
        if(USession::isSetSessionElement('ad')){
            USession::unsetSession();
            USession::destroySession();
            header('Location: /Slope/');
        }
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
        if(!CAdmin::isLogged()) { //if Not logged
            if((!empty(UHTTPMethods::post('username')) && !empty(UHTTPMethods::post('password')))) { //From login form 
                $username = FPersistentManager::getInstance()->verifyAdminUsername(UHTTPMethods::post('username'));
                if($username)
                    $admin = FPersistentManager::getInstance()->retriveAdminOnUsername(UHTTPMethods::post('username'));
                else
                    $admin = [];
                if($username && count($admin) == 1) {
                    if(password_verify(UHTTPMethods::post('password'), $admin[0]->getPassword())) {
                        if(USession::getSessionStatus() == PHP_SESSION_NONE) {
                            USession::getInstance();
                            USession::setSessionElement('ad', $admin[0]->getIdAdmin());
                            CAdmin::dashboard();
                        } else {
                            USession::setSessionElement('ad', $admin[0]->getIdAdmin());
                            CAdmin::dashboard();
                        }
                    } else {
                        $view->showLoginForm(true);
                    }
                } else {
                    $view->showLoginForm(true);
                }
            } else { //Not from login form
                CAdmin::login();
            }
        } else { //if logged
            CAdmin::dashboard();
        }
        
    }

    /**
     * Method to retrive from the database all the data showed in the dashboard
     * @return void
     */
    public static function dashboard() : void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $map = [];
            $skipassBookings = FPersistentManager::retriveAllSkipassBookingAllUsers();
            foreach ($skipassBookings as $element) {
                $skipassObj = FPersistentManager::retriveSkipassObjOnId($element->getIdSkipassObj());
                $idSkiFacility = $skipassObj[0]->getIdSkiFacility();
                $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($idSkiFacility);
                $nameSkiFacility = $skiFacility[0]->getName();
                $date = new DateTime($element->getStartDate());
                $month = $date->format("Y-m");
                if(isset($map[$month][$nameSkiFacility])) {
                    $map[$month][$nameSkiFacility] += 1; 
                } else {
                    $map[$month][$nameSkiFacility] = 1; 
                }
            }
            $utenti = FPersistentManager::getInstance()->retriveAllUsers();
            $countUsers = 0;
            $countSubUsers = 0;
            foreach ($utenti as $element) {
                $subscription = FPersistentManager::getInstance()->retriveSubscriptionFromUserId($element->getIdUser());
                if(count($subscription) > 0)
                    $countSubUsers += 1;
                else   
                    $countUsers += 1;
            }
            $labelsPie = json_encode(["Utenti Abbonati", "Utenti Non Abbonati"]);
            $datiPie = json_encode([$countSubUsers, $countUsers]);
            $map = json_encode($map);
            $view->dashboard($map, $labelsPie, $datiPie);
        } else {
            CAdmin::login();
        }
    }
   
    
    /**
     * Method to search users based on criteria
     * Retrieves users by name, surname, or username if provided via POST
     * If no criteria are provided, retrieves all users
     * Calls the searchUsers() method from VAdmin to display results
     * @return void
     */
    public static function searchUsers() : void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            if(!is_null(UHTTPMethods::post("name")) || !is_null(UHTTPMethods::post("surname"))
            || !is_null(UHTTPMethods::post("username"))) {
                $name = !is_null(UHTTPMethods::post("name")) ? UHTTPMethods::post("name") : "";
                $surname = !is_null(UHTTPMethods::post("surname")) ? UHTTPMethods::post("surname") : "";
                $username = !is_null(UHTTPMethods::post("username")) ? UHTTPMethods::post("username") : "";
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

    /**
     * Method to search skiFacilities, skiRuns and liftStructures based on criteria
     * Retrieves structures by ski facility name, ski run name, or lift structure name if provided via POST
     * If no criteria are provided, retrieves all ski structures
     * Calls the searchStructure() method from VAdmin to display results
     * @return void
     */
    public static function searchStructures() : void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            if(!is_null(UHTTPMethods::post("nameSkiFacility")) || !is_null(UHTTPMethods::post("nameSkiRun"))
            || !is_null(UHTTPMethods::post("nameLiftStructure"))) {
                $nameSkiFacility = !is_null(UHTTPMethods::post("nameSkiFacility")) ? UHTTPMethods::post("nameSkiFacility") : "";
                $nameSkiRun = !is_null(UHTTPMethods::post("nameSkiRun")) ? UHTTPMethods::post("nameSkiRun") : "";
                $nameLiftStructure = !is_null(UHTTPMethods::post("nameLiftStructure")) ? UHTTPMethods::post("nameLiftStructure") : "";
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

    /**
     * Method to search skipass objects based on criteria
     * Retrieves skipass objects by description, value, or ski facility name if provided via POST
     * If no criteria are provided, retrieves all skipass objects with associated ski facility and template data
     * Calls the searchSkipassObjs() method from VAdmin to display results
     * @return void
     */
    public static function searchSkipassObjs() : void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            if(!is_null(UHTTPMethods::post("description")) || !is_null(UHTTPMethods::post("value"))
            || !is_null(UHTTPMethods::post("nameSkiFacility"))) {
                $nameSkiFacility = !is_null(UHTTPMethods::post("nameSkiFacility")) ? UHTTPMethods::post("nameSkiFacility") : "";
                $description = !is_null(UHTTPMethods::post("description")) ? UHTTPMethods::post("description") : "";
                $value = !is_null(UHTTPMethods::post("value")) ? UHTTPMethods::post("value") : "";
                $skipassObjs = FPersistentManager::getInstance()->retriveSkipassObjForSearch($nameSkiFacility, $description, $value);
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
            CAdmin::dashboard();
        }
    }

    /**
     * Method to search skipass bookings based on criteria
     * Retrieves skipass bookings by username, ski facility name, or email if provided via POST
     * If no criteria are provided, retrieves all skipass bookings with associated user and ski facility data
     * Calls the searchSkipassBooking() method from VAdmin to display results
     * @return void
     */
    public static function searchSkipassBooking() : void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            if(!is_null(UHTTPMethods::post("username")) || !is_null(UHTTPMethods::post("nameSkiFacility"))
            || !is_null(UHTTPMethods::post("email"))) {
                $nameSkiFacility = !is_null(UHTTPMethods::post("nameSkiFacility")) ? UHTTPMethods::post("nameSkiFacility") : "";
                $username = !is_null(UHTTPMethods::post("username")) ? UHTTPMethods::post("username") : "";
                $email = !is_null(UHTTPMethods::post("email")) ? UHTTPMethods::post("email") : "";
                $skipassObjs = FPersistentManager::getInstance()->retriveSkipassBookingForSearch($nameSkiFacility, $username, $email);
                $view->searchSkipassBooking($skipassObjs);
            }else {
                $result = FPersistentManager::getInstance()->retriveAllSkipassBookingAllUsers();
                $result1 = [];
                foreach ($result as $object) {
                    $idUser = $object->getIdUser();
                    $user = FPersistentManager::getInstance()->retriveUserOnId($idUser);
                    $idSkipassObj = $object->getIdSkipassObj();
                    $skipassObj = FPersistentManager::getInstance()->retriveSkipassObjOnId($idSkipassObj);
                    $idSkiFacility = $skipassObj[0]->getIdSkiFacility();
                    $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($idSkiFacility);
                    $result1[] = [$object, $skiFacility[0], $user[0]];
                }
                $view->searchSkipassBooking($result1);
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to search skipass templates based on criteria
     * Retrieves skipass templates by description, period, or type if provided via POST
     * If no criteria are provided, retrieves all skipass templates
     * Calls the searchSkipassTemps() method from VAdmin to display results
     * @return void
     */
    public static function searchSkipassTemplate() :void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            if(!is_null(UHTTPMethods::post("description")) || !is_null(UHTTPMethods::post("period"))
            || !is_null(UHTTPMethods::post("type"))) {
                $description = !is_null(UHTTPMethods::post("description")) ? UHTTPMethods::post("description") : "";
                $period = !is_null(UHTTPMethods::post("period")) ? UHTTPMethods::post("period") : "";
                $type = !is_null(UHTTPMethods::post("type")) ? UHTTPMethods::post("type") : "";
                $skipassTemps = FPersistentManager::getInstance()->retriveSkipassTempForSearch($description, $period, $type);
                $view->searchSkipassTemps($skipassTemps);
            }else {
                $result = FPersistentManager::getInstance()->retriveAllSkipassTemp();
                $view->searchSkipassTemps($result);
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to search insurance templates based on criteria
     * Retrieves insurance templates by value or type if provided via POST
     * If no criteria are provided, retrieves all insurance templates
     * Calls the searchInsuranceTemps() method from VAdmin to display results
     * @return void
     */
    public static function searchInsuranceTemplate() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            if(!is_null(UHTTPMethods::post("value")) || !is_null(UHTTPMethods::post("type"))) {
                $value = !is_null(UHTTPMethods::post("value")) ? UHTTPMethods::post("value") : "";
                $type = !is_null(UHTTPMethods::post("type")) ? UHTTPMethods::post("type") : "";
                $insuranceTemps = FPersistentManager::getInstance()->retriveInsuranceTempForSearch($value, $type);
                $view->searchInsuranceTemps($insuranceTemps);
            }else {
                $result = FPersistentManager::getInstance()->retriveAllInsuranceTemp();
                $view->searchInsuranceTemps($result);
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to search subscription templates based on criteria
     * Retrieves subscription templates by value or description if provided via POST
     * If no criteria are provided, retrieves all subscription templates
     * Calls the searchSubscriptionTemps() method from VAdmin to display results
     * @return void
     */
    public static function searchSubscriptionTemplate() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            if(!is_null(UHTTPMethods::post("value")) || !is_null(UHTTPMethods::post("description"))) {
                $value = !is_null(UHTTPMethods::post("value")) ? UHTTPMethods::post("value") : "";
                $description = !is_null(UHTTPMethods::post("description")) ? UHTTPMethods::post("description") : "";
                $subscriptionTemps = FPersistentManager::getInstance()->retriveSubscriptionTempForSearch($description, $value);
                $view->searchSubscriptionTemps($subscriptionTemps);
            }else {
                $result = FPersistentManager::getInstance()->retriveAllSubscriptionTemp();
                $view->searchSubscriptionTemps($result);
            }
        } else {
            CAdmin::dashboard();
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
    public static function addSkipassTemplate() :void{
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
    public static function addInsuranceTemplate() :void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $view->addInsuranceTemplate();
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to retrive all the data in the add subscription template form 
     * @return void
     */
    public static function addSubscription() :void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $view->addSubscription();
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to retrive all the data in the add skipass object template form 
     * @return void
     */
    public static function addSkipassObj() :void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $allSkiFacilities = FPersistentManager::getInstance()->retriveAllSkiFacilities();
            $templates = FPersistentManager::getInstance()->retriveAllSkipassTemp();
            $view->addSkipassObj($allSkiFacilities, $templates);
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to retrive all the data in the add image ski facility form 
     * @return void
     */
    public static function addImageSkiFacility() :void{
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

    /**
     * Method to retrive all the data in the add image landing page form 
     * @return void
     */
    public static function addImageLandingPage() :void{
        if(CAdmin::isLogged()) {
            $id = UHTTPMethods::post('id');
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
                    $image = FPersistentManager::getInstance()->retriveLandingImageOnId($id);
                    if($image[0]->getIdImage() != 0){
                        if(FPersistentManager::getInstance()->deleteLandingImage($image[0]->getIdImage())){
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
     * Method to display the profile modification form for a user
     * Retrieves user data by userId provided via POST and displays the modification form
     * Calls the modifyProfile() method from VAdmin with user data and default flags
     * @return void
     */
    public static function modifyProfile() : void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            if(!is_null(UHTTPMethods::post('userId'))) {
                $userId = UHTTPMethods::post('userId');
                $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
                if(count($user) > 0) {
                    $user = $user[0];
                    $username = $user->getUsername(); 
                    $name = $user->getName();
                    $surname = $user->getSurname();
                    $email = $user->getEmail();
                    $phoneNumber = $user->getPhoneNumber();
                    $birthDate = $user->getBirthDate();
                    $view->modifyProfile($userId, $username, $name, $surname, $email, $phoneNumber, $birthDate, false, false);
                } else {
                    CAdmin::searchUsers();
                }
            } else {
                CAdmin::searchUsers();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to display the profile image modification form for a user
     * Retrieves user data and associated image by userId provided via POST
     * Checks if user has an image (idImage != 0) and passes appropriate flag to view
     * Calls the modifyProfileImage() method from VAdmin with user ID, image status flag, and image data
     * @return void
     */
    public static function modifyProfileImage() : void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            if(!is_null(UHTTPMethods::post('userId'))) {
                $userId = UHTTPMethods::post('userId');
                $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
                $idImage = $user[0]->getIdImage();
                $image = FPersistentManager::getInstance()->retriveImageOnId($idImage);
                if($idImage == 0)
                    $view->modifyProfileImage($userId, false, $image);
                else    
                    $view->modifyProfileImage($userId, true, $image);
            } else {
                CAdmin::searchUsers();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to display the ski facility modification form
     * Retrieves ski facility data by idSkiFacility provided via POST
     * Extracts facility name, status, and description for form pre-population
     * Calls the modifySkiFacility() method from VAdmin with facility data
     * @return void
     */
    public static function modifySkiFacility() : void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            if(!is_null(UHTTPMethods::post('idSkiFacility'))) {
                $idSkiFacility = UHTTPMethods::post('idSkiFacility');
                $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($idSkiFacility);
                $skiFacility = $skiFacility[0];
                $name = $skiFacility->getName();
                $status = $skiFacility->getStatus();
                $description = $skiFacility->getDescription();
                $view->modifySkiFacility($idSkiFacility, $name, $status, $description);
            } else {
                CAdmin::searchStructures();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to display the ski run modification form
     * Retrieves ski run data by idSkiRun provided via POST
     * Gets associated ski facility name and all available ski facility names for dropdown
     * Calls the modifySkiRun() method from VAdmin with run data and facility options
     * @return void
     */
    public static function modifySkiRun(): void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            if(!is_null(UHTTPMethods::post('idSkiRun'))) {
                $idSkiRun = UHTTPMethods::post('idSkiRun');
                $skiRun = FPersistentManager::getInstance()->retriveSkiRunOnId($idSkiRun);
                $skiRun = $skiRun[0];
                $name = $skiRun->getName();
                $type = $skiRun->getType();
                $status = $skiRun->getStatus();
                $idSkiFacility = $skiRun->getIdSkiFacility();
                $nameSkiFacility = FPersistentManager::getInstance()->nameSkiFacility($idSkiFacility);
                $allnameSkiFacility = FPersistentManager::getInstance()->nameAllSkiFacility();
                $view->modifySkiRun($idSkiRun, $name, $type, $status, $nameSkiFacility[0], $allnameSkiFacility, $idSkiFacility);
            } else {
                CAdmin::searchStructures();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to display the lift structure modification form
     * Retrieves lift structure data by idLift provided via POST
     * Gets associated ski facility name and all available ski facility names for dropdown
     * Calls the modifyLiftStructure() method from VAdmin with structure data and facility options
     * @return void
     */
    public static function modifyLiftStructure() : void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            if(!is_null(UHTTPMethods::post('idLift'))) {
                $idLiftStructure = UHTTPMethods::post('idLift');
                $liftStructure = FPersistentManager::getInstance()->retriveLiftStructureOnId($idLiftStructure);
                $liftStructure = $liftStructure[0];
                $name = $liftStructure->getName();
                $type = $liftStructure->getType();
                $status = $liftStructure->getStatus();
                $seats = $liftStructure->getSeats();
                $idSkiFacility = $liftStructure->getIdSkiFacility();
                $nameSkiFacility = FPersistentManager::getInstance()->nameSkiFacility($idSkiFacility);
                $allnameSkiFacility = FPersistentManager::getInstance()->nameAllSkiFacility();
                $view->modifyLiftStructure($idLiftStructure, $name, $type, $status, $seats, $nameSkiFacility[0], $allnameSkiFacility, $idSkiFacility);
            } else {
                CAdmin::searchStructures();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to display the skipass booking modification form
     * Retrieves skipass booking data by idSkipassBooking provided via POST
     * Gets current date for form operations
     * Calls the modifySkipassBooking() method from VAdmin with booking data and current date
     * @return void
     */
    public static function modifySkipassBooking() :void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            if(!is_null(UHTTPMethods::post('idSkipassBooking'))) {
                $idSkipassBooking = UHTTPMethods::post('idSkipassBooking');
                $skipassBooking = FPersistentManager::getInstance()->retriveSkipassBookingOnId($idSkipassBooking);
                $today = new DateTime();
                $view->modifySkipassBooking($skipassBooking[0], $today->format('Y-m-d'));
            } else {
                CAdmin::searchSkipassBooking();
            } 
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to display the skipass object modification form
     * Retrieves skipass object data by idSkipassObj provided via POST
     * Gets associated ski facility and skipass template data for form pre-population
     * Calls the modifySkipassObj() method from VAdmin with object data and related entities
     * @return void
     */
    public static function modifySkipassObj() :void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            if(!is_null(UHTTPMethods::post('idSkipassObj'))) {
                $idSkipassObj = UHTTPMethods::post('idSkipassObj');
                $skipassObj = FPersistentManager::getInstance()->retriveSkipassObjOnId($idSkipassObj);
                $description = $skipassObj[0]->getDescription();
                $value = $skipassObj[0]->getValue();
                $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($skipassObj[0]->getIdSkiFacility());
                $skipassTemp = FPersistentManager::getInstance()->retriveSkipassTempOnId($skipassObj[0]->getIdSkipassTemp());
                $view->modifySkipassObj($idSkipassObj, $description, $value, $skiFacility[0], $skipassTemp[0]);
            } else {
                CAdmin::searchSkipassObjs();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to display the ski facility images modification interface
     * Retrieves all ski facilities and their associated images
     * Organizes images by ski facility ID in a map structure
     * Calls the modifySkiFacilitiesImages() method from VAdmin with facilities and image map
     * @return void
     */
    public static function modifySkiFacilityImage() :void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $allSkiFacilities = FPersistentManager::getInstance()->retriveAllSkiFacilities();
            if(count($allSkiFacilities) > 0) {
                foreach ($allSkiFacilities as $i) {
                    $map[$i->getIdSkiFacility()] = [];
                }
            } else {
                CAdmin::dashboard();
            }
            $skiFacilityImage = FPersistentManager::retriveAllSkiFacilityImage();
            if(count($skiFacilityImage) > 0) {
                foreach ($skiFacilityImage as $i) {
                    if($i->getIdImage() != 0)
                        $map[$i->getIdSkiFacility()][] = FPersistentManager::retriveImageOnId($i->getIdImage());
                    else
                        $map[$i->getIdSkiFacility()][] = [];
                }
            } else {
                CAdmin::dashboard();
            }
            $view->modifySkiFacilitiesImages($allSkiFacilities, $map);
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to display the landing page images modification form
     * Retrieves all 5 landing page images from database
     * Gets image data for each of the 5 landing page positions
     * Calls the modifyLandingPage() method from VAdmin with all 5 images
     * @return void
     */
    public static function modifyLandingPage() :void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $landingImage = FPersistentManager::retriveAllLandingImage();
            if(count($landingImage) > 0) {
                $images = [];
                foreach ($landingImage as $item) {
                    $images[] = FPersistentManager::retriveImageOnId($item->getIdImage());
                }
                $images = array_pad($images, 5, null);
                $view->modifyLandingPage($images[0], $images[1], $images[2], $images[3], $images[4]);
            } else {
                CAdmin::dashboard();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to display the insurance template modification form
     * Retrieves insurance template data by idInsuranceTemp provided via POST
     * Extracts template value and type for form pre-population
     * Calls the modifyInsuranceTemp() method from VAdmin with template data
     * @return void
     */
    public static function modifyInsuranceTemp() :void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            if(!is_null(UHTTPMethods::post('idInsuranceTemp'))) {
                $idInsuranceTemp = UHTTPMethods::post('idInsuranceTemp');
                $insuranceTemp = FPersistentManager::getInstance()->retriveInsuranceTempFromIdInsurance($idInsuranceTemp);    
                $value = $insuranceTemp[0]->getValue();
                $type = $insuranceTemp[0]->getType();
                $view->modifyInsuranceTemp($idInsuranceTemp, $value, $type);
            } else {
                CAdmin::searchInsuranceTemplate();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to display the skipass template modification form
     * Retrieves skipass template data by idSkipassTemp provided via POST
     * Extracts template description, period, and type for form pre-population
     * Calls the modifySkipassTemplate() method from VAdmin with template data
     * @return void
     */
    public static function modifySkipassTemp() :void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            if(!is_null(UHTTPMethods::post('idSkipassTemp'))) {
                $idSkipassTemp = UHTTPMethods::post('idSkipassTemp');
                $skipassTemp = FPersistentManager::getInstance()->retriveSkipassTempOnId($idSkipassTemp);
                $description = $skipassTemp[0]->getDescription();
                $period = $skipassTemp[0]->getPeriod();
                $type = $skipassTemp[0]->getType();
                $view->modifySkipassTemplate($idSkipassTemp, $description, $period, $type);
            } else {
                CAdmin::searchSkipassTemplate();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to handle user profile image upload and modification
     * Processes uploaded image file and validates it (size, type, upload errors)
     * Updates user's image ID after successful upload, deleting old image if exists
     * Redirects to dashboard on success or shows form with errors on failure
     * @return void
     */
    public static function modifyImage() :void{
        if(CAdmin::isLogged()) {
            if(!is_null(UHTTPMethods::post('userId'))) {
                $userId = UHTTPMethods::post('userId');
                $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
                if(count($user) > 0) {
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
                        $view->modifyProfileImage($userId, true, $image);
                    }
                } else {
                    CAdmin::searchUsers();
                }
            } else {
                CAdmin::searchUsers();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /* CONFIRM FUNCTIONS */

    /**
     * Method to verify all the data in the modify user form 
     * @return void
     */
    public static function confirmModify() : void{
        if(CAdmin::isLogged()){
            $view = new VAdmin();
            if(!is_null(UHTTPMethods::post('username'))) {
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
                if(!is_null(UHTTPMethods::post('phoneNumber')) && !preg_match($phone_number_validation_regex, UHTTPMethods::post('phoneNumber'))) {
                    $phoneError = true;
                } else {
                    $phoneError = false;
                    $extract_phone_number_pattern = "/\\+?[1-9][0-9]{7,14}/";
                    preg_match_all($extract_phone_number_pattern, UHTTPMethods::post('phoneNumber'), $matches);
                    $modifiedPhoneNumber = implode($matches[0]);
                }
                if(!is_null(UHTTPMethods::post('birthDate')) && !(date("Y-m-d") > UHTTPMethods::post('birthDate'))){
                    $dateError = true;
                } else {
                    $dateError = false;
                } 
                if(!is_null(UHTTPMethods::post('name')) && !is_null(UHTTPMethods::post('surname')) && !is_null(UHTTPMethods::post('email')) && !is_null(UHTTPMethods::post('birthDate')) && !is_null(UHTTPMethods::post('username')) && !is_null(UHTTPMethods::post('password'))) {
                    if(!$phoneError && !$dateError) { 
                        $updatedUser = new EUser(UHTTPMethods::post('name'), UHTTPMethods::post('surname'), UHTTPMethods::post('email'), $modifiedPhoneNumber, UHTTPMethods::post('birthDate'), UHTTPMethods::post('username'), password_hash(UHTTPMethods::post('password'), PASSWORD_DEFAULT));
                        $updatedUser->setId($userId);
                        FPersistentManager::getInstance()->updatePersonInfo($updatedUser);
                        CAdmin::dashboard();
                    }
                    else {
                        $view->modifyProfile($username, $name, $surname, $email, $phoneNumber, $birthDate, $image, $phoneError, $dateError); 
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

    /**
     * Method to verify all the data in the add ski run form 
     * @return void
     */
    public static function confirmSkiRun() : void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            if(!is_null(UHTTPMethods::post('skiFacility')) && !is_null(UHTTPMethods::post('name')) && !is_null(UHTTPMethods::post('type')) && !is_null(UHTTPMethods::post('status'))) {
                $idSkiFacility = FPersistentManager::getInstance()->retriveIdSkiFacilityFromName(UHTTPMethods::post('skiFacility'));
                $skiRunName = FPersistentManager::getInstance()->verifySkiRunName(UHTTPMethods::post('name'), $idSkiFacility[0]);
                if(!$skiRunName) {
                    $skiRun = new ESkiRun(UHTTPMethods::post('name'), UHTTPMethods::post('type'), UHTTPMethods::post('status'));
                    $skiRun->setIdSkiFacility($idSkiFacility[0]);
                    FPersistentManager::getInstance()->uploadObj($skiRun);
                    CAdmin::dashboard();
                } else {
                    $view->skiRunAlreadyExist();
                }
            } else {
                CAdmin::dashboard();
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
            if(!is_null(UHTTPMethods::post('idSkiRun')) && !is_null(UHTTPMethods::post('idSkiFacility')) && !is_null(UHTTPMethods::post('name')) && !is_null(UHTTPMethods::post('type')) && !is_null(UHTTPMethods::post('status'))) {
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
            if(!is_null(UHTTPMethods::post('name')) && !is_null(UHTTPMethods::post('description')) && !is_null(UHTTPMethods::post('status'))) {
                $skiFacility = FPersistentManager::getInstance()->verifySkiFacilityName(UHTTPMethods::post('name'));
                if(strlen(trim(UHTTPMethods::post('description'))) > 65535) {
                    $view->skiFacilityAlreadyExist();
                }
                if(!$skiFacility) {
                    $skiFacility = new ESkiFacility(UHTTPMethods::post('name'), UHTTPMethods::post('status'), UHTTPMethods::post('description'));
                    if(FPersistentManager::getInstance()->uploadObj($skiFacility))
                        CAdmin::dashboard();
                    else
                        print("ERRORE");
                } else {
                    $view->skiFacilityAlreadyExist();
                }
            } else {
                CAdmin::dashboard();
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
            $view = new VAdmin();
            if(!is_null(UHTTPMethods::post('idSkiFacility')) && !is_null(UHTTPMethods::post('name')) && !is_null(UHTTPMethods::post('status')) && !is_null(UHTTPMethods::post('description'))) {
                $idSkiFacility = UHTTPMethods::post('idSkiFacility');
                $skiFacilityName = FPersistentManager::getInstance()->verifySkiFacilityName('name', UHTTPMethods::post('name')); 
                if(!$skiFacilityName) {
                    $skiFacility = new ESkiFacility(UHTTPMethods::post('name'), UHTTPMethods::post('status'), UHTTPMethods::post('description'));
                    $skiFacility->setIdSkiFacility($idSkiFacility);
                    FPersistentManager::getInstance()->updateSkiFacilityInfo($skiFacility);
                    CAdmin::dashboard(); 
                } else {
                    $view->skiFacilityAlreadyExist();
                }
            } else {
                CAdmin::dashboard();
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
            $view = new VAdmin();
            if(!is_null(UHTTPMethods::post('skiFacility')) && !is_null(UHTTPMethods::post('name')) && !is_null(UHTTPMethods::post('type')) && !is_null(UHTTPMethods::post('status')) && !is_null(UHTTPMethods::post('seats'))) {
                $idSkiFacility = FPersistentManager::getInstance()->retriveIdSkiFacilityFromName(UHTTPMethods::post('skiFacility'));
                $liftStructureName = FPersistentManager::getInstance()->verifyLiftStructureName(UHTTPMethods::post('name'), $idSkiFacility[0]);
                if(!$liftStructureName) {
                    $liftStructure = new ELiftStructure(UHTTPMethods::post('name'), UHTTPMethods::post('type'), UHTTPMethods::post('status'), UHTTPMethods::post('seats'));
                    $liftStructure->setIdSkiFacility($idSkiFacility[0]);
                    FPersistentManager::getInstance()->uploadObj($liftStructure);
                    CAdmin::dashboard();
                } else {
                    $view->liftStructureAlreadyExist();
                }
            } else {
                CAdmin::dashboard();
            }
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
            if(!is_null(UHTTPMethods::post('idLiftStructure')) && !is_null(UHTTPMethods::post('name')) && !is_null(UHTTPMethods::post('idSkiFacility')) && !is_null(UHTTPMethods::post('type')) && !is_null(UHTTPMethods::post('type')) && !is_null(UHTTPMethods::post('seats'))) {
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
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to verify all the data in the add skipass template form 
     * @return void
     */
    public static function confirmSkipassTemp() :void{
        if(CAdmin::isLogged()) {
            if(!is_null(UHTTPMethods::post('description')) && !is_null(UHTTPMethods::post('period')) && !is_null(UHTTPMethods::post('type'))) {
                $description = UHTTPMethods::post('description');
                $period = UHTTPMethods::post('period');
                $type = UHTTPMethods::post('type');
                $skipass = new ESkipassTemp($description, $period, $type);
                FPersistentManager::getInstance()->uploadObj($skipass);
                CAdmin::dashboard();
            } else {
                CAdmin::dashboard();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to verify all the data in the modify skipass template form 
     * @return void
     */
    public static function confirmModifySkipassTemp() :void{
        if(CAdmin::isLogged()) {
            if(!is_null(UHTTPMethods::post('idSkipassTemp')) && !is_null(UHTTPMethods::post('description')) && !is_null(UHTTPMethods::post('period')) && !is_null(UHTTPMethods::post('type'))) {
                $idSkipassTemp = UHTTPMethods::post('idSkipassTemp');
                $skipassTemp = new ESkipassTemp(UHTTPMethods::post('description'), UHTTPMethods::post('period'), UHTTPMethods::post('type'));
                $skipassTemp->setIdSkipassTemplate($idSkipassTemp);
                FPersistentManager::getInstance()->updateSkipassTemplate($skipassTemp);
                CAdmin::dashboard();
            } else {
                CAdmin::dashboard();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to verify all the data in the add skipass object form 
     * @return void
     */
    public static function confirmSkipassObj() :void{
        if(CAdmin::isLogged()) {
            if(!is_null(UHTTPMethods::post('description')) && !is_null(UHTTPMethods::post('value')) && !is_null(UHTTPMethods::post('idSkiFacility')) && !is_null(UHTTPMethods::post('idSkipassTemplate'))) {
                $description = UHTTPMethods::post('description');
                $value = UHTTPMethods::post('value');
                $idSkiFacility = UHTTPMethods::post('idSkiFacility');
                $idSkipassTemplate = UHTTPMethods::post('idSkipassTemplate');
                $skipass = new ESkipassObj($description, $value);
                $skipass->setIdSkiFacility($idSkiFacility);
                $skipass->setIdSkipassTemp($idSkipassTemplate);
                FPersistentManager::getInstance()->uploadObj($skipass);
                CAdmin::dashboard();
            } else {
                CAdmin::dashboard();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to verify all the data in the modify skipass object form 
     * @return void
     */
    public static function confirmModifySkipassObj() :void{
        if(CAdmin::isLogged()) {
            if(!is_null(UHTTPMethods::post('idSkipassObj')) && !is_null(UHTTPMethods::post('description')) && !is_null(UHTTPMethods::post('value'))) {
                $idSkipassObj = UHTTPMethods::post('idSkipassObj');
                $skipassObj = new ESkipassObj(UHTTPMethods::post('description'), UHTTPMethods::post('value'));
                $skipassObj->setIdSkipassObj($idSkipassObj);
                FPersistentManager::getInstance()->updateSkipassObj($skipassObj);
                CAdmin::dashboard();
            } else {
                CAdmin::dashboard();
            }
        } else {
            CAdmin::dashboard();
        }
    }
    

    /**
     * Method to verify all the data in the add insurance template form 
     * @return void
     */
    public static function confirmInsuranceTemp() :void{
        if(CAdmin::isLogged()) {
            if(!is_null(UHTTPMethods::post('type')) && !is_null(UHTTPMethods::post('value'))) {
                $type = UHTTPMethods::post('type');
                $value = UHTTPMethods::post('value');
                $insuranceTemp = new EInsuranceTemp($type, $value);
                FPersistentManager::getInstance()->uploadObj($insuranceTemp);
                CAdmin::dashboard();
            } else {
                CAdmin::dashboard();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to verify all the data in the modify insurance template form 
     * @return void
     */
    public static function confirmModifyInsuranceTemp() :void{
        if(CAdmin::isLogged()) {
            if(!is_null(UHTTPMethods::post('idInsuranceTemp')) && !is_null(UHTTPMethods::post('type')) && !is_null(UHTTPMethods::post('value'))) {
                $idInsuranceTemp = UHTTPMethods::post('idInsuranceTemp');
                $insuranceTemp = new EInsuranceTemp(UHTTPMethods::post('type'), UHTTPMethods::post('value'));
                $insuranceTemp->setIdInsuranceTemp($idInsuranceTemp);
                FPersistentManager::getInstance()->updateInsuranceTemp($insuranceTemp);
                CAdmin::dashboard();
            } else {
                CAdmin::dashboard();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to verify all the data in the add subscription template form 
     * @return void
     */
    public static function confirmSubscription() :void{
        if(CAdmin::isLogged()) {
            if(!is_null(UHTTPMethods::post('description')) && !is_null(UHTTPMethods::post('value')) && !is_null(UHTTPMethods::post('discount'))) {
                $description = UHTTPMethods::post('description');
                $value = UHTTPMethods::post('value');
                $discount = UHTTPMethods::post('discount');
                $subscription = new ESubscriptionTemp($description, $value, $discount);
                FPersistentManager::getInstance()->uploadObj($subscription);
                CAdmin::dashboard();
            } else {
                CAdmin::dashboard();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to verify all the data in the modify skipass booking form 
     * @return void
     */
    public static function confirmModifyBooking() :void{
        if(CAdmin::isLogged()) {
            if(!is_null(UHTTPMethods::post('idSkipassBooking')) && !is_null(UHTTPMethods::post("userId")) && !is_null(UHTTPMethods::post('name')) && !is_null(UHTTPMethods::post('surname')) && !is_null(UHTTPMethods::post('date')) && !is_null(UHTTPMethods::post('type')) && !is_null(UHTTPMethods::post('email')) && !is_null(UHTTPMethods::post('period'))) {
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
                CAdmin::dashboard();
            } else {
                CAdmin::dashboard();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /* DELETE FUNCTIONS */

    /**
     * Method to delete all the data about a ski facility
     * @return void
     */
    public static function deleteSkiFacility() : void{
        if(CAdmin::isLogged()) {
            if(!is_null(UHTTPMethods::post('idSkiFacility'))) {
                $idSkiFacility = UHTTPMethods::post('idSkiFacility');
                FPersistentManager::getInstance()->deleteSkiFacility($idSkiFacility);
                CAdmin::dashboard();
            } else {
                CAdmin::dashboard();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to delete all the data about a ski run
     * @return void
     */
    public static function deleteSkiRun() : void{
        if(CAdmin::isLogged()) {
            if(!is_null(UHTTPMethods::post('idSkiRun'))) {
                $idSkiRun = UHTTPMethods::post('idSkiRun');
                FPersistentManager::getInstance()->deleteSkiRun($idSkiRun);
                CAdmin::dashboard();
            } else {
                CAdmin::dashboard();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to delete all the data about a lift structure
     * @return void
     */
    public static function deleteLiftStructure() : void{
        if(CAdmin::isLogged()) {
            if(!is_null(UHTTPMethods::post('idLiftStructure'))) {
                $idLiftStructure = UHTTPMethods::post('idLiftStructure');
                FPersistentManager::getInstance()->deleteLiftStructure($idLiftStructure);
                CAdmin::dashboard();
            } else {
                CAdmin::dashboard();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to delete all the data about a skipass booking
     * @return void
     */
    public static function deleteSkipassBooking() : void{
        if(CAdmin::isLogged()) {
            if(!is_null(UHTTPMethods::post('idSkipassBooking'))) {
                $idSkipassBooking = UHTTPMethods::post('idSkipassBooking');
                FPersistentManager::getInstance()->deleteSkipassBooking($idSkipassBooking);
                CAdmin::dashboard();
            } else {
                CAdmin::dashboard();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to delete all the data about a skipass template
     * @return void
     */
    public static function deleteSkipassTemp() : void{
        if(CAdmin::isLogged()) {
            if(!is_null(UHTTPMethods::post('idSkipassTemp'))) {
                $idSkipassTemp = UHTTPMethods::post('idSkipassTemp');
                FPersistentManager::getInstance()->deleteSkipassTemp($idSkipassTemp);
                CAdmin::dashboard();
            } else {
                CAdmin::dashboard();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to delete all the data about a insurance template
     * @return void
     */
    public static function deleteInsuranceTemp() : void{
        if(CAdmin::isLogged()) {
            if(!is_null(UHTTPMethods::post('idInsuranceTemp'))) {
                $idInsuranceTemp = UHTTPMethods::post('idInsuranceTemp');
                FPersistentManager::getInstance()->deleteInsuranceTemp($idInsuranceTemp);
                CAdmin::dashboard();
            } else {
                CAdmin::dashboard();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to delete all the data about a skipass object
     * @return void
     */
    public static function deleteSkipassObj() : void{
        if(CAdmin::isLogged()) {
            if(!is_null(UHTTPMethods::post('idSkipassObj'))) {
                $idSkipassObj = UHTTPMethods::post('idSkipassObj');
                FPersistentManager::getInstance()->deleteSkipassObj($idSkipassObj);
                CAdmin::dashboard();
            } else {
                CAdmin::dashboard();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to delete all the data about a subscription template
     * @return void
     */
    public static function deleteSubscriptionTemp() : void{
        if(CAdmin::isLogged()) {
            if(!is_null(UHTTPMethods::post('idSubscriptionTemp'))) {
                $idSubscriptionTemp = UHTTPMethods::post('idSubscriptionTemp');
                FPersistentManager::getInstance()->deleteSubscriptionTemp($idSubscriptionTemp);
                CAdmin::dashboard();
            } else {
                CAdmin::dashboard();
            }
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

    /**
     * Method to retrive all the data in the add skipass template form 
     * @return void
     */
    /* public static function addSkipass() :void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $view->addSkipass();
        } else {
            CAdmin::dashboard();
        }
    } */

    /**
     * Method to verify all the data in the modify skipass object form 
     * @return void
     */
    /* public static function confirmModifySkipass() :void{
        if(CAdmin::isLogged()) {
            if(!is_null(UHTTPMethods::post('idSkipassObj')) && !is_null(UHTTPMethods::post('description')) && !is_null(UHTTPMethods::post('period')) && !is_null(UHTTPMethods::post('type'))) {
                $idSkipassObj = UHTTPMethods::post('idSkipassObj');
                $skipass = new ESkipassObj(UHTTPMethods::post('description'), UHTTPMethods::post('period'), UHTTPMethods::post('type'));
                $skipass->setIdSkipassObj($idSkipassObj);
                FPersistentManager::getInstance()->updateSkipassObj($skipass);
                CAdmin::dashboard();
            } else {
                CAdmin::dashboard();
            }
        } else {
            CAdmin::dashboard();
        }
    } */
    

    

    

    

    

    

    

    

    

    

    

}
?>