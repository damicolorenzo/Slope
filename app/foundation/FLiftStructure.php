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

    public static function saveObj($obj, $fieldArray = null){
        if($fieldArray === null) {
            try {
                FEntityManager::getInstance()->getDb()->beginTransaction();
                $saveLiftStructure = FEntityManager::getInstance()->saveObject(self::getClass(), $obj);
                if($saveLiftStructure !== null) {
                    FEntityManager::getInstance()->getDb()->commit();
                    return $saveLiftStructure;
                } else {
                    return false;
                }
            } catch(PDOException $e) {
                echo "ERROR ".$e->getMessage();
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally {
                FEntityManager::getInstance()->closeConnection();
            }
        } else {
            try {
                FEntityManager::getInstance()->getDb()->beginTransaction();
                foreach($fieldArray as $fv) {
                    FEntityManager::getInstance()->updateObj(FLiftStructure::getTable(), $fv[0], $fv[1], self::getKey(), $obj->getIdLift());
                }
                FEntityManager::getInstance()->getDb()->commit();
                return true;
            } catch(PDOException $e) {
                echo "ERROR ".$e->getMessage();
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally {
                FEntityManager::getInstance()->closeConnection();
            }
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
                $lift = new ELiftStructure($queryResult[$i]['name'], $queryResult[$i]['type'], $queryResult[$i]['status'], $queryResult[$i]['seats']);
                $lift->setIdLift($queryResult[$i]['idLiftStructure']);
                $lift->setIdSkiFacility($queryResult[$i]['idSkiFacility']);
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

    public static function getAllLiftStructureObj() {
        $result = FEntityManager::getInstance()->retriveAllObj(FLiftStructure::getTable());
        return $result;
    }

    public static function getLiftStructureById($id){
        $result = FEntityManager::getInstance()->retriveObj(FLiftStructure::getTable(), 'idLiftStructure', $id);
        return $result;
    }

    public static function getLiftStructureByNameForSearch($queryString) {
        $queryResult = FEntityManager::getInstance()->retriveObjForSearch2(self::getTable(), 'name', $queryString);
        return $queryResult;
    }
}

?>