<?php

class ESkipassBooking {
    
    //attributes
    protected string $startDate;
    protected string $name, $surname, $type, $email;
    protected float $totalSkiFacilitiesPrice;

    //constructor
    public function __construct(string $name, string $surname, string $stringStartDate, string $type, string $email, float $totalSkiFacilitiesPrice) {
        $this->name = $name;
        $this->surname = $surname;
        $date = DateTime::createFromFormat('Y-m-d', $stringStartDate);
        if ($date && $date->format('Y-m-d') === $stringStartDate) {
            $this->startDate = $stringStartDate;
        } else {
            throw new Exception("Formato data non valido");
        }
        $this->type = $type;
        $this->email = $email;
        $this->totalSkiFacilitiesPrice = $totalSkiFacilitiesPrice;
    }

    //Get methods
    public function getName() :string {return $this->name;}
    public function getSurname() :string {return $this->surname;}
    public function getStartDate() :string {return $this->startDate;}
    public function getType() :string {return $this->type;}
    public function getEmail() :string {return $this->email;}
    public function getTotal() :float {return $this->totalSkiFacilitiesPrice;}

    //Set methods
    public function setName(string $name) :void {$this->name = $name;}
    public function setSurname(string $surname) :void {$this->surname = $surname;}
    public function setStartDate(string $stringStartDate) :void {
        $date = DateTime::createFromFormat('Y-m-d', $stringStartDate);
        if ($date && $date->format('Y-m-d') === $stringStartDate) {
            $this->startDate = $stringStartDate;
        } else {
            throw new Exception("Formato data non valido");
        }
    }
    public function setType(string $type) :void {$this->type = $type;}
    public function setEmail(string $email) :void {$this->email = $email;}
    public function setTotal(int $total) :void {$this->totalSkiFacilitiesPrice = $total;}
}