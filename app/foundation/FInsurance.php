<?php

require_once("FEntityManager.php");

class FInsurance {

    private static $table = "insurance";

    private static $value = "(NULL, :type, :period, :price, :idPayment)";

    private static $key = "idInsurance";

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



    public static function bind($stmt, $insurance){
        $stmt->bindValue(":type", $insurance->getType(), PDO::PARAM_STR);
        $stmt->bindValue(":period", $insurance->getPeriod(), PDO::PARAM_INT);
        $stmt->bindValue(":price", $insurance->getPrice(), PDO::PARAM_FLOAT);
        $stmt->bindValue(":idPayment", $insurance->getidP(), PDO::PARAM_STR);
    }


    //public static function createInsuranceObj($queryResult){
    //    $insurances = array();
    //    foreach($queryResult as $ins){
    //        $insurance = new EInsurance($ins['type'], $ins['period'], $ins['price'], $ins['idPayment']);
    //        $insurance->setId($ins['idInsurance']);
    //
    //        if ($ins['idPayment'] !== null){
    //            $p = FEntityManager::getInstance()->retriveObj(FPayment::getTable(), FPayment::getKey(), $ins['idPayment']);
    //            $payment = FPayment::getPayment($p);
    //            $insurance->setPayment($payment[0]);
    //            }
    //        $insurances[] = $insurance;
    //    }
    //        return $insurances;
    //}

    public static function createInsuranceObj($queryResult){
        $insurance = array();

        foreach($queryResult as $ins){
            $payment = FPayment::getObj($ins['idPayment']);
            $insurance = new EInsurance($ins['type'], $ins['period'], $ins['price'], $payment);
            $insurance->setId($ins['idInsurance']);
            $insurance[] = $insurance;
        }
        if(count($insurance) == 1){
            return $insurance[0];
        }
        return $insurance;
    }




    public static function getObj($id){
        $result = FEntityManager :: getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        if (count($result) > 0){
            $insurance = self:: createInsuranceObj($result);
            return $insurance;
        }
        else{
            return null;
        }
    }


    public static function saveObj($obj){
        $saveInsurance = FEntityManager::getInstance()->saveObject(self::getClass(), $obj);
        if ($saveInsurance !== null){
            return true;
        }
        else{
            return false;
        }
    }




}






?>