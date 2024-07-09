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
            #print($query); #TEST
            $stmt = self::$db->prepare($query);
            $foundClass::bind($stmt, $obj);
            $stmt->execute();
            #print_r($stmt); #TEST 
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
            //var_dump($stmt);
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



}

?>