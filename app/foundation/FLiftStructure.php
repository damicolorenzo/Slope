<?php

require_once("FEntityManager.php");

class FLiftStructure {

    private static $table = "liftStructure";
    private static $columns = " ('idLiftStructure', 'name', 'type', 'status', 'seats', 'idSkiFacility')";
    private static $value = "(NULL, :name, :type, :status, :seats, :idSkiFacility)";
    private static $key = "idLiftStructure";
    private static $externalKey = "idSkiFacility";
    
    public static function getTable() {return self::$table;}
    public static function getColumns() {return self::$columns;}
    public static function getValue() {return self::$value;}
    public static function getClass() {return self::class;}
    public static function getKey() {return self::$key;}
    public static function getExtKey() {return self::$externalKey;}

    /**
     * Method to get an object using the id, invoke the retriveObj function from FEntityManager
     * @param string $id Refers to the id
     * @return array 
     */
    public static function getObj(string $id) :array {
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        return $result;
    }

    /**
     * Binds the values of a person object to a prepared SQL statement.
     * @param object $stmt The PDO statement object used for query execution.
     * @param ELiftStructure $liftStructure An object representing a lift structure
     * @return void
     */
    public static function bind(object $stmt, ELiftStructure $liftStructure) : void{
        $stmt->bindValue(":name", $liftStructure->getName(), PDO::PARAM_STR);
        $stmt->bindValue(":type", $liftStructure->getType(), PDO::PARAM_STR);
        $stmt->bindValue(":status",$liftStructure->getStatus(), PDO::PARAM_STR);
        $stmt->bindValue(":seats",$liftStructure->getSeats(), PDO::PARAM_INT);
        $stmt->bindValue(":idSkiFacility",$liftStructure->getIdSkiFacility(), PDO::PARAM_INT);
    }

    /**
     * Method to save an object in the database using the proper FEntityManager function
     * @param ELiftStructure $obj Refers to a lift structure Entity object that needs to be stored in the database
     * @param array $fieldArray Refers to an array of fields and values
     * @return bool true if succeded and false if failed
     */
    public static function saveObj(ELiftStructure $obj, ?array $fieldArray = null) : bool{
        if($fieldArray === null) {
            try {
                FEntityManager::getInstance()->getDb()->beginTransaction();
                $saveLiftStructure = FEntityManager::getInstance()->saveObject(self::getClass(), $obj);
                if($saveLiftStructure !== null) {
                    FEntityManager::getInstance()->getDb()->commit();
                    return true;
                } else {
                    return false;
                }
            } catch(PDOException $e) {
                error_log("Database error in FCreditCard saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally {
                FEntityManager::getInstance()->closeConnection();
            }
        } else {
            try {
                FEntityManager::getInstance()->getDb()->beginTransaction();
                foreach($fieldArray as $fv) {
                    FEntityManager::getInstance()->updateObj(FLiftStructure::getTable(), $fv[0], $fv[1], self::getKey(), $obj->getIdLift());
                }
                FEntityManager::getInstance()->getDb()->commit();
                return true;
            } catch(PDOException $e) {
                error_log("Database error in FCreditCard saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally {
                FEntityManager::getInstance()->closeConnection();
            }
        }
    }

    /**
     * Method to create an object or a set of object from a query
     * @param array $queryResult Refers to the result of a query
     * @return array of objects 
     */
    public static function createLiftStructureObj(array $queryResult) : array{
        if(count($queryResult) == 1){
            $liftA = [];
            $lift = new ELiftStructure($queryResult[0]['name'], $queryResult[0]['type'], $queryResult[0]['status'], $queryResult[0]['seats']);
            $lift->setIdLift($queryResult[0]['idLiftStructure']);
            $lift->setIdSkiFacility($queryResult[0]['idSkiFacility']);
            $liftA[] = $lift;
            return $liftA;
        }elseif(count($queryResult) > 1){
            $lifts = [];
            for($i = 0; $i < count($queryResult); $i++){
                $lift = new ELiftStructure($queryResult[$i]['name'], $queryResult[$i]['type'], $queryResult[$i]['status'], $queryResult[$i]['seats']);
                $lift->setIdLift($queryResult[$i]['idLiftStructure']);
                $lift->setIdSkiFacility($queryResult[$i]['idSkiFacility']);
                $lifts[] = $lift;
            }
            return $lifts;
        }else{
            return [];
        }
    }

    /**
     * Method to get a lift structure object using the id of the ski facility that it refers to
     * @param string $idSkiFacility id of the ski facility
     * @return array $result
     */
    public static function getLiftStructures(string $idSkiFacility) : array{
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getExtKey(), $idSkiFacility);
        return $result;
    }

    /**
     * Method to get the number of the lift structures of a ski facility using the id 
     * @param string $idSkiFacility id of the ski facility
     * @return int number of lift structures
     */
    public static function getNLiftStructures(string $idSkiFacility) : int{
        $result = FEntityManager::getInstance()->countObjId(self::getTable(), self::getExtKey(), $idSkiFacility);
        return $result;
    }

    /**
     * Method to verify if a lift structure exist using its name and the id of the ski facility that it refers to
     * @param string $name name of the lift structure
     * @param string $idSkiFacility id of the ski facility
     * @return bool true if exist false if not exist
     */
    public static function getLiftStructureByNameAndSkiFacility(string $name, string $idSkiFacility) : bool{
        $fields = [['name', $name], [self::getExtKey(), $idSkiFacility]];
        $queryResult = FEntityManager::getInstance()->retriveObjNFields(self::getTable(), $fields);
        return FEntityManager::getInstance()->existInDb($queryResult);
    }

    /**
     * Method to get all the lift structure
     * @return array 
     */
    public static function getAllLiftStructureObj() : array{
        $result = FEntityManager::getInstance()->retriveAllObj(FLiftStructure::getTable());
        return $result;
    }

    /**
     * Method to get a lift structure using the id
     * @param string id of the lift structure
     * @return array 
     */
    public static function getLiftStructureById(string $id) : array{
        $result = FEntityManager::getInstance()->retriveObj(FLiftStructure::getTable(), 'idLiftStructure', $id);
        return $result;
    }

    /**
     * Method to get a lift structure using a field and a value passed in the where condition
     * @param string id of the lift structure
     * @return array 
     */
    public static function getLiftStructureByNameForSearch(string $nameLiftStructure) :array{
        $conditions = [['name' , $nameLiftStructure]];
        $queryResult = FEntityManager::getInstance()->retriveObjForSearch(self::getTable(), $conditions);
        return $queryResult;
    }

    public static function typeAndNumberLiftStructure(string $idSkiFacility) : array{
        $result = FEntityManager::getInstance()->typeAndNumber(self::getTable(), self::getExtKey(), $idSkiFacility);
        return $result;
    }

    
}

?>