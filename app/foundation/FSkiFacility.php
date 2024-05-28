<?php

require_once("FEntityManager.php");

class FSkiFacility {

    private static $table = "SkiFacility";
    private static $key = "idSkiFacility";
    
    public static function getTable() {return self::$table;}
    public static function getClass() {return self::class;}
    public static function getKey() {return self::$key;}

    public static function getObj($id) :array {
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        return $result;
    }
}

?>