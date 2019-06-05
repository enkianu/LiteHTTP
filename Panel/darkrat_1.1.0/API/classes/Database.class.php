<?php



class Database{
 
    // specify your own database credentials
    private $host;
    private $db_name;
    private $username;
    private $password;
    public $conn;
 
    // get the database connection
    public function getConnection(){
        include("../config.php");
        $this->conn = null;
 
        try{
            $this->conn =  new PDO("mysql:host=".$config['dbhost'].";dbname=".$config["dbname"], $config["dbuser"], $config["dbpass"]);

            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>