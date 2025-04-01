<?php

$servername = "localhost"; // Change if necessary
$username = "my_db_username";
$password = "my_db_password";
$database = "my_db_name";

$sqlFile = $_SERVER['DOCUMENT_ROOT'] . "/my-database-file-name.sql"; // Path to the SQL file in the hosting

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Read SQL file
$sql = file_get_contents($sqlFile);
if ($sql === false) {
    die("Error reading the SQL file.");
}

// Execute SQL commands
if ($conn->multi_query($sql)) {
    do {
        // Store result to free up connection for next query
        if ($result = $conn->store_result()) {
            $result->free();
        }
    } while ($conn->more_results() && $conn->next_result());
    echo "Database imported successfully.";
} else {
    echo "Error importing database: " . $conn->error;
}

$conn->close();

?>
