<?php

require_once("FEntityManager.php");

class FSubscriptionTemp {

    private static $table = "subscriptionTemp";
    private static $value = "(NULL, :description, :value, :discount)";
    private static $key = "idSubscriptionTemp";

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
            $price = self::createSubscriptionTempObj($result);
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
    public static function bind(object $stmt, ESubscriptionTemp $subscription) {
        $stmt->bindValue(":description", $subscription->getDescription(), PDO::PARAM_STR);
        $stmt->bindValue(":value", $subscription->getValue(), PDO::PARAM_INT);
        $stmt->bindValue(":discount", $subscription->getDiscount(), PDO::PARAM_INT);
    }

    /**
     * Method to get all skipass objects 
     * @return array 
     */
    public static function getSubscriptionTempObjs() : array{
        $result = FEntityManager::getInstance()->retriveAllObj(self::getTable());
        return $result;
    }

    /**
     * Method to create an object or a set of object from a query
     * @param array $queryResult Refers to the result of a query
     * @return array of objects 
     */
    public static function createSubscriptionTempObj(array $queryResult) : array{
        if(count($queryResult) == 1){
            $subscriptionA = [];
            $subscription = new ESubscriptionTemp($queryResult[0]['description'], $queryResult[0]['value'], $queryResult[0]['discount']);
            $subscription->setIdSubscriptionTemp($queryResult[0]['idSubscriptionTemp']);
            $subscriptionA[] = $subscription;
            return $subscriptionA;
        }elseif(count($queryResult) > 1){
            $subscriptionObjs = [];
            for($i = 0; $i < count($queryResult); $i++){
                $subscription = new ESubscriptionTemp($queryResult[$i]['description'], $queryResult[$i]['value'], $queryResult[$i]['discount']);
                $subscription->setIdSubscriptionTemp($queryResult[$i]['idSubscriptionTemp']);
                $subscriptionObjs[] = $subscription;
            }
            return $subscriptionObjs;
        }else{
            return [];
        }
    }

    /**
     * Method to save an object in the database using the proper FEntityManager function
     * @param ESubscriptionTemp $obj Refers to a lift structure Entity object that needs to be stored in the database
     * @param array $fieldArray Refers to an array of fields and values
     * @return bool true if succeded and false if failed
     */
    public static function saveObj(ESubscriptionTemp $obj, ?array $fieldArray = null) : bool{
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
                error_log("Database error in FSubscriptionTemp saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally {
                FEntityManager::getInstance()->closeConnection();
            }
        } else {
            try {
                FEntityManager::getInstance()->getDb()->beginTransaction();
                foreach($fieldArray as $fv) {
                    FEntityManager::getInstance()->updateObj(self::getTable(), $fv[0], $fv[1], self::getKey(), $obj->getIdSubscriptionTemp());
                }
                FEntityManager::getInstance()->getDb()->commit();
                return true;
            } catch(PDOException $e) {
                error_log("Database error in FSubscriptionTemp saveObj: " . $e->getMessage());
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
    public static function getAllSubscriptionTempObjs() : array{
        $queryResult = FEntityManager::getInstance()->retriveAllObj(self::getTable());
        return $queryResult;
    }

    /**
     * Method to get a insurance object using the id 
     * @param string $id id of the skipass object
     * @return array 
     */
    public static function getSubscriptionTempFromId(string $id) : array{
        $queryResult = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        return $queryResult;
    }


    public static function getSubscriptionTempObjFromFieldsForSearch(array $fields) : array{
        $queryResult = FEntityManager::getInstance()->retriveObjForSearchAND(self::getTable(), $fields);
        return $queryResult;
    }

    public static function verify(string $description, float $value, float $discount){
        $conditions = [['description', $description], ['value', $value], ['discount', $discount]];
        $queryResult = FEntityManager::getInstance()->retriveObjNFields(self::getTable(), $conditions);
        return FEntityManager::getInstance()->existInDb($queryResult);
    }

}

?>