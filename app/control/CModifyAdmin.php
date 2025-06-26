<?php

require_once (__DIR__ . '/../config/autoloader.php');

class CModifyAdmin {

    /**
     * Method to display the profile modification form for a user
     * Retrieves user data by userId provided via POST and displays the modification form
     * Calls the modifyProfile() method from VAdmin with user data and default flags
     * @return void
     */
    public static function modifyProfile() : void{
        if(CAdmin::isLogged()) {
            $view = new VModifyAdmin();
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
                    CSearchAdmin::searchUsers();
                }
            } else {
                CSearchAdmin::searchUsers();
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
            $view = new VModifyAdmin();
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
                CSearchAdmin::searchUsers();
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
            $view = new VModifyAdmin();
            if(!is_null(UHTTPMethods::post('idSkiFacility'))) {
                $idSkiFacility = UHTTPMethods::post('idSkiFacility');
                $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($idSkiFacility);
                $skiFacility = $skiFacility[0];
                $name = $skiFacility->getName();
                $status = $skiFacility->getStatus();
                $description = $skiFacility->getDescription();
                $view->modifySkiFacility($idSkiFacility, $name, $status, $description);
            } else {
                CSearchAdmin::searchStructures();
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
            $view = new VModifyAdmin();
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
                CSearchAdmin::searchStructures();
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
            $view = new VModifyAdmin();
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
                CSearchAdmin::searchStructures();
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
            $view = new VModifyAdmin();
            if(!is_null(UHTTPMethods::post('idSkipassBooking'))) {
                $idSkipassBooking = UHTTPMethods::post('idSkipassBooking');
                $skipassBooking = FPersistentManager::getInstance()->retriveSkipassBookingOnId($idSkipassBooking);
                $today = new DateTime();
                $view->modifySkipassBooking($skipassBooking[0], $today->format('Y-m-d'));
            } else {
                CSearchAdmin::searchSkipassBooking();
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
            $view = new VModifyAdmin();
            if(!is_null(UHTTPMethods::post('idSkipassObj'))) {
                $idSkipassObj = UHTTPMethods::post('idSkipassObj');
                $skipassObj = FPersistentManager::getInstance()->retriveSkipassObjOnId($idSkipassObj);
                $description = $skipassObj[0]->getDescription();
                $value = $skipassObj[0]->getValue();
                $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($skipassObj[0]->getIdSkiFacility());
                $skipassTemp = FPersistentManager::getInstance()->retriveSkipassTempOnId($skipassObj[0]->getIdSkipassTemp());
                $view->modifySkipassObj($idSkipassObj, $description, $value, $skiFacility[0], $skipassTemp[0]);
            } else {
                CSearchAdmin::searchSkipassObjs();
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
            $view = new VModifyAdmin();
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
            $view = new VModifyAdmin();
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
            $view = new VModifyAdmin();
            if(!is_null(UHTTPMethods::post('idInsuranceTemp'))) {
                $idInsuranceTemp = UHTTPMethods::post('idInsuranceTemp');
                $insuranceTemp = FPersistentManager::getInstance()->retriveInsuranceTempFromIdInsurance($idInsuranceTemp);    
                $value = $insuranceTemp[0]->getValue();
                $type = $insuranceTemp[0]->getType();
                $view->modifyInsuranceTemp($idInsuranceTemp, $value, $type);
            } else {
                CSearchAdmin::searchInsuranceTemplate();
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
            $view = new VModifyAdmin();
            if(!is_null(UHTTPMethods::post('idSkipassTemp'))) {
                $idSkipassTemp = UHTTPMethods::post('idSkipassTemp');
                $skipassTemp = FPersistentManager::getInstance()->retriveSkipassTempOnId($idSkipassTemp);
                $description = $skipassTemp[0]->getDescription();
                $period = $skipassTemp[0]->getPeriod();
                $type = $skipassTemp[0]->getType();
                $view->modifySkipassTemplate($idSkipassTemp, $description, $period, $type);
            } else {
                CSearchAdmin::searchSkipassTemplate();
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
                        $view = new VModifyAdmin();
                        $image = UHTTPMethods::files('image');
                        $view->modifyProfileImage($userId, true, $image);
                    }
                } else {
                    CSearchAdmin::searchUsers();
                }
            } else {
                CSearchAdmin::searchUsers();
            }
        } else {
            CAdmin::dashboard();
        }
    }
}

?>