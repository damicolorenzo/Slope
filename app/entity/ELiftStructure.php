<?php

class ELiftStructure {
    
    //attributes
    private string $name, $type, $status;
    private int $seats;
    
    //constructor
    public function __construct(string $name, string $type, string $status, int $seats) {
        $this->name = $name;
        $this->type = $type;
        $this->status = $status;
        $this->seats = $seats;
    }

    //Get methods
    public function getName() :string {return $this->name;}
    public function getType() :string {return $this->type;}
    public function getStatus() :string {return $this->status;}
    public function getSeats() :int {return $this->seats;}

    //Set methods
    public function setName(string $name) :void {$this->name = $name;}
    public function setType(string $type) :void {$this->type = $type;}
    public function setStatus(string $status) :void {$this->status = $status;}
    public function setSeats(int $seats) :void {$this->seats = $seats;}
    
}

?>