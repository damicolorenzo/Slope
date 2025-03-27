<?php

class ELiftStructure {
    
    //attributes
    /**
     * Holds the id of the lift structure in the database.
     * @var int
     */
    private int $idLiftStructure;
    /**
     * Holds the name of the lift structure.
     * @var string
     */
    private string $name;
    /**
     * Holds the type of the lift structure.
     * @var string
     */
    private string $type;
    /**
     * Holds the status of the lift structure.
     * @var string
     */
    private string $status;
    /**
     * Holds the number of seats of the lift structure.
     * @var int
     */
    private int $seats;
    /**
     * Holds the id of the ski facility that is releted to this structure.
     * @var int
     */
    private int $idSkiFacility;
    
    //constructor
    public function __construct(string $name, string $type, string $status, int $seats) {
        $this->name = $name;
        $this->type = $type;
        $this->status = $status;
        $this->seats = $seats;
    }

    //Get methods
    public function getIdLift() :int {return $this->idLiftStructure;}
    public function getIdSkiFacility() :int {return $this->idSkiFacility;}

    public function getName() :string {return $this->name;}
    public function getType() :string {return $this->type;}
    public function getStatus() :string {return $this->status;}
    public function getSeats() :int {return $this->seats;}

    //Set methods
    public function setIdLift(int $idLiftStructure) :void  {$this->idLiftStructure = $idLiftStructure;}
    public function setIdSkiFacility(int $idSkiFacility) :void  {$this->idSkiFacility = $idSkiFacility;}

    public function setName(string $name) :void {$this->name = $name;}
    public function setType(string $type) :void {$this->type = $type;}
    public function setStatus(string $status) :void {$this->status = $status;}
    public function setSeats(int $seats) :void {$this->seats = $seats;}
    
}

?>