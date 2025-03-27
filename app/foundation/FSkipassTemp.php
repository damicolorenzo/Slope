<?php

require_once("FEntityManager.php");

class FSkipassTemp {

    private static $table = "skipassTemp";
    private static $value = "(NULL, :description, :period, :type)";
    private static $key = "idSkipassTemp";

    public static function getTable() {return self::$table;}
    public static function getValue() {return self::$value;}
    public static function getClass() {return self::class;}
    public static function getKey() {return self::$key;}

    /**
     * Method to get an object using the id, invoke the createAdminObj function 
     * @param string $id Refers to the id
     * @return array 
     */
    public static function getObj(string $id) : array{
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);

        if(count($result) > 0){
            $price = self::createSkipassTempObj($result);
            return $price;
        }else{
            return [];
        }
    }

    /**
     * Binds the values of a person object to a prepared SQL statement.
     * @param object $stmt The PDO statement object used for query execution.
     * @param ESkipassTemplate $skipass An object representing a skipass template object
     * @return void
     */
    public static function bind(object $stmt, ESkipassTemplate $skipass) {
        $stmt->bindValue(":description", $skipass->getDescription(), PDO::PARAM_STR);
        $stmt->bindValue(":period", $skipass->getPeriod(), PDO::PARAM_INT);
        $stmt->bindValue(":type", $skipass->getType(), PDO::PARAM_STR);
    }

    /**
     * Method to get all skipass objects 
     * @return array 
     */
    public static function getSkipassTempObjs() : array{
        $result = FEntityManager::getInstance()->retriveAllObj(self::getTable());
        return $result;
    }

    /**
     * Method to create an object or a set of object from a query
     * @param array $queryResult Refers to the result of a query
     * @return array of objects 
     */
    public static function createSkipassTempObj($queryResult) : array{
        if(count($queryResult) == 1){
            $skipassA = [];
            $skipass = new ESkipassTemplate($queryResult[0]['description'], $queryResult[0]['period'], $queryResult[0]['type']);
            $skipass->setIdSkipassTemplate($queryResult[0]['idSkipassTemp']);
            $skipassA[] = $skipass;
            return $skipassA;
        }elseif(count($queryResult) > 1){
            $skipassObjs = [];
            for($i = 0; $i < count($queryResult); $i++){
                $skipass = new ESkipassTemplate($queryResult[$i]['description'], $queryResult[$i]['period'], $queryResult[$i]['type']);
                $skipass->setIdSkipassTemplate($queryResult[$i]['idSkipassTemp']);
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
                error_log("Database error in FSkipassTemp saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally {
                FEntityManager::getInstance()->closeConnection();
            }
        } else {
            try {
                FEntityManager::getInstance()->getDb()->beginTransaction();
                foreach($fieldArray as $fv) {
                    FEntityManager::getInstance()->updateObj(self::getTable(), $fv[0], $fv[1], self::getKey(), $obj->getIdSkipassObj());
                }
                FEntityManager::getInstance()->getDb()->commit();
                return true;
            } catch(PDOException $e) {
                error_log("Database error in FSkipassTemp saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally {
                FEntityManager::getInstance()->closeConnection();
            }
        }
    }

    /**
     * Method to get alll the skipass objects
     * @return array 
     */
    public static function getAllSkipassTempObjs() : array{
        $queryResult = FEntityManager::getInstance()->retriveAllObj(self::getTable());
        return $queryResult;
    }

    /**
     * Method to get a skipass object using the id 
     * @param string $id id of the skipass object
     * @return array 
     */
    public static function getSkipassTempObjFromId(string $id) : array{
        $queryResult = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        return $queryResult;
    }

    /**
     * Method to get a skipass object using some fields
     * @param array $fields some fields and value
     * @return array 
     */
    public static function getSkipassTempObjFromFields(array $fields) : array{
        $queryResult = FEntityManager::getInstance()->retriveObjNFields(self::getTable(), $fields);
        return $queryResult;
    }

    /**
     * Method to get the type of a skipass object using the id 
     * @param string $id id of the skipass object
     * @return array 
     */
    public static function getTypeSkipassObj(string $idSkipassObj) : array{
        $result = FEntityManager::getInstance()->selectObjKey('type', FSkipassObj::getTable(), FSkipassObj::getKey(), $idSkipassObj);
        return $result;
    }

}

?>