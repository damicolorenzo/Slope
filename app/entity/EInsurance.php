<?php
class EInsurance{

    //attributes
    protected string $idInsurance;
    protected string $type;
    protected int $period;
    protected float $price;
    protected string $idPayment;

    //constructor
    //rivedere se inserire o meno idInsurance e idPayment nel costruttore

    public function ___construct(string $type, int $period, float $price, string $idPayment){
        $this->type = $type;
        $this->period = $period;
        $this->price = $price;
    }

    //get methods
    public function getId(){
        return $this->idInsurance;
    }
    public function getType(){
        return $this->type;
    }
    public function getPeriod(){
        return $this->period;
    }
    public function getPrice(){
        return $this->price;
    }
    public function getIdPayment(){
        return $this->idPayment;
    }


    //set methods
    public function setId(string $id){
        $this->idInsurance = $id;
    }
    public function setType(string $type1){
        $this->type = $type1;
    }
    public function setPeriod(int $period1){
        $this->period = $period1;
    }
    public function setPrice(float $price1){
        $this->price = $price1;
    }

}
?>