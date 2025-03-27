<?php

class ESkiFacility {
    
    //attributes
    /**
     * Holds the id of the ski facility in the database.
     * @var int
     */
    private int $idSkiFacility;
    /**
     * Holds the name of the ski facility.
     * @var string
     */
    private string $name;
    /**
     * Holds the status of the ski facility.
     * @var string
     */
    private string $status;
    /**
     * Holds the description of the ski facility.
     * @var string
     */
    private string $description;
    
    //constructor
    public function __construct(string $name, string $status, string $description) {
        $this->name = $name;
        $this->status = $status;
        $this->description = $description;
    }

    //Get methods
    public function getIdSkiFacility() :int {return $this->idSkiFacility;}

    public function getName() :string {return $this->name;}
    public function getStatus() :string {return $this->status;}
    public function getDescription() : string {return $this->description;}
    
    //Set methods
    public function setIdSkiFacility(int $idSkiFacility) :void  {$this->idSkiFacility = $idSkiFacility;}
    
    public function setName(string $name) :void {$this->name = $name;}
    public function setStatus(string $status) :void {$this->status = $status;}
    public function setDescription(string $description) : void {$this->description = $description;}
       
}

?>