<?php

class ESkipassBooking {
    
    //attributes
    /**
     * Holds the id of a skipass booking in the database.
     * @var int
     */
    private int $idSkipassBooking;
    /**
     * Holds the start date of the booking.
     * @var string
     */
    protected string $startDate;
    /**
     * Holds the name of the booking holder.
     * @var string
     */
    protected string $name;
    /**
     * Holds the surname of the booking holder.
     * @var string
     */
    protected string $surname;
    /**
     * Holds the type of the booking.
     * @var string
     */
    protected string $type;
    /**
     * Holds the email of the booking holder.
     * @var string
     */
    protected string $email;
    /**
     * Holds the value of the booking.
     * @var float
     */
    protected float $value;
    /**
     * Holds the time period of the booking.
     * @var int
     */
    protected int $period;
    /**
     * Holds the id of the booking holder (user).
     * This means that if the booking holder have an account this id is equal to the user id.
     * Instead if the booking holder have no account the user id is refered to the user who bought this booking for him/her.
     * @var int
     */
    private int $idUser;
    /**
     * Holds the id of the ski facility which the booking relate to.
     * @var int
     */
    private int $idSkipassObj;

    //constructor
    //rivedere se inserire o meno idPayment nel costruttore
    public function __construct(string $name, string $surname, string $date, string $type, string $email, int $period, float $value) {
        $this->name = $name;
        $this->surname = $surname;
        $this->startDate = $date;
        $this->type = $type;
        $this->period = $period;
        $this->email = $email;
        $this->value = $value;
    }

    //Get methods
    public function getIdSkipassBooking() : int {return $this->idSkipassBooking;}
    public function getName() :string {return $this->name;}
    public function getSurname() :string {return $this->surname;}
    public function getStartDate() :string {return $this->startDate;}
    public function getType() :string {return $this->type;}
    public function getPeriod() :int {return $this->period;}
    public function getEmail() :string {return $this->email;}
    public function getValue() :float {return $this->value;}
    public function getIdUser() :int {return $this->idUser;}
    public function getIdSkipassObj() :int {return $this->idSkipassObj;}

    //Set methods
    public function setIdSkipassBooking(int $id) {$this->idSkipassBooking = $id;}
    public function setName(string $name) :void {$this->name = $name;}
    public function setSurname(string $surname) :void {$this->surname = $surname;}
    public function setStartDate(string $startDate) :void {$this->startDate = $startDate;}
    public function setType(string $type) :void {$this->type = $type;}
    public function setPeriod(int $period) :void {$this->period = $period;}
    public function setEmail(string $email) :void {$this->email = $email;}
    public function setValue(float $value) :void {$this->value = $value;}
    public function setIdUser(int $id) : void {$this->idUser = $id;}
    public function setIdSkipassObj(int $idSkipassObj) : void {$this->idSkipassObj = $idSkipassObj;}
}