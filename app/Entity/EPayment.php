<?php

class EPayment{

    //attributes
    protected float $totalAmount;
    protected DateTime $date;

    //constructor
    public function ___construct(float $totalAmount){
        $this->totalAmount = $totalAmount;
        $objDateTime = new DateTime($date);
        $newObj = clone $objDateTime;
        $newObj->format('Y-m-d'); 
    }

    //get methods
    public function getTtalAmount(){
        return $this->totalAmount;
    }
    public function getDate(){
        return $this->date;
    }


    //set methods
    public function setTotalAmount($totalAmount1){
        $this->totalAmount = $totalAmount1;
    }
    public function setDate($date1){
        $objDateTime = new DateTime($date1);
        $newObj = clone $objDateTime;
        $newObj->format('Y-m-d'); 
        $this->date = $newObj;
    }
    
}
?>