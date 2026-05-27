<?php
// Define the base directory
$baseDir = __DIR__ . '/Reports'; // Change this to your target directory

// Get the file path from the query parameter
$file = isset($_GET['file']) ? $_GET['file'] : '';

if ($file && file_exists($file) && strpos($file, $baseDir) === 0) {
    // Set headers to initiate a download
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    flush(); // Flush system output buffer
    readfile($file); // Read the file and send it to the output
    exit;
} else {
    echo "Invalid file.";
}
?>
