<?php

require_once("../config/config.php");

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
}

?>