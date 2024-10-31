<?php

class ESkiFacility {
    
    //attributes
    private int $idSkiFacility;

    private string $name, $status;
    private float $price;

    private int $idSkiArea;
    
    //constructor
    public function __construct($name, $status, $price) {
        $this->name = $name;
        $this->status = $status;
        $this->price = $price;
    }

    //Get methods
    public function getIdSkiFacility() :int {return $this->idSkiFacility;}
    public function getIdSkiArea() :int {return $this->idSkiArea;}

    public function getName() :string {return $this->name;}
    public function getStatus() :string {return $this->status;}
    public function getPrice() :float {return $this->price;}

    //Set methods
    public function setIdSkiFacility($idSkiFacility) :void  {$this->idSkiFacility = $idSkiFacility;}
    public function setIdSkiArea($idSkiArea) :void  {$this->idSkiArea = $idSkiArea;}

    public function setName(string $name) :void {$this->name = $name;}
    public function setStatus(string $status) :void {$this->status = $status;}
    public function setPrice(float $price) :void {$this->price = $price;}
    
}

?>