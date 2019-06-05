<?php
class Users{
 
    // database connection and table name
    private $conn;
    private $table_name = "users";
 
    // object properties
    public $id;
    public $username;
    public $password; 
    public $privileges;
    public $status;

 
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
                    " . $this->table_name ;
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

}