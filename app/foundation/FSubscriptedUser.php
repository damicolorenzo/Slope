<?php

require_once("FEntityManager.php");


Class FSubscriptedUser{

    private static $table = "SubscriptedUser";
    private static $columns = " ('idSubscriptedUser', 'name', 'surname', 'email', 'phoneNumber', 'birthDate', 'username', 'password', 'yearStart')";
    private static $value = "(NULL, :name, :surname, :email, :phoneNumber, :birthDate, :username, :password, :yearStart)";
    private static $key = "idSubscriptedUser";


    public static function getTable() {return self::$table;}
    public static function getColumns() {return self::$columns;}
    public static function getValue() {return self::$value;}
    public static function getClass() {return self::class;}
    public static function getKey() {return self::$key;}


    public static function crateUserObj($queryResult){
        if(count($queryResult) == 1){
            $attributes = FEntityManagerSQL::getInstance()->retriveObj(self::getTable(), "idSubscriptedUser", $queryResult[0]['idSubscriptedUser']);

            $user = new EUser($queryResult[0]['name'], $queryResult[0]['surname'], $queryResult[0]['email'], $queryResult[0]['phoneNumber'], $queryResult[0]['birthDate'], $queryResult[0]['username'], $queryResult[0]['password'], $queryResult[0]['yearStart']);
            $user->setId($queryResult[0]['idSubscriptedUser']);
            $user->setHashedPassword($queryResult[0]['password']);
            $user->setYearStart($queryResult[0]['yearStart']);
            return $user;
        }elseif(count($queryResult) > 1){
            $users = array();
            for($i = 0; $i < count($queryResult); $i++){
                $attributes = FEntityManagerSQL::getInstance()->retriveObj(self::getTable(), "idSubscriptedUser", $queryResult[$i]['idSubscriptedUser']);

                $user = new EUser($queryResult[$i]['name'], $queryResult[$i]['surname'], $queryResult[$i]['email'],  $queryResult[0]['phoneNumber'], $queryResult[0]['birthDate'], $queryResult[0]['username'], $queryResult[0]['password'], $queryResult[0]['yearStart']);
                $user->setId($queryResult[$i]['idSubscriptedUser']);
                $user->setHashedPassword($queryResult[$i]['password']);
                $user->setYearStart($queryResult[0]['yearStart']);
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