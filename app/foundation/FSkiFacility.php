<?php

require_once("FEntityManager.php");

class FSkiFacility {

    private static $table = "SkiFacility";
    private static $value = "(NULL, :name, :status, :price, :idSkiArea)";
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

    public static function crateSkiFacilityObj($queryResult){
        if(count($queryResult) == 1){
            //$attributes = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $queryResult[0][self::getKey()]);
            $skiFacility = new ESkiFacility($queryResult[0]['name'], $queryResult[0]['status'], $queryResult[0]['price']);
            $skiFacility->setIdSkiFacility($queryResult[0]['idSkiFacility']);
            $skiFacility->setIdSkiArea($queryResult[0]['idSkiArea']);
            //$user->setIdImage($attributes[0]['idImage']);
            return $skiFacility;
        }elseif(count($queryResult) > 1){
            $skiFacilities = array();
            for($i = 0; $i < count($queryResult); $i++){
                //$attributes = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $queryResult[0][self::getKey()]);
                $skiFacility = new ESkiFacility($queryResult[0]['name'], $queryResult[0]['status'], $queryResult[0]['price']);
                $skiFacility->setIdSkiFacility($queryResult[0]['idSkiFacility']);
                $skiFacility->setIdSkiArea($queryResult[0]['idSkiArea']);
                $skiFacilities[] = $skiFacility;
            }
            return $skiFacilities;
        }else{
            return array();
        }
    }

    public static function getSkiFacilities() {
        $result = FEntityManager::getInstance()->selectObj(FSkiFacility::getKey(), FSkiFacility::getTable());
        return $result;
    }

    public static function getIdAllSkiFacilities() {
        $result = FEntityManager::getInstance()->selectObj(FSkiFacility::getKey(), FSkiFacility::getTable());
        return $result;
    }

    public static function getNameSkiFacility($idSkiFacility) {
        $result = FEntityManager::getInstance()->selectObjKey('name', FSkiFacility::getTable(), FSkiFacility::getKey(), $idSkiFacility);
        return $result;
    }

    public static function getAllNameSkiFacility() {
        $result = FEntityManager::getInstance()->selectAllObjKey('name', FSkiFacility::getTable());
        return $result;
    }

    public static function getIdFromName($name) {
        $result = FEntityManager::getInstance()->selectObjKey(FSkiFacility::getKey(), FSkiFacility::getTable(), 'name', $name);
        return $result;
    }
    
}

?>