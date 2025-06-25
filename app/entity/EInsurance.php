<?php
class EInsurance{

    //attributes
    /**
     * Holds the id of the insurance in the database.
     * @var int
     */
    protected string $idInsurance;
    /**
     * Holds the name of the insurance holder.
     * @var string
     */
    protected string $name;
    /**
     * Holds the surname of the insurance holder.
     * @var string
     */
    protected string $surname;
    /**
     * Holds the email of the insurance holder.
     * @var string
     */
    protected string $email;
    /**
     * Holds the type of the insurance.
     * @var string
     */
    protected string $type;
    /**
     * Holds the period of the insurance. (start date + period = end date)
     * @var string
     */
    protected int $period;
    /**
     * Holds the price of the insurance.
     * @var float
     */
    protected float $price;
    /**
     * Holds the start date of the insurance. (start date + period = end date)
     * @var string
     */
    protected string $startDate;
    /**
     * Holds the id of the user(insurance holder).
     * This means that if the insurance holder have an account this id is equal to the user id.
     * Instead if the insurance holder have no account the user id is refered to the user who bought this insurance for him/her.
     * @var int
     */
    protected int $idUser;
    /**
     * Holds the id of the skipassBooking.
     * @var int
     */
    protected int $idSkipassBooking;

    //constructor
    public function __construct(string $name, string $surname, string $email, string $type, string $period, float $price, string $startDate){
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->type = $type;
        $this->period = $period;
        $this->price = $price;
        $this->startDate = $startDate;
    }

    //get methods
    public function getIdInsurance() : int{
        return $this->idInsurance;
    }
    public function getName() : string{
        return $this->name;
    }
    public function getSurname() : string{
        return $this->surname;
    }
    public function getEmail() : string{
        return $this->email;
    }
    public function getType() : string{
        return $this->type;
    }
    public function getPeriod() : int{
        return $this->period;
    }
    public function getPrice() : float{
        return $this->price;
    }
    public function getStartDate() : string{
        return $this->startDate;
    }
    public function getIdUser() : int{
        return $this->idUser;
    }
    public function getIdSkipassBooking() : int{
        return $this->idSkipassBooking;
    }


    //set methods
    public function setIdInsurance(int $id) : void{
        $this->idInsurance = $id;
    }
    public function setName(string $name) :void{
        $this->name = $name;
    }
    public function setSurname(string $surname) :void{
        $this->surname = $surname;
    }
    public function setEmail(string $email) :void{
        $this->email = $email;
    }
    public function setType(string $type) : void{
        $this->type = $type;
    }
    public function setPeriod(int $period) : void{
        $this->period = $period;
    }
    public function setPrice(float $price) : void{
        $this->price = $price;
    }
    public function setStartDate(string $startDate) : void{
        $this->startDate = $startDate;
    }
    public function setIdUser(int $id) : void{
        $this->idUser = $id;
    }
    public function setIdSkipassBooking(int $id) : void{
        $this->idSkipassBooking = $id;
    }

}
?>