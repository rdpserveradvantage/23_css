<?php
include('./config.php');

// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the selected filter values from the AJAX request
$customer = isset($_POST['customer']) ? $_POST['customer'] : [];
$bank = isset($_POST['bank']) ? $_POST['bank'] : [];
$zone = isset($_POST['zone']) ? $_POST['zone'] : [];
$panel_make = isset($_POST['panel_make']) ? $_POST['panel_make'] : [];
$dvr_name = isset($_POST['dvr_name']) ? $_POST['dvr_name'] : [];

// Create the SQL query based on selected filters
$sql = "SELECT  SN, ATMID, DVRIP, Customer, Bank, Zone, Panel_make, DVRName FROM sites WHERE 1=1";

if (!empty($customer)) {
    $customer_imploded = "'" . implode("','", $customer) . "'";
    $sql .= " AND Customer IN ($customer_imploded)";
}

if (!empty($bank)) {
    $bank_imploded = "'" . implode("','", $bank) . "'";
    $sql .= " AND Bank IN ($bank_imploded)";
}

if (!empty($zone)) {
    $zone_imploded = "'" . implode("','", $zone) . "'";
    $sql .= " AND Zone IN ($zone_imploded)";
}

if (!empty($panel_make)) {
    $panel_make_imploded = "'" . implode("','", $panel_make) . "'";
    $sql .= " AND Panel_make IN ($panel_make_imploded)";
}

if (!empty($dvr_name)) {
    $dvr_name_imploded = "'" . implode("','", $dvr_name) . "'";
    $sql .= " AND DVRName IN ($dvr_name_imploded)";
}

$sql .= " LIMIT 400";
// echo $sql ; 
// Execute the query
$result = $conn->query($sql);

// Check if any rows are returned
if ($result->num_rows > 0) {
    $sites = [];
    while ($row = $result->fetch_assoc()) {
        // Check if SN exists in the delegation_sites table
        $sn = $row['SN'];
        $delegation_check_sql = "SELECT 1 FROM delegation_sites WHERE SN = '$sn' LIMIT 1";
        $delegation_result = $conn->query($delegation_check_sql);

        // If there's a match in the delegation_sites table, set isDelegated to 1, else 0
        if ($delegation_result && $delegation_result->num_rows > 0) {
            $row['isDelegated'] = 1;
        } else {
            $row['isDelegated'] = 0;
        }

        // Add each row (with isDelegated field) to the results array
        $sites[] = $row;
    }
    echo json_encode($sites); // Return results as JSON
} else {
    echo json_encode([]); // Return empty array if no results
}

// Close connection
$conn->close();
?>
