<?php

require_once('EPerson.php');

class EUser extends EPerson {

    //attributes
    /**
     * Holds the id of the user in the database.
     * @var int
     */
    protected int $idUser;
    /**
     * Holds the id of the user image in the database.
     * @var int
     */
    protected int $idImage;
    /**
     * Holds the username of the user.
     * @var string
     */
    protected string $username;
    /**
     * Holds the password of the user.
     * @var string
     */
    protected string $password;
    /**
     * Holds the entity class name.
     * @var string
     */
    private static string $entity = EUser::class;

    //constructor
    public function __construct(?string $name, ?string $surname, ?string $email, ?string $phoneNumber, ?string $birthDate, string $username, string $password) {
        if(isset($name) && isset($surname) && isset($email) && isset($phoneNumber) && isset($birthDate))
            parent::__construct($name, $surname,  $email,  $phoneNumber,  $birthDate);
        else
            parent::__construct("", "", "", "", "");
        $this->username = $username;
        $this->password = $password;
        $this->idImage = 0;
    }

    /**
     * Retrieves the entity class name.
     * @return string The class name of the entity.
     */
    public static function getEntity(): string {return self::$entity;}

    //getter
    public function getIdUser() : int {return parent::getId();}
    public function getUsername() : string {return $this->username;}
    public function getPassword() : string {return $this->password;}
    public function getName() :string {return parent::getName();}
    public function getSurname() :string {return parent::getSurname();}
    public function getEmail() :string {return parent::getEmail();}
    public function getPhoneNumber() :string {return parent::getPhoneNumber();}
    public function getBirthDate() :string {return parent::getBirthDate();}
    

    //setter
    public function setUsername(string $username) : void {$this->username = $username;}
    public function setPassword(string $password) : void {$this->password = $password;}
    public function setIdUser(int $id) : void {$this->idUser = $id;}

    public function getIdImage() {return $this->idImage;}
    public function setIdImage($idImage) {$this->idImage = $idImage;}
}

?>