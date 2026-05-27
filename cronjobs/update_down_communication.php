<?php
// Database connection parameters
$host = 'localhost';       // Assuming the database is hosted on the same server
$user = 'root';         // Your database username
$password = '';     // Your database password
$database = 'esurv';       // Your database name

// Create a connection to the MySQL database
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define the SQL query
$sql = "
    UPDATE down_communication dc
    JOIN (
        SELECT panelid, MAX(rtime) AS last_rtime
        FROM wsites
        GROUP BY panelid
    ) w ON dc.panel_id = w.panelid
    SET dc.dc_date = w.last_rtime;
";

// Execute the SQL query
if ($conn->query($sql) === TRUE) {
    echo "Records updated successfully.";
} else {
    echo "Error updating records: " . $conn->error;
}

// Close the connection
$conn->close();
?>
