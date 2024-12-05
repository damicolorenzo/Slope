<?php

class ECreditCard{

    //attributes
    private int $idCreditCard; 
    private string $cardHolderName;
    private string $cardHolderSurname;
    private string $expiryDate;
    private int $cardNumber;
    private int $cvv;
    private int $idUser;

    //constructor
    public function __construct(string $cardHolderName, string $cardHolderSurname, string $expiryDate, int $cardNumber, int $cvv){
        $this->cardHolderName = $cardHolderName;
        $this->cardHolderSurname = $cardHolderSurname;
        $this->expiryDate = $expiryDate;
        $this->cardNumber = $cardNumber;
        $this->cvv = $cvv;
    }

    //get methods
    public function getIdCreditCard(){
        return $this->idCreditCard;
    }
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
    public function getExpiryDate(){
        $date = new DateTime($this->expiryDate);
        return $date->format('Y-m');
    }
    public function getIdUser() {
        return $this->idUser;
    }

    //set methods
    public function setIdCreditCard(int $idCreditCard) {
        $this->idCreditCard = $idCreditCard;
    }
    public function setCardHolderName(string $cardHolderName){
        $this->cardHolderName = $cardHolderName;
    }
    public function setCardHolderSurname(string $cardHolderSurname){
        $this->cardHolderSurname = $cardHolderSurname;
    }
    public function setCardNumber(int $cardNumber){
        $this->cardNumber = $cardNumber;
    }
    public function setCvv(int $cvv){
        $this->cvv = $cvv;
    }
    public function setEndDate(string $expiryDate){
        $this->expiryDate = $expiryDate;
    }
    public function setIdUser(int $idUser) {
        $this->idUser = $idUser;
    }

}
?>