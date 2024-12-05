<?php

Class FUser{

    private static $table = "User";
    private static $columns = " ('idImage', 'idUser')";
    private static $value = "(:idImage, :idUser)";
    private static $key = "idUser";


    public static function getTable() {return self::$table;}
    public static function getColumns() {return self::$columns;}
    public static function getValue() {return self::$value;}
    public static function getClass() {return self::class;}
    public static function getKey() {return self::$key;}


    /* public static function crateUserObj($queryResult){
        if(count($queryResult) == 1){
            $attributes = FEntityManagerSQL::getInstance()->retriveObj(self::getTable(), "idUser", $queryResult[0]['idUser']);

            $user = new EUser($queryResult[0]['name'], $queryResult[0]['surname'], $queryResult[0]['email'], $queryResult[0]['phoneNumber'], $queryResult[0]['birthDate'], $queryResult[0]['username'], $queryResult[0]['password']);
            $user->setId($queryResult[0]['idUser']);
            $user->setHashedPassword($queryResult[0]['password']);
            return $user;
        }elseif(count($queryResult) > 1){
            $users = array();
            for($i = 0; $i < count($queryResult); $i++){
                $attributes = FEntityManagerSQL::getInstance()->retriveObj(self::getTable(), "idUser", $queryResult[$i]['idUser']);

                $user = new EUser($queryResult[$i]['name'], $queryResult[$i]['surname'], $queryResult[$i]['email'],  $queryResult[0]['phoneNumber'], $queryResult[0]['birthDate'], $queryResult[0]['username'], $queryResult[0]['password']);
                $user->setId($queryResult[$i]['idUser']);
                $user->setHashedPassword($queryResult[$i]['password']);
                $users[] = $user;
            }
            return $users;
        }else{
            return array();
        }
    } */

    public static function createUserObj($queryResult){
        if(count($queryResult) == 1){
            $attributes = FEntityManager::getInstance()->retriveObj(self::getTable(), "idUser", $queryResult[0]['idUser']);
            $user = new EUser($queryResult[0]['name'], $queryResult[0]['surname'], $queryResult[0]['email'], $queryResult[0]['phoneNumber'], $queryResult[0]['birthDate'], $queryResult[0]['username'], $queryResult[0]['password']);
            $user->setId($queryResult[0]['idUser']);
            if(isset($attributes[0]['idImage'])) {
                $user->setIdImage($attributes[0]['idImage']);
            } else {
                $user->setIdImage(0);
            }
            return $user;
        }elseif(count($queryResult) > 1){
            $users = array();
            for($i = 0; $i < count($queryResult); $i++){
                $attributes = FEntityManager::getInstance()->retriveObj(self::getTable(), "idUser", $queryResult[$i]['idUser']);
                $user = new EUser($queryResult[0]['name'], $queryResult[0]['surname'], $queryResult[0]['email'], $queryResult[0]['phoneNumber'], $queryResult[0]['birthDate'], $queryResult[0]['username'], $queryResult[0]['password']);
                $user->setId($queryResult[$i]['idUser']);
                $user->setIdImage($attributes[0]['idImage']);
                $users[] = $user;
            }
            return $users;
        }else{
            return array();
        }
    }

    public static function getObj($id) {
        $result = FEntityManager::getInstance()->retriveObj(FPerson::getTable(), self::getKey(), $id);
        //var_dump($result);
        if(count($result) > 0){
            $user = self::createUserObj($result);
            return $user;
        }else{
            return null;
        }

    }

    public static function bind($stmt, $user, $id){
        $stmt->bindValue(":idImage", $user->getIdImage(), PDO::PARAM_INT);
        $stmt->bindValue(":idUser", $id, PDO::PARAM_INT);
    }

    public static function saveObj($obj, $fieldArray = null){
        if($fieldArray === null) {
            try{
                FEntityManager::getInstance()->getDb()->beginTransaction();
                $savePersonAndLastInsertedID = FEntityManager::getInstance()->saveObject(FPerson::getClass(), $obj);
                if($savePersonAndLastInsertedID !== null){
                    $saveUser = FEntityManager::getInstance()->saveObjectFromId(self::getClass(), $obj, $savePersonAndLastInsertedID);
                    FEntityManager::getInstance()->getDb()->commit();
                    if($saveUser){
                        return $savePersonAndLastInsertedID;
                    }
                }else{
                    return false;
                }
            }catch(PDOException $e){
                echo "ERROR " . $e->getMessage();
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            }finally{
                FEntityManager::getInstance()->closeConnection();
            } 
        } else {
            try {
                FEntityManager::getInstance()->getDb()->beginTransaction();
                foreach($fieldArray as $fv) {
                    if($fv[0] == "idUser" || $fv[0] == "idImage") {
                        FEntityManager::getInstance()->updateObj(FUser::getTable(), $fv[0], $fv[1], self::getKey(), $obj->getId());
                    } else {
                        FEntityManager::getInstance()->updateObj(FPerson::getTable(), $fv[0], $fv[1], self::getKey(), $obj->getId());
                    }    
                } 
                FEntityManager::getInstance()->getDb()->commit();
                return true;
            } catch (PDOException $e) {
                echo "ERROR " . $e->getMessage();
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally{
                FEntityManager::getInstance()->closeConnection();
            } 
        }
    }

    public static function getUserByUsername($username){
        $result = FEntityManager::getInstance()->retriveObj(FPerson::getTable(), 'username', $username);
        return $result;
    }

    public static function getUserById($id){
        $result = FEntityManager::getInstance()->retriveObj(FPerson::getTable(), 'idUser', $id);
        return $result;
    }

    public static function getUsersFromUsernameOrNameOrSurname($username, $name, $surname) {
        $result = FEntityManager::getInstance()->retriveObjForSearch(FPerson::getTable(), $username, $name, $surname);
        return $result;
    }

    public static function getUsers() {
        $result = FEntityManager::getInstance()->retriveAllObj(FPerson::getTable());
        return $result;
    }




}

?>