<?php

require_once (__DIR__."\\..\\config\\autoloader.php");

class CAddAdmin {

    /**
     * Method to retrive all the data in the add ski run form 
     * @return void
     */
    public static function addSkiRun() : void{
        if(CAdmin::isLogged()) {
            $view = new VAddAdmin();
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
            $view = new VAddAdmin();
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
            $view = new VAddAdmin();
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
            $view = new VAddAdmin();
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
            $view = new VAddAdmin();
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
            $view = new VAddAdmin();
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
            $view = new VAddAdmin();
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
}

?>