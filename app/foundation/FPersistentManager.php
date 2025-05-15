<?php

require_once (__DIR__."\\..\\config\\autoloader.php");

class FPersistentManager {
    #Singleton 
    
    private static $instance;

    private function __construct() {}

    /**
     * Returns the singleton instance of the FPersistentManager class.
     *
     * Ensures that only one instance of FPersistentManager is created
     * and reused throughout the application (Singleton Pattern).
     *
     * @return FPersistentManager The single instance of this class.
     */
    public static function getInstance() :FPersistentManager {
        if(!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

/* RETRIVE METHODS */

    /**
     * Retrive an object from the database
     * @param string $class
     * @param string $id
     * @return object object from database 
     */
    public static function retriveObj(string $class, string $id) : array{
        $foundClass = "F".substr($class, 1);
        $staticMethod = "getObj";
        $result = call_user_func([$foundClass, $staticMethod], $id);
        return $result;
    }

    /**
     * Retrive all Users 
     * @return array of objects or empty array
     */
    public static function retriveAllUsers() : array{
        $result = FUser::getUsers();
        if(count($result) > 0) {
            return FUser::createUserObj($result);
        } else {
            return [];
        }
    }

    /**
     * Retrive a User findig it on it's username
     * @param string $username
     * @return array of objects or empty array
     */
    public static function retriveUserOnUsername(string $username) : array{
        $user = FUser::getUserByUsername($username); 
        if(count($user) > 0) {
            return FUser::createUserObj($user);
        } else {
            return [];
        }
    }
    
    /**
     * Retrive a User findig on id
     * @param int $id
     * @return array of objects or empty array
     */
    public static function retriveUserOnId(int $id) : array{
        $result = FUser::getUserById($id);
        if(count($result) > 0) {
            return FUser::createUserObj($result);
        } else {
            return [];
        }
    }

    /**
     * Retrive a User for search
     * @param string $username 
     * @param string $name
     * @param string surname
     * @return array of objects or empty array
     */
    public static function retriveUsersForSearch(string $username, string $name, string $surname) : ?array{
        $result = FUser::getUsersFromUsernameOrNameOrSurname($name, $surname);
        $result1 = FUser::getUserByUsername($username);
        if(count($result) > 0) {
            $array = FUser::createUserObj($result);
        } else {
            $array = [];
        } 
        if(count($result1) > 0) {
            $array1 = FUser::createUserObj($result1);
        } else {
            $array1 = [];
        }
        return $array + $array1;
    }

    /**
     * Retrive an Image object findig on id
     * @param string $id
     * @return array of objects or empty array
     */
    public static function retriveImageOnId(string $id) : array{
        $result = FImage::getImageById($id);
        if(count($result) > 0){
            return FImage::createImageObj($result);
        }else{
            return [];
        }
    }

    public static function retriveLandingImageOnId(string $id) : array{
        $result = FLandingImage::getImageById($id);
        if(count($result) > 0){
            return FLandingImage::createImageObj($result);
        }else{
            return [];
        }
    }

    public static function retriveAllLandingImage() : array{
        $result = FLandingImage::getAllImages();
        if(count($result) > 0){
            return FLandingImage::createImageObj($result);
        }else{
            return [];
        }
    }

    /**
     * Retrive an Admin finding on username
     * @param string $username
     * @return array of objects or empty array
     */
    public static function retriveAdminOnUsername(string $username) : array{
        $result = FAdmin::getAdminByUsername($username);
        if(count($result) > 0) {
            return FAdmin::createAdminObj($result);
        } else {
            return [];
        }
    }

    /**
     * Retrive all id of the ski facility objects
     * @return array of ids or empty array
     */
    public static function retriveIdSkiFacilities() : array{
        $result = FSkiFacility::getSkiFacilities();
        return $result;
    }

    /**
     * Retrive all the ski facility objects
     * @return array of objects or empty array
     */
    public static function retriveAllSkiFacilities() : array{
        $result = FSkiFacility::getSkiFacilities();

        if(count($result) > 0) {
            return FSkiFacility::createSkiFacilityObj($result);
        } else {
            return [];
        }
    }

    /**
     * Retrive the name of a ski facility finding it on the ski facility id
     * @param int $idSkiFacility
     * @return array The result set as an associative array.
     */
    public static function nameSkiFacility(int $idSkiFacility) : array{
        $result = FSkiFacility::getNameSkiFacility($idSkiFacility);
        return $result;
    }

    /**
     * Retrive all the names of ski facilities
     * @return array The result set as an array of associative arrays.
     */
    public static function nameAllSkiFacility() : array{
        $result = FSkiFacility::getAllNameSkiFacility(); 
        return $result;
    }

    public static function retriveAllSkiFacilityImage() : array{
        $result = FSkiFacilityImage::getAllImages();
        if(count($result) > 0){
            return FSkiFacilityImage::createImageObj($result);
        }else{
            return [];
        }
    }

    public static function retriveSkiFacilityImageOnId($id) : array{
        $result = FSkiFacilityImage::getImageById($id);
        if(count($result) > 0){
            return FSkiFacilityImage::createImageObj($result);
        }else{
            return [];
        }
    }

    /**
     * Retrive the id of a ski facility finding it on the name
     * @param string $name
     * @return array The result set as an associative array.
     */
    public static function retriveIdSkiFacilityFromName(string $name) : array{
        $result = FSkiFacility::getIdFromName($name);
        return $result;
    }

    /**
     * Retrive a ski facility finding it on id
     * @param int $id
     * @return array of objects or empty array
     */
    public static function retriveSkiFacilityOnId(int $id) : array{
        $result = FSkiFacility::getSkiFacilityById($id);

        if(count($result) > 0) {
            return FSkiFacility::createSkiFacilityObj($result);
        } else {
            return [];
        }
    }

    /**
     * Retrive all the ski run objects finding them on ski facility id
     * @param int $idSkiFacility
     * @return array of objects or empty array
     */
    public static function retriveAllSkiRun(int $idSkiFacility) : array{
        $result = FSkiRun::getSkiRuns($idSkiFacility);

        if(count($result) > 0) {
            return FSkiRun::createSkiRunObj($result);
        } else {
            return [];
        }
    }

    /**
     * Retrive the type and the number of ski run finding them on the ski facility id
     * @param int $idSkiFacility
     * @return array of [CTN , type] or empty array
     */
    public static function typeAndNumberSkiRun(int $idSkiFacility) : array{
        $result = FSkiRun::typeAndNumberSkiRun($idSkiFacility);
        return $result;
    }

    /**
     * Retrive a ski run object finding it on id
     * @param int $id
     * @return array of objects or empty array
     */
    public static function retriveSkiRunOnId(int $id) : array{
        $result = FSkiRun::getSkiRunById($id);

        if(count($result) > 0) {
            return FSkiRun::createSkiRunObj($result);
        } else {
            return [];
        }
    }

    /**
     * Retrive all the lift structure objects finding them on ski facility id
     * @param int $idSkiFacility
     * @return array of objects or empty array
     */
    public static function retriveAllLiftStructures(int $idSkiFacility) : array{
        $result = FLiftStructure::getLiftStructures($idSkiFacility);
        
        if(count($result) > 0) {
            return FLiftStructure::createLiftStructureObj($result);
        } else {
            return [];
        }
    }

    /**
     * Retrive the number of lift structure finding them on the ski facility id
     * @param int $idSkiFacility
     * @return int number of lift structure 
     */
    public static function retriveNLiftStructures(int $idSkiFacility) : int{
        $result = FLiftStructure::getNLiftStructures($idSkiFacility);
        return $result;
    }

    public static function typeAndNumberLiftStructure(int $idSkiFacility) : array{
        $result = FLiftStructure::typeAndNumberLiftStructure($idSkiFacility);
        return $result;
    }

    /**
     * Retrive a lift structure object finding it on id
     * @param int $id
     * @return array of objects or empty array
     */
    public static function retriveLiftStructureOnId(int $id) : array{
        $result = FLiftStructure::getLiftStructureById($id);

        if(count($result) > 0) {
            return FLiftStructure::createLiftStructureObj($result);
        } else {
            return [];
        }
    }

    /**
     * Retrive all the ski facilities, all the ski runs and all the lift structures
     * @return array of objects 
     */
    public static function retriveAllSkiStructures() {
        $result = [];
        $allSkiFacility = FSkiFacility::getAllSkiFacilityObj();
        if(count($allSkiFacility) > 0) {
            $result['skiFacilities'] = FSkiFacility::createSkiFacilityObj($allSkiFacility);
        }
        $allSkiRun = FSkiRun::getAllSkiRunObj();
        if(count($allSkiRun) > 0) {
            $resultArray = FSkiRun::createSkiRunObj($allSkiRun);
            $final = [];
            foreach ($resultArray as $element) {
                $app = [];
                $app[] = $element;
                $idSkiFacility = $element->getIdSkiFacility();
                $name = FSkiFacility::getNameSkiFacility($idSkiFacility);
                $app[] = $name;
                $final[] = $app;
            }
            $result['skiRun'] = $final;
        }
        $allLiftStructure = FLiftStructure::getAllLiftStructureObj();
        if(count($allLiftStructure) > 0) {
            $resultArray = FLiftStructure::createLiftStructureObj($allLiftStructure);
            $final = [];
            foreach ($resultArray as $element) {
                $app = array();
                $app[] = $element;
                $idSkiFacility = $element->getIdSkiFacility();
                $name = FSkiFacility::getNameSkiFacility($idSkiFacility);
                $app[] = $name;
                $final[] = $app;
            }
            $result['liftStructure'] = $final;
        }
        return $result;
    }

    /**
     * DA RIVEDERE
     * Retrive all the ski structure using a query
     * @param string $queryString
     * @return array of objects 
     * The structure of the array is [[list of skiFacility objects], [[skiRuns], [nameSkiFacility]], [[liftStructures], [nameSkiFacility]]]
     */
    public static function retriveForStructureSearch($queryString) {
        $result = [];
        $skiFacilities = FSkiFacility::getSkiFacilityByNameForSearch($queryString);
        if(count($skiFacilities) > 0) {
            $sub = [];
            $sub[] = FSkiFacility::createSkiFacilityObj($skiFacilities);
            $result[] = $sub;
        } else {
            $result[] = [];
        }
        $skiRuns = FSkiRun::getSkiRunByNameForSearch($queryString);
        if(count($skiRuns) > 0) {
            $resultArray = FSkiRun::createSkiRunObj($skiRuns);
            $final = [];
            foreach ($resultArray as $element) {
                $app = [];
                $app[] = $element;
                $idSkiFacility = $element->getIdSkiFacility();
                $name = FSkiFacility::getNameSkiFacility($idSkiFacility);
                $app[] = $name;
                $final[] = $app;
            }
            $result[] = $final;
        } else {
            $result[] = [];
        }
        $liftStructures = FLiftStructure::getLiftStructureByNameForSearch($queryString);
        if(count($liftStructures) > 0) {
            $resultArray = FLiftStructure::createLiftStructureObj($liftStructures);
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
        } else {
            $result[] = [];
        }
        return $result;
    }

    public static function retriveStructureForSearch (string $nameSkiFacility, string $nameSkiRun, string $nameLiftStructure) : ?array{
        $result1 = FSkiFacility::getSkiFacilityByNameForSearch($nameSkiFacility);
        $result2 = FSkiRun::getSkiRunByNameForSearch($nameSkiRun);
        $result3 = FLiftStructure::getLiftStructureByNameForSearch($nameLiftStructure);
        if(count($result1) > 0) {
            $result['skiFacilities'] = FSkiFacility::createSkiFacilityObj($result1);
        } else {
            $result['skiFacilities'] = [];
        } 
        if(count($result2) > 0) {
            $resultArray = FSkiRun::createSkiRunObj($result2);
            $final = [];
            foreach ($resultArray as $element) {
                $app = [];
                $app[] = $element;
                $idSkiFacility = $element->getIdSkiFacility();
                $name = FSkiFacility::getNameSkiFacility($idSkiFacility);
                $app[] = $name;
                $final[] = $app;
            }
            $result['skiRun'] = $final;
        } else {
            $result['skiRun'] = [];
        }
        if(count($result3) > 0) {
            $resultArray = FLiftStructure::createLiftStructureObj($result3);
            $final = [];
            foreach ($resultArray as $element) {
                $app = array();
                $app[] = $element;
                $idSkiFacility = $element->getIdSkiFacility();
                $name = FSkiFacility::getNameSkiFacility($idSkiFacility);
                $app[] = $name;
                $final[] = $app;
            }
            $result['liftStructure'] = $final;
        } else {
            $result['liftStructure'] = [];
        }
        return $result;
    }

    /**
     * DA RIVEDERE
     * Retrive all prices
     * @return array of objects 
     */
    public static function retriveAllPricesForSearch() {
        $result = [];
        $prices = FPrice::getPrices();
        $prices_obj = FPrice::createPriceObj($prices);
        if(count($prices_obj) > 0) {
            foreach($prices_obj as $i) {
                $app = [];
                $app[] = $i;
                $idExtObj = $i->getIdExtObj();
                $extClass = $i->getExtClass();
                $extObj = FPersistentManager::getInstance()->retriveObj($extClass, $idExtObj);
                $app[] = $extObj;
                $result[] = $app;
            }
        }
        print_r($result);
        return $result;
    }

    /**
     * Retrive a price using id
     * @param int $id
     * @return array of objects 
     */
    public static function retrivePriceOnId(int $id) : array{
        $result = FPrice::getPriceFromId($id);

        if(count($result) > 0) {
            return FPrice::createPriceObj($result);
        } else {
            return [];
        }
    }

    /**
     * Retrive a price object using the description and the id of the ski facility
     * @param string $description
     * @param int $idSkiFacility
     * @return array of objects 
    */
    public static function retrivePriceFromDesc(string $description) : array{
        $result = FPrice::getPriceByDescription($description);

        if(count($result) > 0) {
            return FPrice::createPriceObj($result);
        } else {
            return [];
        }
    }

    /**
     * Retrive all skipass booking of a user
     * @param int $idUser
     * @return array of objects 
     */
    public static function retriveAllSkipassBooking(int $idUser) : array{
        $result = FSkipassBooking::getAllSkipassBooking($idUser);
        
        if(count($result) > 0) {
            return FSkipassBooking::createSkipassBookingObj($result);
        } else {
            return [];
        } 
    }

    public static function retriveAllSkipassBookingAllUsers() : array{
        $result = FSkipassBooking::getAllSkipassBookingAllUsers();
        
        if(count($result) > 0) {
            return FSkipassBooking::createSkipassBookingObj($result);
        } else {
            return [];
        } 
    }

    /**
     * Retrive a skipass booking object finding it on a skipassBooking object 
     * @param ESkipassBooking $skipassBooking
     * @return array of objects or empty array
     */
    public static function retriveSkipassBooking(ESkipassBooking $skipassBooking) : array{
        $fields = [['name', $skipassBooking->getName()], ['surname', $skipassBooking->getSurname()], ['type', $skipassBooking->getType()], ['startDate', $skipassBooking->getStartDate()], ['email', $skipassBooking->getEmail()], ['value', $skipassBooking->getValue()], ['period', $skipassBooking->getPeriod()], ['idUser', $skipassBooking->getIdUser()], ['idSkipassObj', $skipassBooking->getIdSkipassObj()]];
        $result = FSkipassBooking::getSkipassBooking($fields);
        if(count($result) > 0) {
            return FSkipassBooking::createSkipassbookingObj($result);
        } else {
            return [];
        }
    }

    /**
     * Retrive a skipass booking object finding it on id
     * @param int $id
     * @return array of objects or empty array
     */
    public static function retriveSkipassBookingOnId(int $id) : array{
        $result = FSkipassBooking::getSkipassBookingFromId($id);

        if(count($result) > 0) {
            return FSkipassBooking::createSkipassbookingObj($result);
        } else {
            return [];
        }
    }

    /**
     * Retrive a credit card finding it on id
     * @param int $id
     * @return array of objects or empty array
     */
    public static function retriveCreditCardFromUserId(int $id) : array{
        $result = FCreditCard::getCreditCardByUserId($id);

        if(count($result) > 0) {
            return FCreditCard::createCreditCardObj($result);
        } else {
            return [];
        }
    }

    /**
     * Retrive a credit card object finding it on a credit card object 
     * @param ECreditCard $creditCard
     * @return array of objects or empty array
     */
    public static function retriveCreditCard(ECreditCard $creditCard) : array{
        $fields = [['cardHolderName', $creditCard->getCardHolderName()], ['cardHolderSurname', $creditCard->getCardHolderSurname()], ['cardNumber', $creditCard->getCardNumber()], ['cvv', $creditCard->getCvv()], ['expiryDate', $creditCard->getExpiryDate()], ['idUser', $creditCard->getIdUser()]];
        $result = FCreditCard::getCreditCard($fields);
        if(count($result) > 0) {
           return FCreditCard::createCreditCardObj($result);
        } else {
            return [];
        }
    }

    /**
     * Retrive an insurance object finding it on a insurance object 
     * @param EInsurance $insurance
     * @return array of objects or empty array
     */
    public static function retriveInsurance(EInsurance $insurance) : array{
        $fields = [['name', $insurance->getName()], ['surname', $insurance->getSurname()], ['startDate', $insurance->getStartDate()], ['type', $insurance->getType()], ['period', $insurance->getPeriod()], ['email', $insurance->getEmail()], ['price', $insurance->getPrice()], ['idUser', $insurance->getIdUser()]];
        $result = FInsurance::getInsurance($fields);
        if(count($result) > 0) {
            return FInsurance::createInsuranceObj($result);
        } else {
            return [];
        }
    }

    /**
     * Retrive all insurance objects using id
     * @param int $id
     * @return array of objects or empty array
     */
    public static function retriveAllInsurance(int $id) : array{
        $result = FInsurance::getAllInsurance($id);

        if(count($result) > 0) {
            return FInsurance::createInsuranceObj($result);
        } else {
            return [];
        } 
    }

    /**
     * Retrive all insurance objects using user id
     * @param int $idUser
     * @return array of objects or empty array
     */
    public static function retriveInsuranceFromIdUser(int $idUser) : array{
        $result = FInsurance::getInsuranceFromIdUser($idUser);
        if(count($result) > 0) {
            return FInsurance::createInsuranceObj($result);
        } else {
            return [];
        } 
    }

    /**
     * Retrive all insurance objects using user id and a date
     * @param int $idUser
     * @param string $date
     * @return array of objects or empty array
     */
    public static function retriveInsuranceFromIdUserAndDate(int $idUser, string $date) : array{
        $result = FInsurance::getInsuranceFromIdUserAndDate($idUser, $date);
        if(count($result) > 0) {
            return FInsurance::createInsuranceObj($result);
        } else {
            return [];
        } 
    }

    public static function retriveInsuranceTempFromIdInsurance(int $idInsurance) : array{
        $fields = [['idInsuranceTemp', $idInsurance]];
        $result = FInsuranceTemp::getInsuranceTempObjFromFields($fields);
        
        if(count($result) > 0) {
            return FInsuranceTemp::createInsuranceTempObj($result);
        } else {
            return [];
        } 
    }

    /**
     * Retrive a insurance template using the type
     * @param string $type
     * @return array of objects or empty array
     */
    public static function retriveInsuranceTempFromType(string $type) : array{
        $result = FInsuranceTemp::getInsuranceTempObjFromType($type);
        
        if(count($result) > 0) {
            return FInsuranceTemp::createInsuranceTempObj($result);
        } else {
            return [];
        } 
    }

    /**
     * Retrive all insurance templates 
     * @return array of objects or empty array
     */
    public static function retriveAllInsuranceTemp() : array{
        $result = FInsuranceTemp::getAllInsuranceTempObjs();
        
        if(count($result) > 0) {
            return FInsuranceTemp::createInsuranceTempObj($result);
        } else {
            return [];
        } 
    }

    public static function retriveInsuranceTempForSearch(string $value, string $type) :array{
        $result = FInsuranceTemp::getInsuranceTempObjFromFieldsForSearch([['value', $value], ['type', $type]]);
        if(count($result) > 0) {
            $result = FSkipassTemp::createSkipassTempObj($result);
        } else {
            $result = [];
        }
        return $result;
    }

    /**
     * Retrive skipass object on id of a ski facility
     * @param int $idSkiFacility
     * @return array of objects or empty array
     */
    public static function retriveSkipassObjOnSkiFacility(int $idSkiFacility) : array{
        $result = FSkipassObj::getSkipassObjOnSkiFacility($idSkiFacility);
        
        if(count($result) > 0) {
            return FSkipassObj::createSkipassObjObj($result);
        } else {
            return [];
        } 
    }

    /**
     * Retrive skipass object on id 
     * @param int $id
     * @return array of objects or empty array
     */
    public static function retriveSkipassObjOnId(int $id) : array{
        $result = FSkipassObj::getSkipassObjFromId($id);

        if(count($result) > 0) {
            return FSkipassObj::createSkipassObjObj($result);
        } else {
            return [];
        }
    }

    /**
     * Retrive id of the skipass object
     * @param string $description
     * @param int $period 
     * @param string $type
     * @return array of objects or empty array
     */
    public static function retriveIdSkipassObj(string $description, int $period, string $type) : array{
        $fields = [['description', $description], ['period', $period], ['type', $type]];
        $result = FSkipassObj::getSkipassObjFromFields($fields);

        if(count($result) > 0) {
            return FSkipassObj::createSkipassObjObj($result);
        } else {
            return [];
        }
    }

    public static function retriveAllSkipassObj() : array{
        $result = FSkipassObj::getAllSkipassObjs();
        
        if(count($result) > 0) {
            return FSkipassObj::createSkipassObjObj($result);
        } else {
            return [];
        } 
    }

    public static function retriveSkipassObjForSearch(string $nameSkiFacility, string $type, string $price) :array{
        if($nameSkiFacility !== "") {
            $result1 = FSkiFacility::getSkiFacilityByName([['name', $nameSkiFacility]]);
            $result3 = FSkipassObj::getSkipassObjFromFieldsForSearch([['description', $nameSkiFacility]]);
            $result2 = [];
            foreach ($result3 as $element) {
                $idSkipassTemp = $element['idSkipassTemp'];
                $result2 = $result2 + FSkipassTemp::getSkipassTempObjFromFields([['idSkipassTemp', $idSkipassTemp]]);
            }
        }
        if($type !== "") {
            $result2 = FSkipassTemp::getSkipassTempObjFromFields([['description', $type]]);
            foreach ($result2 as $element) {
                $idSkipassTemp = $element->getIdSkipassTemp();
                $result3[] = FSkipassObj::getSkipassObjFromFields([['idSkipassTemp', $idSkipassTemp]]);
                $idSkiFacility = $element->getIdSkiFacility();
                $result1[] = FSkiFacility::getSkiFacilityById($idSkiFacility);
            }   
        }
        if($price !== "") {
            $result3 = FSkipassObj::getSkipassObjFromFieldsForSearch([['value', $price]]);
            foreach ($result3 as $element) {
                $idSkipassTemp = $element->getIdSkipassTemp();
                $result2[] = FSkipassTemp::getSkipassTempObjFromFields([['idSkipassTemp', $idSkipassTemp]]);
                $idSkiFacility = $element->getIdSkiFacility();
                $result1[] = FSkiFacility::getSkiFacilityById($idSkiFacility);
            }
        }
        if(count($result1) > 0) {
            $array1 = FSkiFacility::createSkiFacilityObj($result1);
        } else {
            $array1 = [];
        } 
        if(count($result2) > 0) {
            $array2 = FSkipassTemp::createSkipassTempObj($result2);
        } else {
            $array2 = [];
        }
        if(count($result3) > 0) {
            $array3 = FSkipassObj::createSkipassObjObj($result3);
        } else {
            $array3 = [];
        }
        //$result = [$array3, $array1, $array2];
        return $result;
    }

    /**
     * Retrive all skipass templates 
     * @return array of objects or empty array
     */
    public static function retriveAllSkipassTemp() : array{
        $result = FSkipassTemp::getAllSkipassTempObjs();
        
        if(count($result) > 0) {
            return FSkipassTemp::createSkipassTempObj($result);
        } else {
            return [];
        } 
    }

    /**
     * Retrive a skipass template on id
     * @param int $id 
     * @return array of objects or empty array
     */
    public static function retriveSkipassTempOnId(int $id) : array{
        $result = FSkipassTemp::getSkipassTempObjFromId($id);
        
        if(count($result) > 0) {
            return FSkipassTemp::createSkipassTempObj($result);
        } else {
            return [];
        } 
    }

    public static function retriveSkipassTempForSearch(string $description, string $period, string $type) :array{
        $result = FSkipassTemp::getSkipassTempObjFromFieldsForSearch([['description', $description], ['period', $period], ['type', $type]]);
        if(count($result) > 0) {
            $result = FSkipassTemp::createSkipassTempObj($result);
        } else {
            $result = [];
        }
        return $result;
    }

    public static function retriveSkipassTempPeriodType(string $period, string $type) :array{
        $result = FSkipassTemp::getSkipassTempObjFromFieldsForSearch([['period', $period], ['type', $type]]);
        if(count($result) > 0) {
            $result = FSkipassTemp::createSkipassTempObj($result);
        } else {
            $result = [];
        }
        return $result;
    }

    
    
/* UPLOAD METHODS */

    /**
     * Upload any object in the database
     * @param object $obj
     * @return bool
     */
    public static function uploadObj(object $obj) : bool{
        $foundClass = "F" . substr(get_class($obj), 1);
        $staticMethod = "saveObj";
        $result = call_user_func([$foundClass, $staticMethod], $obj);
        return $result;
    }

    /**
     * DA RIVEDERE
     * Upload a price object in the database
     * @param EPrice $price
     * @return bool
     */
    public static function uploadPrice(EPrice $price) : bool{
        $field = [['description', $price->getDescription()], ['value', $price->getValue()]];
        $result = FPrice::saveObj($price, $field);
        return $result;
    }

    public static function uploadSkiFacilityImage(ESkiFacilityImage $obj) : bool{
        $result = FSkiFacilityImage::saveObj($obj);
        return $result;
    }

/* UPDATE METHODS */

    /**
     * Update user date
     * @param EPerson $person
     * @return bool
     */
    public static function updatePersonInfo(EPerson $person) : bool{
        $field = [['name', $person->getName()],['surname', $person->getSurname()],['email', $person->getEmail()],['phoneNumber', $person->getPhoneNumber()], ['birthDate', $person->getBirthDate()]];
        $result = FPerson::saveObj($person, $field);
        return $result;
    }

    /**
     * Update the id of the image refered to a user
     * @param EUser $user
     * @return bool
     */
    public static function updateUserIdImage(EUser $user) : bool{
        $field = [['idImage', $user->getIdImage()]];
        $result = FUser::saveObj($user, $field);

        return $result;
    }

    /**
     * Update the user password
     * @param EUser $user
     * @return bool 
     */
    public static function updateUserPassword(EUser $user) : bool{
        $field = [['password', $user->getPassword()]];
        $result = FUser::saveObj($user, $field);
        return $result;
    }

    /**
     * Update the ski facility info
     * @param ESkiFacility $skiFacility
     * @return bool 
     */
    public static function updateSkiFacilityInfo(ESkiFacility $skiFacility) : bool{
        $field = [['name', $skiFacility->getName()],['status', $skiFacility->getStatus()],['description', $skiFacility->getDescription()]];
        $result = FSkiFacility::saveObj($skiFacility, $field);
        return $result;
    }

    public static function updateIdSkiFacilityImage(ESkiFacilityImage $obj) : bool{
        $field = [['idImage', $obj->getIdImage()]];
        $result = FSkiFacilityImage::saveObj($obj, $field);
        return $result;
    }

    /**
     * Update the ski run info
     * @param ESkiRun $skiRun
     * @return bool 
     */
    public static function updateSkiRunInfo(ESkiRun $skiRun) : bool{
        $field = [['name', $skiRun->getName()], ['type', $skiRun->getType()], ['status', $skiRun->getStatus()], ['idSkiFacility', $skiRun->getIdSkiFacility()]];
        $result = FSkiRun::saveObj($skiRun, $field);
        return $result;
    }

    /**
     * Update the lift structure info
     * @param ELiftStructure $liftStructure
     * @return bool 
     */
    public static function updateLiftStructureInfo(ELiftStructure $liftStructure) : bool{
        $field = [['name', $liftStructure->getName()], ['type', $liftStructure->getType()], ['status', $liftStructure->getStatus()], ['seats', $liftStructure->getSeats()], ['idSkiFacility', $liftStructure->getIdSkiFacility()]];
        $result = FLiftStructure::saveObj($liftStructure, $field);
        return $result;
    }

    /**
     * Update a credit card info
     * @param ECreditCard $creditCard
     * @return bool 
     */
    public static function updateCreditCard(ECreditCard $creditCard) : bool{
        $field = [['cardHolderName', $creditCard->getCardHolderName()], ['cardHolderSurname', $creditCard->getCardHolderSurname()], ['cardNumber', $creditCard->getCardNumber()], ['cvv', $creditCard->getCvv()], ['expityDate', $creditCard->getExpiryDate()]];
        $result = FCreditCard::saveObj($creditCard, $field);
        return $result;
    }

    /**
     * Update a price info
     * @param EPrice $price
     * @return bool 
     */
    public static function updatePrice(EPrice $price) : bool{
        $field = [['description', $price->getDescription()], ['value', $price->getValue()]];
        $result = FPrice::saveObj($price, $field);
        return $result;
    }

    /**
     * Update a skipass object
     * @param ESkipassObj $skipass
     * @return bool 
     */
    public static function updateSkipassObj(ESkipassObj $skipass){
        $field = [['description', $skipass->getDescription()], ['value', $skipass->getValue()]];
        $result = FSkipassObj::saveObj($skipass, $field);
        return $result;
    }

    /**
     * Update a skipass booking
     * @param ESkipassBooking $skipassBooking
     * @return bool 
     */
    public static function updateSkipassBookingInfo(ESkipassBooking $skipassBooking) : bool{
        $field = [['name', $skipassBooking->getName()],['surname', $skipassBooking->getSurname()], ['startDate', $skipassBooking->getStartDate()], ['email', $skipassBooking->getEmail()]];
        $result = FSkipassBooking::saveObj($skipassBooking, $field);
        return $result;
    }

    /**
     * Update a insurance info
     * @param EInsurance $insurance
     * @return bool 
     */
    public static function updateInsuranceInfo(EInsurance $insurance) : bool{
        $field = [['startDate', $insurance->getStartDate()]];
        $result = FInsurance::saveObj($insurance, $field);
        return $result;
    }

    public static function updateIdLandingImage(ELandingImage $obj) : bool{
        $field = [['idImage', $obj->getIdImage()]];
        $result = FLandingImage::saveObj($obj, $field);

        return $result;
    }

    public static function updateInsuranceTemp(EInsuranceTemp $insuranceTemp) : bool{
        $field = [['value', $insuranceTemp->getValue()], ['type', $insuranceTemp->getType()]];
        $result = FInsuranceTemp::saveObj($insuranceTemp, $field);
        return $result;
    }

    public static function updateSkipassTemplate(ESkipassTemplate $skipassTemp){
        $field = [['description', $skipassTemp->getDescription()], ['period', $skipassTemp->getPeriod()], ['type', $skipassTemp->getType()]];
        $result = FSkipassTemp::saveObj($skipassTemp, $field);
        return $result;
    }

/* VERIFY METHODS */

    /**
     * Verify if a user is an admin (also admin)
     * @param int $idUser
     * @return bool 
     */
    public static function verifyAdmin(int $idUser) : bool{
        $result = FAdmin::verify('idUser', $idUser);
        if (count($result) > 0)
            return true;
        else
            return false;
    }

    /**
     * Verify if exist a user with this email (also admin)
     * @param string $email
     * @return bool 
     */
    public static function verifyUserEmail(string $email) : bool{
        $result = FUser::verify('email', $email);
        return $result;
    }

    /**
     * Verify if exist a user with this username (also admin)
     * @param string $username
     * @return bool
     */
    public static function verifyUserUsername(string $username) : bool{
        $result = FUser::verify('username', $username);
        return $result;
    }

    /**
     * Verify if exist a ski run with this name refered to a ski facility
     * @param string $name
     * @param int $idSkiFacility
     * @return bool
     */
    public static function verifySkiRunName(string $name, int $idSkiFacility) : bool{
        $result = FSkiRun::getSkiRunByNameAndSkiFacility($name, $idSkiFacility);
        return $result;
    }

    /**
     * Verify if exist a ski facility using the name
     * @param string $name
     * @return bool
     */
    public static function verifySkiFacilityName(string $name) : bool{
        $result = FSkiFacility::verifySkiFacility('name', $name);
        return $result;
    }

    /**
     * Verify if exist a lift structure with this name refered to a ski facility
     * @param string $name
     * @param int $idSkiFacility
     * @return bool
     */
    public static function verifyLiftStructureName(string $name, int $idSkiFacility) : bool{
        $result = FLiftStructure::getLiftStructureByNameAndSkiFacility($name, $idSkiFacility);
        return $result;
    }

    /**
     * Verify if exist a preferred credit card for the user 
     * @param int $userId
     * @return bool
     */
    public static function verifyPCreditCard(int $userId) : bool{
        $result = FCreditCard::verifyCreditCardByUserId($userId);
        return $result;
    }

    /**
     * Verify if exist a price description referred to a ski facility
     * @param string $description
     * @param int $idSkiFacility
     * @return bool
     */
    public static function verifyPriceDescription(string $description, int $idSkiFacility) : bool{
        $result = FPrice::verifyPriceByDescriptionAndSkiFacility($description, $idSkiFacility);
        return $result;
    }

    /**
     * Verify if exist a price using the id of the skipass object and the id of the ski facility
     * @param int $idSkipassObj
     * @param int $idSkiFacility
     * @return bool
     */
    public static function verifyPrice(int $idSkipassObj, int $idSkiFacility) : bool{
        $result = FPrice::verify('idSkipassObj', $idSkipassObj, 'idSkiFacility', $idSkiFacility);
        return $result;
    }

/* DELETE METHODS */

    /**
     * Method to delete an Image in the Database
     * @param int $idImage Refers to teh id of the image to delete
     * @return bool
     */
    public static function deleteImage(int $idImage) : bool{
        $result = FEntityManager::getInstance()->deleteObjInDb(FImage::getTable(), FImage::getKey(), $idImage);
        return $result;
    }

    public static function deleteLandingImage(int $idImage) : bool{
        $result = FEntityManager::getInstance()->deleteObjInDb(FLandingImage::getTable(), FLandingImage::getKey(), $idImage);
        return $result;
    }

    public static function deleteSkiFacilityImage(int $idImage) : bool{
        $result = FEntityManager::getInstance()->deleteObjInDb(FSkiFacilityImage::getTable(), FSkiFacilityImage::getKey(), $idImage);
        return $result;
    }

    /**
     * Method to delete a skipassBooking
     * @param int $idSkipassBooking
     * @return bool
     */
    public static function deleteSkipassBooking(int $idSkipassBooking) : bool{
        $result = FEntityManager::getInstance()->deleteObjInDb(FSkipassBooking::getTable(), FSkipassBooking::getKey(), $idSkipassBooking);
        return $result;
    }

    /**
     * Method to delete a ski facility
     * @param int $idSkiFacility
     * @return bool
     */
    public static function deleteSkiFacility(int $idSkiFacility) : bool{
        $result = FEntityManager::getInstance()->deleteObjInDb(FSkiFacility::getTable(), FSkiFacility::getKey(), $idSkiFacility);
        return $result;
    }

/* MAYBE UNUSED */
    

    /* public static function verifySkiFacilityName($field, $id) {
        $result = FSkiFacility::getSkiFacilityByName($field, $id);
        
        return $result;
    } */

    /* public static function retriveInsuranceFromBooking($idUser, $booking) {
        $fields = [['name', $booking->getName()], ['surname', $booking->getSurname()], ['startDate', $booking->getStartDate()], ['idUser', $idUser]];
        $result = FInsurance::getInsuranceFromBooking($fields);
        return $result;
    } */

    
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
    public static function checkImage($file){
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

    
    
      
}

?>