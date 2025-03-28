<?php

require_once("FEntityManager.php");

class FSkiFacility {

    private static $table = "skiFacility";
    private static $value = "(NULL, :name, :status, :price)";
    private static $key = "idSkiFacility";

    public static function getTable() {return self::$table;}
    public static function getValue() {return self::$value;}
    public static function getClass() {return self::class;}
    public static function getKey() {return self::$key;}
    
    /**
     * Method to get an object using the id
     * @param string $id Refers to the id
     * @return array 
     */
    public static function getObj(string $id) :array {
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        return $result;
    }

    /**
     * Binds the values of a ski facility to a prepared SQL statement.
     * @param object $stmt The PDO statement object used for query execution.
     * @param ESkiFacility $skiFacility An object representing an insurance
     * @return void
     */
    public static function bind(object $stmt, ESkiFacility $skiFacility){
        $stmt->bindValue(":name", $skiFacility->getName(), PDO::PARAM_STR);
        $stmt->bindValue(":status", $skiFacility->getStatus(), PDO::PARAM_STR);
        $stmt->bindValue(":price",$skiFacility->getPrice(), PDO::PARAM_INT);
    }

    /**
     * Method to save an object in the database using the proper FEntityManager function
     * @param ESkiFacility $obj Refers to an Entity object that needs to be stored in the database
     * @param array $fieldArray Refers to an array of fields and values
     * @return bool true if succeded and false if failed
     */
    public static function saveObj(ESkiFacility $obj, ?array $fieldArray = null) : bool{
        if($fieldArray === null) {
            try{
                FEntityManager::getInstance()->getDb()->beginTransaction();
                $saveSkiFacility = FEntityManager::getInstance()->saveObject(self::getClass(), $obj);
                if($saveSkiFacility !== null){
                    FEntityManager::getInstance()->getDb()->commit();
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                error_log("Database error in FSkiFacility saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            }finally{
                FEntityManager::getInstance()->closeConnection();
            }
        } else {
            try {
                FEntityManager::getInstance()->getDb()->beginTransaction();
                foreach($fieldArray as $fv) {
                    FEntityManager::getInstance()->updateObj(FSkiFacility::getTable(), $fv[0], $fv[1], self::getKey(), $obj->getIdSkiFacility());
                } 
                FEntityManager::getInstance()->getDb()->commit();
                return true;
            } catch (PDOException $e) {
                error_log("Database error in FSkiFacility saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally{
                FEntityManager::getInstance()->closeConnection();
            } 
        }
    }

    /**
     * Method to create an object or a set of object from a query
     * @param array $queryResult Refers to the result of a query
     * @return array of objects 
     */    
    /*public static function createSkiFacilityObj(array $queryResult) : array{
        if(count($queryResult) == 1){
            $skiFacilityA = [];
            $skiFacility = new ESkiFacility($queryResult[0]['name'], $queryResult[0]['status'], $queryResult[0]['description']);
            $skiFacility->setIdSkiFacility($queryResult[0]['idSkiFacility']);
            $skiFacilityA[] = $skiFacility;
            return $skiFacilityA;
        }elseif(count($queryResult) > 1){
            $skiFacilities = [];
            for($i = 0; $i < count($queryResult); $i++){
                $skiFacility = new ESkiFacility($queryResult[$i]['name'], $queryResult[$i]['status'], $queryResult[$i]['description']);
                $skiFacility->setIdSkiFacility($queryResult[$i]['idSkiFacility']);
                $skiFacilities[] = $skiFacility;
            }
            return $skiFacilities;
        }else{
            return [];
        }
    }
    /** */
    
    public static function createSkiFacilityObj(array $queryResult): array {
    if (count($queryResult) == 1) {
        $skiFacilityA = [];
        $description = $queryResult[0]['description'] ?? ""; // Usa una stringa vuota se la chiave non esiste
        $skiFacility = new ESkiFacility($queryResult[0]['name'], $queryResult[0]['status'], $description);
        $skiFacility->setIdSkiFacility($queryResult[0]['idSkiFacility']);
        $skiFacilityA[] = $skiFacility;
        return $skiFacilityA;
    } elseif (count($queryResult) > 1) {
        $skiFacilities = [];
        for ($i = 0; $i < count($queryResult); $i++) {
            $description = $queryResult[$i]['description'] ?? ""; // Evita l'errore se manca
            $skiFacility = new ESkiFacility($queryResult[$i]['name'], $queryResult[$i]['status'], $description);
            $skiFacility->setIdSkiFacility($queryResult[$i]['idSkiFacility']);
            $skiFacilities[] = $skiFacility;
        }
        return $skiFacilities;
    } else {
        return [];
    }
}
    
    /**
     * Method to get all ski facility objects 
     * @return array $result
     */
    public static function getSkiFacilities() : array{
        $result = FEntityManager::getInstance()->retriveAllObj(FSkiFacility::getTable());
        return $result;
    }

    /**
     * Method to get all the ski facility id 
     * @return array $result
     */
    public static function getIdAllSkiFacilities() : array{
        $result = FEntityManager::getInstance()->selectObj(FSkiFacility::getKey(), FSkiFacility::getTable());
        return $result;
    }

    /**
     * Method to get the name of the ski facility using the id
     * @param string $idSkiFacility id of the ski facility
     * @return array $result
     */
    public static function getNameSkiFacility(string $idSkiFacility) : array{
        $result = FEntityManager::getInstance()->selectObjKey('name', FSkiFacility::getTable(), FSkiFacility::getKey(), $idSkiFacility);
        return $result;
    }

    /**
     * Method to get all the name of the ski facilities
     * @return array $result
     */
    public static function getAllNameSkiFacility() : array{
        $result = FEntityManager::getInstance()->selectObj('name', FSkiFacility::getTable());
        return $result;
    }

    /**
     * Method to get the id of the ski facility from the name
     * @param string $name 
     * @return array $result
     */
    public static function getIdFromName(string $name) : array{
        $result = FEntityManager::getInstance()->selectObjKey(FSkiFacility::getKey(), FSkiFacility::getTable(), 'name', $name);
        return $result;
    }

    /* C'è giò getSkiFacilities */
    public static function getAllSkiFacilityObj() {
        $result = FEntityManager::getInstance()->retriveAllObj(FSkiFacility::getTable());
        return $result;
    }

    /**
     * Method to get a ski facility using the id
     * @param string $id
     * @return array $result
     */
    public static function getSkiFacilityById(string $id) : array{ 
        $result = FEntityManager::getInstance()->retriveObj(FSkiFacility::getTable(), 'idSkiFacility', $id);
        return $result;
    }

    /**
     * Method to verify if exist a ski facility using field and value
     * @param string $field
     * @param string $id
     * @return bool 
     */
    public static function verifySkiFacility(string $field, string $id) : bool{
        $queryResult = FEntityManager::getInstance()->retriveObj(self::getTable(), $field, $id);
        return FEntityManager::getInstance()->existInDb($queryResult);
    }


    public static function getSkiFacilityByNameForSearch($queryString) {
        $queryResult = FEntityManager::getInstance()->retriveObjForSearch(self::getTable(), 'name', $queryString);
        return $queryResult;
    }
    
}

?>