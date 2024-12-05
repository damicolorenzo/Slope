<?php

require_once("FEntityManager.php");

class FCreditCard{

    private static $table = "creditCard";
    private static $value = "(NULL, :cardHolderName, :cardHolderSurname, :expiryDate, :cardNumber, :cvv, :idUser)";
    private static $key = "idCreditCard";


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

    public static function bind($stmt, $creditCard){
        $stmt->bindValue(":cardHolderName", $creditCard->getCardHolderName(), PDO::PARAM_STR);
        $stmt->bindValue(":cardHolderSurname", $creditCard->getCardHolderSurname(), PDO::PARAM_STR);
        $stmt->bindValue(":expiryDate", $creditCard->getExpiryDate(), PDO::PARAM_STR);
        $stmt->bindValue(":cardNumber", $creditCard->getCardNumber(), PDO::PARAM_STR);
        $stmt->bindValue(":cvv", $creditCard->getCvv(), PDO::PARAM_INT);
        $stmt->bindValue(":idUser", $creditCard->getIdUser(), PDO::PARAM_INT);
    }


    public static function createCreditCardObj($queryResult){
        $creditCard = new ECreditCard($queryResult[0]['cardHolderName'], $queryResult[0]['cardHolderSurname'], $queryResult[0]['expiryDate'], $queryResult[0]['cardNumber'], $queryResult[0]['cvv']);
        $creditCard->setIdCreditCard($queryResult[0]['idCreditCard']);
        $creditCard->setIdUser($queryResult[0]['idUser']);
        return $creditCard;
    }

    public static function getObj($id){
        $result = FEntityManager :: getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        if (count($result) > 0){
            $creditCard = self:: createCreditCardObj($result);
            return $creditCard;
        }
        else{
            return null;
        }
    }


    public static function saveObj($obj, $fieldArray = null) {
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
                echo "ERROR ".$e->getMessage();
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
                echo "ERROR ".$e->getMessage();
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally {
                FEntityManager::getInstance()->closeConnection();
            }
        }
    }

    public static function verifyCreditCardByUserId($userId) {
        $queryResult = FEntityManager::getInstance()->retriveObj(self::getTable(), 'idUser', $userId);
        return FEntityManager::getInstance()->existInDb($queryResult);
    }

    public static function getCreditCardByUserId($userId) {
        $queryResult = FEntityManager::getInstance()->retriveObj(self::getTable(), 'idUser', $userId);
        return $queryResult;
    }

}


?>