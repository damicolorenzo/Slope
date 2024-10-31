<?php 

Class EPerson {

    // attributes
    protected $idUser;

    protected string $name;
    protected string $surname;
    protected string $email;
    protected string $phoneNumber;
    protected string $birthDate;
    protected string $username;
    protected string $password;
    protected int $cardNumber;

    //constructor
    //rivedere se inserire o meno cardNumber nel costruttore
    public function __construct(string $name, string $surname, string $email, string $phoneNumber, string $stringBirthDate, string $username, string $password) {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->birthDate = $stringBirthDate;
        $this->username = $username;
        $this->password = $password;
    }

    //Get methods
    public function getId() :int {return $this->idUser;}

    public function getName() :string {return $this->name;}
    public function getSurname() :string {return $this->surname;}
    public function getEmail() :string {return $this->email;}
    public function getPhoneNumber() :string {return $this->phoneNumber;}
    public function getBirthDate() :string {return $this->birthDate;}
    public function getUsername() :string {return $this->username;}
    public function getPassword() :string {return $this->password;}
    public function getCardNumber() :int {return $this->cardNumber;}


    //Set methods
    public function setId(int $id) :void { $this->idUser = $id;}
    
    public function setName(string $name) :void { $this->name = $name;}
    public function setSurname(string $surname) :void {$this->surname = $surname;}
    public function setEmail(string $email) :void { $this->email = $email;}
    public function setPhoneNumber(string $phoneNumber) :void { $this->phoneNumber = $phoneNumber;}
    public function setBirthDate(string $stringBirthDate) :void {$this->birthDate = $stringBirthDate;}
    public function setUsername(string $username) :void { $this->username = $username;}
    public function setPassword(string $password) :void {$this->password = $password;}
    public function setCardNumber(int $cardNumber) :void {$this->cardNumber = $cardNumber;}


}