<?php

class ESkiFacilityImage{

    //attributes
    private $idSkiFacility;
    private $idImage;
    
    private static $entity = ESkiFacilityImage::class;

    //constructor
    public function __construct($idImage){
        $this->idImage = $idImage;
    }

    //methods
    public static function getEntity(): string {return self::$entity;}
    public function getIdSkiFacility() {return $this->idSkiFacility;}
    public function getIdImage() {return $this->idImage;}
    public function setIdSkiFacility($id) {$this->idSkiFacility = $id;}
    public function setIdImage($id) {$this->idImage = $id;}
}