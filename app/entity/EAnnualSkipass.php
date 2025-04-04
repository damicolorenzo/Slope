<?php

require_once("ESkipassBooking.php");

/* CLASSE NON UTILIZZATA */

class EAnnualSkipass extends ESkipassBooking {

    //attributes
    protected static float $priceMultiplier = 0.6;
    protected static int $period = 30*6;

    //constructor
    public function __construct(string $name, string $surname, string $stringStartDate, string $type, string $email, float $totalSkiFacilitiesPrice) {
        parent::__construct($name, $surname, $stringStartDate, $type, $email, $totalSkiFacilitiesPrice);
    }

    //get and set methods
    public function getPriceMultiplier() :float {return $this->priceMultiplier;}
    public function getPeriod() :int {return $this->period;}
}

?>