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

    public static function crateUserObj($queryResult){
        if(count($queryResult) == 1){
            $attributes = FEntityManager::getInstance()->retriveObj(self::getTable(), "idUser", $queryResult[0]['idUser']);

            $user = new EUser($queryResult[0]['name'], $queryResult[0]['surname'], $queryResult[0]['email'], $queryResult[0]['phoneNumber'], $queryResult[0]['birthDate'], $queryResult[0]['username'], $queryResult[0]['password']);
            $user->setId($queryResult[0]['idUser']);
            $user->setIdImage($attributes[0]['idImage']);
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
            $user = self::crateUserObj($result);
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
        }
        
    }


}

?>