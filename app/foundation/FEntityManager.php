<?php

require_once(__DIR__."\\..\\config\\config.php");

class FEntityManager {

    private static $instance;
    private static $db;

    private function __construct() {
        try {
            self::$db = new PDO("mysql:dbname=".DB_NAME.";host=".DB_HOST.";charset=utf8;", DB_USER, DB_PASS);
        } catch(PDOException $e) {
            echo "ERROR".$e->getMessage();
            die;
        } 
    }

    public static function getInstance() :FEntityManager {
        if(!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function getDb() :PDO {return self::$db;}
    public static function closeConnection() :void {static::$instance = null;}


    /**
     * Method to return rows from a query SELECT FROM @table WHERE @field = @id
     * @param Sring $table Refers to the table of the Database
     * @param String $field  Refers to a field of the table
     * @param mixed $id Refers to the value in the where clause
     * @return array
     */
    public static function retriveObj($table, $field, $id) :array {
        try {
            $query = "SELECT * FROM ".$table. " WHERE ".$field." = '".$id."';";
            $statement = self::$db->prepare($query);
            $statement->execute();
            $numberOfRows = $statement->rowCount();
            if($numberOfRows > 0) {
                $result = array();
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                while($row = $statement->fetch()) {
                    $result[] = $row;
                }
                return $result;
            } else {
                return array();
            }
        } catch(PDOException $e) {
            echo "ERROR" .$e->getMessage();
            return array();
        } 
    }

    public static function retriveObj2($table, $field1, $id1, $field2, $id2) :array {
        try {
            $query = "SELECT * FROM ".$table. " WHERE ".$field1." = '".$id1."' AND ".$field2." = ".$id2.";";
            echo $query;
            $statement = self::$db->prepare($query);
            $statement->execute();
            $numberOfRows = $statement->rowCount();
            if($numberOfRows > 0) {
                $result = array();
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                while($row = $statement->fetch()) {
                    $result[] = $row;
                }
                return $result;
            } else {
                return array();
            }
        } catch(PDOException $e) {
            echo "ERROR" .$e->getMessage();
            return array();
        } 
    }

    public static function selectObj($field, $table) {
        try {
            $query = "SELECT " . $field. " FROM ".$table.";";
            $statement = self::$db->prepare($query);
            $statement->execute();
            $numberOfRows = $statement->rowCount();
            if($numberOfRows > 0) {
                $result = array();
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                while($row = $statement->fetch()) {
                    $result[] = $row;
                }
                return $result;
            } else {
                return array();
            }
        } catch(PDOException $e) {
            echo "ERROR" .$e->getMessage();
            return array();
        } 
    }

    public static function selectObjKey($field, $table, $field2, $extKey) {
        try {
            $query = "SELECT " . $field. " FROM ".$table." WHERE ".$field2." = '".$extKey. "';";
            echo $query;
            $statement = self::$db->prepare($query);
            $statement->execute();
            $result = $statement->fetch();
            return $result[0];
        } catch(PDOException $e) {
            echo "ERROR" .$e->getMessage();
            return array();
        } 
    }

    public static function selectAllObjKey($field, $table) {
        try {
            $query = "SELECT " . $field. " FROM ".$table.";";
            $statement = self::$db->prepare($query);
            $statement->execute();
            $numberOfRows = $statement->rowCount();
            if($numberOfRows > 0) {
                $result = array();
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                while($row = $statement->fetch()) {
                    $result[] = $row;
                }
                return $result;
            } else {
                return array();
            }
        } catch(PDOException $e) {
            echo "ERROR" .$e->getMessage();
            return array();
        } 
    }

    public static function countObjId($table, $field, $extId) {
        try {
            $query = "SELECT COUNT(*) as CNT FROM ".$table." WHERE ". $field. " = ". $extId. ";";
            $statement = self::$db->prepare($query);
            $statement->execute();
            $count = $statement->fetch();
            return $count;
        } catch(PDOException $e) {
            echo "ERROR" .$e->getMessage();
            return array();
        } 
    }

    public static function retriveAllObj($table) :array {
        try {
            $query = "SELECT * FROM ".$table.";";
            $statement = self::$db->prepare($query);
            $statement->execute();
            $numberOfRows = $statement->rowCount();
            if($numberOfRows > 0) {
                $result = array();
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                while($row = $statement->fetch()) {
                    $result[] = $row;
                }
                return $result;
            } else {
                return array();
            }
        } catch(PDOException $e) {
            echo "ERROR" .$e->getMessage();
            return array();
        } 
    }

    public static function typeAndNumberSkiRun($table, $key, $id) {
        try {
            $query = "SELECT COUNT(*) as CNT, type FROM ".$table." WHERE ".$key." = ".$id." GROUP BY type";
            $statement = self::$db->prepare($query);
            $statement->execute();
            $numberOfRows = $statement->rowCount();
            if($numberOfRows > 0) {
                $result = array();
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                while($row = $statement->fetch()) {
                    $result[] = $row;
                }
                return $result;
            } else {
                return array();
            }
        } catch(PDOException $e) {
            echo "ERROR" .$e->getMessage();
            return array();
        }
    }

    public static function retriveObjForSearch($table, $username, $name, $surname) {
        try {
            if($username === '') {
                $name = str_replace("'", "\\'", $name);
                $surname = str_replace("'", "\\'", $surname);
                $query = "SELECT * FROM ".$table." WHERE (name LIKE '%".$name."%' AND surname LIKE '%".$surname."%');";
            }
            if($name === '' || $surname === '') {
                $username = str_replace("'", "\\'", $username);
                $query = "SELECT * FROM ".$table." WHERE (username LIKE '%".$username."%');";
            }
            $statement = self::$db->prepare($query);
            $statement->execute();
            $numberOfRows = $statement->rowCount();
            if($numberOfRows > 0) {
                $result = array();
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                while($row = $statement->fetch()) {
                    $result[] = $row;
                }
                return $result;
            } else {
                return array();
            }
        } catch (PDOException $e) {
            echo "ERROR" . $e->getMessage();
            return array();
        }
    }
    /**
     * Method to save an object in the Database using the INSERT TO query
     * @param String $foundClass Refers to the name of the foundation class, so you can get the table and the value
     * @param Object $obj Refers to an Entity Object to save in the Database
     * @return int | null
     */
    public static function saveObject($foundClass, $obj)
    {
        try{
            $query = "INSERT INTO " . $foundClass::getTable() . " VALUES" . $foundClass::getValue();
            echo $query;
            $stmt = self::$db->prepare($query);
            $foundClass::bind($stmt, $obj);
            $stmt->execute();
            $id = self::$db->lastInsertId();
            return $id;
        }catch(Exception $e){
            echo "ERROR: " . $e->getMessage();
            return null;
        }
    }

    /**
     * Method to store an object in the Database if we only have the id and we need to store only the id
     * @param String $foundClass Refers to the name of the foundation class, so you can get the table and the value
     * @param int $id Refers to an Entity Object id to save in the Database
     * @return bool
     */
    public static function saveObjectFromId($foundClass, $obj, $id)
    {
        try{
            $query = "INSERT INTO " . $foundClass::getTable() . " VALUES " . $foundClass::getValue();
            $stmt = self::$db->prepare($query);
            $foundClass::bind($stmt, $obj, $id);
            $stmt->execute();
            return true;
        }catch(Exception $e){
            echo "ERROR: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Method to check if the query return or not a row
     * @param array $queryResult Is the output of a query
     * @return bool   
     */
    public static function existInDb($queryResult) :bool {
        if(count($queryResult) > 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Method to update rows with UPDATE @table SET @field = @fieldValue WHERE @cond = @condvalue
     * @param Sring $table Refers to the table of the Database
     * @param String $field  Refers to the field to update
     * @param mixed $fieldvalue Refers to the value to update
     * @param String  $cond Refers to the Where condition
     * @param mixed $condvalue Refers to the value of the condition
     * @return bool
     */
    public static function updateObj($table, $field, $fieldValue, $cond, $condValue){
        try{
            $query = "UPDATE " . $table . " SET ". $field. " = '" . $fieldValue . "' WHERE " . $cond . " = '" . $condValue . "';";
            echo $query;
            $stmt = self::$db->prepare($query);
            $stmt->execute();
            return true;
        }catch(Exception $e){
            echo "ERROR: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Method to delete a row from the Database with query DELETE FROM WHERE
     * @param Sring $table Refers to the table of the Database
     * @param String $field  Refers to a field of the table
     * @param mixed $id Refers to the value in the where clause
     * @return boolean
     */
    public static function deleteObjInDb($table, $field, $id){
        try{
            $query = "DELETE FROM " . $table . " WHERE " . $field . " = '".$id."';";
            $stmt = self::$db->prepare($query);
            $stmt->execute();
            return true;
        }catch(Exception $e){
            echo "ERROR: " . $e->getMessage();
            return false;
        }
    }



}

?>