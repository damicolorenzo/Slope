<?php

class ESkiRun {
    
    //attributes
    private string $name, $type, $status;
    
    //constructor
    public function __constructor(string $name, string $type, string $status) {
        $this->name = $name;
        $this->type = $type;
        $this->status = $status;
    }

    //Get methods
    public function getName() :string {return $this->name;}
    public function getType() :string {return $this->type;}
    public function getStatus() :string {return $this->status;}

    //Set methods
    public function setName(string $name) :void {$this->name = $name;}
    public function setType(string $type) :void {$this->type = $type;}
    public function setStatus(string $status) :void {$this->status = $status;}
    
}

?>