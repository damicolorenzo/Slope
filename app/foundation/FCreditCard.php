<?php

require_once("FEntityManager.php");

class FCreditCard{

    private static $table = "credtiCard";

    //da vedere se :cardNumber
    private static $value = "(NULL, :cardHolderName, :cardHolderSurname, :endDate, :cvv)";

    private static $key = "cardNumber";


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
        $stmt->bindValue(":endDate", $creditCard->getEndDateStr(), PDO::PARAM_STR);
        //$stmt->bindValue(":cardNumber", $creditCard->getCardNumber(), PDO::PARAM_INT);
        $stmt->bindValue(":cvv", $creditCard->getCvv(), PDO::PARAM_INT);
    }


    public static function createCreditCardObj($queryResult){
        $creditCard = array();

        foreach($queryResult as $cc){
            $creditCard = new ECreditCard($cc['cardHolderName'], $cc['cardHolderSurname'], $cc['cardNumber'], $cc['cvv']);
            $endDate = DateTime::createFromFormat('Y-m-d', $cc['endDate']);
            $creditCard->setEndDate($endDate);
            $creditCard[] = $creditCard;
        }
        if(count($creditCard) == 1){
            return $creditCard[0];
        }
        return $creditCard;

    }

    public static function getObj($cardNumber){
        $result = FEntityManager :: getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        if (count($result) > 0){
            $creditCard = self:: createCreditCardObj($result);
            return $creditCard;
        }
        else{
            return null;
        }
    }


    public static function saveObj($obj){
        $saveCreditCard = FEntityManager::getInstance()->saveObject(self::getClass(), $obj);
        if ($saveCreditCard !== null){
            return true;
        }
        else{
            return false;
        }
    }


}


?>