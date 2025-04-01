<?php

$servername = "localhost"; // Change if necessary
$username = "my_db_username";
$password = "my_db_password";
$database = "my_db_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get all table names
$tables = [];
$result = $conn->query("SHOW TABLES");
while ($row = $result->fetch_array()) {
    $tables[] = $row[0];
}

// Disable foreign key checks
$conn->query("SET FOREIGN_KEY_CHECKS = 0");

// Drop each table
foreach ($tables as $table) {
    $conn->query("DROP TABLE IF EXISTS `$table`");
}

// Re-enable foreign key checks
$conn->query("SET FOREIGN_KEY_CHECKS = 1");

echo "All tables have been deleted. Database is now empty.";

$conn->close();

?>
