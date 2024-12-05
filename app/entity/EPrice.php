<?php

class EPrice {
    
    private int $idPrice;

    private string $description;
    private float $full, $reduced;

    public function __construct(string $description, float $full, float $reduced)  {
        $this->description = $description;
        $this->full = $full;
        $this->reduced = $reduced;
    }

    public function getIdPrice() : int {return $this->idPrice;}
    public function getDescription() : string {return $this->description;}
    public function getFull() : float {return $this->full;}
    public function getReduced() : float {return $this->reduced;}

    public function setIdPrice(int $idPrice) : void {$this->idPrice = $idPrice;}
    public function setDescription(string $description) : void {$this->description = $description;}
    public function setFull(float $full) : void {$this->full = $full;}
    public function setReduced(float $reduced) : void {$this->reduced = $reduced;}

}

?>