<?php

class ESkiRun {
    
    //attributes
    /**
     * Holds the id of the ski run in the database.
     * @var int
     */
    private int $idSkiRun;
    /**
     * Holds the name of the ski run.
     * @var string
     */
    private string $name;
    /**
     * Holds the type of the ski run.
     * @var string
     */
    private string $type;
    /**
     * Holds the status of the ski run.
     * @var string
     */
    private string $status;
    /**
     * Holds the id of the ski facility that relate to the ski run.
     * @var int
     */
    private int $idSkiFacility;

    //constructor
    public function __construct(string $name, string $type, string $status) {
        $this->name = $name;
        $this->type = $type;
        $this->status = $status;
    }

    //Get methods
    public function getIdSkiRun() :int {return $this->idSkiRun;}
    public function getIdSkiFacility() :int {return $this->idSkiFacility;}

    public function getName() :string {return $this->name;}
    public function getType() :string {return $this->type;}
    public function getStatus() :string {return $this->status;}

    //Set methods
    public function setIdSkiRun(int $idSkiRun) :void  {$this->idSkiRun = $idSkiRun;}
    public function setIdSkiFacility(int $idSkiFacility) :void  {$this->idSkiFacility = $idSkiFacility;}

    public function setName(string $name) :void {$this->name = $name;}
    public function setType(string $type) :void {$this->type = $type;}
    public function setStatus(string $status) :void {$this->status = $status;}
    
}

?>