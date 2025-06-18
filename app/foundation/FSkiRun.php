<?php

require_once("FEntityManager.php");

class FSkiRun {

    private static $table = "skirun";
    private static $value = "(NULL, :name, :type, :status, :idSkiFacility)";
    private static $key = "idSkiRun";
    private static $externalKey = "idSkiFacility";
    
    public static function getTable() {return self::$table;}
    public static function getValue() {return self::$value;}
    public static function getClass() {return self::class;}
    public static function getKey() {return self::$key;}
    public static function getExtKey() {return self::$externalKey;}

    public static function getObj($id) :array {
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        return $result;
    }

    /**
     * Binds the values of a person object to a prepared SQL statement.
     * @param object $stmt The PDO statement object used for query execution.
     * @param ESkiRun $skiRun An object representing a ski run
     * @return void
     */
    public static function bind($stmt, $skiRun){
        $stmt->bindValue(":name", $skiRun->getName(), PDO::PARAM_STR);
        $stmt->bindValue(":type", $skiRun->getType(), PDO::PARAM_STR);
        $stmt->bindValue(":status",$skiRun->getStatus(), PDO::PARAM_STR);
        $stmt->bindValue(":idSkiFacility",$skiRun->getIdSkiFacility(), PDO::PARAM_INT);
    }

    /**
     * Method to save an object in the database using the proper FEntityManager function
     * @param ESkiRun $obj Refers to a lift structure Entity object that needs to be stored in the database
     * @param array $fieldArray Refers to an array of fields and values
     * @return bool true if succeded and false if failed
     */
    public static function saveObj(ESkiRun $obj, ?array $fieldArray = null) : bool{
        if($fieldArray === null) {
            try {
                FEntityManager::getInstance()->getDb()->beginTransaction();
                $saveSkiRun = FEntityManager::getInstance()->saveObject(self::getClass(), $obj);
                if($saveSkiRun !== null) {
                    FEntityManager::getInstance()->getDb()->commit();
                    return true;
                } else {
                    return false;
                }
            } catch(PDOException $e) {
                error_log("Database error in FSkiRun saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally {
                FEntityManager::getInstance()->closeConnection();
            }
        } else {
            try {
                FEntityManager::getInstance()->getDb()->beginTransaction();
                foreach($fieldArray as $fv) {
                    FEntityManager::getInstance()->updateObj(FSkiRun::getTable(), $fv[0], $fv[1], self::getKey(), $obj->getIdSkiRun());
                }
                FEntityManager::getInstance()->getDb()->commit();
                return true;
            } catch(PDOException $e) {
                error_log("Database error in FSkiRun saveObj: " . $e->getMessage());
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
    public static function createSkiRunObj(array $queryResult) : array{
        if(count($queryResult) == 1){
            $skiRunA = [];
            $skiRun = new ESkiRun($queryResult[0]['name'], $queryResult[0]['type'], $queryResult[0]['status']);
            $skiRun->setIdSkiRun($queryResult[0]['idSkiRun']);
            $skiRun->setIdSkiFacility($queryResult[0]['idSkiFacility']);
            $skiRunA[] = $skiRun;
            return $skiRunA;
        }elseif(count($queryResult) > 1){
            $skiRuns = [];
            for($i = 0; $i < count($queryResult); $i++){
                $skiRun = new ESkiRun($queryResult[$i]['name'], $queryResult[$i]['type'], $queryResult[$i]['status']);
                $skiRun->setIdSkiRun($queryResult[$i]['idSkiRun']);
                $skiRun->setIdSkiFacility($queryResult[$i]['idSkiFacility']);
                $skiRuns[] = $skiRun;
            }
            return $skiRuns;
        }else{
            return [];
        }
    }

    public static function getSkiRunImages($id) {
        /* Da implementare */
        /* $result = FEntityManager::getInstance()->retriveObj(self::getTable(), FSkiRun::getKey(), $id);
        if(count($result) > 0) {
            $image = self::createImageObj($result);
            return $image;
        } else {
            return null;
        } */
    }

    public static function createImageObj($queryResult) {
        /* Da implementare */
        /* if(count($queryResult) > 0) {
            $images = array();
            for($i = 0; $i < count($queryResult); $i++) {

            }
            return $images;
        } else {
            return array();
        } */   
    }

    /**
     * Method to get a ski run object using the id of the ski facility that it refers to
     * @param string $idSkiFacility id of the ski facility
     * @return array $result
     */
    public static function getSkiRuns(string $idSkiFacility) : array{
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getExtKey(), $idSkiFacility);
        return $result;
    }

    /**
     * Method to get a ski run type and number of seats using the id of the ski facility that it refers to
     * @param string $idSkiFacility id of the ski facility
     * @return array $result
     */
    public static function typeAndNumberSkiRun(string $idSkiFacility) : array{
        $result = FEntityManager::getInstance()->typeAndNumber(self::getTable(), self::getExtKey(), $idSkiFacility);
        return $result;
    }

    /**
     * Method to get a ski run object using the name and the id of the ski facility that it refers to
     * @param string $name name of the ski facility
     * @param string $idSkiFacility id of the ski facility
     * @return bool
     */
    public static function getSkiRunByNameAndSkiFacility(string $name, string $idSkiFacility) : bool{
        $fields = [['name', $name], [self::getExtKey(), $idSkiFacility]]; 
        $queryResult = FEntityManager::getInstance()->retriveObjNFields(self::getTable(), $fields);
        return FEntityManager::getInstance()->existInDb($queryResult);
    }

    /**
     * Method to get all ski run object
     * @return array $result
     */
    public static function getAllSkiRunObj() : array{
        $result = FEntityManager::getInstance()->retriveAllObj(FSkiRun::getTable());
        return $result;
    }

    /**
     * Method to get a ski run object using the id 
     * @param string $id id of the ski run
     * @return array $result
     */
    public static function getSkiRunById(string $id) : array{
        $result = FEntityManager::getInstance()->retriveObj(FSkiRun::getTable(), 'idSkiRun', $id);
        return $result;
    }

    /**
     * Method to get a ski run object 
     * @param string $skiRunName 
     * @return array $result
     */
    public static function getSkiRunByNameForSearch(string $skiRunName) : array{
        if($skiRunName != "") {
            $conditions = [['name', $skiRunName]];
            $queryResult = FEntityManager::getInstance()->retriveObjForSearchAND(self::getTable(), $conditions);
        } else 
            return [];
        return $queryResult;
    }

    public static function getSkiRunByIdSkiFacility(int $idSkiFacility) : array {
        $conditions = [['idSkiFacility', $idSkiFacility]];
        $queryResult = FEntityManager::getInstance()->retriveObjNFields(self::getTable(), $conditions);
        return $queryResult;
    }
}

?>