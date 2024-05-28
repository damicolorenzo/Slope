<?php

require_once('EUser.php');
class ESubscriptedUser extends EUser{

    protected static float $reduction=0.7;
    protected DateTime $yearstart;


    public function __construct(string $name, string $surname, string $email, int $phoneNumber, string $birthDate, string $username, string $password, string $stringyear){
        
        parent::__construct($name, $surname,  $email,  $phoneNumber,  $birthDate,  $username,  $password);
        $objDateTime = new DateTime($stringyear);
        $newObj = clone $objDateTime;
        $newObj->format('Y-m-d'); 
        $this->year = $newObj;
    }

    //get methods
    public function getYear() :DateTime {return $this->year;}

    //set methods
    public function setYear(string $year) :void {
        $objDateTime = new DateTime($year);
        $newObj = clone $objDateTime;
        $newObj->format('Y-m-d'); 
        $this->year = $newObj;
    }


}

?>