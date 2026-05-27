<?php
include('./config.php'); // Include your DB connection file

// Check if the required fields are set
if (isset($_POST['atmid_sn']) && !empty($_POST['atmid_sn'])) {
    // Loop through the submitted SNs
    $terminal = $_POST['terminal']; // Array of selected SNs

    $atmid_sn = $_POST['atmid_sn']; // Array of selected SNs
    $atmid = $_POST['atmid']; // Array of ATMIDs
    $dvrip = $_POST['dvrip']; // Array of DVRIPs
    $bank = $_POST['bank']; // Array of Banks
    $customer = $_POST['customer']; // Array of Customers
    $zone = $_POST['zone']; // Array of Zones

    // Loop through the arrays and insert/update records
    foreach ($atmid_sn as $index => $sn) {
        // Prepare the data for insertion or update
        $atm_id = $atmid[$index];
        $dvr_ip = $dvrip[$index];
        $bank_value = $bank[$index];
        $customer_value = $customer[$index];
        $zone_value = $zone[$index];

        // Check if the record with the same SN and ATMID already exists
        $check_sql = "SELECT id FROM delegation_sites WHERE SN = '$sn' AND ATMID = '$atm_id'";
        $result = $conn->query($check_sql);

        // If the record exists, update it
        if ($result->num_rows > 0) {
            // Update the record
            echo $update_sql = "UPDATE delegation_sites SET 
                terminal = '$terminal', 
                DVRIP = '$dvr_ip', 
                Bank = '$bank_value', 
                Customer = '$customer_value', 
                Zone = '$zone_value' 
                WHERE SN = '$sn' AND ATMID = '$atm_id'";
            $conn->query($update_sql);
        } else {
            // If the record doesn't exist, insert a new record
            $insert_sql = "INSERT INTO delegation_sites (SN, terminal,ATMID, DVRIP, Bank, Customer, Zone) 
                VALUES ('$sn', '$terminal', '$atm_id', '$dvr_ip', '$bank_value', '$customer_value', '$zone_value')";
            $conn->query($insert_sql);
        }
    }

    // Redirect or give feedback
    echo "Records have been successfully processed!";
} else {
    // If no SNs are selected, show an error
    echo "No sites selected. Please select at least one site.";
}

// Close the database connection
$conn->close();
?>

<a href="./atm_delegation.php"> &nbsp; Go Back </a>
