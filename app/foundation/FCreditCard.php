<?php

require_once("FEntityManager.php");

class FCreditCard{

    private static $table = "creditCard";
    private static $value = "(NULL, :cardHolderName, :cardHolderSurname, :expiryDate, :cardNumber, :cvv, :idUser)";
    private static $key = "idCreditCard";
    private static $extKey = "idUser";


    public static function getTable(){
        return self::$table;
    }

    public static function getValue(){
        return self::$value;
    }

    public static function getKey(){
        return self::$key;
    }

    public static function getClass(){
        return self::class;
    }

    public static function getExtKey(){
        return self::$extKey;
    }

    /**
     * Binds the values of a credit card object to a prepared SQL statement.
     * @param object $stmt The PDO statement object used for query execution.
     * @param ECreditCard $creditCard An object representing a credit card.
     * @return void
     */
    public static function bind(object $stmt, ECreditCard $creditCard) : void{
        $stmt->bindValue(":cardHolderName", $creditCard->getCardHolderName(), PDO::PARAM_STR);
        $stmt->bindValue(":cardHolderSurname", $creditCard->getCardHolderSurname(), PDO::PARAM_STR);
        $stmt->bindValue(":expiryDate", $creditCard->getExpiryDate(), PDO::PARAM_STR);
        $stmt->bindValue(":cardNumber", $creditCard->getCardNumber(), PDO::PARAM_STR);
        $stmt->bindValue(":cvv", $creditCard->getCvv(), PDO::PARAM_INT);
        $stmt->bindValue(":idUser", $creditCard->getIdUser(), PDO::PARAM_INT);
    }

    /**
     * Method to create an object or a set of object from a query
     * @param array $queryResult Refers to the result of a query
     * @return array of objects
     */
    public static function createCreditCardObj(array $queryResult) : array{
        $creditCardA = [];
        $creditCard = new ECreditCard($queryResult[0]['cardHolderName'], $queryResult[0]['cardHolderSurname'], $queryResult[0]['expiryDate'], $queryResult[0]['cardNumber'], $queryResult[0]['cvv']);
        $creditCard->setIdCreditCard($queryResult[0]['idCreditCard']);
        $creditCard->setIdUser($queryResult[0]['idUser']);
        $creditCardA[] = $creditCard;
        return $creditCardA;
    }

    /**
     * Method to get an object using the id, invoke the createCreditCardObj function 
     * @param string $id Refers to the id
     * @return array 
     */
    public static function getObj(string $id) : array{
        $result = FEntityManager :: getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        if (count($result) > 0){
            $creditCard = self:: createCreditCardObj($result);
            return $creditCard;
        }
        else{
            return [];
        }
    }

    /**
     * Method to save an object in the database using the proper FEntityManager function
     * @param ECreditCard $obj Refers to a credit card Entity object that needs to be stored in the database
     * @param array $obj Refers to an array of fields and values
     * @return bool true if succeded and false if failed
     */
    public static function saveObj(ECreditCard $obj, ?array $fieldArray = null) : bool{
        if($fieldArray === null) {
            try {
                FEntityManager::getInstance()->getDb()->beginTransaction();
                $saveCreditCard = FEntityManager::getInstance()->saveObject(self::getClass(), $obj);
                if($saveCreditCard !== null) {
                    FEntityManager::getInstance()->getDb()->commit();
                    return $saveCreditCard;
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
                    FEntityManager::getInstance()->updateObj(FCreditCard::getTable(), $fv[0], $fv[1], self::getKey(), $obj->getIdCreditCard());
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
     * Method to verify if a credit card exist in the database using the user id
     * @param string $userId user id 
     * @return bool
     */
    public static function verifyCreditCardByUserId(string $userId) : bool {
        $queryResult = FEntityManager::getInstance()->retriveObj(self::getTable(), 'idUser', $userId);
        return FEntityManager::getInstance()->existInDb($queryResult);
    }

    /**
     * Method to get a credit card using the user id
     * @param string $userId user id 
     * @return array $queryResult
     */
    public static function getCreditCardByUserId(string $userId) : array{
        $queryResult = FEntityManager::getInstance()->retriveObj(self::getTable(), 'idUser', $userId);
        return $queryResult;
    }

    /**
     * Method to get a credit card using some fields
     * @param array $fields array of fields and values
     * @return array $queryResult
     */
    public static function getCreditCard(array $fields) : array{
        $queryResult = FEntityManager::getInstance()->retriveObjNFields(self::getTable(), $fields);
        return $queryResult;
    }

}


?>