<?php

require_once("FEntityManager.php");

class FSkiFacilityImage{

    private static $table = "skifacilityimages";
    private static $columns = " ( 'idSkiFacility', 'idImage')";
    private static $value = "( :idSkiFacility, :idImage ) ";
    private static $key = "idSkiFacility";

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
            $im = new ESkiFacilityImage($queryResult[0]['idImage']);
            $im->setIdSkiFacility($queryResult[0]['idSkiFacility']);
            $images[] = $im;
            return $images;
        }elseif(count($queryResult) > 1){
            $images = [];
            for($i = 0; $i < count($queryResult); $i++){
                $im = new ESkiFacilityImage($queryResult[$i]['idImage']);
                $im->setIdSkiFacility($queryResult[$i]['idSkiFacility']);
                $images[] = $im;
            }
            return $images;
        } else {
            return [];
        }
    }

    public static function bind($stmt, $image){
        $stmt->bindValue(":idSkiFacility", $image->getIdSkiFacility(), PDO::PARAM_INT);
        $stmt->bindValue(":idImage", $image->getIdImage(), PDO::PARAM_INT);
    }

    public static function saveObj(ESkiFacilityImage $obj, ?array $fieldArray = null) : bool{
        if($fieldArray === null) {
            try{
                FEntityManager::getInstance()->getDb()->beginTransaction();
                $saveObj = FEntityManager::getInstance()->saveObject1(FSkiFacilityImage::getClass(), $obj);
                FEntityManager::getInstance()->getDb()->commit();
                if($saveObj)
                    return true;
                else 
                    return false;
            }catch(PDOException $e){
                error_log("Database error in FSkiFacilityImage saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            }finally{
                FEntityManager::getInstance()->closeConnection();
            } 
        } else {
            try {
                FEntityManager::getInstance()->getDb()->beginTransaction();
                foreach($fieldArray as $fv) {
                    FEntityManager::getInstance()->updateObj(FSkiFacilityImage::getTable(), $fv[0], $fv[1], self::getKey(), $obj->getIdSkiFacility());    
                } 
                FEntityManager::getInstance()->getDb()->commit();
                return true;
            } catch (PDOException $e) {
                error_log("Database error in FSkiFacilityImage saveObj: " . $e->getMessage());
                FEntityManager::getInstance()->getDb()->rollBack();
                return false;
            } finally{
                FEntityManager::getInstance()->closeConnection();
            } 
        }
    }

    public static function getImageById($id) : ?array{
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), 'idSkiFacility', $id);
        return $result;
    }

    public static function getAllImages() : ?array{
        $result = FEntityManager::getInstance()->retriveAllObj(self::getTable());
        return $result;
    }
}