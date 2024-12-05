<?php

require_once("FEntityManager.php");

class FSkipassBooking {

    private static $table = "SkipassBooking";
    private static $value = "(NULL, :name, :surname, :email, :date, :period, :type, :totalPrice, :idUser, :idSkiFacility)";
    private static $key = "idSkipassBooking";
    private static $externalKey = 'iduser';
    
    public static function getTable() {return self::$table;}
    public static function getValue() {return self::$value;}
    public static function getClass() {return self::class;}
    public static function getKey() {return self::$key;}
    public static function getExtKey() {return self::$externalKey;}

    public static function getObj($id) :array {
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        return $result;
    }

    public static function bind($stmt, $skipass){
        $stmt->bindValue(":name", $skipass->getName(), PDO::PARAM_STR);
        $stmt->bindValue(":surname", $skipass->getSurname(), PDO::PARAM_STR);
        $stmt->bindValue(":email",$skipass->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(":date",$skipass->getStartDate(), PDO::PARAM_STR);
        $stmt->bindValue(":period",$skipass->getPeriod(), PDO::PARAM_STR);
        $stmt->bindValue(":type",$skipass->getType(), PDO::PARAM_STR);
        $stmt->bindValue(":totalPrice",$skipass->getTotal(), PDO::PARAM_INT);
        $stmt->bindValue(":idUser", $skipass->getIdUser(), PDO::PARAM_INT);
        $stmt->bindValue(":idSkiFacility", $skipass->getIdSkiFacility   (), PDO::PARAM_INT);
    }

    public static function saveObj($obj){
        $saveSkipass = FEntityManager::getInstance()->saveObject(self::getClass(), $obj);
        if($saveSkipass !== null){
            return $saveSkipass;
        }else{
            return false;
        }
    }

    public static function getSkipassBooking($fields) {
        $queryResult = FEntityManager::getInstance()->retriveIdFromObj(self::getKey(), self::getTable(), $fields);
        return $queryResult;
    }

    public static function getAllSkipassBooking($id) {
        $queryResult = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getExtKey(), $id);
        return $queryResult;
    }

    public static function createSkipassbookingObj($queryResult) {
        if(count($queryResult) == 1){
            //$attributes = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $queryResult[0][self::getKey()]);
            $skipassBooking = new ESkipassBooking($queryResult[0]['name'], $queryResult[0]['surname'], $queryResult[0]['date'], $queryResult[0]['type'], $queryResult[0]['email'], $queryResult[0]['period'], $queryResult[0]['totalPrice']); 
            $skipassBooking->setIdSkipassBooking($queryResult[0]['idSkipassBooking']);
            $skipassBooking->setIdUser($queryResult[0]['idUser']);
            $skipassBooking->setIdSkiFacility($queryResult[0]['idSkiFacility']);
            return $skipassBooking;
        }elseif(count($queryResult) > 1){
            $skipassBooknigs = array();
            for($i = 0; $i < count($queryResult); $i++){
                //$attributes = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $queryResult[0][self::getKey()]);
                $skipassBooking = new ESkipassBooking($queryResult[$i]['name'], $queryResult[$i]['surname'], $queryResult[$i]['date'], $queryResult[$i]['type'], $queryResult[$i]['email'], $queryResult[$i]['period'], $queryResult[$i]['totalPrice']); 
                $skipassBooking->setIdSkipassBooking($queryResult[$i]['idSkipassBooking']);
                $skipassBooking->setIdUser($queryResult[$i]['idUser']);
                $skipassBooking->setIdSkiFacility($queryResult[$i]['idSkiFacility']);
                $skipassBooknigs[] = $skipassBooking;
            }
            return $skipassBooknigs;
        }else{
            return array();
        }
    }

    public static function getSkipassBookingFromId($id) {
        $queryResult = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        return $queryResult;
    }
}

?>