<?php

require_once("FEntityManager.php");

class FLandingImage{

    private static $table = "landingimages";
    private static $columns = " ( 'id', 'idImage')";
    private static $value = "( NULL, :idImage ) ";
    private static $key = "id";

    public static function getTable(){
        return self::$table;
    }

    public static function getColumns() {
        return self::$columns;
    }

    public static function getValue(){
        return self::$value;
    }

    public static function getClass(){
        return self::class;
    }

    public static function getKey(){
        return self::$key;
    }

    public static function createImageObj($queryResult) : array{
        if(count($queryResult) == 1){
            $images = [];
            $im = new ELandingImage($queryResult[0]['idImage']);
            $im->setId($queryResult[0]['id']);
            $images[] = $im;
            return $images;
        }elseif(count($queryResult) > 1){
            $images = [];
            for($i = 0; $i < count($queryResult); $i++){
                $im = new ELandingImage($queryResult[$i]['idImage']);
                $im->setId($queryResult[$i]['id']);
                $images[] = $im;
            }
            return $images;
        } else {
            return [];
        }
    }

    public static function bind($stmt, $image){
        $stmt->bindValue(":idImage", $image->getIdImage(), PDO::PARAM_INT);
    }

    public static function saveObj(ELandingImage $obj, ?array $fieldArray = null) {
        if($fieldArray === null) {
            try{
                FEntityManager::getInstance()->getDb()->beginTransaction();
                $savePersonAndLastInsertedID = FEntityManager::getInstance()->saveObject(FLandingImage::getClass(), $obj);
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
                error_log("Database error in FLandingImage saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            }finally{
                FEntityManager::getInstance()->closeConnection();
            } 
        } else {
            try {
                FEntityManager::getInstance()->getDb()->beginTransaction();
                foreach($fieldArray as $fv) {
                    FEntityManager::getInstance()->updateObj(FLandingImage::getTable(), $fv[0], $fv[1], self::getKey(), $obj->getId());    
                } 
                FEntityManager::getInstance()->getDb()->commit();
                return true;
            } catch (PDOException $e) {
                error_log("Database error in FLandingImage saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally{
                FEntityManager::getInstance()->closeConnection();
            } 
        }
    }

    public static function getImageById($id) : ?array{
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), 'id', $id);
        return $result;
    }

    public static function getAllImages() : ?array{
        $result = FEntityManager::getInstance()->retriveAllObj(self::getTable());
        return $result;
    }
}