<?php

class ESkipassBooking {
    
    //attributes
    private int $idSkipassBooking;
    protected string $startDate;
    protected string $name, $surname, $type, $email;
    protected float $totalSkiFacilitiesPrice;
    protected int $period;
    private int $idUser;
    private int $idSkiFacility;

    //constructor
    //rivedere se inserire o meno idPayment nel costruttore
    public function __construct(string $name, string $surname, string $stringStartDate, string $type, string $email, int $period, float $totalSkiFacilitiesPrice) {
        $this->name = $name;
        $this->surname = $surname;
        $date = DateTime::createFromFormat('Y-m-d', $stringStartDate);
        if ($date && $date->format('Y-m-d') === $stringStartDate) {
            $this->startDate = $stringStartDate;
        } else {
            throw new Exception("Formato data non valido");
        }
        $this->type = $type;
        $this->period = $period;
        $this->email = $email;
        $this->totalSkiFacilitiesPrice = $totalSkiFacilitiesPrice;
    }

    //Get methods
    public function getIdSkipassBooking() : int {return $this->idSkipassBooking;}
    public function getName() :string {return $this->name;}
    public function getSurname() :string {return $this->surname;}
    public function getStartDate() :string {return $this->startDate;}
    public function getType() :string {return $this->type;}
    public function getPeriod() :int {return $this->period;}
    public function getEmail() :string {return $this->email;}
    public function getTotal() :float {return $this->totalSkiFacilitiesPrice;}
    public function getIdUser() :int {return $this->idUser;}
    public function getIdSkiFacility() :int {return $this->idSkiFacility;}

    //Set methods
    public function setIdSkipassBooking(int $id) {$this->idSkipassBooking = $id;}
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
    public function setPeriod(int $period) :void {$this->period = $period;}
    public function setEmail(string $email) :void {$this->email = $email;}
    public function setTotal(int $total) :void {$this->totalSkiFacilitiesPrice = $total;}
    public function setIdUser(int $id) : void {$this->idUser = $id;}
    public function setIdSkiFacility(int $idSkiFacility) : void {$this->idSkiFacility = $idSkiFacility;}
}