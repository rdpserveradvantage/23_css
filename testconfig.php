<?php 
$host="192.168.0.11:90";
//$host="localhost";
$user="root";
$pass="";
$dbname="esurv";
//$conn = new mysqli($host, $user, $pass, $dbname);
$conn = new mysqli($host, $user, $pass, $dbname);
//$conn = mysqli_connect($host, $user, $pass, $dbname);
// Check connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected succesfull";
   
}










?>