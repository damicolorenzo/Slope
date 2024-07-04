<?php

class FPayment {

    private static $table = "payment";

    private static $value = "(NULL, :totalAmount, :date, :cardNumber)";

    private static $key = "idPayment";

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


    public static function bind($stmt, $payment){
        $stmt->bindValue(":totalAmount", $payment->getTotalAmount(), PDO::PARAM_FLOAT);
        $stmt->bindValue(":date", $payment->getDateStr(), PDO::PARAM_STR);
        $stmt->bindValue(":cardNumber", $payment->getCardNumber(), PDO::PARAM_INT);
    }



    public static function getPayment(){

    }


}






?>