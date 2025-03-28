<?php
class ESubscription{

    //attributes
    /**
     * Holds the id of the subscription in the database.
     * @var int
     */
    protected int $idSubscription;
    /**
     * Holds the name of the subscription.
     * @var string
     */
    protected string $name;
    /**
     * Holds the surname of the subscription.
     * @var string
     */
    protected string $surname;
    /**
     * Holds the email of the subscription.
     * @var string
     */
    protected string $email;
    /**
     * Holds the type of the subscription.
     * @var string
     */
    protected string $type;
    /**
     * Holds the period of the subscription.
     * @var string
     */
    protected string $period;
    /**
     * Holds the price of the subscription.
     * @var float
     */
    protected float $price;
    /**
     * Holds the start date of the subscription.
     * @var string
     */
    protected string $startDate;
    /**
     * Holds the id of the user(subscription holder).
     * @var int
     */
    protected int $idUser;

    //constructor
    public function __construct(string $name, string $surname, string $email, string $type, string $period, string $startDate, float $price){
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->type = $type;
        $this->period = $period;
        $this->startDate = $startDate;
        $this->price = $price;
    }

    //get methods
    public function getIdSubscription() : int{
        return $this->idSubscription;
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
    public function getPeriod() : string{
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


    //set methods
    public function setIdSubscription(int $id) : void{
        $this->idSubscription = $id;
    }
    public function setName(string $name) : void{
        $this->name = $name;
    }
    public function setSurname(string $surname) : void{
        $this->surname = $surname;
    }
    public function setEmail(string $email) : void{
        $this->email = $email;
    }
    public function setType(string $type) : void{
        $this->type = $type;
    }
    public function setPeriod(string $period) : void{
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

}
?>