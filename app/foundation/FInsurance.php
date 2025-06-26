<?php

require_once("FEntityManager.php");

class FInsurance {

    private static $table = "insurance";
    private static $value = "(NULL, :name, :surname, :email, :type, :period, :price, :startDate, :idUser, :idSkipassBooking)";
    private static $key = "idInsurance";
    private static $extKeyUser = "idUser";
    private static $extKeyBooking = "idSkipassBooking";


    public static function getTable(){
        return self::$table;
    }

    public static function getValue(){
        return self::$value;
    }

    public static function getKey(){
        return self::$key;
    }

    public static function getExtKeyUser(){
        return self::$extKeyUser;
    }

    public static function getExtKeyBooking(){
        return self::$extKeyBooking;
    }

    public static function getClass(){
        return self::class;
    }

    /**
     * Binds the values of a person object to a prepared SQL statement.
     * @param object $stmt The PDO statement object used for query execution.
     * @param EInsurance $insurance An object representing an insurance
     * @return void
     */
    public static function bind(object $stmt, EInsurance $insurance) : void{
        $stmt->bindValue(":name", $insurance->getName(), PDO::PARAM_STR);
        $stmt->bindValue(":surname", $insurance->getSurname(), PDO::PARAM_STR);
        $stmt->bindValue(":email",$insurance->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(":type", $insurance->getType(), PDO::PARAM_STR);
        $stmt->bindValue(":period", $insurance->getPeriod(), PDO::PARAM_INT);
        $stmt->bindValue(":price", $insurance->getPrice(), PDO::PARAM_INT);
        $stmt->bindValue(":startDate", $insurance->getStartDate(), PDO::PARAM_STR);
        $stmt->bindValue(":idUser", $insurance->getIdUser(), PDO::PARAM_INT);
        $stmt->bindValue(":idSkipassBooking", $insurance->getIdSkipassBooking(), PDO::PARAM_INT);
    }

    /**
     * Method to create an object or a set of object from a query
     * @param array $queryResult Refers to the result of a query
     * @return array of objects 
     */
    public static function createInsuranceObj(array $queryResult) : array{
        if(count($queryResult) == 1) {
            $insuranceA = [];
            $insurance = new EInsurance($queryResult[0]['name'], $queryResult[0]['surname'], $queryResult[0]['email'], $queryResult[0]['type'], $queryResult[0]['period'], $queryResult[0]['price'], $queryResult[0]['startDate']);
            $insurance->setIdInsurance($queryResult[0]['idInsurance']);
            $insurance->setIdUser($queryResult[0]['idUser']);
            $insurance->setIdUser($queryResult[0]['idSkipassBooking']);
            $insuranceA[] = $insurance;
            return $insuranceA;
        } elseif(count($queryResult) > 1) {
            $insurancies = [];
            for($i = 0; $i < count($queryResult); $i++) {
                $insurance = new EInsurance($queryResult[$i]['name'], $queryResult[$i]['surname'], $queryResult[$i]['email'], $queryResult[$i]['type'], $queryResult[$i]['period'], $queryResult[$i]['price'], $queryResult[$i]['startDate']);
                $insurance->setIdInsurance($queryResult[$i]['idInsurance']);
                $insurance->setIdUser($queryResult[$i]['idUser']);
                $insurance->setIdUser($queryResult[$i]['idSkipassBooking']);
                $insurancies[] = $insurance;
            }
            return $insurancies;
        } else {
            return [];
        }
    }

    /**
     * Method to get an object using the id, invoke the createAdminObj function 
     * @param string $id Refers to the id
     * @return array 
     */
    public static function getObj(string $id) : array{
        $result = FEntityManager :: getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        if (count($result) > 0){
            $insurance = self:: createInsuranceObj($result);
            return $insurance;
        }
        else{
            return [];
        }
    }

    /**
     * Method to save an object in the database using the proper FEntityManager function
     * @param object $obj Refers to an Entity object that needs to be stored in the database
     * @return bool true if succeded and false if failed
     */
    public static function saveObj(EInsurance $obj, ?array $fieldArray = null) : bool{
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
                error_log("Database error in FInsurance saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally {
                FEntityManager::getInstance()->closeConnection();
            }
        } else {
            try {
                FEntityManager::getInstance()->getDb()->beginTransaction();
                foreach($fieldArray as $fv) {
                    FEntityManager::getInstance()->updateObj(self::getTable(), $fv[0], $fv[1], self::getKey(), $obj->getIdInsurance());
                }
                FEntityManager::getInstance()->getDb()->commit();
                return true;
            } catch(PDOException $e) {
                error_log("Database error in FInsurance saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally {
                FEntityManager::getInstance()->closeConnection();
            }
        }
    }

    /**
     * Method to get an insurance object using the id
     * @param string $id id of the insurance
     * @return array $queryResult
     */
    public static function getInsurance(array $fields) : array{
        $queryResult = FEntityManager::getInstance()->retriveObjNFields(self::getTable(), $fields);
        return $queryResult;
    }

    /**
     * Method to get all the insurance objects using the id 
     * @param string $id insurance id
     * @return array $queryResult
     */
    public static function getAllInsurance(string $id) : array{
        $queryResult = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        return $queryResult;
    }

    /**
     * Method to get a set of insurance object using some fields 
     * @param $fields array of fields and values
     * @return array $queryResult
     */
    public static function getInsurances(array $fields) : array{
        $queryResult = FEntityManager::getInstance()->retriveObjNFields(self::getTable(), $fields);
        return $queryResult;
    }

    /**
     * Method to get a insurance using id user
     * @param $idUser id of the user
     * @return array $queryResult
     */
    public static function getInsuranceFromIdUser(int $idUser) : array{
        $queryResult = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getExtKeyUser(), $idUser);
        return $queryResult;
    }

    /**
     * Method to get a insurance using id user and date
     * @param $idUser id of the user
     * @return array $queryResult
     */
    public static function getInsuranceFromIdUserAndDate(int $idUser, string $date) : array{
        $field = [['idUser', $idUser], ['startDate', $date]];
        $queryResult = FEntityManager::getInstance()->retriveObjNFields(self::getTable(), $field);
        return $queryResult;
    }

    /**
     * Method to get a insurance using id user and date
     * @param $idUser id of the user
     * @return array $queryResult
     */
    public static function getInsuranceFromIdUserIdSkipassBookingAndDate(int $idUser, int $idSkipassBooking, string $date) : array{
        $field = [['idUser', $idUser], ['idSkipassBooking', $idSkipassBooking], ['startDate', $date]];
        $queryResult = FEntityManager::getInstance()->retriveObjNFields(self::getTable(), $field);
        return $queryResult;
    }
}
?>