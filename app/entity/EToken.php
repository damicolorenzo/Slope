<?php
class EToken{

    //attributes
    /**
     * Holds the id of the token in the database.
     * @var int
     */
    private int $id;
    /**
     * Holds the id of the user in the database.
     * @var int
     */
    private int $userId;
    /**
     * Holds the token in the database.
     * @var string
     */
    private string $token;
    /**
     * Holds the expire time of the token in the database.
     * @var string
     */
    private string $expiresAt;
    /**
     * Holds the used value of the token in the database.
     * @var bool
     */
    private bool $used;
    /**
     * Holds the create time of the token in the database.
     * @var string
     */
    private string $createdAt;

    //constructor
    public function __construct(string $token, string $expiresAt, string $createdAt) {
        $this->token = $token;
        $this->expiresAt = $expiresAt;
        $this->used = false;
        $this->createdAt = $createdAt;
    }

    //Get methods
    public function getId() : int {return $this->id;}
    public function getUserId() : int {return $this->userId;}
    public function getToken() : string {return $this->token;}
    public function getExpiresAt() : string {return $this->expiresAt;}
    public function getUsed() : bool {return $this->used;}
    public function getCreatedAt() : string {return $this->createdAt;}

    //Set methods
    public function setId(int $id) : void {$this->id = $id;}
    public function setUserId(int $userId) : void {$this->userId = $userId;}
    public function setToken(string $token) : void {$this->token = $token;}
    public function setExpiresAt(string $expiresAt) : void {$this->expiresAt = $expiresAt;}
    public function setUsed(bool $used) : void {$this->used = $used;}
    public function setCreatedAt(string $createdAt) : void {$this->createdAt = $createdAt;}

}
?>