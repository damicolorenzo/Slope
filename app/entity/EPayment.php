<?php

class EPayment{

    //attributes
    /**
     * Holds the id of the payment in the database.
     * @var int
     */
    private int $idPayment;
    /**
     * Holds the id of the "object" purchased through the payment.
     * @var int
     */
    private int $idExternalObj;
    /**
     * Holds the id of the credit card used to carry out the payment.
     * @var int
     */
    private int $idCreditCard;
    /**
     * Holds the total amout of money exchanged for the payment.
     * @var float
     */
    private float $totalAmount;
    /**
     * Holds the date on which the payment was made
     * @var string
     */
    private string $date;
    /**
     * Holds the class name of the "object" purchased through the payment.
     * @var string
     */
    private string $extObjClass;

    //constructor
    public function __construct(string $extObjClass, float $totalAmount, string $date){
        $this->extObjClass = $extObjClass;
        $this->totalAmount = $totalAmount;
        $this->date = $date;
    }

    //get methods
    public function getIdPayment() : int{
        return $this->idPayment;
    }
    public function getTotalAmount() : float{
        return $this->totalAmount;
    }
    public function getDate() : string{
        return $this->date;
    }
    public function getIdCreditCard() : int{
        return $this->idCreditCard;
    }
    public function getIdExternalObj() : int{
        return $this->idExternalObj;
    }
    public function getExtObjClass() : string{
        return $this->extObjClass;
    }

    //set methods
    public function setIdPayment(int $idPayment) : void{
        $this->idPayment = $idPayment;
    }
    public function setTotalAmount(float $totalAmount1) : void{
        $this->totalAmount = $totalAmount1;
    }
    public function setDate(string $date) : void{
        $this->date = $date;
    }
    public function setIdCreditCard(int $idCreditCard) : void{
        $this->idCreditCard = $idCreditCard;
    }
    public function setIdExternalObj(int $idExternalObj) : void {
        $this->idExternalObj = $idExternalObj;
    } 
    public function setExtObjClass(string $extObjClass) : void{
        $this->extObjClass = $extObjClass;
    }

}
?>