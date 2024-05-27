<?php

class ECreditCard{

    //attributes
    protected string $cardHolderName;
    protected string $cardHolderSurname;
    protected DateTime $endDate;
    protected int $cardNumber;
    protected int $cvv;

    //constructor
    public function ___construct(string $cardHolderName, string $cardHolderSurname, int $cardNumber, int $cvv){
        $this->cardHolderName = $cardHolderName;
        $this->cardHolderSurname = $cardHolderSurname;
        $objDateTime = new DateTime($endDate);
        $newObj = clone $objDateTime;
        $newObj->format('Y-m-d'); 
        $this->cardNumber = $cardNumber;
        $this->cvv = $cvv;
    }

    //get methods
    public function getCardHolderName(){
        return $this->cardHolderName;
    }
    public function getCardHolderSurname(){
        return $this->cardHolderSurname;
    }
    public function getCardNumber(){
        return $this->cardNumber;
    }
    public function getCvv(){
        return $this->cvv;
    }
    public function getEndDate(){
        return $this->endDate;
    }
    //set methods
    public function setCardHolderName($cardHolderName1){
        $this->cardHolderName = $cardHolderName1;
    }
    public function setCardHolderSurname($cardHolderSurname1){
        $this->cardHolderSurname = $cardHolderSurname1;
    }
    public function setCardNumber($cardNumber1){
        $this->cardNumber = $cardNumber1;
    }
    public function setCvv($cvv1){
        $this->cvv = $cvv1;
    }
    public function setEndDate($endDate1){
        $objDateTime = new DateTime($endDate1);
        $newObj = clone $objDateTime;
        $newObj->format('Y-m-d'); 
        $this->endDate = $newObj;
    }
}
?>