<?php

class FCreditCard{

    private static $table = "credtiCard";

    private static $value = "(NULL, :cardHolderName, :cardHolderSurname, :endDate, :cardNumber, :cvv)";

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
        $stmt->bindValue(":endDate", $creditCard->getEndDateStr(), PDO::PARAM_STR);
        $stmt->bindValue(":cardNumber", $creditCard->getCardNumber(), PDO::PARAM_INT);
        $stmt->bindValue(":cvv", $creditCard->getCvv(), PDO::PARAM_INT);
    }






}


?>