<?php
// Database connection
$host = "localhost";
$user = "root";
$pass = $password = "";
$dbname = "esurv";

// Function to create a new DB connection
function createConnection($host, $user, $pass, $dbname) {
    $mysqli = new mysqli($host, $user, $pass, $dbname);
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    return $mysqli;
}

// Initial connection
$con = createConnection($host, $user, $password, $dbname);

$start = new DateTime('2025-04-01');
$end = new DateTime('2025-04-29'); // exclusive

while ($start < $end) {
    $startStr = $start->format('Y-m-d 00:00:00');
    $nextDay = clone $start;
    $nextDay->modify('+1 day');
    $endStr = $nextDay->format('Y-m-d 00:00:00');

    $sql = "
        INSERT INTO `alerts2_backup3` (
            `id`, `panelid`, `seqno`, `zone`, `alarm`, `createtime`, `receivedtime`, `comment`, `status`,
            `sendtoclient`, `closedBy`, `closedtime`, `sendip`, `alerttype`, `location`, `priority`,
            `AlertUserStatus`, `level`, `sip2`, `c_status`, `auto_alert`, `critical_alerts`
        )
        SELECT
            `id`, `panelid`, `seqno`, `zone`, `alarm`, `createtime`, `receivedtime`, `comment`, `status`,
            `sendtoclient`, `closedBy`, `closedtime`, `sendip`, `alerttype`, `location`, `priority`,
            `AlertUserStatus`, `level`, `sip2`, `c_status`, `auto_alert`, `critical_alerts`
        FROM `alerts2_backup`
        WHERE `receivedtime` >= '$startStr' AND `receivedtime` < '$endStr'
    ";

    echo "Inserting data for: $startStr to $endStr</ br>";

    if ($con->query($sql) === TRUE) {
        echo "Success</ br>";
    } else {
        echo "Error: " . $con->error . "</ br>";

        // Reconnect if connection is lost
        if (!mysqli_ping($con)) {
            echo "Reconnecting to database...</ br>";
            $con->close();
            sleep(5); // Wait before retry
            $con = createConnection($host, $user, $password, $dbname);
        }

        // Optional: You can log this date and continue or retry
    }

    // Optional: Short delay to avoid DB overload
    sleep(1);

    $start = $nextDay;
}
?>
