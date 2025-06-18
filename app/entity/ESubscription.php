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
    protected string $startDate;
    /**
     * Holds the id of the user(subscription holder).
     * @var int
     */
    protected string $endDate;
    /**
     * Holds the id of the user(subscription holder).
     * @var int
     */
    protected int $idUser;
    protected int $idSubscriptionTemp;

    //constructor
    public function __construct(string $name, string $surname, string $email, string $startDate, string $endDate){
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
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
    public function getStartDate() : string{
        return $this->startDate;
    }
    public function getEndDate() : string{
        return $this->endDate;
    }
    public function getIdUser() : int{
        return $this->idUser;
    }
    public function getIdSubscriptionTemp() : int{
        return $this->idSubscriptionTemp;
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
    public function setStartDate(string $startDate) : void{
        $this->startDate = $startDate;
    }
    public function setEndDate(string $endDate) : void{
        $this->endDate = $endDate;
    }
    public function setIdUser(int $id) : void{
        $this->idUser = $id;
    }
    public function setIdSubscriptionTemp(int $id) : void{
        $this->idSubscriptionTemp = $id;
    }

}
?>