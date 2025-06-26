<?php

require_once(__DIR__."/../config/config.php");

class FEntityManager {

    private static $instance;
    private static $db;

    private function __construct() {
        try {
            self::$db = new PDO("mysql:dbname=".DB_NAME.";host=".DB_HOST.";charset=utf8;", DB_USER, DB_PASS);
        } catch(PDOException $e) {
            error_log("Database error " . $e->getMessage()); // Log instead of echo
            return null;
        } 
    }

    /**
     * Returns the singleton instance of the FEntityManager class.
     *
     * Ensures that only one instance of FEntityManager is created
     * and reused throughout the application (Singleton Pattern).
     *
     * @return FEntityManager The single instance of this class.
     */
    public static function getInstance() :FEntityManager {
        if(!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function getDb() :PDO {return self::$db;}
    public static function closeConnection() :void {static::$instance = null;}

    /**
     * Method to return rows from a query SELECT * FROM @table WHERE @field = @id
     * @param Sring $table Refers to the table in the database
     * @param String $field  Refers to a field of the table
     * @param int $id Refers to the value in the where clause
     * @throws PDOException in case occures an error with the query
     * @return array
     */
    public static function retriveObj(string $table, string $field, string $id) : ?array {
        try {
            $query = "SELECT * FROM {$table} WHERE {$field} = :id";
            //$query = "SELECT * FROM ".$table. " WHERE ".$field." = '".$id."';";
            $statement = self::$db->prepare($query);
            $statement->bindParam(':id', $id, PDO::PARAM_STR);  
            $statement->execute();
            $numberOfRows = $statement->rowCount();
            if($numberOfRows > 0) {
                $result = [];
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                while($row = $statement->fetch()) {
                    $result[] = $row;
                }
                return $result;
            } else {
                return [];
            }
        } catch(PDOException $e) {
            error_log("Database error in retriveObj: " . $e->getMessage()); // Log instead of echo
            return [];
            /* echo "ERROR" .$e->getMessage();
            return array(); */
        } 
    }
    
    /**
     * Retrieves records from a table based on multiple conditions.
     *
     * @param string $table The name of the database table.
     * @param array $conditions An associative array of field-value pairs for filtering. ($conditions = ['field1' => 'value1', 'field2' => 42];)
     * @return array The result set as an associative array.
     */
    public static function retriveObjNFields(string $table, array $conditions) : array {
        try {
            if(empty($conditions)) {
                throw new Exception("At least one condition must be provided.");
            }

            $fields = [];
            foreach ($conditions as $field) {
                $fields[] = "{$field[0]} = :{$field[0]}";
            }

            $condition = implode(" AND ", $fields);
            $query = "SELECT * FROM {$table} WHERE {$condition}";
            //print($query);
            $statement = self::$db->prepare($query);
            foreach ($conditions as $field) {
                if(is_int($field[1]))
                    $app = PDO::PARAM_INT;
                else
                    $app = PDO::PARAM_STR;
                $statement->bindValue(":{$field[0]}", $field[1], $app);
            }
            //print_r($statement);
            $statement->execute();
            $numberOfRows = $statement->rowCount();
            if($numberOfRows > 0) {
                $result = [];
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                while($row = $statement->fetch()) {
                    $result[] = $row;
                }
                return $result;
            } else {
                return [];
            }
        } catch (Exception $e) {
            error_log("Database error in retrieveObjNFields: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Method to save an object in the database using the INSERT INTO query
     * @param string $foundClass Refers to the name of the foundation class
     * @param object $obj Refers to an Entity object that needs to be stored in the database
     * @throws PDOException in case occures an error with the query
     * @return int | null, id of the object inserted in the db
     */
    public static function saveObject(string $foundClass, object $obj) : ?int {
        try{
            $table = $foundClass::getTable();
            $values = $foundClass::getValue();
            $query = "INSERT INTO {$table} VALUES {$values}";
            $stmt = self::$db->prepare($query);
            $foundClass::bind($stmt, $obj);
            $stmt->execute();
            $id = self::$db->lastInsertId();
            return (int) $id;
        }catch(Exception $e){
            print("Database error in saveObject: " . $e->getMessage()); // Log instead of echo
            return null;
        }
    }

    public static function saveObject1(string $foundClass, object $obj) : ?bool {
        try{
            $table = $foundClass::getTable();
            $values = $foundClass::getValue();
            $query = "INSERT INTO {$table} VALUES {$values}";
            //$query = "INSERT INTO " . $foundClass::getTable() . " VALUES" . $foundClass::getValue();
            $stmt = self::$db->prepare($query);
            $foundClass::bind($stmt, $obj);
            $stmt->execute();
            return true;
        }catch(Exception $e){
            error_log("Database error in saveObject: " . $e->getMessage()); // Log instead of echo
            return null;
        }
    }

    /**
     * Method to store an object in the database if we only have the id and we need to store only the id
     * @param string $foundClass Refers to the name of the foundation class, so you can get the table and the value
     * @param object $obj Refers to an Entity object that needs to be stored in the database
     * @param string $id Refers to an Entity Object id to save in the Database
     * @return bool
     */
    public static function saveObjectFromId(string $foundClass, object $obj, string $id) {
        try{
            $query = "INSERT INTO {$foundClass::getTable()} VALUES {$foundClass::getValue()}";
            $stmt = self::$db->prepare($query);
            $foundClass::bind($stmt, $obj, $id);
            $stmt->execute();
            return true;
        }catch(Exception $e){
            error_log("Database error in saveObjectFromId: " . $e->getMessage()); // Log instead of echo
            return false;
        }
    } 

    /**
     * Method to check if the query return or not a row
     * @param array $queryResult Is the output of a query
     * @return bool   
     */
    public static function existInDb(array $queryResult) :bool {
        if(count($queryResult) > 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Method to select a value from the database if we only have the field and the table
     * @param string $fiedl Refers to the name of the field in the table 
     * @param string $table Refers to a table in the database
     * @return array The result set as an associative array.
     */
    public static function selectObj(string $field, string $table) : array{
        try {
            $query = "SELECT {$field} FROM {$table}";
            //$query = "SELECT " . $field. " FROM ".$table.";";
            $statement = self::$db->prepare($query);
            $statement->execute();
            $numberOfRows = $statement->rowCount();
            if($numberOfRows > 0) {
                $result = [];
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                while($row = $statement->fetch()) {
                    $result[] = $row;
                }
                return $result;
            } else {
                return [];
            }
        } catch(PDOException $e) {
            error_log("Database error in selectObj: " . $e->getMessage()); // Log instead of echo
            return [];
        } 
    }

    /**
     * Method to select a value from the database if we only have the field, the table and a condition (where field2 = extKey)
     * @param string $field Refers to the name of the field in the table 
     * @param string $table Refers to a table in the database
     * @param string $field2 Refers to the name of the field in the where clause
     * @param string $extKey Refers to the value of the field in the where clause 
     * @return array The result set as an associative array.
     */
    public static function selectObjKey(string $field, string $table, string $field2, string $extKey) :array{
        try {
            $query = "SELECT {$field} FROM {$table} WHERE {$field2} = :extKey";
            $statement = self::$db->prepare($query);
            $statement->bindParam(':extKey', $extKey, PDO::PARAM_STR);
            $statement->execute();
            $result = $statement->fetch();
            if(!$result)
                return [];
            else
                return $result;
        } catch(PDOException $e) {
            error_log("Database error in selectObj: " . $e->getMessage()); // Log instead of echo
            return [];
        } 
    }

    /**
     * Method to count rows from a table if we only have a condition (where field = extId)
     * @param string $table Refers to a table in the database
     * @param string $field Refers to the name of the field in the where clause
     * @param string $extId Refers to the value of the field in the where clause 
     * @return int The result is the number of objects.
     */
    public static function countObjId(string $table, string $field, string $extId) : ?int{
        try {
            $query = "SELECT COUNT(*) as CNT FROM {$table} WHERE {$field} = {$extId}";
            $statement = self::$db->prepare($query);
            $statement->execute();
            $count = $statement->fetch();
            return $count['CNT'];
        } catch(PDOException $e) {
            error_log("Database error in countObjId: " . $e->getMessage()); // Log instead of echo
            return null;
        } 
    }

    /**
     * Method to retrive all rows from a table
     * @param string $table Refers to a table in the database 
     * @return array The result set as an associative array.
     */
    public static function retriveAllObj(string $table) :array {
        try {
            $query = "SELECT * FROM {$table}";
            $statement = self::$db->prepare($query);
            $statement->execute();
            $numberOfRows = $statement->rowCount();
            if($numberOfRows > 0) {
                $result = [];
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                while($row = $statement->fetch()) {
                    $result[] = $row;
                }
                return $result;
            } else {
                return [];
            }
        } catch(PDOException $e) {
            error_log("Database error in retriveAllObj: " . $e->getMessage()); // Log instead of echo
            return [];
        } 
    }

    /**
     * DA RIVEDERE
     * Method to count  
     * @param string $table Refers to a table in the database 
     * @return array The result set as an associative array.
     */
    public static function typeAndNumber($table, $key, $id) : array{
        try {
            $query = "SELECT COUNT(*) as CNT, type FROM {$table} WHERE {$key} = {$id} GROUP BY type";
            $statement = self::$db->prepare($query);
            $statement->execute();
            $numberOfRows = $statement->rowCount();
            if($numberOfRows > 0) {
                $result = [];
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                while($row = $statement->fetch()) {
                    $result[] = $row;
                }
                return $result;
            } else {
                return [];
            }
        } catch(PDOException $e) {
            error_log("Database error in typeAndNumberSkiRun: " . $e->getMessage()); // Log instead of echo
            return [];
        }
    }

    /**
     * DA RIVEDERE
     * Method to retrive all rows from a table
     * @param string $table Refers to a table in the database 
     * @return array The result set as an associative array.
     */
    public static function retriveObjForSearchAND($table, $conditions) {
        try { 
            $fields = [];
            foreach ($conditions as $field) {
                $fields[] = "{$field[0]} LIKE :{$field[0]}";
            }  
            $condition = implode(" AND ", $fields);
            $query = "SELECT * FROM {$table} WHERE {$condition}";
            $statement = self::$db->prepare($query);
            foreach ($conditions as $field) {
                if(is_int($field[1]))
                    $app = PDO::PARAM_INT;
                else
                    $app = PDO::PARAM_STR;
                $app1 = "%{$field[1]}%";
                $statement->bindValue(":{$field[0]}", $app1, $app);
            }

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

    public static function retriveObjForSearchMixed($table, $fields) {
        try {
            $clauses = [];
            $params = [];
            $paramCounter = 0;

            foreach ($fields as $group) {
                $orParts = [];

                foreach ($group as $field) {
                    $fieldName = $field[0];
                    $fieldValue = $field[1];
                    $paramKey = ":param_{$fieldName}_{$paramCounter}";

                    $orParts[] = "{$fieldName} = {$paramKey}";
                    $params[$paramKey] = [
                        $fieldValue,
                        is_int($fieldValue) ? PDO::PARAM_INT : PDO::PARAM_STR
                    ];

                    $paramCounter++;
                }

                // Se il gruppo contiene almeno un elemento valido
                if (!empty($orParts)) {
                    $clauses[] = '(' . implode(' OR ', $orParts) . ')';
                }
            }

            // Costruzione della WHERE clause
            $condition = implode(' AND ', $clauses);
            $query = "SELECT * FROM {$table}" . (!empty($condition) ? " WHERE {$condition}" : '');

            // Prepara la query
            $statement = self::$db->prepare($query);

            // Per debug
            $debugQuery = $query;
            foreach ($params as $key => [$value, $type]) {
                $statement->bindValue($key, $value, $type);

                // Per sostituzione nel debug
                $escaped = $value;
                if ($type === PDO::PARAM_STR) {
                    $escaped = "'" . addslashes($value) . "'";
                } elseif ($type === PDO::PARAM_NULL) {
                    $escaped = "NULL";
                }
                $debugQuery = preg_replace('/' . preg_quote($key, '/') . '/', $escaped, $debugQuery, 1);
            }

            // Debug query con valori sostituiti
            //print($debugQuery);

            // Esecuzione
            $statement->execute();

            $result = [];
            if ($statement->rowCount() > 0) {
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                while ($row = $statement->fetch()) {
                    $result[] = $row;
                }
            }

            return $result;

        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
            return [];
        }
    }

    /**
     * Method to retrive all rows from a table using the like operator 
     * @param string $table Refers to a table in the database 
     * @return array The result set as an associative array.
     */
    public static function retriveObjLike(string $table, $field, $value) {
        try {
            $query = "SELECT * FROM {$table} WHERE ({$field} LIKE %{$value}%);";
            $statement = self::$db->prepare($query);
            $statement->execute();
            $numberOfRows = $statement->rowCount();
            if($numberOfRows > 0) {
                $result = [];
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                while($row = $statement->fetch()) {
                    $result[] = $row;
                }
                return $result;
            } else {
                return [];
            }
        } catch (PDOException $e) {
            error_log("Database error in retriveObjLike: " . $e->getMessage());
            return [];
        }
    }

    
    
    /**
     * Method to update rows with UPDATE @table SET @field = @fieldValue WHERE @cond = @condvalue
     * @param string $table Refers to the table of the Database
     * @param string $field  Refers to the field to update
     * @param mixed $fieldvalue Refers to the value to update
     * @param string  $cond Refers to the Where condition
     * @param mixed $condvalue Refers to the value of the condition
     * @return bool
     */
    public static function updateObj(string $table, string $field, mixed $fieldValue, string $cond, mixed $condValue) : bool{
        try{
            $query = "UPDATE {$table} SET {$field} = :fieldValue WHERE {$cond} = :condValue;";
            $stmt = self::$db->prepare($query);
            if(is_int($fieldValue))
                    $app = PDO::PARAM_INT;
                else
                    $app = PDO::PARAM_STR;
            $stmt->bindParam(':fieldValue', $fieldValue, $app);
            if(is_int($condValue))
                    $app = PDO::PARAM_INT;
                else
                    $app = PDO::PARAM_STR;
            $stmt->bindParam(':condValue', $condValue, $app);
            $stmt->execute();
            return true;
        }catch(Exception $e){
            echo "ERROR: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Method to delete a row from the Database with query DELETE FROM WHERE
     * @param string $table Refers to the table of the Database
     * @param string $field  Refers to a field of the table
     * @param mixed $id Refers to the value in the where clause
     * @return bool
     */
    public static function deleteObjInDb(string $table, string $field, mixed $id) : bool{
        try{
            $query = "DELETE FROM {$table} WHERE {$field} = :id";
            $statement = self::$db->prepare($query);
            $statement->bindParam(':id', $id, PDO::PARAM_STR);  
            $statement->execute();
            return true;
        }catch(Exception $e){
            print($e->getMessage());
            echo "ERROR: " . $e->getMessage();
            return false;
        }
    }




}

?>