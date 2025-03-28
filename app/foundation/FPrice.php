<?php

require_once("FEntityManager.php");

class FPrice {

    private static $table = "price";
    private static $value = "(NULL, :description, :value, :idExternalObj, :extObjClass)";
    private static $key = "idPrice";
    private static $extKey1 = "idExternalObj";

    public static function getTable() {return self::$table;}
    public static function getValue() {return self::$value;}
    public static function getClass() {return self::class;}
    public static function getKey() {return self::$key;}
    public static function getExtKey1() {return self::$extKey1;}

    /**
     * Method to get an object using the id of the ski facility and the id of the skipass object
     * @param string $id1 id of the ski facility
     * @param string $id2 id of the skipass object
     * @return array 
     */
    public static function getObj(string $id) : array{
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);

        if(count($result) > 0){
            $price = self::createPriceObj($result);
            return $price;
        }else{
            return [];
        }
    }

    /**
     * Binds the values of a price object to a prepared SQL statement.
     * @param object $stmt The PDO statement object used for query execution.
     * @param EPrice $price An object representing a price
     * @return void
     */
    public static function bind(object $stmt, EPrice $price, ) {
        $stmt->bindValue(":description", $price->getDescription(), PDO::PARAM_STR);
        $stmt->bindValue(":value", $price->getValue(), PDO::PARAM_INT);
        $stmt->bindValue(":idExternalObj", $price->getIdExternalObj(), PDO::PARAM_INT);
        $stmt->bindValue(":extObjClass", $price->getExtObjClass(), PDO::PARAM_STR);
    }

    /**
     * Method to get all the prices
     * @return array 
     */
    public static function getPrices() : array{
        $result = FEntityManager::getInstance()->retriveAllObj(self::getTable());
        return $result;
    }

    /**
     * Method to create an object or a set of object from a query
     * @param array $queryResult Refers to the result of a query
     * @return array of objects 
     */
    public static function createPriceObj(array $queryResult) : array{
        if(count($queryResult) == 1){
            $priceA = [];
            $price = new EPrice($queryResult[0]['description'], $queryResult[0]['value']);
            $price->setIdPrice($queryResult[0]['idPrice']);
            $price->setIdExternalObj($queryResult[0]['idExternalObj']);
            $price->setExtObjClass($queryResult[0]['extObjClass']);
            $priceA[] = $price;
            return $priceA;
        }elseif(count($queryResult) > 1){
            $prices = [];
            for($i = 0; $i < count($queryResult); $i++){
                $price = new EPrice($queryResult[$i]['description'], $queryResult[$i]['value']);
                $price->setIdPrice($queryResult[$i]['idPrice']);
                $price->setIdExternalObj($queryResult[$i]['idExternalObj']);
                $price->setExtObjClass($queryResult[$i]['extObjClass']);
                $prices[] = $price;
            }
            return $prices;
        }else{
            return [];
        }
    }

    /**
     * Method to save an object in the database using the proper FEntityManager function
     * @param EPrice $obj Refers to a price Entity object that needs to be stored in the database
     * @param array $fieldArray Refers to an array of fields and values
     * @return bool true if succeded and false if failed
     */
    public static function saveObj(EPrice $obj, ?array $fieldArray = null) : bool{
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
                error_log("Database error in FPrice saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally {
                FEntityManager::getInstance()->closeConnection();
            }
        } else {
            try {
                FEntityManager::getInstance()->getDb()->beginTransaction();
                foreach($fieldArray as $fv) {
                    FEntityManager::getInstance()->updateObj(FPrice::getTable(), $fv[0], $fv[1], self::getKey(), $obj->getIdPrice());
                }
                FEntityManager::getInstance()->getDb()->commit();
                return true;
            } catch(PDOException $e) {
                error_log("Database error in FPrice saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally {
                FEntityManager::getInstance()->closeConnection();
            }
        }
    }

    public static function getPriceFromId($id) {
        $queryResult = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        return $queryResult;
    }

    public static function verifyPriceByDescriptionAndSkiFacility($description, $idSkiFacility) {
        $queryResult = FEntityManager::getInstance()->retriveObj2(self::getTable(), 'description', $description, self::getExtKey(), $idSkiFacility);
        return FEntityManager::getInstance()->existInDb($queryResult);
    }

    public static function getPriceByDescriptionAndSkiFacility($description, $idSkiFacility) {
        $queryResult = FEntityManager::getInstance()->retriveObj2(self::getTable(), 'description', $description, self::getExtKey(), $idSkiFacility);
        return $queryResult;
    }

    public static function verify($field1, $id1, $field2, $id2){
        $queryResult = FEntityManager::getInstance()->retriveObj2(self::getTable(), $field1, $id1, $field2, $id2);
        return FEntityManager::getInstance()->existInDb($queryResult);
    }

}

?>