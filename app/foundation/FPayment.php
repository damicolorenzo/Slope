<?php

require_once("FEntityManager.php");

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



    public static function createPaymentObj($queryResult){
        $payment = array();

        foreach($queryResult as $p){
            $cardNumber = FCreditCard::getObj($p['cardNumber']);
            $payment = new EPayment($p['totalAmount'], $cardNumber);
            $payment->setId($p['idPayment']);
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $p['date']);
            $payment->setTime($date);
            $payment[] = $payment;
        }
        if(count($payment) == 1){
            return $payment[0];
        }
        return $payment;
    }



    public static function getObj($id){
        $result = FEntityManager :: getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        if (count($result) > 0){
            $payment = self:: createPaymentObj($result);
            return $payment;
        }
        else{
            return null;
        }
    }


    public static function saveObj($obj){
        $savePayment = FEntityManager::getInstance()->saveObject(self::getClass(), $obj);
        if ($savePayment !== null){
            return true;
        }
        else{
            return false;
        }
    }



}






?>