<?php

Class FPerson{

    private static $table = "person";
    private static $columns = " ('idUser', 'name', 'surname', 'email', 'phoneNumber', 'birthDate')";
    private static $value = "(NULL, :name, :surname, :email, :phoneNumber, :birthDate)";
    private static $key = "idUser";


    public static function getTable() {return self::$table;}
    public static function getColumns() {return self::$columns;}
    public static function getValue() {return self::$value;}
    public static function getClass() {return self::class;}
    public static function getKey() {return self::$key;}


    /* public static function getObj($id) :array {
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        return $result;
    } */


    /**
     * Binds the values of a paymeny object to a prepared SQL statement.
     * @param object $stmt The PDO statement object used for query execution.
     * @param EPerson $person An object representing a person
     * @return void
     */
    public static function bind(object $stmt, EPerson $person){
        //$stmt->bindValue(":idUser", $person->getId(), PDO::PARAM_INT);
        $stmt->bindValue(":name", $person->getName(), PDO::PARAM_STR);
        $stmt->bindValue(":surname", $person->getSurname(), PDO::PARAM_STR);
        $stmt->bindValue(":email", $person->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(":phoneNumber", $person->getPhoneNumber(), PDO::PARAM_STR);
        $stmt->bindValue(":birthDate", $person->getBirthDate(), PDO::PARAM_STR);
    }

    /**
     * Method to get a user using the id of the ski facility that it refers to
     * @param string $id user id
     * @return array $result
     */
    public static function getPerson(string $id) : array{
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        if(count($result) > 0){
            $user = self::createPersonObj($result);
            return $user;
        }else{
            return [];
        }
    }

    /**
     * Method to create an object or a set of object from a query
     * @param array $queryResult Refers to the result of a query
     * @return array of objects 
     */
    public static function createPersonObj(array $queryResult) : array{
        if(count($queryResult) == 1){
            $personA = [];
            $person = new EPerson($queryResult[0]['name'], $queryResult[0]['surname'], $queryResult[0]['email'], $queryResult[0]['phoneNumber'], $queryResult[0]['birthDate']);
            $person->setId($queryResult[0]['idUser']);
            $personA[] = $person;
            return $personA;
        }elseif(count($queryResult) > 1){
            $people = [];
            for($i = 0; $i < count($queryResult); $i++){
                $person = new EPerson($queryResult[$i]['name'], $queryResult[$i]['surname'], $queryResult[$i]['email'], $queryResult[$i]['phoneNumber'], $queryResult[$i]['birthDate']);
                $person->setId($queryResult[$i]['idUser']);
                $people[] = $person;
            }
            return $people;
        }else{
            return [];
        }
    }

    /**
     * Method to save an object in the database using the proper FEntityManager function
     * @param EPerson $obj Refers to a person Entity object that needs to be stored in the database
     * @param array $fieldArray Refers to an array of fields and values
     * @return bool true if succeded and false if failed
     */
    public static function saveObj(EPerson $obj, ?array $fieldArray = null) : bool{
        if($fieldArray === null) {
            try{
                FEntityManager::getInstance()->getDb()->beginTransaction();
                $savePersonAndLastInsertedID = FEntityManager::getInstance()->saveObject(FPerson::getClass(), $obj);
                $obj->setId($savePersonAndLastInsertedID);
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
                    FEntityManager::getInstance()->updateObj(FPerson::getTable(), $fv[0], $fv[1], self::getKey(), $obj->getId());    
                } 
                FEntityManager::getInstance()->getDb()->commit();
                return true;
            } catch (PDOException $e) {
                error_log("Database error in FPerson saveObj: " . $e->getMessage());
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
     * Method to get an user object using the email
     * @param string $email
     * @return array $result
     */
    public static function getPersonByEmail(string $email) : array{
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), 'email', $email);
        return $result;
    }

    /* public static function saveObj($obj){
        $savePerson = FEntityManager::getInstance()->saveObject(self::getClass(), $obj);
        if($savePerson !== null){
            return $savePerson;
        }
        else{
            return false;
        }
    } */

    


}

?>