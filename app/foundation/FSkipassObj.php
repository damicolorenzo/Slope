<?php

require_once("FEntityManager.php");

class FSkipassObj {

    private static $table = "skipassObj";
    private static $value = "(NULL, :description, :value, :idSkiFacility, :idSkipassTemp)";
    private static $key = "idSkipassObj";
    private static $extKey1 = "idSkiFacility";
    private static $extKey2 = "idSkipassTemp";

    public static function getTable() {return self::$table;}
    public static function getValue() {return self::$value;}
    public static function getClass() {return self::class;}
    public static function getKey() {return self::$key;}
    public static function getExtKey1() {return self::$extKey1;}
    public static function getExtKey2() {return self::$extKey2;}

    /**
     * Method to get an object using the id, invoke the createAdminObj function 
     * @param string $id Refers to the id
     * @return array 
     */
    public static function getObj(string $id) : array{
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);

        if(count($result) > 0){
            $price = self::createSkipassObjObj($result);
            return $price;
        }else{
            return [];
        }
    }

    /**
     * Binds the values of a person object to a prepared SQL statement.
     * @param object $stmt The PDO statement object used for query execution.
     * @param ESkipassObj $skipass An object representing a skipass object
     * @return void
     */
    public static function bind(object $stmt, ESkipassObj $skipass) {
        $stmt->bindValue(":description", $skipass->getDescription(), PDO::PARAM_STR);
        $stmt->bindValue(":value", $skipass->getValue(), PDO::PARAM_INT);
        $stmt->bindValue(":idSkiFacility", $skipass->getIdSkiFacility(), PDO::PARAM_INT);
        $stmt->bindValue(":idSkipassTemp", $skipass->getIdSkipassTemp(), PDO::PARAM_INT);
    }

    /**
     * Method to get all skipass objects 
     * @return array 
     */
    public static function getSkipassObjs() : array{
        $result = FEntityManager::getInstance()->retriveAllObj(self::getTable());
        return $result;
    }

    /**
     * Method to create an object or a set of object from a query
     * @param array $queryResult Refers to the result of a query
     * @return array of objects 
     */
    public static function createSkipassObjObj($queryResult) : array{
        if(count($queryResult) == 1){
            $skipassA = [];
            $skipass = new ESkipassObj($queryResult[0]['description'], $queryResult[0]['value']);
            $skipass->setIdSkipassObj($queryResult[0]['idSkipassObj']);
            $skipass->setIdSkiFacility($queryResult[0]['idSkiFacility']);
            $skipass->setIdSkipassTemp($queryResult[0]['idSkipassTemp']);
            $skipassA[] = $skipass;
            return $skipassA;
        }elseif(count($queryResult) > 1){
            $skipassObjs = [];
            for($i = 0; $i < count($queryResult); $i++){
                $skipass = new ESkipassObj($queryResult[$i]['description'], $queryResult[$i]['value']);
                $skipass->setIdSkipassObj($queryResult[$i]['idSkipassObj']);
                $skipass->setIdSkiFacility($queryResult[$i]['idSkiFacility']);
                $skipass->setIdSkipassTemp($queryResult[$i]['idSkipassTemp']);
                $skipassObjs[] = $skipass;
            }
            return $skipassObjs;
        }else{
            return [];
        }
    }

    /**
     * Method to save an object in the database using the proper FEntityManager function
     * @param ESkipassObj $obj Refers to a lift structure Entity object that needs to be stored in the database
     * @param array $fieldArray Refers to an array of fields and values
     * @return bool true if succeded and false if failed
     */
    public static function saveObj(ESkipassObj $obj, ?array $fieldArray = null) : bool{
        if($fieldArray === null) {
            try {
                FEntityManager::getInstance()->getDb()->beginTransaction();
                $savePrice = FEntityManager::getInstance()->saveObject(self::getClass(), $obj);
                if($savePrice !== null) {
                    FEntityManager::getInstance()->getDb()->commit();
                    return true;
                } else {
                    return false;
                }
            } catch(PDOException $e) {
                error_log("Database error in FSkipassObj saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally {
                FEntityManager::getInstance()->closeConnection();
            }
        } else {
            try {
                FEntityManager::getInstance()->getDb()->beginTransaction();
                foreach($fieldArray as $fv) {
                    FEntityManager::getInstance()->updateObj(FSkipassObj::getTable(), $fv[0], $fv[1], self::getKey(), $obj->getIdSkipassObj());
                }
                FEntityManager::getInstance()->getDb()->commit();
                return true;
            } catch(PDOException $e) {
                error_log("Database error in FSkipassObj saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally {
                FEntityManager::getInstance()->closeConnection();
            }
        }
    }

    /**
     * Method to get all the skipass objects
     * @return array 
     */
    public static function getAllSkipassObjs() : array{
        $queryResult = FEntityManager::getInstance()->retriveAllObj(self::getTable());
        return $queryResult;
    }

    /**
     * Method to get skipass objects on ski facility id
     * @return array 
     */
    public static function getSkipassObjOnSkiFacility(string $idSkiFacility) : array{
        $queryResult = FEntityManager::getInstance()->retriveObj(self::getTable(), self::$extKey1, $idSkiFacility);
        return $queryResult;
    }

    /**
     * Method to get a skipass object using the id 
     * @param string $id id of the skipass object
     * @return array 
     */
    public static function getSkipassObjFromId(string $id) : array{
        $queryResult = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        return $queryResult;
    }

    /**
     * Method to get a skipass object using some fields
     * @param array $fields some fields and value
     * @return array 
     */
    public static function getSkipassObjFromFields(array $fields) : array{
        $queryResult = FEntityManager::getInstance()->retriveObjNFields(self::getTable(), $fields);
        return $queryResult;
    }

    public static function getSkipassObjFromFieldsForSearch(array $fields) : array{
        $queryResult = FEntityManager::getInstance()->retriveObjForSearchAND(self::getTable(), $fields);
        return $queryResult;
    }

    /**
     * Method to get the type of a skipass object using the id 
     * @param string $id id of the skipass object
     * @return array 
     */
    public static function getValueSkipassObj(string $idSkipassObj) : array{
        $result = FEntityManager::getInstance()->selectObjKey('value', FSkipassObj::getTable(), FSkipassObj::getKey(), $idSkipassObj);
        return $result;
    }

    public static function verify(string $description, int $idSkiFacility, int $idSkipassTemp){
        $conditions = [['description', $description], ['idSkiFacility', $idSkiFacility], ['idSkipassTemp', $idSkipassTemp]];
        $queryResult = FEntityManager::getInstance()->retriveObjNFields(self::getTable(), $conditions);
        return FEntityManager::getInstance()->existInDb($queryResult);
    }

}

?>