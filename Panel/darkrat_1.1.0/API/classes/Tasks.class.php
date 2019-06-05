<?php
class Tasks{
 
    // database connection and table name
    private $conn;
    private $table_name = "tasks";
 
    // object properties
    public $id;
    public $task;
    public $params;
    public $filters;
    public $executions;
    public $username;
    public $status;
    public $execution_only;
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
                    " . $this->table_name . " WHERE execution_only IS NULL ORDER BY id DESC";
                    //SELECT * FROM tasks WHERE IS NULL
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }


    // create product
function create(){
 
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
            task=:task, params=:params, filters=:filters, executions=:executions, username=:username, status=:status,execution_only=:execution_only,date=:date";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 


    // sanitize
    $this->task=htmlspecialchars(strip_tags($this->task));
    $this->params=base64_encode(htmlspecialchars(strip_tags($this->params)));
    $this->filters = "";
    $this->executions=htmlspecialchars(strip_tags($this->executions));
    $this->username = strip_tags($this->username);
    $this->status=1;
    $this->execution_only = NULL;
    $this->date=time();
 
    // bind values
    $stmt->bindParam(":task", $this->task);
    $stmt->bindParam(":params", $this->params);
    $stmt->bindParam(":filters", $this->filters);
    $stmt->bindParam(":executions", $this->executions);
    $stmt->bindParam(":username", $this->username);
    $stmt->bindParam(":status", $this->status);
    $stmt->bindParam(":execution_only", $this->execution_only);
    $stmt->bindParam(":date", $this->date);
 
    // execute query
    if($stmt->execute()){
        $in = $this->conn->prepare("INSERT INTO plogs VALUES(NULL, :u, :ip, :r, UNIX_TIMESTAMP())");
        $in->execute(array(":u" => $this->username, ":ip" => $_SERVER['REMOTE_ADDR'], ":r" => 'Create task #'. $this->conn->query("SELECT id FROM tasks ORDER BY id DESC LIMIT 1")->fetchColumn(0)));
        return true;
    }
 
    return false;
     
}

    function pause(){
    //    $this->id=htmlspecialchars(strip_tags($this->id));
        $up = $this->conn->prepare("UPDATE " . $this->table_name . " SET status = '2' WHERE id = :i LIMIT 1");
        $up->execute(array(":i" => $this->id));
        $in = $this->conn->prepare("INSERT INTO plogs VALUES(NULL, :u, :ip, :r, UNIX_TIMESTAMP())");
        $in->execute(array(":u" => $this->username, ":ip" => $_SERVER['REMOTE_ADDR'], ":r" => 'Paused task #'. $this->id));

        return true;
    }
    function resume(){
    //    $this->id=htmlspecialchars(strip_tags($this->id));
        $up = $this->conn->prepare("UPDATE " . $this->table_name . " SET status = '1' WHERE id = :i LIMIT 1");
        $up->execute(array(":i" => $this->id));
        $in = $this->conn->prepare("INSERT INTO plogs VALUES(NULL, :u, :ip, :r, UNIX_TIMESTAMP())");
        $in->execute(array(":u" => $this->username, ":ip" => $_SERVER['REMOTE_ADDR'], ":r" => 'Resume task #'. $this->id));

        //echo  $this->id;
        return true;
    }
    function delete(){

        $statement = $this->conn->prepare("DELETE FROM " . $this->table_name . " WHERE id = ?");
        $statement->execute(array($this->id)); 
        $in = $this->conn->prepare("INSERT INTO plogs VALUES(NULL, :u, :ip, :r, UNIX_TIMESTAMP())");
        $in->execute(array(":u" => $this->username, ":ip" => $_SERVER['REMOTE_ADDR'], ":r" => 'Delete task #'. $this->id));
        return true;
    }

}

/*
SELECT * FROM tasks

SELECT
(SELECT * FROM tasks)+
(SELECT COUNT(*) FROM tasks_completed WHERE taskid = :i)
AS SumCount
*/