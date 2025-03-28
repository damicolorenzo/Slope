<?php

/**
 * Class ESkipassTemplate
 * 
 * Represents the template of a skipass as opposed to a booking
 * 
 */
class ESkipassTemplate {
    
    //attributes
    /**
     * Holds the id of the skipass object in the database.
     * @var int
     */
    private int $idSkipassTemplate;
    /**
     * Holds the description of the skipass object.
     * @var string
     */
    private string $description;
    /**
     * Holds the period of the skipass object.
     * @var int
     */
    private int $period;
    /**
     * Holds the type of the skipass object.
     * @var string
     */
    private string $type;

    public function __construct(string $description, int $period, string $type)  {
        $this->description = $description;
        $this->period = $period;
        $this->type = $type;
    }

    public function getIdSkipassTemplate() : int {return $this->idSkipassTemplate;}
    public function getDescription() : string {return $this->description;}
    public function getPeriod() : int {return $this->period;}
    public function getType() : string {return $this->type;}
    
    public function setIdSkipassTemplate(int $idSkipassTemp) : void {$this->idSkipassTemplate = $idSkipassTemp;}
    public function setDescription(string $description) : void {$this->description = $description;}
    public function setPeriod(int $period) : void {$this->period = $period;}
    public function setType(string $type) : void {$this->type = $type;}
    
}

?>