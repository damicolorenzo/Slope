<?php

/* require_once("FUser.php");
require_once("FPerson.php");
 */

 require_once (__DIR__."\\..\\config\\autoloader.php");

class FPersistentManager {
    #Singleton 
    
    private static $instance;

    private function __construct() {}

    public static function getInstance() :FPersistentManager {
        if(!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * return an object from database specifying the class and the id 
    */
    public static function retriveObj($class, $id) {
        $foundClass = "F".substr($class, 1);
        $staticMethod = "getObj";
        $result = call_user_func([$foundClass, $staticMethod], $id);
        return $result;
    }

    /**
     * upload any object in the database
     */
    public static function uploadObj($obj){
        $foundClass = "F" . substr(get_class($obj), 1);
        $staticMethod = "saveObj";
        $result = call_user_func([$foundClass, $staticMethod], $obj);
        return $result;
    }

    /**
     * verify if exist a user with this email (also mod)
     * @param String $email
     */
    public static function verifyUserEmail($email){
        $result = FPerson::verify('email', $email);
        return $result;
    }

    /**
     * verify if exist a user with this username (also mod)
     * @param String $username
     */
    public static function verifyUserUsername($username){
        $result = FPerson::verify('username', $username);

        return $result;
    }

    /**
     * return a User findig it not on the id but on it's username
     */
    public static function retriveUserOnUsername($username)
    {
        $result = FUser::getUserByUsername($username);

        if(count($result) > 0) {
            $obj = FUser::crateUserObj($result);
        }
        return $obj;
    }

    public static function retriveUserOnId($id)
    {
        $result = FUser::getUserById($id);

        if(count($result) > 0) {
            $obj = FUser::crateUserObj($result);
        }
        return $obj;
    }

    public static function retriveImageOnId($id)
    {
        $result = FImage::getImageById($id);
        return $result;
    }
     
    public static function updateUserIdImage($user){
        $field = [['idImage', $user->getIdImage()]];
        $result = FUser::saveObj($user, $field);

        return $result;
    }

    public static function updateUserPassword($user){
        $field = [['password', $user->getPassword()]];
        $result = FUser::saveObj($user, $field);

        return $result;
    }

    public static function retriveAdminOnUsername($username) {
        $result = FAdmin::getAdminByUsername($username);
        return $result;
    }

    public static function retriveAllUsers() {
        $result = FUser::getUsers();
        return $result;
    }

    public static function retriveUsersForSearch($username, $name, $surname) {
        $result = FUser::getUsersFromUsernameOrNameOrSurname($username, $name, $surname);
        return $result;
    }

    public static function updateUserInfo($user){
        $field = [['name', $user->getName()],['surname', $user->getSurname()],['email', $user->getEmail()],['phoneNumber', $user->getPhoneNumber()], ['birthDate', $user->getBirthDate()]];
        $result = FUser::saveObj($user, $field);

        return $result;
    }

    public static function retriveIdSkiFacilities() {
        $result = FSkiFacility::getSkiFacilities();

        return $result;
    }

    public static function retriveAllSkiFacilities() {
        $result = FSkiFacility::getSkiFacilities();

        if(count($result) > 0) {
            $obj = FSkiFacility::crateSkiFacilityObj($result);
        }
        return $obj;
    }

    public static function typeAndNumberSkiRun($idSkiFacility) {
        $result = FSkiRun::typeAndNumberSkiRun($idSkiFacility);

        return $result;
    }

    public static function retriveAllSkiRun($idSkiFacility) {
        $result = FSkiRun::getSkiRuns($idSkiFacility);

        if(count($result) > 0) {
            $obj = FSkiRun::crateSkiRunObj($result);
        }
        return $obj;
    }

    public static function retriveAllLiftStructures($idSkiFacility) {
        $result = FLiftStructure::getLiftStructures($idSkiFacility);
        
        if(count($result) > 0) {
            $obj = FLiftStructure::crateLiftStructureObj($result);
        }
        return $obj;
    }

    public static function retriveNLiftStructures($idSkiFacility) {
        $result = FLiftStructure::getNLiftStructures($idSkiFacility);
        
        return $result;
    }

    public static function nameSkiFacility($idSkiFacility) {
        $result = FSkiFacility::getNameSkiFacility($idSkiFacility);
        
        return $result;
    }

    public static function nameAllSkiFacility() {
        $result = FSkiFacility::getAllNameSkiFacility();
        
        return $result;
    }

    public static function verifySkiRunName($name, $idSkiFacility) {
        $result = FSkiRun::getSkiRunByNameAndSkiFacility($name, $idSkiFacility);
        
        return $result;
    }

    public static function retriveIdSkiFacilityFromName($name) {
        $result = FSkiFacility::getIdFromName($name);
        
        return $result;
    }

    public static function verifyLiftStructureName($name, $idSkiFacility) {
        $result = FLiftStructure::getLiftStructureByNameAndSkiFacility($name, $idSkiFacility);
        
        return $result;
    }
    
    public static function retriveAllSkiStructures() {
        $result = array();
        $allSkiFacility = FSkiFacility::getAllSkiFacilityObj();
        if(count($allSkiFacility) > 0) {
            $result[] = FSkiFacility::crateSkiFacilityObj($allSkiFacility);
        }
        $allSkiRun = FSkiRun::getAllSkiRunObj();
        if(count($allSkiRun) > 0) {
            $resultArray = FSkiRun::crateSkiRunObj($allSkiRun);
            $final = array();
            foreach ($resultArray as $element) {
                $app = array();
                $app[] = $element;
                $idSkiFacility = $element->getIdSkiFacility();
                $name = FSkiFacility::getNameSkiFacility($idSkiFacility);
                $app[] = $name;
                $final[] = $app;
            }
            $result[] = $final;
        }
        $allLiftStructure = FLiftStructure::getAllLiftStructureObj();
        if(count($allLiftStructure) > 0) {
            $resultArray = FLiftStructure::crateLiftStructureObj($allLiftStructure);
            $final = array();
            foreach ($resultArray as $element) {
                $app = array();
                $app[] = $element;
                $idSkiFacility = $element->getIdSkiFacility();
                $name = FSkiFacility::getNameSkiFacility($idSkiFacility);
                $app[] = $name;
                $final[] = $app;
            }
            $result[] = $final;
        }
        return $result;
    }

    public static function retriveSkiFacilityOnId($id) {
        $result = FSkiFacility::getSkiFacilityById($id);

        if(count($result) > 0) {
            $obj = FSkiFacility::crateSkiFacilityObj($result);
        }
        return $obj;
    }

    public static function retriveSkiRunOnId($id) {
        $result = FSkiRun::getSkiRunById($id);

        if(count($result) > 0) {
            $obj = FSkiRun::crateSkiRunObj($result);
        }
        return $obj;
    }

    public static function retriveLiftStructureOnId($id) {
        $result = FLiftStructure::getLiftStructureById($id);

        if(count($result) > 0) {
            $obj = FLiftStructure::crateLiftStructureObj($result);
        }
        return $obj;
    }

    public static function verifySkiFacilityName($field, $id) {
        $result = FSkiFacility::getSkiFacilityByName($field, $id);
        
        return $result;
    }

    public static function updateSkiFacilityInfo($skiFacility){
        $field = [['name', $skiFacility->getName()],['status', $skiFacility->getStatus()],['price', $skiFacility->getPrice()]];
        $result = FSkiFacility::saveObj($skiFacility, $field);

        return $result;
    }

    public static function updateSkiRunInfo($skiRun){
        $field = [['name', $skiRun->getName()], ['type', $skiRun->getType()], ['status', $skiRun->getStatus()], ['idSkiFacility', $skiRun->getIdSkiFacility()]];
        $result = FSkiRun::saveObj($skiRun, $field);

        return $result;
    }

    public static function updateLiftStructureInfo($liftStructure){
        $field = [['name', $liftStructure->getName()], ['type', $liftStructure->getType()], ['status', $liftStructure->getStatus()], ['seats', $liftStructure->getSeats()], ['idSkiFacility', $liftStructure->getIdSkiFacility()]];
        $result = FLiftStructure::saveObj($liftStructure, $field);

        return $result;
    }


    public static function retriveForStructureSearch($queryString) {
        $result = array();
        $skiFacilities = FSkiFacility::getSkiFacilityByNameForSearch($queryString);
        if(count($skiFacilities) > 0) {
            $sub = array();
            $sub[] = FSkiFacility::crateSkiFacilityObj($skiFacilities);
            $result[] = $sub;
        } else {
            $result[] = array();
        }
        $skiRuns = FSkiRun::getSkiRunByNameForSearch($queryString);
        if(count($skiRuns) > 0) {
            $resultArray = FSkiRun::crateSkiRunObj($skiRuns);
            $final = array();
            if($resultArray instanceof ESkiRun) {
                $app = array();
                $idSkiFacility = $resultArray->getIdSkiFacility();
                $name = FSkiFacility::getNameSkiFacility($idSkiFacility); 
                $app[] = $resultArray;
                $app[] = $name;
                $final[] = $app;
            } elseif(count($resultArray) > 1) {
                foreach ($resultArray as $element) {
                    $app = array();
                    $app[] = $element;
                    $idSkiFacility = $element->getIdSkiFacility();
                    $name = FSkiFacility::getNameSkiFacility($idSkiFacility);
                    $app[] = $name;
                    $final[] = $app;
                }
            }
            $result[] = $final;
        } else {
            $result[] = array();
        }
        $liftStructures = FLiftStructure::getLiftStructureByNameForSearch($queryString);
        if(count($liftStructures) > 0) {
            $resultArray = FLiftStructure::crateLiftStructureObj($liftStructures);
            $final = array();
            if($resultArray instanceof ELiftStructure) {
                $app = array();
                $idSkiFacility = $resultArray->getIdSkiFacility();
                $name = FSkiFacility::getNameSkiFacility($idSkiFacility); 
                $app[] = $resultArray;
                $app[] = $name;
                $final[] = $app;
            } elseif(count($resultArray) > 1) {
                foreach ($resultArray as $element) {
                    $app = array();
                    $app[] = $element;
                    $idSkiFacility = $element->getIdSkiFacility();
                    $name = FSkiFacility::getNameSkiFacility($idSkiFacility);
                    $app[] = $name;
                    $final[] = $app;
                }
            }
            $result[] = $final;
        } else {
            $result[] = array();
        }
        return $result;
    }




    /*
    Caricamento immagine
    */
    public static function manageImages($uploadedImages){ #_FILES['imageFile']
        foreach($uploadedImages['tmp_name'] as $index => $tmpName){
            $file = [
            'name' => $uploadedImages['name'][$index],
            'type' => $uploadedImages['type'][$index],
            'size' => $uploadedImages['size'][$index],
            'tmp_name' => $tmpName,
            'error' => $uploadedImages['error'][$index],
            'full_path' => $uploadedImages['full_path'][$index]
            ];
            //check if the uploaded image is ok 
            $checkUploadImage = self::uploadImage($file);
            #print($checkUploadImage);
            if($checkUploadImage == 'UPLOAD_ERROR_OK' || $checkUploadImage == 'TYPE_ERROR' || $checkUploadImage == 'SIZE_ERROR'){
                break;
            } else {
                $checkUploadImage = self::uploadAnImage($checkUploadImage);
            }
        }
        return $uploadedImages;
    }

    /* UPLOAD FUNCTION */
    public static function uploadAnImage(EImage $image){
        $uploadImage = FImage::saveObj($image);

        if($uploadImage){
            return true;
        }else{
            return false;
        }
    }

    /* CHECK FUNCTION */
    public static function uploadImage($file){
        $check = self::validateImage($file);
        #print($check);
        if($check[0]){
            //create new Image Obj ad perist it
            $image = new EImage($file['name'], $file['size'], $file['type'], file_get_contents($file['tmp_name']));
            return $image;
        }else{
            return $check[1];
        }
    }

    public static function validateImage($file){
        if($file['error'] !== UPLOAD_ERR_OK){
            $error = 'UPLOAD_ERROR_OK';
    
            return [false, $error];
        }
    
        if(!in_array($file['type'], ALLOWED_IMAGE_TYPE)){
            $error = 'TYPE_ERROR';
    
            return [false, $error];
        }
    
        if($file['size'] > MAX_IMAGE_SIZE){
            $error = 'SIZE_ERROR';
    
            return [false, $error];
        }
    
        return [true, null];
    }

    /**
     * Method to delete an Image in the Database
     * @param int $idImage Refers to teh id of the image to delete
     */
    public static function deleteImage($idImage){

        $result = FEntityManager::getInstance()->deleteObjInDb(FImage::getTable(), FImage::getKey(), $idImage);

        return $result;
    }
      
}

?>