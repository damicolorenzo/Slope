<?php

class EPayment{

    //attributes
    private string $idPayment;
    private string $type;
    private int $idExternalObj;
    private int $idCreditCard;
    private float $totalAmount;
    private string $date;

    //constructor
    public function __construct(string $type, float $totalAmount, string $date){
        $this->type = $type;
        $this->totalAmount = $totalAmount;
        $this->date = $date;
    }

    //get methods
    public function getIdPayment(){
        return $this->idPayment;
    }
    public function getTotalAmount(){
        return $this->totalAmount;
    }
    public function getDate(){
        return $this->date;
    }
    public function getIdCreditCard(){
        return $this->idCreditCard;
    }
    public function getIdExternalObj(){
        return $this->idExternalObj;
    }
    public function getType() {
        return $this->type;
    }

    //set methods
    public function setIdPayment($idPayment){
        $this->idPayment = $idPayment;
    }
    public function setTotalAmount(float $totalAmount1){
        $this->totalAmount = $totalAmount1;
    }
    public function setDate(string $date) {
        $this->date = $date;
    }
    public function setIdCreditCard(int $idCreditCard)  {
        $this->idCreditCard = $idCreditCard;
    }
    public function setIdExternalObj(int $idExternalObj) {
        $this->idExternalObj = $idExternalObj;
    }
    public function setType(string $type) {
        $this->type = $type;
    } 

}
?>