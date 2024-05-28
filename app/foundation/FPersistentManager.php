<?php

class FPersistentManager {
    #Singleton 
    
    private static $instance;

    private function __construct() {}

    public static function getInstance() :FPersistentManager {
        if(!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * return an object from database specifying the class and the id 
    */
    public static function retriveObj($class, $id) :array {
        $foundClass = "F".substr($class, 1);
        $staticMethod = "getObj";
        $result = call_user_func([$foundClass, $staticMethod], $id);
        return $result;
    }

    public static function getSkiRunImages($idSkiRun) {
        $skiRun = FSkiRun::getSkiRunImages($idSkiRun);
        return $skiRun;
    }
}

?>