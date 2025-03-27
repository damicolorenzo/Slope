<?php

class ECreditCard{

    //attributes
    /**
     * Holds the id of the credit card in the database.
     * @var int
     */
    private int $idCreditCard; 
    /**
     * Holds the name of the holder of the credit card.
     * @var string
     */
    private string $cardHolderName;
    /**
     * Holds the surname of the holder of the credit card.
     * @var string
     */
    private string $cardHolderSurname;
    /**
     * Holds the expiry date of the credit card.
     * @var string
     */
    private string $expiryDate;
    /**
     * Holds the number of the credit card.
     * @var int
     */
    private string $cardNumber;
    /**
     * Holds the cvv of the credit card (code on the back of the card).
     * @var int
     */
    private int $cvv;
    /**
     * Holds the id of the user(holder) of the credit card.
     * @var int
     */
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
    public function getIdCreditCard() : int{
        return $this->idCreditCard;
    }
    public function getCardHolderName() : string{
        return $this->cardHolderName;
    }
    public function getCardHolderSurname() : string{
        return $this->cardHolderSurname;
    }
    public function getCardNumber() : string{
        return $this->cardNumber;
    }
    public function getCvv() : int{
        return $this->cvv;
    }
    public function getExpiryDate() : string{
        return $this->expiryDate;
    }
    public function getIdUser() : int{
        return $this->idUser;
    }

    //set methods
    public function setIdCreditCard(int $idCreditCard) :void{
        $this->idCreditCard = $idCreditCard;
    }
    public function setCardHolderName(string $cardHolderName) : void{
        $this->cardHolderName = $cardHolderName;
    }
    public function setCardHolderSurname(string $cardHolderSurname) : void{
        $this->cardHolderSurname = $cardHolderSurname;
    }
    public function setCardNumber(string $cardNumber) : void{
        $this->cardNumber = $cardNumber;
    }
    public function setCvv(int $cvv) : void{
        $this->cvv = $cvv;
    }
    public function setExpiryDate(string $expiryDate) : void{
        $this->expiryDate = $expiryDate;
    }
    public function setIdUser(int $idUser) : void{
        $this->idUser = $idUser;
    }

}
?>