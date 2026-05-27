<?php 
// Step 1: Database connection
$servername = "localhost"; // Change this as needed
$username = "root";        // Change this as needed
$password = "";            // Change this as needed
$dbname = "esurv";         // Change this to your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>