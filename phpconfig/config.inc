<?php
/* Database credentials. */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'amichelb');
define('DB_PASSWORD', 'OnuZ80kn');
define('DB_NAME', 'amichelb');

/* Variable defintions */
$servername = "localhost";
$username = "amichelb";
$password = "OnuZ80kn";
$dbname = "amichelb";
 
/* Attempt to connect to MySQL database */
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>