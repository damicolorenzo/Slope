<?php

require_once("FEntityManager.php");


Class FAdmin{

    private static $table = "admin";
    private static $value = "(:idUser)";
    private static $key = "idUser";


    public static function getTable() {return self::$table;}
    public static function getValue() {return self::$value;}
    public static function getClass() {return self::class;}
    public static function getKey() {return self::$key;}


    public static function crateAdminObj($queryResult){
        if(count($queryResult) == 1){
            $admin = new EAdmin($queryResult[0]['name'], $queryResult[0]['surname'], $queryResult[0]['email'], $queryResult[0]['phoneNumber'], $queryResult[0]['birthDate'], $queryResult[0]['username'], $queryResult[0]['password']);
            $admin->setId($queryResult[0]['idUser']);
            $admin->setPassword($queryResult[0]['password']);
            return $admin;
        }
    }

    public static function getObj($id) {
        $result = FEntityManager::getInstance()->retriveObj(FPerson::getTable(), FAdmin::getKey(), $id);
        if(count($result) > 0) {
            $admin = self::crateAdminObj($result);
            return $admin;
        } else {
            return null;
        }
    }


    public static function bind($stmt, $id){
        $stmt->bindValue(":idUser", $id, PDO::PARAM_INT);
    }



    public static function saveObj($obj){
        $savePerson = FEntityManager::getInstance()->saveObject(FPerson::getClass(), $obj);
        if($savePerson !== null){
            $saveAdmin = FEntityManager::getInstance()->saveObjectFromId(self::getClass(), $obj, $savePerson);
            return $saveAdmin;
        }
        else{
            return false;
        }
    }

    public static function getAdminByUsername($username) {
        $result = FEntityManager::getInstance()->retriveObj(FPerson::getTable(), 'username', $username);
        if($result !== null && count($result) > 0) {
            $user = self::crateAdminObj($result);
            return $user;
        } else {
            return null;
        }
    }


}

?>