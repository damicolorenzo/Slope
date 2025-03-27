<?php
require_once('EUser.php');

/* CLASSE NON UTILIZZATA */

class ERegisteredUser extends EUser{


    public function __construct(string $name, string $surname, string $email, int $phoneNumber, string $birthDate, string $username, string $password){
        
        parent::__construct($name, $surname,  $email,  $phoneNumber,  $birthDate,  $username,  $password);
    }
}


?>