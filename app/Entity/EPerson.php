<?php 

Class EPerson {

    // attributes
    protected string $name
    protected string $surname
    protected string $email
    protected int $phoneNumber
    protected DateTime $birthDate
    protected string $username
    protected string $password

    //constructor
    public function __construct(string $name, $string $surname, string $email, int $phoneNumber, DateTime $birthDate, string $username, string $password) {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $objDateTime = new DateTime($birthDate);
        $newObj = clone $objDateTime;
        $newObj->format('Y-m-d'); 
        $this->username = $username;
        $this->password = $password;

    }

    //Get methods
    public function getName() :string {return $this->name;}
    public function getSurname() :string {return $this->surname;}
    public function getEmail() :string {return $this->email;}
    public function getPhoneNumber() :int {return $this->phoneNumber;}
    public function getBirthDate() :DateTime {return $this->birthDate;}
    public function getUsername() :string {return $this->username;}
    public function getPassword() :string {return $this->password;}


    //Set methods
    public function setName(string $name) :void {return $this->name = $name;}
    public function setSurname() :void {return $this->surname = $surname;}
    public function setEmail() :void {return $this->email = $email;}
    public function setPhoneNumber() :void {return $this->phoneNumber = $phoneNumber;}
    public function setBirthDate(string $birthDate) :void {
        $objDateTime = new DateTime($birthDate);
        $newObj = clone $objDateTime;
        $newObj->format('Y-m-d'); 
        $this->startDate = $newObj;
    }
    public function setUsername() :void {return $this->username = $username;}
    public function setPassword() :void {return $this->password = $password;}


}