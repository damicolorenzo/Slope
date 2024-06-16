<?php

class FInsurance {

    private static $table = "insurance";

    private static $value = "(NULL, :type, :period, :price)";

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
    }


    //public static function createInsuranceObj($queryResult){
    //    if (count())
    //}

    public static function getObj($id){
        $result = FEntityManager :: getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        if (count($result) > 0){
            $insurance = self:: createInsuranceObj($result);
        }

    }




}






?>