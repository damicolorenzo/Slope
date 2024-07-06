<?php

require_once("FEntityManager.php");


Class FRegisteredUser{

    private static $table = "RegisteredUser";
    private static $columns = " ('idRegisteredUser', 'name', 'surname', 'email', 'phoneNumber', 'birthDate', 'username', 'password')";
    private static $value = "(NULL, :name, :surname, :email, :phoneNumber, :birthDate, :username, :password)";
    private static $key = "idRegisteredUser";


    public static function getTable() {return self::$table;}
    public static function getColumns() {return self::$columns;}
    public static function getValue() {return self::$value;}
    public static function getClass() {return self::class;}
    public static function getKey() {return self::$key;}



    public static function crateUserObj($queryResult){
        if(count($queryResult) == 1){
            $attributes = FEntityManagerSQL::getInstance()->retriveObj(self::getTable(), "idRegisteredUser", $queryResult[0]['idRegisteredUser']);

            $user = new EUser($queryResult[0]['name'], $queryResult[0]['surname'], $queryResult[0]['email'], $queryResult[0]['phoneNumber'], $queryResult[0]['birthDate'], $queryResult[0]['username'], $queryResult[0]['password']);
            $user->setId($queryResult[0]['idRegisteredUser']);
            $user->setHashedPassword($queryResult[0]['password']);
            return $user;
        }elseif(count($queryResult) > 1){
            $users = array();
            for($i = 0; $i < count($queryResult); $i++){
                $attributes = FEntityManagerSQL::getInstance()->retriveObj(self::getTable(), "idRegisteredUser", $queryResult[$i]['idRegisteredUser']);

                $user = new EUser($queryResult[$i]['name'], $queryResult[$i]['surname'], $queryResult[$i]['email'],  $queryResult[0]['phoneNumber'], $queryResult[0]['birthDate'], $queryResult[0]['username'], $queryResult[0]['password']);
                $user->setId($queryResult[$i]['idRegisteredUser']);
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




    public static function bind($stmt, $registeredUser){
        $stmt->bindValue(":name", $registeredUser->getName(), PDO::PARAM_STR);
        $stmt->bindValue(":surname", $registeredUser->getSurame(), PDO::PARAM_STR);
        $stmt->bindValue(":email", $registeredUser->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(":phoneNumber", $registeredUser->getPhoneNumber(), PDO::PARAM_STR);
        $stmt->bindValue(":birthDate", $registeredUser->getBirthDate(), PDO::PARAM_STR);
        $stmt->bindValue(":username", $registeredUser->getUsername(), PDO::PARAM_STR);
        $stmt->bindValue(":password", $registeredUser->getPassword(), PDO::PARAM_STR);
    }



    public static function saveObj($obj){
        $saveRegisteredUser = FEntityManager::getInstance()->saveObject(self::getClass(), $obj);
        if($saveRegisteredUser !== null){
            return $saveRegisteredUser;
        }
        else{
            return false;
        }
    }


}

?>