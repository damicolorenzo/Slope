<?php

require_once("FEntityManager.php");

class FLiftStructure {

    private static $table = "LiftStructure";
    private static $columns = " ('idLiftStructure', 'name', 'type', 'status', 'seats')";
    private static $value = "(NULL, :name, :type, :status, :seats)";
    private static $key = "idLiftStructure";
    
    public static function getTable() {return self::$table;}
    public static function getColumns() {return self::$columns;}
    public static function getValue() {return self::$value;}
    public static function getClass() {return self::class;}
    public static function getKey() {return self::$key;}

    public static function getObj($id) :array {
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        return $result;
    }

    public static function bind($stmt, $liftStructure){
        $stmt->bindValue(":name", $liftStructure->getName(), PDO::PARAM_STR);
        $stmt->bindValue(":type", $liftStructure->getType(), PDO::PARAM_STR);
        $stmt->bindValue(":status",$liftStructure->getStatus(), PDO::PARAM_STR);
        $stmt->bindValue(":seats",$liftStructure->getSeats(), PDO::PARAM_INT);
    }

    public static function saveObj($obj){
        $saveLiftStructure = FEntityManager::getInstance()->saveObject(self::getClass(), $obj);
        if($saveLiftStructure !== null){
            return $saveLiftStructure;
        }else{
            return false;
        }
    }
}

?>