<?php

class ESkiFacility {
    
    //attributes
    private string $name, $status;
    private float $price;
    
    //constructor
    public function __constructor(string $name, string $status, float $price) {
        $this->name = $name;
        $this->status = $status;
        $this->price = $price;
    }

    //Get methods
    public function getName() :string {return $this->name;}
    public function getStatus() :string {return $this->status;}
    public function getPrice() :float {return $this->price;}

    //Set methods
    public function setName(string $name) :void {$this->name = $name;}
    public function setStatus(string $status) :void {$this->status = $status;}
    public function setPrice(float $price) :void {$this->price = $price;}
    
}

?>