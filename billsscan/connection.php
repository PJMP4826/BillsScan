<?php
$host = 'localhost'; 
$dbname = 'proyecto';
$user = 'root'; 
$pass = ''; 

$con = new mysqli($host, $user, $pass, $dbname);

if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);
}

?>
