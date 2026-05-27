<?php
header("Refresh: 5");

$mysqli = new mysqli("localhost", "root", "", "");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$result = $mysqli->query("SELECT id FROM information_schema.processlist WHERE id > 54867 AND id <> CONNECTION_ID()");

while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $mysqli->query("KILL $id");
    echo "Killed connection ID: $id\n";
}

$mysqli->close();

?>
