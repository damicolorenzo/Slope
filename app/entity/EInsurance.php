<?php
class EInsurance{

    //attributes
    protected string $type;
    protected int $period;
    protected float $price;
    protected string $idPayment;

    //constructor
    public function ___construct(string $type, int $period, float $price, string $idPayment){
        $this->type = $type;
        $this->period = $period;
        $this->price = $price;
        $this->idPayment = $idPayment;
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
    public function getIdPayment(){
        return $this->idPayment;
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