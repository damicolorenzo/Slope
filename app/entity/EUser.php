<?php

require_once('EPerson.php');

class EUser extends EPerson {

    protected $idImage;

    private static $entity = EUser::class;

    //constructor
    public function __construct(string $name, string $surname, string $email, string $phoneNumber, string $birthDate, string $username, string $password) {
        parent::__construct($name, $surname,  $email,  $phoneNumber,  $birthDate,  $username,  $password);
        $this->idImage = 0;
    }

    public static function getEntity(): string {return self::$entity;}

    public function getIdImage() {return $this->idImage;}
    public function setIdImage($idImage) {$this->idImage = $idImage;}
}

?>