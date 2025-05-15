<?php

require_once("FEntityManager.php");

class FSkipassBooking {

    private static $table = "SkipassBooking";
    private static $value = "(NULL, :name, :surname, :type, :startDate, :email, :value, :period, :idUser, :idSkipassObj)";
    private static $key = "idSkipassBooking";
    private static $externalKeyU = 'iduser';
    private static $externalKeyO = 'idSkipassObj';
    
    public static function getTable() {return self::$table;}
    public static function getValue() {return self::$value;}
    public static function getClass() {return self::class;}
    public static function getKey() {return self::$key;}
    public static function getExtKeyU() {return self::$externalKeyU;}
    public static function getExtKeyO() {return self::$externalKeyO;}

    /**
     * Method to get an object using the id
     * @param string $id Refers to the id
     * @return array 
     */
    public static function getObj(string $id) :array {
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        return $result;
    }

    /**
     * Binds the values of a credit card object to a prepared SQL statement.
     * @param object $stmt The PDO statement object used for query execution.
     * @param ESkipassBooking $skipass An object representing a skipass booking.
     * @return void
     */
    public static function bind(object $stmt, ESkipassBooking $skipass) : void{
        $stmt->bindValue(":name", $skipass->getName(), PDO::PARAM_STR);
        $stmt->bindValue(":surname", $skipass->getSurname(), PDO::PARAM_STR);
        $stmt->bindValue(":type",$skipass->getType(), PDO::PARAM_STR);
        $stmt->bindValue(":startDate",$skipass->getStartDate(), PDO::PARAM_STR);
        $stmt->bindValue(":email",$skipass->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(":value",$skipass->getValue(), PDO::PARAM_INT);
        $stmt->bindValue(":period",$skipass->getPeriod(), PDO::PARAM_INT);
        $stmt->bindValue(":idUser", $skipass->getIdUser(), PDO::PARAM_INT);
        $stmt->bindValue(":idSkipassObj", $skipass->getIdSkipassObj(), PDO::PARAM_INT);
    }

    /**
     * Method to save an object in the database using the proper FEntityManager function
     * @param object $obj Refers to an Entity object that needs to be stored in the database
     * @return bool true if succeded and false if failed
     */
    public static function saveObj(ESkipassBooking $obj, ?array $fieldArray = null) : bool{
        if($fieldArray === null) {
            try {
                FEntityManager::getInstance()->getDb()->beginTransaction();
                $savePrice = FEntityManager::getInstance()->saveObject(self::getClass(), $obj);
                if($savePrice !== null) {
                    FEntityManager::getInstance()->getDb()->commit();
                    return true;
                } else {
                    return false;
                }
            } catch(PDOException $e) {
                error_log("Database error in FSkipassBooking saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally {
                FEntityManager::getInstance()->closeConnection();
            }
        } else {
            try {
                FEntityManager::getInstance()->getDb()->beginTransaction();
                foreach($fieldArray as $fv) {
                    FEntityManager::getInstance()->updateObj(self::getTable(), $fv[0], $fv[1], self::getKey(), $obj->getIdSkipassBooking());
                }
                FEntityManager::getInstance()->getDb()->commit();
                return true;
            } catch(PDOException $e) {
                error_log("Database error in FSkipassBooking saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally {
                FEntityManager::getInstance()->closeConnection();
            }
        }
    }

    /**
     * DA RIVEDERE retriveIdFromObj
     * Method to get a booking object using a field
     * @param string $field
     * @return array $queryResult
     */
    public static function getSkipassBooking(array $fields) : array{
        $queryResult = FEntityManager::getInstance()->retriveObjNFields(self::getTable(), $fields);
        return $queryResult;
    }

    /**
     * Method to get all bookings object using the user id
     * @param string $id user id
     * @return array $queryResult
     */
    public static function getAllSkipassBooking(string $id) : array{
        $queryResult = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getExtKeyU(), $id);
        return $queryResult;
    }

    public static function getAllSkipassBookingAllUsers() : array{
        $queryResult = FEntityManager::getInstance()->retriveAllObj(self::getTable());
        return $queryResult;
    }

    /**
     * Method to create an object or a set of object from a query
     * @param array $queryResult Refers to the result of a query
     * @return array of objects 
     */
    public static function createSkipassbookingObj(array $queryResult) : array{
        if(count($queryResult) == 1){
            $skipassBookingA = [];
            $skipassBooking = new ESkipassBooking($queryResult[0]['name'], $queryResult[0]['surname'], $queryResult[0]['startDate'], $queryResult[0]['type'], $queryResult[0]['email'], $queryResult[0]['period'], $queryResult[0]['value']); 
            $skipassBooking->setIdSkipassBooking($queryResult[0]['idSkipassBooking']);
            $skipassBooking->setIdUser($queryResult[0]['idUser']);
            $skipassBooking->setIdSkipassObj($queryResult[0]['idSkipassObj']);
            $skipassBookingA[] = $skipassBooking;
            return $skipassBookingA;
        }elseif(count($queryResult) > 1){
            $skipassBooknigs = [];
            for($i = 0; $i < count($queryResult); $i++){
                $skipassBooking = new ESkipassBooking($queryResult[$i]['name'], $queryResult[$i]['surname'], $queryResult[$i]['startDate'], $queryResult[$i]['type'], $queryResult[$i]['email'], $queryResult[$i]['period'], $queryResult[$i]['value']); 
                $skipassBooking->setIdSkipassBooking($queryResult[$i]['idSkipassBooking']);
                $skipassBooking->setIdUser($queryResult[$i]['idUser']);
                $skipassBooking->setIdSkipassObj($queryResult[$i]['idSkipassObj']);
                $skipassBooknigs[] = $skipassBooking;
            }
            return $skipassBooknigs;
        }else{
            return [];
        }
    }

    /**
     * Method to get a booking object using the id
     * @param string $id id of the booking
     * @return array $queryResult
     */
    public static function getSkipassBookingFromId(string $id) : array{
        $queryResult = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        return $queryResult;
    }
}

?>