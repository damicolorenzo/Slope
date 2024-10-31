<?php

class ELiftStructure {
    
    //attributes
    private int $idLiftStructure;

    private string $name, $type, $status;
    private int $seats;

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
    public function setIdLift($idLiftStructure) :void  {$this->idLiftStructure = $idLiftStructure;}
    public function setIdSkiFacility($idSkiFacility) :void  {$this->idSkiFacility = $idSkiFacility;}

    public function setName(string $name) :void {$this->name = $name;}
    public function setType(string $type) :void {$this->type = $type;}
    public function setStatus(string $status) :void {$this->status = $status;}
    public function setSeats(int $seats) :void {$this->seats = $seats;}
    
}

?>