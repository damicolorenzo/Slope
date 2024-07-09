<?php 

require_once(__DIR__."\\..\\..\\config\\config.php");

class USession {
    
    private static $instance;

    private function __construct() {
        session_set_cookie_params(COOKIE_EXP_TIME);
        session_start();
    }

    public static function getInstance() {
        if(self::$instance == null) {
            self::$instance = new USession();
        }
        return self::$instance;
    }

    public static function getSessionStatus() {return session_status();}
    public static function getSessionElement($id) {return $_SESSION[$id];}
    public static function setSessionElement($id, $value) {$_SESSION[$id] = $value;}
    public static function unsetSession() {session_unset();}
    public static function unsetSessionElement($id) {unset($_SESSION[$id]);}
    public static function destroySession() {session_destroy();}
    public static function isSetSessionElement($id) {
        if(isset($_SESSION[$id])) {
            return true;
        } else {
            return false;
        }
    }
}

?>