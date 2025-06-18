<?php

require_once("FEntityManager.php");

class FInsuranceTemp {

    private static $table = "insuranceTemp";
    private static $value = "(NULL, :type, :value)";
    private static $key = "idInsuranceTemp";

    public static function getTable() {return self::$table;}
    public static function getValue() {return self::$value;}
    public static function getClass() {return self::class;}
    public static function getKey() {return self::$key;}

    /**
     * Method to get an object using the id
     * @param string $id Refers to the id
     * @return array 
     */
    public static function getObj(string $id) : array{
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);

        if(count($result) > 0){
            $price = self::createInsuranceTempObj($result);
            return $price;
        }else{
            return [];
        }
    }

    /**
     * Binds the values of a insurance object to a prepared SQL statement.
     * @param object $stmt The PDO statement object used for query execution.
     * @param EInsuranceTemp $skipass An object representing a skipass template object
     * @return void
     */
    public static function bind(object $stmt, EInsuranceTemp $insurance) {
        $stmt->bindValue(":type", $insurance->getType(), PDO::PARAM_STR);
        $stmt->bindValue(":value", $insurance->getValue(), PDO::PARAM_INT);
    }

    /**
     * Method to get all skipass objects 
     * @return array 
     */
    public static function getInsuranceTempObjs() : array{
        $result = FEntityManager::getInstance()->retriveAllObj(self::getTable());
        return $result;
    }

    /**
     * Method to create an object or a set of object from a query
     * @param array $queryResult Refers to the result of a query
     * @return array of objects 
     */
    public static function createInsuranceTempObj(array $queryResult) : array{
        if(count($queryResult) == 1){
            $insuranceA = [];
            $insurance = new EInsuranceTemp($queryResult[0]['type'], $queryResult[0]['value']);
            $insurance->setIdInsuranceTemp($queryResult[0]['idInsuranceTemp']);
            $insuranceA[] = $insurance;
            return $insuranceA;
        }elseif(count($queryResult) > 1){
            $insuranceObjs = [];
            for($i = 0; $i < count($queryResult); $i++){
                $insurance = new EInsuranceTemp($queryResult[$i]['type'], $queryResult[$i]['value']);
                $insurance->setIdInsuranceTemp($queryResult[$i]['idInsuranceTemp']);
                $insuranceObjs[] = $insurance;
            }
            return $insuranceObjs;
        }else{
            return [];
        }
    }

    /**
     * Method to save an object in the database using the proper FEntityManager function
     * @param EInsuranceTemp $obj Refers to a lift structure Entity object that needs to be stored in the database
     * @param array $fieldArray Refers to an array of fields and values
     * @return bool true if succeded and false if failed
     */
    public static function saveObj(EInsuranceTemp $obj, ?array $fieldArray = null) : bool{
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
                error_log("Database error in FInsuranceTemp saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally {
                FEntityManager::getInstance()->closeConnection();
            }
        } else {
            try {
                FEntityManager::getInstance()->getDb()->beginTransaction();
                foreach($fieldArray as $fv) {
                    FEntityManager::getInstance()->updateObj(self::getTable(), $fv[0], $fv[1], self::getKey(), $obj->getIdInsuranceTemp());
                }
                FEntityManager::getInstance()->getDb()->commit();
                return true;
            } catch(PDOException $e) {
                error_log("Database error in FInsuranceTemp saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally {
                FEntityManager::getInstance()->closeConnection();
            }
        }
    }

    /**
     * Method to get all the insurance objects
     * @return array 
     */
    public static function getAllInsuranceTempObjs() : array{
        $queryResult = FEntityManager::getInstance()->retriveAllObj(self::getTable());
        return $queryResult;
    }

    /**
     * Method to get a insurance object using the id 
     * @param string $id id of the skipass object
     * @return array 
     */
    public static function getInsuranceTempObjFromId(string $id) : array{
        $queryResult = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        return $queryResult;
    }

    /**
     * Method to get a insurance object using the type 
     * @param string $id id of the skipass object
     * @return array 
     */
    public static function getInsuranceTempObjFromType(string $type) : array{
        $field = [['type', $type]];
        $queryResult = FEntityManager::getInstance()->retriveObjNFields(self::getTable(), $field);
        return $queryResult;
    }

    /**
     * Method to get a skipass object using some fields
     * @param array $fields some fields and value
     * @return array 
     */
    public static function getInsuranceTempObjFromFields(array $fields) : array{
        $queryResult = FEntityManager::getInstance()->retriveObjNFields(self::getTable(), $fields);
        return $queryResult;
    }

    /**
     * Method to get the type of a skipass object using the id 
     * @param string $id id of the skipass object
     * @return array 
     */
    public static function getTypeInsuranceTempObj(string $idSkipassObj) : array{
        $result = FEntityManager::getInstance()->selectObjKey('type', self::getTable(), self::getKey(), $idSkipassObj);
        return $result;
    }

    public static function getInsuranceTempObjFromFieldsForSearch(array $fields) : array{
        $queryResult = FEntityManager::getInstance()->retriveObjForSearchAND(self::getTable(), $fields);
        return $queryResult;
    }

}

?>