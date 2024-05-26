<?php
class EInsurance{

    //attributes
    protected string $type;
    protected int $period;
    protected float $price;

    //constructor
    public function ___construct(string $type, int $period, float $price){
        $this->type = $type;
        $this->period = $period;
        $this->price = $price;
    }

    //get methods
    public function getType(){
        return $this->type;
    }
    public function getPeriod(){
        return $this->period;
    }
    public function getPrice(){
        return $this->price;
    }


    //set methods
    public function setType($type1){
        $this->type = $type1;
    }
    public function setPeriod($period1){
        $this->period = $period1;
    }
    public function setPrice($price1){
        $this->price = $price1;
    }

}
?>