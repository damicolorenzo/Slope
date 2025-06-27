<?php

require_once("FEntityManager.php");

class FImage{

    private static $table = "image";
    private static $columns = " ( 'idImage', 'name', 'size', 'type', 'imageData')";
    private static $value = "( NULL, :name, :size, :type, :imageData ) ";
    private static $key = "idImage";

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
            $im = new EImage($queryResult[0]['name'], $queryResult[0]['size'],$queryResult[0]['type'],$queryResult[0]['imageData']);
            $im->setId($queryResult[0]['idImage']);
            $images[] = $im;
            return $images;
        }elseif(count($queryResult) > 1){
            $images = [];
            for($i = 0; $i < count($queryResult); $i++){
                $im = new EImage($queryResult[$i]['name'], $queryResult[$i]['size'],$queryResult[$i]['type'],$queryResult[$i]['imageData']);
                $im->setId($queryResult[$i]['idImage']);
                $images[] = $im;
            }
            return $images;
        } else {
            return [];
        }
    }

    public static function bind($stmt, $image){
        $stmt->bindValue(":name", $image->getName(), PDO::PARAM_STR);
        $stmt->bindValue(":size", $image->getSize(), PDO::PARAM_INT);
        $stmt->bindValue(":type",$image->getType(), PDO::PARAM_STR);
        $stmt->bindValue(":imageData", $image->getImageData(), PDO::PARAM_LOB);
    }

    public static function saveObj(EImage $obj) : bool{
        try{
            FEntityManager::getInstance()->getDb()->beginTransaction();
            $saveImageLastInsertedID = FEntityManager::getInstance()->saveObject(self::getClass(), $obj);
            $obj->setId($saveImageLastInsertedID);
            if($saveImageLastInsertedID !== null){
                FEntityManager::getInstance()->getDb()->commit();
               return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            error_log("Database error in FImage saveObj: " . $e->getMessage());
            FEntityManager::getInstance()->getDb()->rollBack();
            return false;
        }finally{
            FEntityManager::getInstance()->closeConnection();
        }
    }

    public static function getImageById($id) : ?array{
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), 'idImage', $id);
        return $result;
    }
}