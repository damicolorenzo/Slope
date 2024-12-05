<?php

require_once("FEntityManager.php");

class FSkiRun {

    private static $table = "SkiRun";
    private static $value = "(NULL, :name, :type, :status, :idSkiFacility)";
    private static $key = "idSkiRun";
    private static $externalKey = "idSkiFacility";
    
    public static function getTable() {return self::$table;}
    public static function getValue() {return self::$value;}
    public static function getClass() {return self::class;}
    public static function getKey() {return self::$key;}
    public static function getExtKey() {return self::$externalKey;}

    public static function getObj($id) :array {
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        return $result;
    }

    public static function bind($stmt, $skiRun){
        $stmt->bindValue(":name", $skiRun->getName(), PDO::PARAM_STR);
        $stmt->bindValue(":type", $skiRun->getType(), PDO::PARAM_STR);
        $stmt->bindValue(":status",$skiRun->getStatus(), PDO::PARAM_STR);
        $stmt->bindValue(":idSkiFacility",$skiRun->getIdSkiFacility(), PDO::PARAM_INT);
    }

    public static function saveObj($obj, $fieldArray = null){
        if($fieldArray === null) {
            try {
                FEntityManager::getInstance()->getDb()->beginTransaction();
                $saveSkiRun = FEntityManager::getInstance()->saveObject(self::getClass(), $obj);
                if($saveSkiRun !== null) {
                    FEntityManager::getInstance()->getDb()->commit();
                    return $saveSkiRun;
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
                    FEntityManager::getInstance()->updateObj(FSkiRun::getTable(), $fv[0], $fv[1], self::getKey(), $obj->getIdSkiRun());
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

    public static function createSkiRunObj($queryResult){
        if(count($queryResult) == 1){
            //$attributes = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $queryResult[0][self::getKey()]);
            $skiRun = new ESkiRun($queryResult[0]['name'], $queryResult[0]['type'], $queryResult[0]['status']);
            $skiRun->setIdSkiRun($queryResult[0]['idSkiRun']);
            $skiRun->setIdSkiFacility($queryResult[0]['idSkiFacility']);
            return $skiRun;
        }elseif(count($queryResult) > 1){
            $skiRuns = array();
            for($i = 0; $i < count($queryResult); $i++){
                //$attributes = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $queryResult[0][self::getKey()]);
                $skiRun = new ESkiRun($queryResult[$i]['name'], $queryResult[$i]['type'], $queryResult[$i]['status']);
                $skiRun->setIdSkiRun($queryResult[$i]['idSkiRun']);
                $skiRun->setIdSkiFacility($queryResult[$i]['idSkiFacility']);
                $skiRuns[] = $skiRun;
            }
            return $skiRuns;
        }else{
            return array();
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

    public static function getSkiRuns($idSkiFacility) {
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getExtKey(), $idSkiFacility);
        return $result;
    }

    public static function typeAndNumberSkiRun($idSkiFacility) {
        $result = FEntityManager::getInstance()->typeAndNumberSkiRun(self::getTable(), self::getExtKey(), $idSkiFacility);
        return $result;
    }

    public static function getSkiRunByNameAndSkiFacility($name, $idSkiFacility) {
        $queryResult = FEntityManager::getInstance()->retriveObj2(self::getTable(), 'name', $name, self::getExtKey(), $idSkiFacility);
        return FEntityManager::getInstance()->existInDb($queryResult);
    }

    public static function getAllSkiRunObj() {
        $result = FEntityManager::getInstance()->retriveAllObj(FSkiRun::getTable());
        return $result;
    }

    public static function getSkiRunById($id){
        $result = FEntityManager::getInstance()->retriveObj(FSkiRun::getTable(), 'idSkiRun', $id);
        return $result;
    }

    public static function getSkiRunByNameForSearch($queryString) {
        $queryResult = FEntityManager::getInstance()->retriveObjForSearch2(self::getTable(), 'name', $queryString);
        return $queryResult;
    }
}

?>