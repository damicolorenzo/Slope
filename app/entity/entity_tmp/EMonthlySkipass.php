<?php

require_once("ESkipassBooking.php");

class EMonthlySkipass extends ESkipassBooking {

    //attributes
    protected static float $priceMultiplier = 0.5;
    protected static int $period = 30;

    //constructor
    public function __construct(string $name, string $surname, string $stringStartDate, string $type, string $email, float $totalSkiFacilitiesPrice) {
        parent::__construct($name, $surname, $stringStartDate, $type, $email, $totalSkiFacilitiesPrice);
    }

    //Get and set methods
    public function getPriceMultiplier() :float {return $this->priceMultiplier;}
    public function getPeriod() :int {return $this->period;}
}

?>