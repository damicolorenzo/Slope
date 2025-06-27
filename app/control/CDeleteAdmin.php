<?php

require_once (__DIR__ . '/../config/autoloader.php');

class CDeleteAdmin {

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

    /**
     * Deletes user's profile
     */
    public static function deleteProfile() :void{
        if(CAdmin::isLogged()) {
            if(!is_null(UHTTPMethods::post('userId'))) {
                $userId = UHTTPMethods::post('userId');
                FPersistentManager::getInstance()->deleteProfile($userId);
                CSearchAdmin::searchUsers();
            } else {
                CSearchAdmin::searchUsers();
            }
        } else {
            CAdmin::dashboard();
        }
    }

    /**
     * Method to delete the user image
     * @return void
     */
    public static function deleteImage() :void{
        if(CAdmin::isLogged()) {
            if(!is_null(UHTTPMethods::post('userId'))) {
                $userId = UHTTPMethods::post('userId');
                $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
                $idImage = $user[0]->getIdImage();
                FPersistentManager::getInstance()->deleteImage($idImage);
                CSearchAdmin::searchUsers();
            } else {
                CSearchAdmin::searchUsers();
            }
        } else {
            CAdmin::dashboard();
        }
    }
}

?>