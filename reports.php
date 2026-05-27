<?php
// Define the base directory
$baseDir = __DIR__ . '/Reports'; // Change this to your target directory

// Get the current directory path from the URL, or default to the base directory
$currentDir = isset($_GET['dir']) ? $_GET['dir'] : $baseDir;

// Function to scan the directory and return items
function scanDirectory($dir) {
    if (!is_dir($dir)) {
        // If the directory does not exist, return an empty array
        return false;
    }
    
    $items = scandir($dir);
    $items = array_diff($items, array('.', '..')); // Exclude . and ..
    return $items;
}

// Get the items in the current directory
$items = scanDirectory($currentDir);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directory Listing</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        a {
            display: block;
            margin: 10px 0;
            padding: 10px;
            border-radius: 4px;
            text-decoration: none;
            color: #fff;
            transition: background 0.3s;
        }
        a.folder {
            background-color: #007bff;
        }
        a.folder:hover {
            background-color: #0056b3;
        }
        a.file {
            background-color: #28a745;
        }
        a.file:hover {
            background-color: #218838;
        }
        .back {
            font-weight: bold;
            color: #007bff;
            margin-bottom: 20px;
            text-decoration: underline;
        }
        .back:hover {
            color: #0056b3;
        }
        .file-info {
            color: #555;
            margin-top: 5px;
        }
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Reports</h1>

        <?php
        // Show a back link if not in the base directory
        if ($currentDir !== $baseDir) {
            $parentDir = dirname($currentDir);
            echo "<a href='?dir=" . urlencode($parentDir) . "' class='back'>Back to Parent Directory</a>";
        }

        // Check if items were retrieved
        if ($items === false) {
            echo "<p class='error'>Error: The directory <strong>$currentDir</strong> does not exist.</p>";
        } else {
            // List folders and files
            foreach ($items as $item) {
                $itemPath = $currentDir . '/' . $item;
                if (is_dir($itemPath)) {
                    echo "<a href='?dir=" . urlencode($itemPath) . "' class='folder'><i class='fas fa-folder'></i> $item</a>";
                } else {
                    echo "<a href='download.php?file=" . urlencode($itemPath) . "' class='file'><i class='fas fa-file'></i> $item</a>";
                }
            }
        }
        ?>
    </div>
</body>
</html>
