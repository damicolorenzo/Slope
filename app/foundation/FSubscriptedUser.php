<?php

require_once("FEntityManager.php");


Class FSubscriptedUser{

    private static $table = "SubscriptedUser";
    private static $columns = " ('idSubscriptedUser', 'surname', 'email', 'phoneNumber', 'birthDate', 'username', 'password', 'yearStart')";
    private static $value = "(NULL, :name, :surname, :email, :phoneNumber, :birthDate, :username, :password, :yearStart)";
    private static $key = "idSubscriptedUser";


    public static function getTable() {return self::$table;}
    public static function getColumns() {return self::$columns;}
    public static function getValue() {return self::$value;}
    public static function getClass() {return self::class;}
    public static function getKey() {return self::$key;}


    public static function getObj($id) :array {
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        return $result;
    }




    public static function bind($stmt, $subscriptedUser){
        $stmt->bindValue(":name", $subscriptedUser->getName(), PDO::PARAM_STR);
        $stmt->bindValue(":surname", $subscriptedUser->getSurame(), PDO::PARAM_STR);
        $stmt->bindValue(":email", $subscriptedUser->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(":phoneNumber", $subscriptedUser->getPhoneNumber(), PDO::PARAM_STR);
        $stmt->bindValue(":birthDate", $subscriptedUser->getBirthDate(), PDO::PARAM_STR);
        $stmt->bindValue(":username", $subscriptedUser->getUsername(), PDO::PARAM_STR);
        $stmt->bindValue(":password", $subscriptedUser->getPassword(), PDO::PARAM_STR);
        $stmt->bindValue(":yearStart", $subscriptedUser->getYearStart(), PDO::PARAM_STR);
    }



    public static function saveObj($obj){
        $saveSubscriptedUser = FEntityManager::getInstance()->saveObject(self::getClass(), $obj);
        if($saveSubscriptedUser !== null){
            return $saveSubscriptedUser;
        }
        else{
            return false;
        }
    }


}

?>