<?php

/**
 * Class EInsuranceTemp
 * 
 * Represents the template of a insurance as opposed to a insurance
 * 
 */
class EInsuranceTemp {
    
    //attributes
    /**
     * Holds the id of the insurance object in the database.
     * @var int
     */
    private int $idInsuranceTemp;
    /**
     * Holds the type of the insurance object.
     * @var string
     */
    private string $type;
    /**
     * Holds the value of the value object.
     * @var float
     */
    private float $value;

    public function __construct(string $type, float $value)  {
        $this->type = $type;
        $this->value = $value;
    }

    public function getIdInsuranceTemp() : int {return $this->idInsuranceTemp;}
    public function getType() : string {return $this->type;}
    public function getValue() : float {return $this->value;}
    
    public function setIdInsuranceTemp(int $idInsuranceTemp) : void {$this->idInsuranceTemp = $idInsuranceTemp;}
    public function setType(string $type) : void {$this->type = $type;}
    public function setValue(float $value) : void {$this->value = $value;}
}

?>