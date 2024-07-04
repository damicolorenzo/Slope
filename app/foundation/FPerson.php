<?php

require_once("FEntityManager.php");


Class FPerson{

    private static $table = "Person";
    private static $columns = " ('idPerson', 'name', 'surname', 'email', 'phoneNumber', 'birthDate', 'username', 'password')";
    private static $value = "(NULL, :name, :surname, :email, :phoneNumber, :birthDate, :username, :password)";
    private static $key = "idPerson";


    public static function getTable() {return self::$table;}
    public static function getColumns() {return self::$columns;}
    public static function getValue() {return self::$value;}
    public static function getClass() {return self::class;}
    public static function getKey() {return self::$key;}


    public static function getObj($id) :array {
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        return $result;
    }




    public static function bind($stmt, $person){
        $stmt->bindValue(":name", $person->getName(), PDO::PARAM_STR);
        $stmt->bindValue(":surname", $person->getSurame(), PDO::PARAM_STR);
        $stmt->bindValue(":email", $person->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(":phoneNumber", $person->getPhoneNumber(), PDO::PARAM_STR);
        $stmt->bindValue(":birthDate", $person->getBirthDate(), PDO::PARAM_STR);
        $stmt->bindValue(":username", $person->getUsername(), PDO::PARAM_STR);
        $stmt->bindValue(":password", $person->getPassword(), PDO::PARAM_STR);
    }



    public static function saveObj($obj){
        $savePerson = FEntityManager::getInstance()->saveObject(self::getClass(), $obj);
        if($savePerson !== null){
            return $savePerson;
        }
        else{
            return false;
        }
    }


}

?>