<?php
date_default_timezone_set('Asia/Kolkata');
error_reporting(0);
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "esurv";
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
} else {
      //echo "Connected succesfully";
}


//$newcn = new mysqli("localhost", $user, $pass,$dbname);
//$newcn = new mysqli("192.168.100.21", "esurv", "Esurv123*","esurv");
//$newcn = new mysqli($host, "esurv", "Esurv123*","esurv");
// Check connection
//if ($newcn->connect_error) {
//    die("Connection failed: " . $newcn->connect_error);
//echo "Connection Failed";
//} else {
//echo "Connected succesfully";
//}

//$cn = new mysqli("localhost", $user, $pass,$dbname);
//$cn = new mysqli("192.168.0.11", "esurv", "Esurv123*","esurv");
//$cn = new mysqli($host, "esurv", "Esurv123*","esurv");
// Check connection
//if ($cn->connect_error) {
//  die("Connection failed: " . $cn->connect_error);
//echo "Connection Failed";
// } else {
//echo "Connected succesfully";
//}


//$contt = new mysqli("198.38.84.103", "comsarmi_bajaj", //"Bajaj@1234", "comsarmi_dvr_bajaj");
//if ($contt->connect_error) {
//  die("Connection failed: " . $contt->connect_error);
//} else {
//echo "Connected succesfully";
//}


//$cont = new mysqli("198.38.84.103", "sarmicro_esurvwb", "esurv123*", "sarmicro_esurvweb");
//if ($cont->connect_error) {
//  die("Connection failed: " . $cont->connect_error);
///} else{
//echo "Connected succesfully";
//}


$userid = $_SESSION['id'];
$curentdt = date("Y-m-d H:i:s");
$t = date("H:i:s");
$now = $datetime = date('Y-m-d H:i:s');
?>