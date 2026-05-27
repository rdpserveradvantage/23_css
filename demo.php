<?php

// Increase memory and execution limits
ini_set('memory_limit', '512M');
set_time_limit(0);

// Enable output buffering for real-time display
ob_implicit_flush(true);
ob_end_flush();

function logMessage($msg) {
    $timestamp = date('Y-m-d H:i:s');
    echo "[$timestamp] $msg\n";
}

function connectToDatabase($maxAttempts = 5) {
    $attempt = 0;
    
    while ($attempt < $maxAttempts) {
        $attempt++;
        
        try {
            logMessage("Attempting database connection (Attempt $attempt of $maxAttempts)...");
            
            $mysqli = new mysqli("localhost", "root", "", "esurv");
            
            if ($mysqli->connect_errno) {
                throw new Exception("Connection failed: " . $mysqli->connect_error);
            }
            
            // Set charset
            if (!$mysqli->set_charset("utf8mb4")) {
                throw new Exception("Charset error: " . $mysqli->error);
            }
            
            logMessage("✓ Database connection established successfully");
            return $mysqli;
            
        } catch (Exception $e) {
            logMessage("✗ Connection attempt failed: " . $e->getMessage());
            
            if ($attempt < $maxAttempts) {
                logMessage("Retrying in 5 seconds...");
                sleep(5);
            } else {
                logMessage("Maximum connection attempts reached. Exiting.");
                return false;
            }
        }
    }
    
    return false;
}

function checkConnection($mysqli) {
    if ($mysqli && $mysqli->ping()) {
        return true;
    }
    return false;
}

// Save checkpoint
function saveCheckpoint($date, $lastId = 0) {
    $checkpointFile = 'migration_checkpoint.txt';
    file_put_contents($checkpointFile, "$date,$lastId");
    logMessage("Checkpoint saved: Date=$date, LastID=$lastId");
}

// Load checkpoint
function loadCheckpoint() {
    $checkpointFile = 'migration_checkpoint.txt';
    if (file_exists($checkpointFile)) {
        $data = trim(file_get_contents($checkpointFile));
        list($date, $lastId) = explode(',', $data);
        logMessage("Resuming from checkpoint: Date=$date, LastID=$lastId");
        return ['date' => $date, 'last_id' => (int)$lastId];
    }
    return null;
}

// Direct delete without transaction rollback
function processBatchDirect($mysqli, $targetTable, $ids) {
    if (empty($ids)) return 0;
    
    $idList = implode(',', $ids);
    $processed = 0;
    
    try {
        // 1. INSERT without transaction - auto-commit mode
        $mysqli->autocommit(true); // Enable auto-commit
        
        logMessage("Inserting " . count($ids) . " rows into $targetTable...");
        $insertResult = $mysqli->query("
            INSERT IGNORE INTO `$targetTable`
            SELECT *
            FROM alert_3
            WHERE id IN ($idList)
        ");
        
        if (!$insertResult) {
            throw new Exception("Insert failed: " . $mysqli->error);
        }
        
        $insertedRows = $mysqli->affected_rows;
        logMessage("Inserted $insertedRows rows");
        
        // 2. DELETE without transaction - permanent delete
        logMessage("Deleting " . count($ids) . " rows from alert_3...");
        $deleteResult = $mysqli->query("
            DELETE FROM alert_3
            WHERE id IN ($idList)
        ");
        
        if (!$deleteResult) {
            throw new Exception("Delete failed: " . $mysqli->error);
        }
        
        $deletedRows = $mysqli->affected_rows;
        $processed = $deletedRows;
        
        logMessage("Deleted $deletedRows rows permanently");
        
        // Verify the delete
        $verifyQuery = $mysqli->query("
            SELECT COUNT(*) as remaining 
            FROM alert_3 
            WHERE id IN ($idList)
        ");
        
        if ($verifyQuery) {
            $verifyRow = $verifyQuery->fetch_assoc();
            if ($verifyRow['remaining'] > 0) {
                logMessage("WARNING: {$verifyRow['remaining']} rows still exist after delete!");
            } else {
                logMessage("✓ Verified: All rows deleted successfully");
            }
        }
        
    } catch (Exception $e) {
        logMessage("✗ Error in batch processing: " . $e->getMessage());
        // Continue with next batch even if this one fails
    }
    
    return $processed;
}

// Get current row count for monitoring
function getRowCount($mysqli) {
    $result = $mysqli->query("SELECT COUNT(*) as cnt FROM alert_3");
    if ($result) {
        $row = $result->fetch_assoc();
        return $row['cnt'];
    }
    return 0;
}

// Main script
logMessage("Starting data migration from alert_3 to date-based tables...");
logMessage("WARNING: This script uses direct DELETE without transaction rollback!");
logMessage("Deleted rows will be PERMANENT even if script fails!");

$batchSize = 500; // Smaller batches for safety
$totalRowsProcessed = 0;
$totalTablesCreated = 0;
$startTime = microtime(true);
$mysqli = null;

// Initial database connection
$mysqli = connectToDatabase();
if (!$mysqli) {
    die("Could not establish database connection. Exiting.\n");
}

// Set auto-commit ON (no transactions)
$mysqli->autocommit(true);

// Load checkpoint if exists
$checkpoint = loadCheckpoint();
$checkpointDate = $checkpoint ? $checkpoint['date'] : null;
$lastProcessedId = $checkpoint ? $checkpoint['last_id'] : 0;

// Get initial count
$initialCount = getRowCount($mysqli);
logMessage("Initial rows in alert_3: " . number_format($initialCount));

while (true) {
    // Check connection
    if (!checkConnection($mysqli)) {
        logMessage("Database connection lost. Attempting to reconnect...");
        $mysqli = connectToDatabase();
        if (!$mysqli) {
            die("Could not re-establish database connection. Exiting.\n");
        }
        $mysqli->autocommit(true);
        sleep(2);
    }
    
    // 1️⃣ Find date to process
    $currentDate = null;
    
    if ($checkpointDate) {
        // Use checkpoint date
        $currentDate = $checkpointDate;
        $checkpointDate = null; // Use only once
        logMessage("Resuming from checkpoint date: $currentDate");
    } else {
        // Find earliest date
        logMessage("Finding earliest date in alert_3...");
        
        $res = $mysqli->query("
            SELECT DATE(receivedtime) as min_date
            FROM alert_3
            WHERE receivedtime IS NOT NULL
            ORDER BY receivedtime ASC
            LIMIT 1
        ");

        if (!$res || $res->num_rows === 0) {
            logMessage("No more data to process in alert_3.");
            break;
        }
        
        $row = $res->fetch_assoc();
        $currentDate = $row['min_date'];
        
        if (empty($currentDate)) {
            logMessage("No valid dates found in receivedtime column.");
            break;
        }
    }
    
    $start = $currentDate . " 00:00:00";
    $end = date('Y-m-d 00:00:00', strtotime($currentDate . ' +1 day'));
    $dateKey = date('Ymd', strtotime($currentDate));
    $targetTable = "alertdata_" . $dateKey;

    logMessage("Processing date: $currentDate -> Table: $targetTable");

    // 2️⃣ Ensure table exists
    $tableExists = $mysqli->query("SHOW TABLES LIKE '$targetTable'")->num_rows > 0;
    
    if (!$tableExists) {
        logMessage("Creating table $targetTable...");
        $createResult = $mysqli->query("
            CREATE TABLE IF NOT EXISTS `$targetTable`
            LIKE alert_3
        ");
        
        if ($createResult) {
            $totalTablesCreated++;
            logMessage("✓ Table $targetTable created successfully");
        } else {
            logMessage("✗ Failed to create table $targetTable: " . $mysqli->error);
            break;
        }
    } else {
        logMessage("Table $targetTable already exists");
    }

    // Get total rows for this date
    $countRes = $mysqli->query("
        SELECT COUNT(*) as date_count
        FROM alert_3
        WHERE receivedtime >= '$start'
          AND receivedtime < '$end'
    ");
    
    $totalForDate = 0;
    if ($countRes) {
        $countRow = $countRes->fetch_assoc();
        $totalForDate = $countRow['date_count'];
        logMessage("Rows to process for $currentDate: " . number_format($totalForDate));
    }

    $rowsForDate = 0;
    $batchCount = 0;
    $lastId = $lastProcessedId;

    // 3️⃣ Process date in batches WITHOUT TRANSACTIONS
    while (true) {
        $batchCount++;
        
        // Check connection
        if (!checkConnection($mysqli)) {
            logMessage("Connection lost. Reconnecting...");
            $mysqli = connectToDatabase();
            if (!$mysqli) {
                die("Could not re-establish connection. Exiting.\n");
            }
            $mysqli->autocommit(true);
            continue;
        }
        
        // Get batch of IDs with WHERE clause to skip already processed
        $whereClause = "receivedtime >= '$start' AND receivedtime < '$end'";
        if ($lastId > 0) {
            $whereClause .= " AND id > $lastId";
        }
        
        $idRes = $mysqli->query("
            SELECT id
            FROM alert_3
            WHERE $whereClause
            ORDER BY id ASC
            LIMIT $batchSize
        ");

        if (!$idRes) {
            logMessage("Error fetching batch IDs: " . $mysqli->error);
            sleep(2);
            continue;
        }

        if ($idRes->num_rows === 0) {
            logMessage("No more rows for date $currentDate");
            break;
        }

        $ids = [];
        while ($r = $idRes->fetch_assoc()) {
            $ids[] = $r['id'];
            $lastId = $r['id']; // Track last processed ID
        }
        $idRes->free();

        if (empty($ids)) {
            break;
        }

        $currentBatchRows = count($ids);
        
        // Process batch DIRECTLY (no transaction)
        $processed = processBatchDirect($mysqli, $targetTable, $ids);
        
        $rowsForDate += $processed;
        $totalRowsProcessed += $processed;
        
        // Save checkpoint after each batch
        saveCheckpoint($currentDate, $lastId);
        
        // Show progress
        $currentCount = getRowCount($mysqli);
        $progressPercent = $totalForDate > 0 ? round(($rowsForDate / $totalForDate) * 100, 2) : 0;
        
        logMessage("✓ Batch $batchCount: Processed $processed rows");
        logMessage("  Date progress: $rowsForDate/$totalForDate ($progressPercent%)");
        logMessage("  Remaining in alert_3: " . number_format($currentCount));
        logMessage("  Total processed: " . number_format($totalRowsProcessed));
        
        // Free memory
        unset($ids);
        
        // Periodic status update
        if ($batchCount % 10 === 0) {
            $memoryUsage = round(memory_get_usage(true) / 1024 / 1024, 2);
            $elapsedTime = time() - $startTime;
            $rowsPerSecond = $totalRowsProcessed > 0 ? round($totalRowsProcessed / $elapsedTime, 2) : 0;
            
            logMessage("=== Status Update ===");
            logMessage("Memory: {$memoryUsage}MB");
            logMessage("Speed: {$rowsPerSecond} rows/sec");
            logMessage("Elapsed: {$elapsedTime}s");
            logMessage("=====================");
            
            // Force garbage collection
            gc_collect_cycles();
        }
        
        // Small delay to prevent overwhelming
        usleep(50000); // 0.05s
        
        // Safety check - if processing too slowly, reduce batch size
        if ($processed < $currentBatchRows * 0.5) {
            // Less than 50% success rate, reduce batch size
            $newBatchSize = max(100, floor($batchSize * 0.8));
            if ($newBatchSize < $batchSize) {
                logMessage("Reducing batch size from $batchSize to $newBatchSize due to low success rate");
                $batchSize = $newBatchSize;
            }
        }
    }

    logMessage("✅ Completed date $currentDate: " . number_format($rowsForDate) . " rows");
    
    // Clear checkpoint after completing a date
    if (file_exists('migration_checkpoint.txt')) {
        unlink('migration_checkpoint.txt');
        logMessage("Checkpoint cleared for completed date");
    }
    
    // Optimize tables after completing a date
    if ($rowsForDate > 0) {
        logMessage("Optimizing tables...");
        $mysqli->query("OPTIMIZE TABLE alert_3");
        $mysqli->query("OPTIMIZE TABLE `$targetTable`");
    }
    
    // Reset lastId for next date
    $lastProcessedId = 0;
    
    sleep(1);
}

$endTime = microtime(true);
$executionTime = round($endTime - $startTime, 2);
$rowsPerSecond = $totalRowsProcessed > 0 ? round($totalRowsProcessed / $executionTime, 2) : 0;
$finalCount = getRowCount($mysqli);

logMessage("=========================================");
logMessage("MIGRATION COMPLETED");
logMessage("=========================================");
logMessage("Initial rows: " . number_format($initialCount));
logMessage("Final rows: " . number_format($finalCount));
logMessage("Total rows processed: " . number_format($totalRowsProcessed));
logMessage("Total tables created: $totalTablesCreated");
logMessage("Execution time: {$executionTime}s");
logMessage("Average speed: {$rowsPerSecond} rows/second");
logMessage("Rows reduced by: " . number_format($initialCount - $finalCount));
logMessage("=========================================");

if ($mysqli) {
    $mysqli->close();
}

// Final cleanup
if (file_exists('migration_checkpoint.txt')) {
    unlink('migration_checkpoint.txt');
}

logMessage("Script completed successfully!");
?>
