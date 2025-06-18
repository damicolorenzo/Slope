<?php

require_once("FEntityManager.php");


Class FAdmin{

    private static $table = "admin";
    private static $value = "(:idAdmin, :username, :password)";
    private static $key = "idAdmin";

    public static function getTable() {return self::$table;}
    public static function getValue() {return self::$value;}
    public static function getKey() {return self::$key;}
    public static function getClass() {return self::class;}

    /**
     * Method to create an object or a set of object from a query
     * @param array $queryResult Refers to the result of a query
     * @return mixed an object, array of objects, or empty array 
     */
    public static function createAdminObj(array $queryResult) : array{
        if(count($queryResult) == 1) {
            $adminA = [];
            $admin = new EAdmin($queryResult[0]['username'], $queryResult[0]['password']);
            $admin->setIdAdmin($queryResult[0]['idAdmin']);
            $adminA[] = $admin;
            return $adminA;
        } elseif(count($queryResult) > 1) {
            $admins = array();
            for($i = 0; $i < count($queryResult); $i++){
                $admin = new EAdmin($queryResult[$i]['username'], $queryResult[$i]['password']);
                $admin->setIdAdmin($queryResult[$i]['idAdmin']);
                $admins[] = $admin;
            }
            return $admins;
        } else {
            return [];
        }
    }

    /**
     * Method to get an object using the id, invoke the createAdminObj function 
     * @param string $id Refers to the id
     * @return array 
     */
    public static function getObj(string $id) : array{
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        if(count($result) > 0) {
            $admin = self::createAdminObj($result);
            return $admin;
        } else {
            return [];
        }
    }

    /**
     * Binds the values of a person object to a prepared SQL statement.
     * @param object $stmt The PDO statement object used for query execution.
     * @param object $person An object representing a user, expected to have getId(), getUsername(), and getPassword() methods.
     * @return void
     */
    public static function bind(object $stmt, object $person) : void{
        $stmt->bindValue(":idAdmin", $person->getIdAdmin(), PDO::PARAM_INT);
        $stmt->bindValue(":username", $person->getUsername(), PDO::PARAM_STR);
        $stmt->bindValue(":password", $person->getPassword(), PDO::PARAM_STR);
    }

    /**
     * Method to save an object in the database using the proper FEntityManager function
     * @param object $obj Refers to an Entity object that needs to be stored in the database
     * @return bool true if succeded and false if failed
     */
    public static function saveObj(EAdmin $obj) : bool{
        $savePerson = FEntityManager::getInstance()->saveObject(self::getClass(), $obj);
        if($savePerson !== null){
            FEntityManager::getInstance()->saveObject(self::getClass(), $obj);
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Method to get an admin object using the username 
     * @param string $username Refers to the username
     * @return array returns the object or null
     */
    public static function getAdminByUsername(string $username) : array{
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), 'username', $username);
        return $result;
    }

    public static function verifyUsername(string $field, string $value) : bool{
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), $field, $value);
        return FEntityManager::getInstance()->existInDb($result);
    }

    public static function verify(string $field, int $value) : bool{
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), $field, $value);
        return FEntityManager::getInstance()->existInDb($result);
    }

}

?>