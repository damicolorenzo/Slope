<?php
require_once('EPerson.php');

class EAdmin extends EPerson{

    /**
     * Holds the id of the user in the database.
     * @var int
     */
    protected int $idUser;
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
    private static string $entity = EAdmin::class;

    //constructor
    public function __construct(string $name, string $surname, string $email, string $phoneNumber, string $birthDate, string $username, string $password) {
        parent::__construct($name, $surname,  $email,  $phoneNumber,  $birthDate);
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Retrieves the entity class name.
     * @return string The class name of the entity.
     */
    public static function getEntity(): string {
        return self::$entity;
    }

    //getter
    public function getUsername() : string {return $this->username;}
    public function getPassword() : string {return $this->password;}

    //setter
    public function setUsername(string $username) : void {$this->username = $username;}
    public function setPassword(string $password) : void {$this->password = $password;}
}


?>