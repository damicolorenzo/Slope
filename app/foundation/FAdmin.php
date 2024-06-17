<?php

require_once("FEntityManager.php");


Class FAdmin{

    private static $table = "Admin";
    private static $columns = " ('idAdmin', 'surname', 'email', 'phoneNumber', 'birthDate', 'adminname', 'password')";
    private static $value = "(NULL, :name, :surname, :email, :phoneNumber, :birthDate, :adminname, :password)";
    private static $key = "idAdmin";


    public static function getTable() {return self::$table;}
    public static function getColumns() {return self::$columns;}
    public static function getValue() {return self::$value;}
    public static function getClass() {return self::class;}
    public static function getKey() {return self::$key;}


    public static function getObj($id) :array {
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        return $result;
    }




    public static function bind($stmt, $admin){
        $stmt->bindValue(":name", $admin->getName(), PDO::PARAM_STR);
        $stmt->bindValue(":surname", $admin->getSurame(), PDO::PARAM_STR);
        $stmt->bindValue(":email", $admin->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(":phoneNumber", $admin->getPhoneNumber(), PDO::PARAM_STR);
        $stmt->bindValue(":birthDate", $admin->getBirthDate(), PDO::PARAM_STR);
        $stmt->bindValue(":adminname", $admin->getadminname(), PDO::PARAM_STR);
        $stmt->bindValue(":password", $admin->getPassword(), PDO::PARAM_STR);
    }



    public static function saveObj($obj){
        $saveAdmin = FEntityManager::getInstance()->saveObject(self::getClass(), $obj);
        if($saveAdmin !== null){
            return $saveAdmin;
        }
        else{
            return false;
        }
    }


}

?>