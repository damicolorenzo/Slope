<?php

class EPrice {
    
    /**
     * Holds the id a price object in the database.
     * @var int
     */
    private int $idPrice;
    /**
     * Holds the description of the price.
     * Refers to what is price for and about.
     * @var string
     */
    private string $description;
    /**
     * Holds the value of the price.
     * @var float
     */
    private float $value;
    /**
     * Holds the id of the "object" purchased through the payment.
     * @var int
     */
    private int $idExtObj;
    /**
     * Holds the class name of the "object" purchased through the payment.
     * @var string
     */
    private string $extClass;

    /* private int $idSkiFacility;
    private int $idSkipassObj; */

    public function __construct(string $description, float $value)  {
        $this->description = $description;
        $this->value = $value;
    }

    public function getIdPrice() : int {return $this->idPrice;}
    public function getDescription() : string {return $this->description;}
    public function getValue() : float {return $this->value;}
    public function getIdExtObj() : int {return $this->idExtObj;}
    /* public function getIdSkiFacility() : int {return $this->idSkiFacility;}
    public function getIdSkipassObj() : int {return $this->idSkipassObj;} */
    public function getExtClass() : string {return $this->extClass;}

    public function setIdPrice(int $idPrice) : void {$this->idPrice = $idPrice;}
    public function setDescription(string $description) : void {$this->description = $description;}
    public function setValue(float $value) : void {$this->value = $value;}
    /* public function setIdSkiFacility(int $idSkiFacility) : void {$this->idSkiFacility = $idSkiFacility;}
    public function setIdSkipassObj(int $idSkipassObj) : void {$this->idSkipassObj = $idSkipassObj;} */
    public function setIdExtObj(string $idExternalObj) : void {$this->idExtObj = $idExternalObj;}
    public function setExtClass(string $extObjClass) : void {$this->extClass = $extObjClass;}
    
}

?>