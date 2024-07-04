<?php

class ECreditCard{

    //attributes
    protected string $cardHolderName;
    protected string $cardHolderSurname;
    protected DateTime $endDate;
    protected int $cardNumber;
    protected int $cvv;

    //constructor
    public function ___construct(string $cardHolderName, string $cardHolderSurname, string $endDate, int $cardNumber, int $cvv){
        $this->cardHolderName = $cardHolderName;
        $this->cardHolderSurname = $cardHolderSurname;
        $objDateTime = new DateTime($stringEndDate);
        $newObj = clone $objDateTime;
        $newObj->format('Y-m-d'); 
        $this->endDate = $newObj;
        $this->setTime();
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
    public function getEndDateStr(){
        return $this->endDate->format('Y-m-d');
    }


    //set methods
    public function setCardHolderName(string $cardHolderName1){
        $this->cardHolderName = $cardHolderName1;
    }
    public function setCardHolderSurname(string $cardHolderSurname1){
        $this->cardHolderSurname = $cardHolderSurname1;
    }
    public function setCardNumber(int $cardNumber1){
        $this->cardNumber = $cardNumber1;
    }
    public function setCvv(int $cvv1){
        $this->cvv = $cvv1;
    }
    public function setEndDate(DateTime $endDate1){
        $objDateTime = new DateTime($endDate1);
        $newObj = clone $objDateTime;
        $newObj->format('Y-m-d'); 
        $this->endDate = $newObj;
}

}
?>