<?php

require_once("FEntityManager.php");

class FPayment {

    private static $table = "payment";
    private static $value = "(NULL, :type, :totalAmount, :date, :idCreditCard, :idExternalObj)";
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
        $stmt->bindValue(":type", $payment->getType(), PDO::PARAM_STR);
        $stmt->bindValue(":totalAmount", $payment->getTotalAmount(), PDO::PARAM_INT);
        $stmt->bindValue(":date", $payment->getDate(), PDO::PARAM_STR);
        $stmt->bindValue(":idCreditCard", $payment->getIdCreditCard(), PDO::PARAM_INT);
        $stmt->bindValue(":idExternalObj", $payment->getIdExternalObj(), PDO::PARAM_INT);
    }



    public static function createPaymentObj($queryResult){
        $payment = new EPayment($queryResult[0]['type'], $queryResult[0]['totalAmount'], $queryResult[0]['date']);
        $payment->setIdCreditCard($queryResult[0]['idCreditCard']);
        $payment->setIdExternalObj($queryResult[0]['idExternalObj']);
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