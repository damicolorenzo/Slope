<?php

require_once("FEntityManager.php");

class FSkipassBooking {

    private static $table = "SkipassBooking";
    private static $value = "(NULL, :name, :surname, :tpye, :email, :total, :startDate, :idPayment)";
    private static $key = "idSkipassBooking";
    
    public static function getTable() {return self::$table;}
    public static function getValue() {return self::$value;}
    public static function getClass() {return self::class;}
    public static function getKey() {return self::$key;}


    public static function getObj($id) :array {
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        return $result;
    }

    public static function bind($stmt, $skipass){
        $stmt->bindValue(":name", $skipass->getName(), PDO::PARAM_STR);
        $stmt->bindValue(":surname", $skipass->getSurname(), PDO::PARAM_STR);
        $stmt->bindValue(":tpye",$skipass->getType(), PDO::PARAM_STR);
        $stmt->bindValue(":email",$skipass->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(":startDate",$skipass->getStartDate(), PDO::PARAM_STR);
        $stmt->bindValue(":total",$skipass->getTotal(), PDO::PARAM_INT);
        $stmt->bindValue(":idPayment", $skipass->getidP(), PDO::PARAM_STR);
    }

    public static function saveObj($obj){
        $saveSkipass = FEntityManager::getInstance()->saveObject(self::getClass(), $obj);
        if($saveSkipass !== null){
            return $saveSkipass;
        }else{
            return false;
        }
    }
}

?>