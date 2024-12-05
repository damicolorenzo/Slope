<?php

require_once("ESkipassBooking.php");

class EWeekLySkipass extends ESkipassBooking {

    //attributes
    protected static float $priceMultiplier = 0.4;
    protected static int $period = 7;

    private static ESkipassBooking $skipassBooking;

    //constructor
    public function __construct(string $name, string $surname, string $stringStartDate, string $type, string $email, float $totalSkiFacilitiesPrice) {
        $totalSkiFacilitiesPrice = $totalSkiFacilitiesPrice * self::getPriceMultiplier();
        self::$skipassBooking = self::createSkipassBooking($name, $surname, $stringStartDate, $type, self::$period, $email, $totalSkiFacilitiesPrice);
    }

    //Get and set methods
    public function getPriceMultiplier() :float {return $this->priceMultiplier;}
    public function getPeriod() :int {return $this->period;}

    public static function createSkipassBooking(string $name, string $surname, string $stringStartDate, string $type, int $period,  string $email, float $totalSkiFacilitiesPrice) {
        return new ESkipassBooking($name, $surname, $stringStartDate, $type, $email, $period, $totalSkiFacilitiesPrice);
    }

    public function getSkipassBooking() {return $this->skipassBooking;}
}

?>