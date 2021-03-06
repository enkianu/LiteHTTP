<?php
class Plogs{
 
    // database connection and table name
    private $conn;
    private $table_name = "plogs";
 
    // object properties
    public $id;
    public $username;
    public $ipaddress;
    public $action;
    public $date;
   
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    } 


    function read(){
 
        // select all query
        $query = "SELECT
                  *
                FROM
                    " . $this->table_name . " ORDER BY ID DESC";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }

    function clear(){
 
        // select all query
        $query = "TRUNCATE TABLE " . $this->table_name;
           // echo  $query;
           // die();
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }

}