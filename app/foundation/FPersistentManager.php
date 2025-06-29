<?php

require_once (__DIR__."/../config/autoloader.php");

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
     * Retrive all Users 
     * @return array of objects or empty array
     */
    public static function retriveAllPersons() : array{
        $result = FUser::getPersons();
        if(count($result) > 0) {
            return FPerson::createPersonObj($result);
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
     * Retrive a User findig it on it's emai
     * @param string $email
     * @return array of objects or empty array
     */
    public static function retriveUserOnEmail(string $email) : array{
        $person = FPerson::getPersonByEmail($email); 
        $userId = $person[0]['idUser'];
        $user = FUser::getUserById($userId);
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
     * Retrieves user records matching a given username for search purposes.
     *
     * @param string $username The username to search for.
     * @return array An array of user objects matching the username; empty array if none found.
     */
    public static function retriveUsersFromUsernameForSearch(string $username) : array{
        $result = FUser::getUsersFromUsernameForSearch($username);
        if(count($result) > 0) {
            return FUser::createUserObj($result);
        } else {
            return [];
        }
    }

    /**
     * Retrieves user records matching a given email for search purposes.
     *
     * @param string $email The email address to search for.
     * @return array An array of user objects matching the email; empty array if none found.
     */
    public static function retriveUsersFromEmailForSearch(string $email) : array{
        $result = FUser::getUsersFromEmailForSearch($email);
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
        //se si inserisce solo il nome si ricerca solo per nome
        //se si inserisce solo il cognome si ricerca solo per cognome 
        if($username == "" && $name == "" && $surname == "") {
            $result = FUser::getUsers();
            if(count($result) > 0) {
            $array = FUser::createUserObj($result);
            } else {
                $array = [];
            } 
            return $array;
        }
            
        $result = FUser::getUsersNameANDSurname($name, $surname);
        if(count($result) > 0)
            $result[0]['username'] = FUser::getUserById($result[0]['idUser'])[0]['username'];
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

    /**
     * Retrieves landing images by their ID.
     *
     * @param string $id The ID of the landing image to retrieve.
     * @return array An array of ELandingImage objects if found; empty array otherwise.
     */
    public static function retriveLandingImageOnId(string $id) : array{
        $result = FLandingImage::getImageById($id);
        if(count($result) > 0){
            return FLandingImage::createImageObj($result);
        }else{
            return [];
        }
    }

    /**
     * Retrieves all landing images from the database.
     *
     * @return array An array of ELandingImage objects if any exist; empty array otherwise.
     */
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

    /**
     * Retrieves all ski facility images from the database.
     *
     * @return array An array of FSkiFacilityImage objects if any exist; empty array otherwise.
     */
    public static function retriveAllSkiFacilityImage() : array{
        $result = FSkiFacilityImage::getAllImages();
        if(count($result) > 0){
            return FSkiFacilityImage::createImageObj($result);
        }else{
            return [];
        }
    }

    /**
     * Retrieves ski facility images by a specific ID.
     *
     * @param mixed $id The ID of the ski facility image to retrieve.
     * @return array An array of FSkiFacilityImage objects if found; empty array otherwise.
     */
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
     * Retrieves ski facilities matching a given name for search purposes.
     *
     * @param string $nameSkiFacility The name (or partial name) of the ski facility to search for.
     * @return array An array of ski facility objects if matches are found; empty array otherwise.
     */
    public static function retriveSkiFacilityForSearch(string $nameSkiFacility) {
        $result = FSkiFacility::getSkiFacilityByNameForSearch($nameSkiFacility);
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

    /**
     * Retrieves the types and their counts of lift structures associated with a specific ski facility.
     *
     * @param int $idSkiFacility The ID of the ski facility.
     * @return array An array containing types of lift structures and their corresponding counts.
     */
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
                $app[] = $name[0];
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
                $app[] = $name[0];
                $final[] = $app;
            }
            $result['liftStructure'] = $final;
        }
        return $result;
    }

    /**
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

    /**
     * Retrieves ski structures (ski facilities, ski runs, lift structures) based on provided search criteria.
     *
     * If all parameters are empty, it returns all ski structures.
     * Otherwise, it searches and combines results for ski facilities, ski runs, and lift structures
     * matching the given names, grouping them with their related ski facility names.
     *
     * @param string $nameSkiFacility Name of the ski facility to search for.
     * @param string $nameSkiRun Name of the ski run to search for.
     * @param string $nameLiftStructure Name of the lift structure to search for.
     * @return array|null An associative array containing the results with keys:
     *                    'skiFacilities', 'skiRun', and 'liftStructure'.
     *                    Each entry contains objects paired with their ski facility names.
     *                    Returns null if no results are found.
     */
    public static function retriveStructureForSearch (string $nameSkiFacility, string $nameSkiRun, string $nameLiftStructure) : ?array{
        if($nameSkiFacility == "" && $nameSkiRun == "" && $nameLiftStructure == "") {
            $result = self::retriveAllSkiStructures();
            return $result;
        }
        if($nameSkiFacility != "") {
            $idSkiFacility = FSkiFacility::getIdFromName($nameSkiFacility);
            if(count($idSkiFacility) > 0)
                $result21 = FSkiRun::getSkiRunByIdSkiFacility($idSkiFacility[0]);
            else 
                $result21 = [];
            if(count($result21) > 0) {
                $resultArray = FSkiRun::createSkiRunObj($result21);
                $final = [];
                foreach ($resultArray as $element) {
                    $app = [];
                    $app[] = $element;
                    $name = $nameSkiFacility;
                    $app[] = $name;
                    $final[] = $app;
                }
                $result['skiRun'] = $final;
            } 
            if(count($idSkiFacility) > 0)
                $result31 = FLiftStructure::getLiftStructureByIdSkiFacility($idSkiFacility[0]);
            else 
                $result31 = [];
            if(count($result31) > 0) {
                $resultArray = FLiftStructure::createLiftStructureObj($result31);
                $final = [];
                foreach ($resultArray as $element) {
                    $app = [];
                    $app[] = $element;
                    $name = $nameSkiFacility;
                    $app[] = $name;
                    $final[] = $app;
                }
                $result['liftStructure'] = $final;
            }
        }
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
                $app[] = $name[0];
                $final[] = $app;
            }
            if(isset($result['skiRun']))
                $result['skiRun'] = array_merge($final, $result['skiRun']);
            else
                $result['skiRun'] = $final;
        } elseif(!isset($result['skiRun'])) {
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
                $app[] = $name[0];
                $final[] = $app;
            }
            if(isset($result['liftStructure']))
                $result['liftStructure'] = array_merge($final, $result['liftStructure']);
            else
                $result['liftStructure'] = $final;
            
        } elseif(!isset($result['liftStructure'])) {
            $result['liftStructure'] = [];
        }
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

    /**
     * Retrieves all skipass bookings for all users.
     *
     * Calls the data layer to fetch all skipass booking records,
     * then creates and returns an array of SkipassBooking objects.
     * Returns an empty array if no records are found.
     *
     * @return array An array of SkipassBooking objects or empty array if none found.
     */
    public static function retriveAllSkipassBookingAllUsers() : array{
        $result = FSkipassBooking::getAllSkipassBookingAllUsers();
        
        if(count($result) > 0) {
            return FSkipassBooking::createSkipassBookingObj($result);
        } else {
            return [];
        } 
    }

    /**
     * Adds a unique key-value pair to an array of fields if not already present.
     *
     * Checks if the given key-value pair exists in the array; if it does, returns the original array.
     * Otherwise, appends the new key-value pair and returns the updated array.
     *
     * @param array $fields The array of key-value pairs to check and add to.
     * @param string $key The key to check for uniqueness.
     * @param mixed $value The value associated with the key.
     * @return array The updated array with the new unique key-value pair added if it was not present.
     */
    public static function addUniqueField(array $fields, string $key, $value): array {
        foreach ($fields as $field) {
            if ($field[0] === $key && $field[1] === $value) {
                // Già presente, non aggiungo
                return $fields;
            }
        }

        // Non trovato, lo aggiungo
        $fields[] = [$key, $value];
        return $fields;
    }

    /**
     * Retrieves skipass bookings filtered by ski facility name, username, and email.
     *
     * If all filters are empty, returns all bookings with related ski facility and user info.
     * Otherwise, searches bookings by provided fields, handling multiple conditions.
     *
     * @param string $nameSkiFacility Name of the ski facility to search for.
     * @param string $username Username to search for.
     * @param string $email Email to search for.
     * @return array Array of arrays containing SkipassBooking object, SkiFacility object, and User object.
     */
    public static function retriveSkipassBookingForSearch(string $nameSkiFacility, string $username, string $email) :array{
        $fields = [];
        $final = [];
        if($nameSkiFacility == "" && $username == "" && $email == "") {
            $result = self::retriveAllSkipassBookingAllUsers();
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
            return $result1;
        }
        if($nameSkiFacility != "") {
            $skiFacility = self::retriveSkiFacilityForSearch($nameSkiFacility);
            foreach ($skiFacility as $e) {
                $skipassObj = self::retriveSkipassObjOnSkiFacility($e->getIdSkiFacility());
                foreach ($skipassObj as $i) {
                    $idSkipassObj = $i->getIdSkipassObj();
                    $fields = self::addUniqueField($fields, 'idSkipassObj', $idSkipassObj);
                }
            }
        }
        $final[] = $fields; 
        $fields = []; 
        if($username != "") {
            $user = self::retriveUsersFromUsernameForSearch($username);
            foreach ($user as $e) {
                $idUser = $e->getIdUser();
                $fields[] = ['idUser', $idUser];
            }
        }   
        $final[] = $fields;
        $fields = [];  
        if($email != "") {
            $user = self::retriveUsersFromEmailForSearch($email);
            if(count($user) > 0) {
                foreach ($user as $e) {
                    $idUser = $e->getIdUser();
                    $fields[] = ['idUser', $idUser];
                }
            }
        }
        $final[] = $fields;
        if (array_filter($final)) {
            $result = FSkipassBooking::getSkipassBookingFromFieldsForSearch($final);
        } else {
            $result = [];
        }
        if(count($result) > 0) {
            $array1 = FSkipassBooking::createSkipassBookingObj($result);
            $result1 = [];
            foreach ($array1 as $object) {
                $idUser = $object->getIdUser();
                $user = FPersistentManager::getInstance()->retriveUserOnId($idUser);
                $idSkipassObj = $object->getIdSkipassObj();
                $skipassObj = FPersistentManager::getInstance()->retriveSkipassObjOnId($idSkipassObj);
                $idSkiFacility = $skipassObj[0]->getIdSkiFacility();
                $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($idSkiFacility);
                $result1[] = [$object, $skiFacility[0], $user[0]];
            }
        } else {
            $result1 = [];
        }
        return $result1;
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

    /**
     * Retrive all insurance objects using user id and a date
     * @param int $idUser
     * @param string $date
     * @return array of objects or empty array
     */
    public static function retriveInsuranceFromIdUserIdSkipassBookingAndDate(int $idUser, int $idSkipassBooking, string $date) : array{
        $result = FInsurance::getInsuranceFromIdUserIdSkipassBookingAndDate($idUser, $idSkipassBooking, $date);
        if(count($result) > 0) {
            return FInsurance::createInsuranceObj($result);
        } else {
            return [];
        } 
    }

    /**
     * Retrive all insurance objects using user id 
     * @param int $idUser
     * @param string $date
     * @return array of objects or empty array
     */
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

    /**
     * Retrieve insurance templates by value and type for search purposes
     * 
     * @param string $value The value to search for in insurance templates
     * @param string $type The type of insurance template to filter by
     * @return array Array of insurance template objects matching the criteria or empty array if none found
     */
    public static function retriveInsuranceTempForSearch(string $value, string $type) :array{
        $result = FInsuranceTemp::getInsuranceTempObjFromFieldsForSearch([['value', $value], ['type', $type]]);
        if(count($result) > 0) {
            $result = FInsuranceTemp::createInsuranceTempObj($result);
        } else {
            $result = [];
        }
        return $result;
    }

    /**
     * Retrieve all subscription templates from the database
     * 
     * @return array Array of subscription template objects or empty array if none found
     */
    public static function retriveAllSubscriptionTemp() : array{
        $result = FSubscriptionTemp::getAllSubscriptionTempObjs();
        
        if(count($result) > 0) {
            return FSubscriptionTemp::createSubscriptionTempObj($result);
        } else {
            return [];
        } 
    }

    /**
     * Retrieve a subscription template by its ID
     * 
     * @param int $idSubscriptionTemp The ID of the subscription template
     * @return array Array of subscription template objects or empty array if none found
     */
    public static function retriveSubscriptionTempFromId(int $idSubscriptionTemp) :array{
        $result = FSubscriptionTemp::getSubscriptionTempFromId($idSubscriptionTemp);
        if(count($result) > 0) {
            $result = FSubscriptionTemp::createSubscriptionTempObj($result);
        } else {
            $result = [];
        }
        return $result;
    }

    /**
     * Retrieve subscription templates matching given description and value
     * 
     * @param string $description The description to search for
     * @param string $value The value to search for
     * @return array Array of subscription template objects or empty array if none found
     */
    public static function retriveSubscriptionTempForSearch(string $description, string $value) :array{
        $result = FSubscriptionTemp::getSubscriptionTempObjFromFieldsForSearch([['description', $description], ['value', $value]]);
        if(count($result) > 0) {
            $result = FSubscriptionTemp::createSubscriptionTempObj($result);
        } else {
            $result = [];
        }
        return $result;
    }

    /**
     * Retrieve subscriptions matching the given subscription object's attributes
     * 
     * @param ESubscription $subscription The subscription object containing search criteria
     * @return array Array of subscription objects matching the criteria, or empty array if none found
     */
    public static function retriveSubscription(ESubscription $subscription) : array{
        $fields = [['name', $subscription->getName()], ['surname', $subscription->getSurname()], ['email', $subscription->getEmail()], ['startDate', $subscription->getStartDate()], ['endDate', $subscription->getEndDate()]];
        $result = FSubscription::getSubscription($fields);
        if(count($result) > 0) {
            return FSubscription::createSubscriptionObj($result);
        } else {
            return [];
        }
    }

    /**
     * Retrieve all subscriptions associated with a specific user ID
     * 
     * @param int $userId The ID of the user
     * @return array Array of subscription objects linked to the user, or empty array if none found
     */
    public static function retriveSubscriptionFromUserId(int $userId) :array{
        $result = FSubscription::getSubscriptionFromUserId($userId);
        if(count($result) > 0) {
            $result = FSubscription::createSubscriptionObj($result);
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

    /**
     * Retrieve all skipass objects from the database
     * 
     * @return array Array of skipass objects, or empty array if none found
     */
    public static function retriveAllSkipassObj() : array{
        $result = FSkipassObj::getAllSkipassObjs();
        
        if(count($result) > 0) {
            return FSkipassObj::createSkipassObjObj($result);
        } else {
            return [];
        } 
    }

    /**
     * Retrieve skipass objects based on search criteria: ski facility name, description, and value.
     * If all parameters are empty, returns all skipass objects with related ski facility and skipass template.
     * Otherwise, it filters skipass objects by description/value and/or ski facility name.
     * 
     * @param string $nameSkiFacility Name of the ski facility to search for (can be empty)
     * @param string $description Description of the skipass to search for (can be empty)
     * @param string $value Value of the skipass to search for (can be empty)
     * @return array Array of arrays each containing: [SkipassObj, SkiFacility, SkipassTemp] matching the search criteria, or empty array if none found
     */
    public static function retriveSkipassObjForSearch(string $nameSkiFacility, string $description, string $value) :array{
        if($nameSkiFacility == "" && $description == "" && $value == "") {
            $result1 = self::retriveAllSkipassObj();
            $result = [];
            foreach ($result1 as $object) {
                $idSkiFacility = $object->getIdSkiFacility();
                $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($idSkiFacility);
                $idSkipassTemp = $object->getIdSkipassTemp();
                $skipassTemp = FPersistentManager::getInstance()->retriveSkipassTempOnId($idSkipassTemp);
                $result[] = [$object, $skiFacility[0], $skipassTemp[0]];
            }
            return $result;
        }
        if($description != "" || $value != "") {
            $field = [['description', $description], ['value', $value]];
            $result1 = FSkipassObj::getSkipassObjFromFieldsForSearch($field);
        } else {
            $result1 = [];
        }
        if($nameSkiFacility != "") {
            $idSkiFacility = self::retriveIdSkiFacilityFromName($nameSkiFacility);
            if(count($idSkiFacility) > 0)
                $result2 = FSkipassObj::getSkipassObjOnSkiFacility($idSkiFacility[0]);
            else 
                $result2 = [];
        } else {
            $result2 = [];
        }
        if(count($result1) > 0) {
            $array1 = FSkipassObj::createSkipassObjObj($result1);
            $result1 = [];
                foreach ($array1 as $object) {
                    $idSkiFacility = $object->getIdSkiFacility();
                    $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($idSkiFacility);
                    $idSkipassTemp = $object->getIdSkipassTemp();
                    $skipassTemp = FPersistentManager::getInstance()->retriveSkipassTempOnId($idSkipassTemp);
                    $result1[] = [$object, $skiFacility[0], $skipassTemp[0]];
                }
        } else {
            $result1 = [];
        }
        if(count($result2) > 0) {
            $array2 = FSkipassObj::createSkipassObjObj($result2);
            $result2 = [];
                foreach ($array2 as $object) {
                    $idSkiFacility = $object->getIdSkiFacility();
                    $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($idSkiFacility);
                    $idSkipassTemp = $object->getIdSkipassTemp();
                    $skipassTemp = FPersistentManager::getInstance()->retriveSkipassTempOnId($idSkipassTemp);
                    $result2[] = [$object, $skiFacility[0], $skipassTemp[0]];
                }
        } else {
            $result2 = [];
        }

        return array_merge($result1, $result2);
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

    /**
     * Retrieve skipass template objects based on search criteria: description, period, and type.
     * 
     * @param string $description Description of the skipass template to search for
     * @param string $period Period of the skipass template to search for
     * @param string $type Type of the skipass template to search for
     * @return array Array of skipass template objects matching the search criteria, or empty array if none found
     */
    public static function retriveSkipassTempForSearch(string $description, string $period, string $type) :array{
        $result = FSkipassTemp::getSkipassTempObjFromFieldsForSearch([['description', $description], ['period', $period], ['type', $type]]);
        if(count($result) > 0) {
            $result = FSkipassTemp::createSkipassTempObj($result);
        } else {
            $result = [];
        }
        return $result;
    }

    /**
     * Retrieve skipass template objects filtered by period and type.
     * 
     * @param string $period The period of the skipass template to search for
     * @param string $type The type of the skipass template to search for
     * @return array Array of skipass template objects matching the period and type, or empty array if none found
     */
    public static function retriveSkipassTempPeriodType(string $period, string $type) :array{
        $result = FSkipassTemp::getSkipassTempObjFromFieldsForSearch([['period', $period], ['type', $type]]);
        if(count($result) > 0) {
            $result = FSkipassTemp::createSkipassTempObj($result);
        } else {
            $result = [];
        }
        return $result;
    }

    public static function retriveTokenFromToken(string $token) :array {
        $result = FToken::getTokenFromToken($token);
        if(count($result) > 0) {
            $result = FToken::createTokenObj($result);
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

    /**
     * Update a Ski Facility Image record in the database using its ID.
     *
     * @param ESkiFacilityImage $obj The Ski Facility Image object to update
     * @return bool True if the update was successful, false otherwise
     */
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
        $field = [['idUser', $creditCard->getIdUser()], ['cardHolderName', $creditCard->getCardHolderName()], ['cardHolderSurname', $creditCard->getCardHolderSurname()], ['cardNumber', $creditCard->getCardNumber()], ['cvv', $creditCard->getCvv()], ['expiryDate', $creditCard->getExpiryDate()]];
        $result = FCreditCard::saveObj($creditCard, $field);
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
        $field = [['name', $insurance->getName()], ['surname', $insurance->getSurname()], ['startDate', $insurance->getStartDate()]];
        $result = FInsurance::saveObj($insurance, $field);
        return $result;
    }

    /**
     * Update a Landing Image record in the database using its ID.
     *
     * @param ELandingImage $obj The Landing Image object to update
     * @return bool True if the update was successful, false otherwise
     */
    public static function updateIdLandingImage(ELandingImage $obj) : bool{
        $field = [['idImage', $obj->getIdImage()]];
        $result = FLandingImage::saveObj($obj, $field);

        return $result;
    }

    /**
     * Update an Insurance Template record in the database using its value and type as keys.
     *
     * @param EInsuranceTemp $insuranceTemp The Insurance Template object to update
     * @return bool True if the update was successful, false otherwise
     */
    public static function updateInsuranceTemp(EInsuranceTemp $insuranceTemp) : bool{
        $field = [['value', $insuranceTemp->getValue()], ['type', $insuranceTemp->getType()]];
        $result = FInsuranceTemp::saveObj($insuranceTemp, $field);
        return $result;
    }

    /**
     * Update an Subscription Template record in the database using its value and type as keys.
     *
     * @param ESubscriptionTemp $insuranceTemp The Insurance Template object to update
     * @return bool True if the update was successful, false otherwise
     */
    public static function updateSubscriptionTemp(ESubscriptionTemp $subscriptionTemp) : bool{
        $field = [['description', $subscriptionTemp->getDescription()], ['value', $subscriptionTemp->getValue()], ['discount', $subscriptionTemp->getDiscount()]];
        $result = FSubscriptionTemp::saveObj($subscriptionTemp, $field);
        return $result;
    }

    /**
     * Update a Skipass Template record in the database using its description, period, and type as keys.
     *
     * @param ESkipassTemp $skipassTemp The Skipass Template object to update
     * @return bool True if the update was successful, false otherwise
     */
    public static function updateSkipassTemplate(ESkipassTemp $skipassTemp){
        $field = [['description', $skipassTemp->getDescription()], ['period', $skipassTemp->getPeriod()], ['type', $skipassTemp->getType()]];
        $result = FSkipassTemp::saveObj($skipassTemp, $field);
        return $result;
    }

    /**
     * Update a price info
     * @param EToken $token
     * @return bool 
     */
    public static function updateToken(EToken $token) : bool{
        $field = [['user_id', $token->getUserId()], ['token', $token->getToken()], ['expires_at', $token->getExpiresAt()], ['used', $token->getUsed()], ['created_at', $token->getCreatedAt()]];
        $result = FToken::saveObj($token, $field);
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
        return $result;
    }

    /**
     * Verify if exist a user with this username (also admin)
     * @param string $username
     * @return bool
     */
    public static function verifyAdminUsername(string $username) : bool{
        $result = FAdmin::verifyUsername('username', $username);
        return $result;
    }

    /**
     * Verify if exist a user with this email (also admin)
     * @param string $email
     * @return bool 
     */
    public static function verifyUserEmail(string $email) : bool{
        $result = FPerson::verify('email', $email);
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

    public static function verifyUser(string $username, string $email) {
        $result1 = FPerson::verify('email', $email);
        $result2 = FUser::verify('username', $username); 
        return !$result1 && !$result2; 
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

    /**
     * Verify if a subscription exists for a given user ID.
     *
     * @param int $idUser The user ID to verify subscription for
     * @return bool True if a subscription exists for the user, false otherwise
     */
    public static function verifySubscriptionFromUserId(int $idUser) : bool{
        $result = FSubscription::verify('idUser', $idUser);
        return $result;
    }

    public static function verifySkipassTemp(string $description, int $period, string $type) {
        $result = FSkipassTemp::verify($description, $period, $type);
        return $result;
    }

    public static function verifyInsuranceTemp(string $type, float $value) {
        $result = FInsuranceTemp::verify($type, $value);
        return $result;
    }

    public static function verifySubscriptionTemp(string $description, float $value, float $discount) {
        $result = FSubscriptionTemp::verify($description, $value, $discount);
        return $result;
    }

    public static function verifySkipassObj(string $description, int $idSkiFacility, int $idSkipassTemp) {
        $result = FSkipassObj::verify($description, $idSkiFacility, $idSkipassTemp);
        return $result;
    }

    public static function verifySkipassBooking(int $idUser, string $name, string $surname, string $email, int $period, string $type, string $date, int $idSkiFacility) {
        $skipassObjs = self::getInstance()->retriveSkipassObjOnSkiFacility($idSkiFacility);
        foreach ($skipassObjs as $i) {
            $idSkipassTemp = $i->getIdSkipassTemp();
            $skipassTemps = FPersistentManager::getInstance()->retriveSkipassTempOnId($idSkipassTemp);
            if($skipassTemps[0]->getPeriod() == $period && $skipassTemps[0]->getType() == $type)
                $idSkipassObj = $i->getIdSkipassObj();
        }
        $result = FSkipassBooking::verify($name, $surname, $type, $date, $email, $period, $idUser, $idSkipassObj);
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

    /**
     * Delete a landing image from the database by its ID.
     *
     * @param int $idImage The ID of the landing image to delete
     * @return bool True if deletion was successful, false otherwise
     */
    public static function deleteLandingImage(int $idImage) : bool{
        $result = FEntityManager::getInstance()->deleteObjInDb(FLandingImage::getTable(), FLandingImage::getKey(), $idImage);
        return $result;
    }

    /**
     * Delete a ski facility image from the database by its ID.
     *
     * @param int $idImage The ID of the ski facility image to delete
     * @return bool True if deletion was successful, false otherwise
     */
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

    /**
     * Method to delete a ski run
     * @param int $idSkiRun
     * @return bool
     */
    public static function deleteSkiRun(int $idSkiRun) : bool{
        $result = FEntityManager::getInstance()->deleteObjInDb(FSkiRun::getTable(), FSkiRun::getKey(), $idSkiRun);
        return $result;
    }

    /**
     * Method to delete a lift structure
     * @param int $idLiftStructure
     * @return bool
     */
    public static function deleteLiftStructure(int $idLiftStructure) : bool{
        $result = FEntityManager::getInstance()->deleteObjInDb(FLiftStructure::getTable(), FLiftStructure::getKey(), $idLiftStructure);
        return $result;
    }

    /**
     * Method to delete a skipass template
     * @param int $idSkipassTemp
     * @return bool
     */
    public static function deleteSkipassTemp(int $idSkipassTemp) : bool{
        $result = FEntityManager::getInstance()->deleteObjInDb(FSkipassTemp::getTable(), FSkipassTemp::getKey(), $idSkipassTemp);
        return $result;
    }

    /**
     * Method to delete a insurance template
     * @param int $idInsuranceTemp
     * @return bool
     */
    public static function deleteInsuranceTemp(int $idInsuranceTemp) : bool{
        $result = FEntityManager::getInstance()->deleteObjInDb(FInsuranceTemp::getTable(), FInsuranceTemp::getKey(), $idInsuranceTemp);
        return $result;
    }

    /**
     * Method to delete a skipass obj
     * @param int $idSkipassObj
     * @return bool
     */
    public static function deleteSkipassObj(int $idSkipassObj) : bool{
        $result = FEntityManager::getInstance()->deleteObjInDb(FSkipassObj::getTable(), FSkipassObj::getKey(), $idSkipassObj);
        return $result;
    }

    /**
     * Delete a credit card record associated with a specific user ID.
     *
     * @param int $userId The ID of the user whose credit card should be deleted
     * @return bool True if the deletion was successful, false otherwise
     */
    public static function deleteCreditCard(int $userId) : bool {
        $result = FEntityManager::getInstance()->deleteObjInDb(FCreditCard::getTable(), FCreditCard::getExtKey(), $userId);
        return $result;
    }

    /**
     * Delete a subscription template by its ID.
     *
     * @param int $idSubscriptionTemp The ID of the subscription template to delete
     * @return bool True if the deletion was successful, false otherwise
     */
    public static function deleteSubscriptionTemp(int $idSubscriptionTemp) : bool {
        $result = FEntityManager::getInstance()->deleteObjInDb(FSubscriptionTemp::getTable(), FSubscriptionTemp::getKey(), $idSubscriptionTemp);
        return $result;
    }

    /**
     * Delete a profile by its ID.
     *
     * @param int $userId The ID of the user to delete
     * @return bool True if the deletion was successful, false otherwise
     */
    public static function deleteProfile(int $userId) : bool {
        $result1 = FEntityManager::getInstance()->deleteObjInDb(FPerson::getTable(), FPerson::getKey(), $userId);
        $result2 = FEntityManager::getInstance()->deleteObjInDb(FUser::getTable(), FUser::getKey(), $userId);
        return $result1 && $result2;
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
            $checkUploadImage = self::checkImage($file);
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