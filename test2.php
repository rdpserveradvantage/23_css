<?php
include('config.php'); 
set_time_limit(0);

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "esurv";
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully\n";
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


return ; 



	$sql = mysqli_query($conn,"select * from alerts");
	while($sql_result = mysqli_fetch_assoc($sql)){

	$id = $sql_result['id'];
	$panelid = $sql_result['panelid'];


	$comfortID = mysqli_fetch_assoc(mysqli_query($conn,"select comfortID from sites where NewPanelID='".$panelid."' OR OldPanelID='".$panelid."'"))['comfortID'];

	if($comfortID){
		mysqli_query($conn,"update alerts set comfortID='".$comfortID."' where id='".$id."'");
	}





	}




	return ; 



$sql = mysqli_query($conn, "SELECT * FROM sites");

while ($sql_result = mysqli_fetch_assoc($sql)) {
    $sn = $sql_result['SN'];

    $comfortID = 'CT'.str_pad((int)$sn, 6, "0", STR_PAD_LEFT);
    $update = "UPDATE sites SET comfortID = '$comfortID' WHERE SN = '$sn'";

	mysqli_query($conn, $update);    
}
?>
