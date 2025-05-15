<?php

/* da implementare */

class ELandingImage{

    //attributes
    private $id;
    private $idImage;
    
    private static $entity = ELandingImage::class;

    //constructor
    public function __construct($idImage){
        $this->idImage = $idImage;
    }

    //methods
    public static function getEntity(): string {return self::$entity;}
    public function getId() {return $this->id;}
    public function getIdImage() {return $this->idImage;}
    public function setId($id) {$this->id = $id;}
    public function setIdImage($id) {$this->idImage = $id;}
}