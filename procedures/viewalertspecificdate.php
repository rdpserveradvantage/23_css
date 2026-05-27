<?php
ini_set('max_execution_time', 900);  // 5 minutes
ini_set('memory_limit', '2G');     // 512 MB


error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "esurv";
$con = $conn = new mysqli($host, $user, $pass, $dbname);


// Fetch the current date
$currentYear = date('Y');
$currentMonth = date('m');
//$currentDay = date('d');
$currentDay = '08';
// Define the folder path based on current date
$folderPath = "../Reports/$currentYear/$currentMonth/$currentDay";

// Create directories if they don't exist
if (!file_exists($folderPath)) {
    mkdir($folderPath, 0777, true); // Create directories recursively with full permissions
}

// Define the file path for the CSV
$filePath = "$folderPath/viewalert.csv";

// Open the file for writing (this will create the file)
$output = fopen($filePath, 'w');

// Check if the file was successfully opened
if ($output === false) {
    die('Error opening the file for writing.');
}

$query = "SELECT * FROM alert_data";
$result = mysqli_query($con, $query);

// Number of rows per sheet
$rowsPerSheet = 1000000;

// Calculate total rows
$totalRows = mysqli_num_rows($result);

// Calculate number of sheets needed
$numSheets = ceil($totalRows / $rowsPerSheet);

// Column headers (updated according to the new column names)
$headers = [
    'id', 'Client_name', 'Incident_number', 'Region', 'ATMID', 'SiteAddress', 'City', 
    'State', 'Zone', 'alarm', 'Incident_category', 'Alram_message', 'createtime', 'receivedtime',
    'closeDateTime', 'DVRIP', 'Panel_make', 'panelid', 'bank', 'Reactive', 'Closed_By', 
    'Closed_Date', 'Remark', 'sendip', 'TestingByServiceTeam', 'Testing_remark'
];

// Write the column headers to the CSV file
fputcsv($output, $headers);

$start = 0;

for ($sheetIndex = 1; $sheetIndex <= $numSheets; $sheetIndex++) {
    // Set the starting point for the current sheet
    $query = "SELECT * FROM alert_data LIMIT $start, $rowsPerSheet";
    $result = mysqli_query($con, $query);

    // For each sheet, write data to the CSV
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }

    // Move to the next chunk of data
    $start += $rowsPerSheet;
}

// Close the file
fclose($output);

// Close the connection
mysqli_close($con);

// Optionally, you can output a success message or redirect the user
echo "CSV file has been successfully saved to: $filePath";
?>
