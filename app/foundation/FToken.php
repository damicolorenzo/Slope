<?php

require_once("FEntityManager.php");

class FToken {

    private static $table = "password_resets";
    private static $value = "(NULL, :user_id, :token, :expires_at, :used, :created_at)";
    private static $key = "id";
    private static $externalKey = "user_id";
    
    public static function getTable() {return self::$table;}
    public static function getValue() {return self::$value;}
    public static function getClass() {return self::class;}
    public static function getKey() {return self::$key;}
    public static function getExtKey() {return self::$externalKey;}

    public static function getObj($id) :array {
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);
        return $result;
    }

    /**
     * Binds the values of a token object to a prepared SQL statement.
     * @param object $stmt The PDO statement object used for query execution.
     * @param EToken $tokne An object representing a token
     * @return void
     */
    public static function bind($stmt, $token) : void {
        $stmt->bindValue(":user_id", $token->getUserId(), PDO::PARAM_INT);
        $stmt->bindValue(":token", $token->getToken(), PDO::PARAM_STR);
        $stmt->bindValue(":expires_at",$token->getExpiresAt(), PDO::PARAM_STR);
        $stmt->bindValue(":used",$token->getUsed(), PDO::PARAM_BOOL);
        $stmt->bindValue(":created_at",$token->getCreatedAt(), PDO::PARAM_STR);
    }

    /**
     * Method to save an object in the database using the proper FEntityManager function
     * @param EToken $obj Refers to a token Entity object that needs to be stored in the database
     * @param array $fieldArray Refers to an array of fields and values
     * @return bool true if succeded and false if failed
     */
    public static function saveObj(EToken $obj, ?array $fieldArray = null) : bool{
        if($fieldArray === null) {
            try {
                FEntityManager::getInstance()->getDb()->beginTransaction();
                $saveSkiRun = FEntityManager::getInstance()->saveObject(self::getClass(), $obj);
                if($saveSkiRun !== null) {
                    FEntityManager::getInstance()->getDb()->commit();
                    return true;
                } else {
                    return false;
                }
            } catch(PDOException $e) {
                error_log("Database error in FToken saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally {
                FEntityManager::getInstance()->closeConnection();
            }
        } else {
            try {
                FEntityManager::getInstance()->getDb()->beginTransaction();
                foreach($fieldArray as $fv) {
                    FEntityManager::getInstance()->updateObj(FToken::getTable(), $fv[0], $fv[1], self::getKey(), $obj->getId());
                }
                FEntityManager::getInstance()->getDb()->commit();
                return true;
            } catch(PDOException $e) {
                error_log("Database error in FToken saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally {
                FEntityManager::getInstance()->closeConnection();
            }
        }
    }

    /**
     * Method to create an object or a set of object from a query
     * @param array $queryResult Refers to the result of a query
     * @return array of objects 
     */
    public static function createTokenObj(array $queryResult) : array{
        if(count($queryResult) == 1){
            $tokenA = [];
            $token = new EToken($queryResult[0]['token'], $queryResult[0]['expires_at'], $queryResult[0]['created_at']);
            $token->setId($queryResult[0]['id']);
            $token->setUserId($queryResult[0]['user_id']);
            $tokenA[] = $token;
            return $tokenA;
        }elseif(count($queryResult) > 1){
            $tokenA = [];
            for($i = 0; $i < count($queryResult); $i++){
                $token = new EToken($queryResult[$i]['token'], $queryResult[$i]['expiresAt'], $queryResult[$i]['createdAt']);
                $token->setId($queryResult[$i]['id']);
                $token->setUserId($queryResult[$i]['userId']);
                $tokenA[] = $token;
            }
            return $tokenA;
        }else{
            return [];
        }
    }

    /**
     * Method to get a token object using the token value 
     * @param string $token
     * @return array $result
     */
    public static function getTokenFromToken(string $token) : array{
        $result = FEntityManager::getInstance()->retriveObj(FToken::getTable(), 'token', $token);
        return $result;
    }
}

?>