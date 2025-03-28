<?php

require_once("ESkipassBooking.php");

/* CLASSE NON UTILIZZATA */

class EDailySkipass extends ESkipassBooking {

    //attributes
    protected const PRICE_MULTIPLIER = 0.3;
    protected const PERIOD = 1;


    //constructor
    public function __construct(string $name, string $surname, string $stringStartDate, string $type, string $email, float $totalSkiFacilitiesPrice) {
        parent::__construct($name, $surname, $stringStartDate, $type, $email, self::PERIOD, $totalSkiFacilitiesPrice*self::PRICE_MULTIPLIER);
    }

}

?>