<?php
$servername = "localhost";
// $username = "osn_developer01";
// $password = "2?[?k0gZWOu0";
$username = "root";
$password = "";

// Create connection
//$mysqli = new mysqli($servername, $username, $password, "osn_arijs");
$mysqli = new mysqli($servername, $username, $password, "osn_arijs");
$mysqli->set_charset("utf8");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


$path = '';
if(!in_array($_SERVER["HTTP_HOST"],array('localhost:1234','localhost','localhost:80'))){
        $path=$folder='services/';
        include '_updates_sync.php';
    } else {$path=$folder='../services/';}


?>