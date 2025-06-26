<?php

require_once (__DIR__ . '/../config/autoloader.php');

class CConfirmModifyAdmin {
    
    /**
     * Method to verify all the data in the modify user form 
     * @return void
     */
    public static function confirmModify() : void{
        if(CAdmin::isLogged()){
            $view = new VModifyAdmin();
            if(!is_null(UHTTPMethods::post('username')) && !is_null(UHTTPMethods::post('name')) && !is_null(UHTTPMethods::post('surname')) &&
            !is_null(UHTTPMethods::post('email')) && !is_null(UHTTPMethods::post('birthDate'))) {
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
    }

    /**
     * Method to verify all the data in the add ski run form 
     * @return void
     */
    public static function confirmSkiRun() : void{
        if(CAdmin::isLogged()) {
            if(!is_null(UHTTPMethods::post('skiFacility')) && !is_null(UHTTPMethods::post('name')) && !is_null(UHTTPMethods::post('type')) && !is_null(UHTTPMethods::post('status'))) {
                $idSkiFacility = FPersistentManager::getInstance()->retriveIdSkiFacilityFromName(UHTTPMethods::post('skiFacility'));
                $skiRunName = FPersistentManager::getInstance()->verifySkiRunName(UHTTPMethods::post('name'), $idSkiFacility[0]);
                if(!$skiRunName) {
                    $skiRun = new ESkiRun(UHTTPMethods::post('name'), UHTTPMethods::post('type'), UHTTPMethods::post('status'));
                    $skiRun->setIdSkiFacility($idSkiFacility[0]);
                    FPersistentManager::getInstance()->uploadObj($skiRun);
                    CAdmin::dashboard();
                } else {
                    $view = new VAddAdmin();
                    $nameSkiFacility = FPersistentManager::getInstance()->nameAllSkiFacility();
                    $view->addSkiRun($nameSkiFacility, true);
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
            $view = new VModifyAdmin();
            if(!is_null(UHTTPMethods::post('name')) && !is_null(UHTTPMethods::post('description')) && !is_null(UHTTPMethods::post('status'))) {
                $skiFacility = FPersistentManager::getInstance()->verifySkiFacilityName(UHTTPMethods::post('name'));
                if(strlen(trim(UHTTPMethods::post('description'))) > 65535) {
                    $view = new VAddAdmin();
                    $view->addSkiFacility(false, true);
                }
                if(!$skiFacility) {
                    $skiFacility = new ESkiFacility(UHTTPMethods::post('name'), UHTTPMethods::post('status'), UHTTPMethods::post('description'));
                    FPersistentManager::getInstance()->uploadObj($skiFacility);
                    CAdmin::dashboard();
                } else {
                    $view = new VAddAdmin();
                    $view->addSkiFacility(true, false);
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
            $view = new VModifyAdmin();
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
            $view = new VModifyAdmin();
            if(!is_null(UHTTPMethods::post('skiFacility')) && !is_null(UHTTPMethods::post('name')) && !is_null(UHTTPMethods::post('type')) && !is_null(UHTTPMethods::post('status')) && !is_null(UHTTPMethods::post('seats'))) {
                $idSkiFacility = FPersistentManager::getInstance()->retriveIdSkiFacilityFromName(UHTTPMethods::post('skiFacility'));
                $liftStructureName = FPersistentManager::getInstance()->verifyLiftStructureName(UHTTPMethods::post('name'), $idSkiFacility[0]);
                if(!$liftStructureName) {
                    $liftStructure = new ELiftStructure(UHTTPMethods::post('name'), UHTTPMethods::post('type'), UHTTPMethods::post('status'), UHTTPMethods::post('seats'));
                    $liftStructure->setIdSkiFacility($idSkiFacility[0]);
                    FPersistentManager::getInstance()->uploadObj($liftStructure);
                    CAdmin::dashboard();
                } else {
                    $view = new VAddAdmin();
                    $nameSkiFacility = FPersistentManager::getInstance()->nameAllSkiFacility();
                    $view->addLiftStructure($nameSkiFacility, true);
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
                $skipassTemp = FPersistentManager::getInstance()->verifySkipassTemp($description, $period, $type);
                if(!$skipassTemp) {
                    $skipass = new ESkipassTemp($description, $period, $type);
                    FPersistentManager::getInstance()->uploadObj($skipass);
                    CAdmin::dashboard();
                } else {
                    $view = new VAddAdmin();
                    $view->addSkipassTemplate(true);
                }
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
                $skipassObj = FPersistentManager::getInstance()->verifySkipassObj($description, $idSkiFacility, $idSkipassTemplate);
                if(!$skipassObj) {
                    $skipass = new ESkipassObj($description, $value);
                    $skipass->setIdSkiFacility($idSkiFacility);
                    $skipass->setIdSkipassTemp($idSkipassTemplate);
                    FPersistentManager::getInstance()->uploadObj($skipass);
                    CAdmin::dashboard();
                } else {
                    $view = new VAddAdmin();
                    $allSkiFacilities = FPersistentManager::getInstance()->retriveAllSkiFacilities();
                    $templates = FPersistentManager::getInstance()->retriveAllSkipassTemp();
                    $view->addSkipassObj($allSkiFacilities, $templates, true);
                }
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
                $insuranceTemp = FPersistentManager::getInstance()->verifyInsuranceTemp($type, $value);
                if(!$insuranceTemp) {
                    $insuranceTemp = new EInsuranceTemp($type, $value);
                    FPersistentManager::getInstance()->uploadObj($insuranceTemp);
                    CAdmin::dashboard();
                } else {
                    $view = new VAddAdmin();
                    $view->addInsuranceTemplate(true);
                }
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
                $subscriptionTemp = FPersistentManager::getInstance()->verifySubscriptionTemp($description, $value, $discount);
                if(!$subscriptionTemp) {
                    $subscription = new ESubscriptionTemp($description, $value, $discount);
                    FPersistentManager::getInstance()->uploadObj($subscription);
                    CAdmin::dashboard();
                } else {
                    $view = new VAddAdmin();
                    $view->addSubscription(true);
                }
                
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
}

?>