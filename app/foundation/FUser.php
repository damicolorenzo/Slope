<?php

Class FUser{

    private static $table = "user";
    private static $columns = "('idImage', 'idUser', 'username', 'password')";
    private static $value = "(:idImage, :idUser, :username, :password)";
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

    /**
     * Method to create an object or a set of object from a query
     * @param array $queryResult Refers to the result of a query
     * @return array of objects 
     */
    /*
    public static function createUserObj(array $queryResult) : array{
        if(count($queryResult) == 1){
            $userA = [];
            $person = FEntityManager::getInstance()->retriveObj(FPerson::getTable(), "idUser", $queryResult[0]['idUser']);
            $user = FEntityManager::getInstance()->retriveObj(FUser::getTable(), "idUser", $queryResult[0]['idUser']);
            //print_r($person);
            if($person == [])
                    $user = new EUser(null, null, null, null, null, $queryResult[0]['username'], $queryResult[0]['password']);
                else
                    $user = new EUser($person[0]['name'], $person[0]['surname'], $person[0]['email'], $person[0]['phoneNumber'], $person[0]['birthDate'], $user[0]['username'], $user[0]['password']);
            $user->setId($queryResult[0]['idUser']);
            if(isset($queryResult[0]['idImage'])) {
                $user->setIdImage($queryResult[0]['idImage']);
            } else {
                $user->setIdImage(0);
            }
            $userA[] = $user;
            return $userA;
        }elseif(count($queryResult) > 1){
            $users = [];
            for($i = 0; $i < count($queryResult); $i++){
                $person = FEntityManager::getInstance()->retriveObj(FPerson::getTable(), "idUser", $queryResult[$i]['idUser']);
                if($person == [])
                    $user = new EUser(null, null, null, null, null, $queryResult[$i]['username'], $queryResult[$i]['password']);
                else
                    $user = new EUser($person[$i]['name'], $person[$i]['surname'], $person[$i]['email'], $person[$i]['phoneNumber'], $person[$i]['birthDate'], $queryResult[$i]['username'] ?? "", $queryResult[$i]['password'] ?? "");
                $user->setId($queryResult[$i]['idUser']);
                if(isset($queryResult[$i]['idImage'])) {
                    $user->setIdImage($queryResult[$i]['idImage']);
                } else {
                    $user->setIdImage(0);
                }
                $users[] = $user;
            }
            return $users;
        }else{
            return [];
        }
    }
    /** */

    public static function createUserObj(array $queryResult) : array {
        if (count($queryResult) == 1) {
            $userA = [];
            $person = FEntityManager::getInstance()->retriveObj(FPerson::getTable(), "idUser", $queryResult[0]['idUser']);
    
            // Verifica se $person ha almeno un elemento
            if (!empty($person)) {
                $personData = $person[0]; // Usa sempre l'indice 0
                $user = new EUser(
                    $personData['name'],
                    $personData['surname'],
                    $personData['email'],
                    $personData['phoneNumber'],
                    $personData['birthDate'],
                    $queryResult[0]['username'] ?? "",
                    $queryResult[0]['password'] ?? ""
                );
            } else {
                // Se $person è vuoto, usa stringhe vuote invece di null
                $user = new EUser("", "", "", "", "", $queryResult[0]['username'] ?? "", $queryResult[0]['password'] ?? "");
            }
    
            $user->setId($queryResult[0]['idUser']);
            $user->setIdImage($queryResult[0]['idImage'] ?? 0);
    
            $userA[] = $user;
            return $userA;
    
        } elseif (count($queryResult) > 1) {
            $users = [];
            for ($i = 0; $i < count($queryResult); $i++) {
                $person = FEntityManager::getInstance()->retriveObj(FPerson::getTable(), "idUser", $queryResult[$i]['idUser']);
    
                if (!empty($person)) {
                    $personData = $person[0]; // Usa sempre l'indice 0
                    $user = new EUser(
                        $personData['name'],
                        $personData['surname'],
                        $personData['email'],
                        $personData['phoneNumber'],
                        $personData['birthDate'],
                        $queryResult[$i]['username'] ?? "",
                        $queryResult[$i]['password'] ?? ""
                    );
                } else {
                    $user = new EUser("", "", "", "", "", $queryResult[$i]['username'] ?? "", $queryResult[$i]['password'] ?? "");
                }
    
                $user->setId($queryResult[$i]['idUser']);
                $user->setIdImage($queryResult[$i]['idImage'] ?? 0);
    
                $users[] = $user;
            }
            return $users;
        } else {
            return [];
        }
    }
    
    /**
     * Method to get a user using the id of the ski facility that it refers to
     * @param string $id user id
     * @return mixed $result
     */
    public static function getObj(string $id) : mixed{
        $result = FEntityManager::getInstance()->retriveObj(FUser::getTable(), self::getKey(), $id);
        if(count($result) > 0){
            $user = self::createUserObj($result);
            return $user;
        }else{
            return [];
        }
    }

    /**
     * Binds the values of a person object to a prepared SQL statement.
     * @param object $stmt The PDO statement object used for query execution.
     * @param EUser $user An object representing a user
     * @return void
     */
    public static function bind(object $stmt, EUser $user) : void{
        $stmt->bindValue(":idImage", $user->getIdImage(), PDO::PARAM_INT);
        $stmt->bindValue(":idUser", $user->getIdUser(), PDO::PARAM_INT);
        $stmt->bindValue(":username", $user->getUsername(), PDO::PARAM_STR);
        $stmt->bindValue(":password", $user->getPassword(), PDO::PARAM_STR);
    }

    /**
     * Method to save an object in the database using the proper FEntityManager function
     * @param EUser $obj Refers to a user Entity object that needs to be stored in the database
     * @param array $fieldArray Refers to an array of fields and values
     * @return bool true if succeded and false if failed
     */
    public static function saveObj(EUser $obj, ?array $fieldArray = null) : bool{
        if($fieldArray === null) {
            try{
                FEntityManager::getInstance()->getDb()->beginTransaction();
                $savePersonAndLastInsertedID = FEntityManager::getInstance()->saveObject(FPerson::getClass(), $obj);
                // Controlla se l'ID ottenuto è valido
                if (!empty($savePersonAndLastInsertedID) && is_numeric($savePersonAndLastInsertedID)) {
                    $obj->setId((int) $savePersonAndLastInsertedID);
                } else {
                    error_log("Errore: L'ID restituito è NULL in FUser::saveObj");
                    FEntityManager::getInstance()->getDb()->rollBack();
                    return false;
                }
                if($savePersonAndLastInsertedID !== null){
                    $saveUser = FEntityManager::getInstance()->saveObjectFromId(self::getClass(), $obj, $savePersonAndLastInsertedID);
                    FEntityManager::getInstance()->getDb()->commit();
                    if($saveUser){
                        return true;
                    }
                }else{
                    return false;
                }
            }catch(PDOException $e){
                error_log("Database error in FUser saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            }finally{
                FEntityManager::getInstance()->closeConnection();
            } 
        } else {
            try {
                FEntityManager::getInstance()->getDb()->beginTransaction();
                foreach($fieldArray as $fv) {
                    FEntityManager::getInstance()->updateObj(FUser::getTable(), $fv[0], $fv[1], self::getKey(), $obj->getId());    
                } 
                FEntityManager::getInstance()->getDb()->commit();
                return true;
            } catch (PDOException $e) {
                error_log("Database error in FUser saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally{
                FEntityManager::getInstance()->closeConnection();
            } 
        }
    }

    /**
     * Method to verify if a person exist using a field and a value
     * @param string $field field 
     * @param string $value value
     * @return bool true if exist false if not exist
     */
    public static function verify(string $field, string $id) : bool{
        $queryResult = FEntityManager::getInstance()->retriveObj(self::getTable(), $field, $id);
        return FEntityManager::getInstance()->existInDb($queryResult);
    }

    /**
     * Method to get an user object using the username
     * @param string $username
     * @return array $result
     */
    public static function getUserByUsername(string $username) : array{
        $result = FEntityManager::getInstance()->retriveObj(FUser::getTable(), 'username', $username);
        return $result;
    }

    /**
     * Method to get an user object using the id
     * @param string $id id of the user
     * @return array $result
     */
    public static function getUserById(string $id) : array{
        $result = FEntityManager::getInstance()->retriveObj(FUser::getTable(), 'idUser', $id);
        return $result;
    }

    /**
     * Method to get an user object using the username, the name and the surname
     * @param string $username
     * @param string $name
     * @param string $surname
     * @return array $result
     */
    public static function getUsersFromUsernameOrNameOrSurname(string $name, string $surname) : array{
        $conditions = [["name", $name] , ["surname", $surname]];
        $result = FEntityManager::getInstance()->retriveObjForSearch(FPerson::getTable(), $conditions);
        return $result;
    }

    /**
     * Method to get all user object
     * @return array $result
     */
    public static function getUsers() : array{
        $result = FEntityManager::getInstance()->retriveAllObj(self::getTable());
        return $result;
    }


    public static function getUsersWithConditions(array $condition) : array{
        $result = FEntityManager::getInstance()->retriveObjNFields(self::getTable(), $condition);
        return $result;
    }
}

?>