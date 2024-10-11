<?php

class UHTTPMethods {

    /*
    Funzione per accedere all'array $_POST 
    */
    public static function post($param) {return $_POST[$param];}
    public static function allPost() {return $_POST;}

    /*
    Funzione per accedere all'array $_FILES
    */
    public static function files(...$param) {
        switch (count($param)) {
            case 1:
                return $_FILES[$param[0]];
                break;
            
            case 2:
                return $_FILES[$param[0]][$param[1]];
                break;  
                
            case 3:
                return $_FILES[$param[0]][$param[1]][$param[2]];
                break;     




            default:
                return $_FILES[$param[0]];
                break;
        }
    }
}