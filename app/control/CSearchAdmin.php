<?php

require_once (__DIR__ . '/../config/autoloader.php');

class CSearchAdmin {

    /**
     * Method to search users based on criteria
     * Retrieves users by name, surname, or username if provided via POST
     * If no criteria are provided, retrieves all users
     * Calls the searchUsers() method from VAdmin to display results
     * @return void
     */
    public static function searchUsers() : void{
        if(CAdmin::isLogged()) {
            $view = new VSearchAdmin();
            if(!is_null(UHTTPMethods::post("name")) || !is_null(UHTTPMethods::post("surname"))
            || !is_null(UHTTPMethods::post("username"))) {
                $name = !is_null(UHTTPMethods::post("name")) ? UHTTPMethods::post("name") : "";
                $surname = !is_null(UHTTPMethods::post("surname")) ? UHTTPMethods::post("surname") : "";
                $username = !is_null(UHTTPMethods::post("username")) ? UHTTPMethods::post("username") : "";
                $users = FPersistentManager::getInstance()->retriveUsersForSearch($username, $name, $surname);
                $view->searchUsers($users);
            } else {
                $users = FPersistentManager::getInstance()->retriveUsersForSearch("", "", "");
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
            $view = new VSearchAdmin();
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
            $view = new VSearchAdmin();
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
            $view = new VSearchAdmin();
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
            $view = new VSearchAdmin();
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
    public static function searchInsuranceTemplate() :void{
        if(CAdmin::isLogged()) {
            $view = new VSearchAdmin();
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
    public static function searchSubscriptionTemplate() :void{
        if(CAdmin::isLogged()) {
            $view = new VSearchAdmin();
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
    
}

?>