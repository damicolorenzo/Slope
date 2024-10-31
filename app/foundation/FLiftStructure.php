<?php

require_once("FEntityManager.php");

class FLiftStructure {

    private static $table = "LiftStructure";
    private static $columns = " ('idLiftStructure', 'name', 'type', 'status', 'seats', 'idSkiFacility')";
    private static $value = "(NULL, :name, :type, :status, :seats, :idSkiFacility)";
    private static $key = "idLiftStructure";
    private static $externalKey = "idSkiFacility";
    
    public static function getTable() {return self::$table;}
    public static function getColumns() {return self::$columns;}
    public static function getValue() {return self::$value;}
    public static function getClass() {return self::class;}
    public static function getKey() {return self::$key;}
    public static function getExtKey() {return self::$externalKey;}

    public static function getObj($id) :array {
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        return $result;
    }

    public static function bind($stmt, $liftStructure){
        $stmt->bindValue(":name", $liftStructure->getName(), PDO::PARAM_STR);
        $stmt->bindValue(":type", $liftStructure->getType(), PDO::PARAM_STR);
        $stmt->bindValue(":status",$liftStructure->getStatus(), PDO::PARAM_STR);
        $stmt->bindValue(":seats",$liftStructure->getSeats(), PDO::PARAM_INT);
        $stmt->bindValue(":idSkiFacility",$liftStructure->getIdSkiFacility(), PDO::PARAM_INT);
    }

    public static function saveObj($obj){
        $saveLiftStructure = FEntityManager::getInstance()->saveObject(self::getClass(), $obj);
        if($saveLiftStructure !== null){
            return $saveLiftStructure;
        }
        else{
            return false;
        }
    }

    public static function crateLiftStructureObj($queryResult){
        if(count($queryResult) == 1){
            //$attributes = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $queryResult[0][self::getKey()]);
            $lift = new ELiftStructure($queryResult[0]['name'], $queryResult[0]['type'], $queryResult[0]['status'], $queryResult[0]['seats']);
            $lift->setIdLift($queryResult[0]['idLiftStructure']);
            $lift->setIdSkiFacility($queryResult[0]['idSkiFacility']);
            return $lift;
        }elseif(count($queryResult) > 1){
            $lifts = array();
            for($i = 0; $i < count($queryResult); $i++){
                //$attributes = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $queryResult[0][self::getKey()]);
                $lift = new ELiftStructure($queryResult[0]['name'], $queryResult[0]['type'], $queryResult[0]['status'], $queryResult[0]['seats']);
                $lift->setIdLift($queryResult[0]['idLiftStructure']);
                $lift->setIdSkiFacility($queryResult[0]['idSkiFacility']);
                $lifts[] = $lift;
            }
            return $lifts;
        }else{
            return array();
        }
    }

    public static function getLiftStructures($idSkiFacility) {
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getExtKey(), $idSkiFacility);
        return $result;
    }

    public static function getNLiftStructures($idSkiFacility) {
        $result = FEntityManager::getInstance()->countObjId(self::getTable(), self::getExtKey(), $idSkiFacility);
        return $result;
    }

    public static function getLiftStructureByNameAndSkiFacility($name, $idSkiFacility) {
        $queryResult = FEntityManager::getInstance()->retriveObj2(self::getTable(), 'name', $name, self::getExtKey(), $idSkiFacility);
        return FEntityManager::getInstance()->existInDb($queryResult);
    }
}

?>