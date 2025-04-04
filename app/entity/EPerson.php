<?php 

Class EPerson {

    // attributes
    /**
     * Holds the id of the person in the database.
     * @var int
     */
    protected int $idUser;
    /**
     * Holds the name of the person.
     * @var string
     */
    protected string $name;
    /**
     * Holds the surname of the person.
     * @var string
     */
    protected string $surname;
    /**
     * Holds the email of the person.
     * @var string
     */
    protected string $email;
    /**
     * Holds the phone number of the person.
     * @var string
     */
    protected string $phoneNumber;
    /**
     * Holds the birth date of the person.
     * @var string
     */
    protected string $birthDate;
    /* 
    protected string $username;
    protected string $password;
    protected int $cardNumber;
    */

    //constructor
    public function __construct(string $name, string $surname, string $email, string $phoneNumber, string $stringBirthDate/* , string $username, string $password */) {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->birthDate = $stringBirthDate;
        /* $this->username = $username;
        $this->password = $password; */
    }

    //Get methods
    public function getId() :int {return $this->idUser;}

    public function getName() :string {return $this->name;}
    public function getSurname() :string {return $this->surname;}
    public function getEmail() :string {return $this->email;}
    public function getPhoneNumber() :string {return $this->phoneNumber;}
    public function getBirthDate() :string {return $this->birthDate;}
    /* public function getUsername() :string {return $this->username;}
    public function getPassword() :string {return $this->password;}
    public function getCardNumber() :int {return $this->cardNumber;} */


    //Set methods
    public function setId(int $id) :void { $this->idUser = $id;}
    
    public function setName(string $name) :void { $this->name = $name;}
    public function setSurname(string $surname) :void {$this->surname = $surname;}
    public function setEmail(string $email) :void { $this->email = $email;}
    public function setPhoneNumber(string $phoneNumber) :void { $this->phoneNumber = $phoneNumber;}
    public function setBirthDate(string $birthDate) :void {$this->birthDate = $birthDate;}
    /* public function setUsername(string $username) :void { $this->username = $username;}
    public function setPassword(string $password) :void {$this->password = $password;}
    public function setCardNumber(int $cardNumber) :void {$this->cardNumber = $cardNumber;} */


}