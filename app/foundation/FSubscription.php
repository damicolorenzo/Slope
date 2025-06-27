<?php

require_once("FEntityManager.php");

class FSubscription {

    private static $table = "subscription";
    private static $value = "(NULL, :name, :surname, :email, :startDate, :endDate, :idUser, :idSubscriptionTemp)";
    private static $key = "idSubscription";
    private static $extKey1 = "idUser";
    private static $extKey2 = "idSubscriptionTemp";

    public static function getTable() {return self::$table;}
    public static function getValue() {return self::$value;}
    public static function getClass() {return self::class;}
    public static function getKey() {return self::$key;}
    public static function getExtKey1(){return self::$extKey1;}
    public static function getExtKey2(){return self::$extKey2;}
    /**
     * Method to get an object using the id
     * @param string $id Refers to the id
     * @return array 
     */
    public static function getObj(string $id) : array{
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);

        if(count($result) > 0){
            $price = self::createSubscriptionObj($result);
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
    public static function bind(object $stmt, ESubscription $subscription) {
        $stmt->bindValue(":name", $subscription->getName(), PDO::PARAM_STR);
        $stmt->bindValue(":surname", $subscription->getSurname(), PDO::PARAM_STR);
        $stmt->bindValue(":email", $subscription->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(":startDate", $subscription->getStartDate(), PDO::PARAM_STR);
        $stmt->bindValue(":endDate", $subscription->getEndDate(), PDO::PARAM_STR);
        $stmt->bindValue(":idUser", $subscription->getIdUser(), PDO::PARAM_INT);
        $stmt->bindValue(":idSubscriptionTemp", $subscription->getIdSubscriptionTemp(), PDO::PARAM_INT);
    }

    /**
     * Method to get all skipass objects 
     * @return array 
     */
    public static function getSubscriptionObjs() : array{
        $result = FEntityManager::getInstance()->retriveAllObj(self::getTable());
        return $result;
    }

    /**
     * Method to create an object or a set of object from a query
     * @param array $queryResult Refers to the result of a query
     * @return array of objects 
     */
    public static function createSubscriptionObj(array $queryResult) : array{
        if(count($queryResult) == 1){
            $subscriptionA = [];
            $subscription = new ESubscription($queryResult[0]['name'], $queryResult[0]['surname'], $queryResult[0]['email'], $queryResult[0]['startDate'], $queryResult[0]['endDate']);
            $subscription->setIdSubscription($queryResult[0]['idSubscription']);
            $subscription->setIdUser($queryResult[0]['idUser']);
            $subscription->setIdSubscriptionTemp($queryResult[0]['idSubscriptionTemp']);
            $subscriptionA[] = $subscription;
            return $subscriptionA;
        }elseif(count($queryResult) > 1){
            $subscriptionObjs = [];
            for($i = 0; $i < count($queryResult); $i++){
                $subscription = new ESubscription($queryResult[$i]['name'], $queryResult[$i]['surname'], $queryResult[$i]['email'], $queryResult[$i]['startDate'], $queryResult[$i]['endDate']);
                $subscription->setIdSubscription($queryResult[$i]['idSubscription']);
                $subscription->setIdUser($queryResult[$i]['idUser']);
                $subscription->setIdSubscriptionTemp($queryResult[$i]['idSubscriptionTemp']);
                $subscriptionA[] = $subscription;
            }
            return $subscriptionObjs;
        }else{
            return [];
        }
    }

    /**
     * Method to save an object in the database using the proper FEntityManager function
     * @param ESubscription $obj Refers to a lift structure Entity object that needs to be stored in the database
     * @param array $fieldArray Refers to an array of fields and values
     * @return bool true if succeded and false if failed
     */
    public static function saveObj(ESubscription $obj, ?array $fieldArray = null) : bool{
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
                error_log("Database error in FSubscription saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally {
                FEntityManager::getInstance()->closeConnection();
            }
        } else {
            try {
                FEntityManager::getInstance()->getDb()->beginTransaction();
                foreach($fieldArray as $fv) {
                    FEntityManager::getInstance()->updateObj(self::getTable(), $fv[0], $fv[1], self::getKey(), $obj->getIdSubscription());
                }
                FEntityManager::getInstance()->getDb()->commit();
                return true;
            } catch(PDOException $e) {
                error_log("Database error in FSubscription saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally {
                FEntityManager::getInstance()->closeConnection();
            }
        }
    }


    public static function getSubscription(array $fields) : array{
        $queryResult = FEntityManager::getInstance()->retriveObjNFields(self::getTable(), $fields);
        return $queryResult;
    }
    /**
     * Method to get all the insurance objects
     * @return array 
     */
    public static function getAllSubscriptionObjs() : array{
        $queryResult = FEntityManager::getInstance()->retriveAllObj(self::getTable());
        return $queryResult;
    }

    /**
     * Method to get a insurance object using the id 
     * @param string $id id of the skipass object
     * @return array 
     */
    public static function getSubscriptionFromId(string $id) : array{
        $queryResult = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        return $queryResult;
    }

    public static function getSubscriptionFromUserId(string $userId) : array{
        $queryResult = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getExtKey1(), $userId);
        return $queryResult;
    }


    public static function getSubscriptionObjFromFieldsForSearch(array $fields) : array{
        $queryResult = FEntityManager::getInstance()->retriveObjForSearchAND(self::getTable(), $fields);
        return $queryResult;
    }

    public static function verify($field1, $id1){
        $queryResult = FEntityManager::getInstance()->retriveObj(self::getTable(), $field1, $id1);
        return FEntityManager::getInstance()->existInDb($queryResult);
    }

}

?>