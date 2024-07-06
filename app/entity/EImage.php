<?php

class EImage{

    //attributes
    private $idImage;
    private $name;
    private $size;
    private $types;
    private $imageData;
    private static $entity = EImage::class;

    //constructor
    public function __construct($name, $size, $type, $imageData){
        $this->name = $name;
        $this->size = $size;
        $this->types = $type;
        $this->imageData = $imageData;
    }

    //methods
    public static function getEntity(): string {return self::$entity;}
    public function getId() {return $this->idImage;}
    public function getName() {return $this->name;}
    public function getSize() {return $this->size;}
    public function getType() {return $this->types;}
    public function getImageData() {return $this->imageData;}
    public function getEncodedData() {return base64_encode($this->imageData);}
    public function setId($id) {$this->idImage = $id;}
}