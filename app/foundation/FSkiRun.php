<?php

require_once("FEntityManager.php");

class FSkiRun {

    private static $table = "SkiRun";
    private static $value = "(NULL, :name, :type, :status)";
    private static $key = "idSkiRun";
    
    public static function getTable() {return self::$table;}
    public static function getValue() {return self::$value;}
    public static function getClass() {return self::class;}
    public static function getKey() {return self::$key;}

    public static function getObj($id) :array {
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        return $result;
    }

    public static function bind($stmt, $skiRun){
        $stmt->bindValue(":name", $skiRun->getName(), PDO::PARAM_STR);
        $stmt->bindValue(":type", $skiRun->getType(), PDO::PARAM_STR);
        $stmt->bindValue(":status",$skiRun->getStatus(), PDO::PARAM_STR);
    }

    public static function saveObj($obj){
        $saveSkiRun = FEntityManager::getInstance()->saveObject(self::getClass(), $obj);
        if($saveSkiRun !== null){
            return $saveSkiRun;
        }else{
            return false;
        }
    }

    public static function getSkiRunImages($id) {
        /* Da implementare */
        /* $result = FEntityManager::getInstance()->retriveObj(self::getTable(), FSkiRun::getKey(), $id);
        if(count($result) > 0) {
            $image = self::createImageObj($result);
            return $image;
        } else {
            return null;
        } */
    }

    public static function createImageObj($queryResult) {
        /* Da implementare */
        /* if(count($queryResult) > 0) {
            $images = array();
            for($i = 0; $i < count($queryResult); $i++) {

            }
            return $images;
        } else {
            return array();
        } */   
    }
}

?>