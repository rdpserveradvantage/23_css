<?php
// remove_single_delegation.php
include('./config.php');  // Include the database connection file

// Check if the SN parameter is provided
if (isset($_POST['SN'])) {
    $sn = $_POST['SN'];

    // Sanitize the SN input to avoid SQL injection
    $sn = $conn->real_escape_string($sn);

    // Prepare the SQL query to delete the record from delegation_sites
    $sql = "DELETE FROM delegation_sites WHERE SN = '$sn'";

    // Execute the query and check if it was successful
    if ($conn->query($sql) === TRUE) {
        echo "Delegation removed successfully!";
    } else {
        echo "Error removing delegation: " . $conn->error;
    }
} else {
    echo "SN parameter is missing!";
}

// Close the database connection
$conn->close();
?>
