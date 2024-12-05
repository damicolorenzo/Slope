<?php

require_once("FEntityManager.php");

class FPrice {

    private static $table = "Price";
    private static $value = "(NULL, :description, :full, :reduced)";
    private static $key = "idPrice";

    public static function getTable() {return self::$table;}
    public static function getValue() {return self::$value;}
    public static function getClass() {return self::class;}
    public static function getKey() {return self::$key;}

    public static function getObj($id) {
        $result = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $id);

        if(count($result) > 0){
            $price = self::createPriceObj($result);
            return $price;
        }else{
            return null;
        }
    }

    public static function bind($stmt, $price) {
        $stmt->bindValue(":description", $price->getDescription(), PDO::PARAM_STR);
        $stmt->bindValue(":full", $price->getFull(), PDO::PARAM_INT);
        $stmt->bindValue(":reduced", $price->getReduced(), PDO::PARAM_INT);
    }

    public static function getPrices() {
        $result = FEntityManager::getInstance()->retriveAllObj(self::getTable());
        return $result;
    }

    public static function createPriceObj($queryResult) {
        if(count($queryResult) == 1){
            //$attributes = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $queryResult[0][self::getKey()]);
            $price = new EPrice($queryResult[0]['description'], $queryResult[0]['full'], $queryResult[0]['reduced']);
            $price->setIdPrice($queryResult[0]['idPrice']);
            return $price;
        }elseif(count($queryResult) > 1){
            $prices = array();
            for($i = 0; $i < count($queryResult); $i++){
                //$attributes = FEntityManager::getInstance()->retriveObj(self::getTable(), self::getKey(), $queryResult[0][self::getKey()]);
                $price = new EPrice($queryResult[0]['description'], $queryResult[0]['full'], $queryResult[0]['reduced']);
                $price->setIdPrice($queryResult[0]['idPrice']);
                $prices[] = $price;
            }
            return $prices;
        }else{
            return array();
        }
    }

}

?>