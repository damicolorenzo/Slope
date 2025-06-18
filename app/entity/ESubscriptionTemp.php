<?php
class ESubscriptionTemp{

    //attributes
    /**
     * Holds the id of the subscription in the database.
     * @var int
     */
    protected int $idSubscriptionTemp;
    
    private string $description;

    private float $value;

    private float $discount;

    //constructor
    public function __construct(string $description, float $value, float $discount){
        $this->description = $description;
        $this->value = $value;
        $this->discount = $discount;
    }

    //get methods
    public function getIdSubscriptionTemp() : int{
        return $this->idSubscriptionTemp;
    }
    public function getDescription() : string{
        return $this->description;
    }
    public function getValue() : float{
        return $this->value;
    }
    public function getDiscount() : float{
        return $this->discount;
    }

    //set methods
    public function setIdSubscriptionTemp(int $id) : void{
        $this->idSubscriptionTemp = $id;
    }
    public function setDescription(string $description) : void{
        $this->description = $description;
    }
    public function setValue(float $value) : void{
        $this->value = $value;
    }
    public function setDiscount(float $discount) : void{
        $this->discount = $discount;
    }
    

}
?>