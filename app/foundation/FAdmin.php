<?php

require_once("FEntityManager.php");


Class FAdmin{

    private static $table = "Admin";
    private static $columns = " ('idAdmin', 'name', 'surname', 'email', 'phoneNumber', 'birthDate', 'password')";
    private static $value = "(NULL, :name, :surname, :email, :phoneNumber, :birthDate, :password)";
    private static $key = "idAdmin";


    public static function getTable() {return self::$table;}
    public static function getColumns() {return self::$columns;}
    public static function getValue() {return self::$value;}
    public static function getClass() {return self::class;}
    public static function getKey() {return self::$key;}


    public static function crateUserObj($queryResult){
        if(count($queryResult) == 1){
            $attributes = FEntityManagerSQL::getInstance()->retriveObj(self::getTable(), "idAdmin", $queryResult[0]['idAdmin']);

            $user = new EUser($queryResult[0]['name'], $queryResult[0]['surname'], $queryResult[0]['email'], $queryResult[0]['phoneNumber'], $queryResult[0]['birthDate'], $queryResult[0]['username'], $queryResult[0]['password']);
            $user->setId($queryResult[0]['idAdmin']);
            $user->setHashedPassword($queryResult[0]['password']);
            return $user;
        }elseif(count($queryResult) > 1){
            $users = array();
            for($i = 0; $i < count($queryResult); $i++){
                $attributes = FEntityManagerSQL::getInstance()->retriveObj(self::getTable(), "idAdmin", $queryResult[$i]['idAdmin']);

                $user = new EUser($queryResult[$i]['name'], $queryResult[$i]['surname'], $queryResult[$i]['email'],  $queryResult[0]['phoneNumber'], $queryResult[0]['birthDate'], $queryResult[0]['username'], $queryResult[0]['password']);
                $user->setId($queryResult[$i]['idAdmin']);
                $user->setHashedPassword($queryResult[$i]['password']);
                $users[] = $user;
            }
            return $users;
        }else{
            return array();
        }
    }




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