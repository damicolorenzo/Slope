<?php

require_once("FEntityManager.php");


Class FUser{

    private static $table = "User";
    private static $columns = " ('idUser', 'surname', 'email', 'phoneNumber', 'birthDate', 'username', 'password')";
    private static $value = "(NULL, :name, :surname, :email, :phoneNumber, :birthDate, :username, :password)";
    private static $key = "idUser";


    public static function getTable() {return self::$table;}
    public static function getColumns() {return self::$columns;}
    public static function getValue() {return self::$value;}
    public static function getClass() {return self::class;}
    public static function getKey() {return self::$key;}


    public static function getObj($id) :array {
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        return $result;
    }




    public static function bind($stmt, $user){
        $stmt->bindValue(":name", $user->getName(), PDO::PARAM_STR);
        $stmt->bindValue(":surname", $user->getSurame(), PDO::PARAM_STR);
        $stmt->bindValue(":email", $user->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(":phoneNumber", $user->getPhoneNumber(), PDO::PARAM_STR);
        $stmt->bindValue(":birthDate", $user->getBirthDate(), PDO::PARAM_STR);
        $stmt->bindValue(":username", $user->getUsername(), PDO::PARAM_STR);
        $stmt->bindValue(":password", $user->getPassword(), PDO::PARAM_STR);
    }



    public static function saveObj($obj){
        $saveUser = FEntityManager::getInstance()->saveObject(self::getClass(), $obj);
        if($saveUser !== null){
            return $saveUser;
        }
        else{
            return false;
        }
    }


}

?>