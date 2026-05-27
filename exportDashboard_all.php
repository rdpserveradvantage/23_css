<?php include('config.php');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Create a new PhpSpreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set the header row in the Excel sheet
$headerRow = [
    'Sr No.',
    'Project',
    'ATMID',
    'Customer',
    'Bank',
    'City',
    'State',
    'Zone',
    'DVRNAME',
    'Tracker No',
    'DVR IP',
    'Username',
    'Password',
    'Live',
    'Live Date',
    'Remarks',
    'Panel Make',
    'Address',
];

$columnIndex = 1;
foreach ($headerRow as $header) {
    $sheet->setCellValueByColumnAndRow($columnIndex, 1, $header);
    $columnIndex++;
}
$sql = $_REQUEST['sql'];


// Fetch data from the database
$query = mysqli_query($conn, $sql);
$srno = ($page - 1) * $recordsPerPage + 1;
$rowIndex = 2;

while ($queryResult = mysqli_fetch_assoc($query)) {
    $columnIndex = 1;

    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $srno);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $queryResult['project']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $queryResult['ATMID']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $queryResult['Customer']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $queryResult['Bank']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $queryResult['City']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $queryResult['State']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $queryResult['Zone']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $queryResult['dvrname']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $queryResult['TrackerNo']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $queryResult['dvrip']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $queryResult['username']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $queryResult['password']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $queryResult['live']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $queryResult['live_date']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $queryResult['site_remark']);
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $queryResult['Panel_Make']);
    

    // Split the address into lines
    $addressWords = explode(' ', $queryResult['Address']);
    $addressLines = array_chunk($addressWords, 3);
    $addressText = '';
    foreach ($addressLines as $line) {
        $addressText .= implode(' ', $line) . "\n";
    }
    
    $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $addressText);
    
    $rowIndex++;
    $srno++;
}

// // Save the Excel file
// $writer = new Xlsx($spreadsheet);
// $excelFilePath = 'exported_table.xlsx';
// $writer->save($excelFilePath);


// Create a writer to save the Excel file
$writer = new Xlsx($spreadsheet);

// Save the Excel file to a temporary location
$tempFile = tempnam(sys_get_temp_dir(), 'Inventory');
$writer->save($tempFile);

// Provide the file as a download to the user
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ExportedRecords.xlsx"');
header('Cache-Control: max-age=0');
readfile($tempFile);

// Close the database connection
mysqli_close($con);

// Clean up and delete the temporary file
unlink($tempFile);

?>
