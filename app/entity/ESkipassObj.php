<?php

/**
 * Class ESkipassObj
 * 
 * Represents the skipass object for a specific ski facility
 * 
 */
class ESkipassObj {
    
    //attributes
    /**
     * Holds the id of the skipass object in the database.
     * @var int
     */
    private int $idSkipassObj;
    /**
     * Holds the description of the skipass object.
     * @var string
     */
    private string $description;
    /**
     * Holds the value of the skipass object.
     * @var int
     */
    private float $value;
    /**
     * Holds the id of the ski facility
     * @var int
     */
    private int $idSkiFacility;
    /**
     * Holds the id of the skipass template
     * @var int
     */
    private int $idSkipassTemp;

    public function __construct(string $description, float $value)  {
        $this->description = $description;
        $this->value = $value;
    }

    public function getIdSkipassObj() : int {return $this->idSkipassObj;}
    public function getIdSkiFacility() : int {return $this->idSkiFacility;}
    public function getIdSkipassTemp() : int {return $this->idSkipassTemp;}
    public function getDescription() : string {return $this->description;}
    public function getValue() : float {return $this->value;}
    
    public function setIdSkipassObj(int $idSkipassObj) : void {$this->idSkipassObj = $idSkipassObj;}
    public function setIdSkiFacility(int $idSkiFacility) : void {$this->idSkiFacility = $idSkiFacility;}
    public function setIdSkipassTemp(int $idSkipassTemp) : void {$this->idSkipassTemp = $idSkipassTemp;}
    public function setDescription(string $description) : void {$this->description = $description;}
    public function setValue(float $value) : void {$this->value = $value;}
    
}

?>