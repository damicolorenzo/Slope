<?php

require_once("FEntityManager.php");

class FPayment {

    private static $table = "payment";
    private static $value = "(NULL, :totalAmount, :date, :extObjClass, :idExternalObj, :idCreditCard)";
    private static $key = "idPayment";

    public static function getTable(){
        return self::$table;
    }

    public static function getValue(){
        return self::$value;
    }

    public static function getKey(){
        return self::$key;
    }

    public static function getClass(){
        return self::class;
    }

    /**
     * Binds the values of a paymeny object to a prepared SQL statement.
     * @param object $stmt The PDO statement object used for query execution.
     * @param EPaymeny $payment An object representing a lift structure
     * @return void
     */
    public static function bind(object $stmt, EPayment $payment) : void{
        $stmt->bindValue(":totalAmount", $payment->getTotalAmount(), PDO::PARAM_INT);
        $stmt->bindValue(":date", $payment->getDate(), PDO::PARAM_STR);
        $stmt->bindValue(":extObjClass", $payment->getExtObjClass(), PDO::PARAM_STR);
        $stmt->bindValue(":idExternalObj", $payment->getIdExternalObj(), PDO::PARAM_INT);
        $stmt->bindValue(":idCreditCard", $payment->getIdCreditCard(), PDO::PARAM_INT);
    }

    /**
     * Method to create an object or a set of object from a query
     * @param array $queryResult Refers to the result of a query
     * @return array of objects 
     */
    public static function createPaymentObj(array $queryResult) : array{
        $paymentA = [];
        $payment = new EPayment($queryResult[0]['extObjClass'], $queryResult[0]['totalAmount'], $queryResult[0]['date']);
        $payment->setIdCreditCard($queryResult[0]['idCreditCard']);
        $payment->setIdExternalObj($queryResult[0]['idExternalObj']);
        $paymentA[] = $payment;
        return $paymentA;
    }

    /**
     * Method to get an object using the id, invoke the retriveObj function from FEntityManager
     * @param string $id Refers to the id
     * @return array 
     */ 
    public static function getObj(string $id) : array{
        $result = FEntityManager :: getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        if (count($result) > 0){
            $payment = self::createPaymentObj($result);
            return $payment;
        }
        else{
            return [];
        }
    }

    /**
     * Method to save an object in the database using the proper FEntityManager function
     * @param EPaymeny $obj Refers to a payment Entity object that needs to be stored in the database
     * @return bool true if succeded and false if failed
     */
    public static function saveObj(EPayment $obj, ?array $fieldArray = null) : bool{
        if($fieldArray === null) {
            try {
                FEntityManager::getInstance()->getDb()->beginTransaction();
                $savePayment = FEntityManager::getInstance()->saveObject(self::getClass(), $obj);
                if($savePayment !== null) {
                    FEntityManager::getInstance()->getDb()->commit();
                    return $savePayment;
                } else {
                    return false;
                }
            } catch(PDOException $e) {
                error_log("Database error in FPayment saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally {
                FEntityManager::getInstance()->closeConnection();
            }
        } else {
            try {
                FEntityManager::getInstance()->getDb()->beginTransaction();
                foreach($fieldArray as $fv) {
                    FEntityManager::getInstance()->updateObj(FPayment::getTable(), $fv[0], $fv[1], self::getKey(), $obj->getIdPayment());
                }
                FEntityManager::getInstance()->getDb()->commit();
                return true;
            } catch(PDOException $e) {
                error_log("Database error in FPayment saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally {
                FEntityManager::getInstance()->closeConnection();
            }
        }
    }
}

?>