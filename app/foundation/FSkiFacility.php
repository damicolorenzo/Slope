<?php

require_once("FEntityManager.php");

class FSkiFacility {

    private static $table = "SkiFacility";
    private static $value = "(NULL, :name, :status, :price)";
    private static $key = "idSkiFacility";

    public static function getTable() {return self::$table;}
    public static function getValue() {return self::$value;}
    public static function getClass() {return self::class;}
    public static function getKey() {return self::$key;}
    
    public static function getObj($id) :array {
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        return $result;
    }

    public static function bind($stmt, $skiFacility){
        $stmt->bindValue(":name", $skiFacility->getName(), PDO::PARAM_STR);
        $stmt->bindValue(":status", $skiFacility->getStatus(), PDO::PARAM_STR);
        $stmt->bindValue(":price",$skiFacility->getPrice(), PDO::PARAM_INT);
    }

    public static function saveObj($obj){
        $saveSkiFacility = FEntityManager::getInstance()->saveObject(self::getClass(), $obj);
        if($saveSkiFacility !== null){
            return $saveSkiFacility;
        }else{
            return false;
        }
    }
}

?>