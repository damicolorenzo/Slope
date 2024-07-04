<?php

class EPayment{

    //attributes
    protected string $idPayment;
    protected float $totalAmount;
    protected DateTime $date;
    protected int $cardNumber;

    //constructor
    //rivedere se inserire o meno cardNumber e idPayment nel costruttore
    public function ___construct(float $totalAmount){
        $this->totalAmount = $totalAmount;
        // da rivedere (non va bene)
        //$objDateTime = new DateTime($stringDate);
        //$newObj = clone $objDateTime;
        //$newObj->format('Y-m-d'); 
        //$this->date = $newObj;
        $this->setTime();
    }

    //get methods
    public function getId(){
        return $this->idPayment;
    }
    public function getTtalAmount(){
        return $this->totalAmount;
    }
    public function getDate(){
        return $this->date;
    }
    public function getDateStr(){
        return $this->date->format('Y-m-d H:i:s');
    }
    public function getCardNumber(){
        return $this->cardNumber;
    }



    //set methods
    public function setId($idPayment1){
        $this->idPayment = $idPayment;
    }
    public function setTotalAmount(float $totalAmount1){
        $this->totalAmount = $totalAmount1;
    }
    //public function setDate($date1){
    //    $objDateTime = new DateTime($date1);
    //    $newObj = clone $objDateTime;
    //    $newObj->format('Y-m-d'); 
    //    $this->date = $newObj;
    //}


    public function setTime(){
        $this->date = new DateTime("now");
    }

    public function setDate(DateTime $date1){
        $this->date = $date1;
    }
}
?>