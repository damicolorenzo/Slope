<?php 

Class EPerson {

    // attributes
    protected string $idUser;
    protected string $name;
    protected string $surname;
    protected string $email;
    protected int $phoneNumber;
    protected DateTime $birthDate;
    protected string $username;
    protected string $password;

    //constructor
    public function __construct(string $idUser, string $name, string $surname, string $email, int $phoneNumber, string $stringBirthDate, string $username, string $password) {
        $this->idUser = $idUser;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $objDateTime = new DateTime($stringBirthDate);
        $newObj = clone $objDateTime;
        $newObj->format('Y-m-d'); 
        $this->birthDate = $newObj;
        $this->username = $username;
        $this->password = $password;

    }

    //Get methods
    public function getId() : string {return $this->idUser;}
    public function getName() :string {return $this->name;}
    public function getSurname() :string {return $this->surname;}
    public function getEmail() :string {return $this->email;}
    public function getPhoneNumber() :int {return $this->phoneNumber;}
    public function getBirthDate() :DateTime {return $this->birthDate;}
    public function getUsername() :string {return $this->username;}
    public function getPassword() :string {return $this->password;}


    //Set methods
    public function setId(string $idUser) :void {$this->idUser = $idUser;}
    public function setName(string $name) :void { $this->name = $name;}
    public function setSurname(string $surname) :void {$this->surname = $surname;}
    public function setEmail(string $email) :void { $this->email = $email;}
    public function setPhoneNumber(int $phoneNumber) :void { $this->phoneNumber = $phoneNumber;}
    public function setBirthDate(string $birthDate) :void {
        $objDateTime = new DateTime($birthDate);
        $newObj = clone $objDateTime;
        $newObj->format('Y-m-d'); 
        $this->startDate = $newObj;
    }
    public function setUsername(string $username) :void { $this->username = $username;}
    public function setPassword(string $password) :void {$this->password = $password;}


}