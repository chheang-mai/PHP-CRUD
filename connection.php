<?php
$servername = "localhost"; // Change if your database is hosted elsewhere
$username = "root"; // Change if you have a different username
$password = ""; // Change if you set a MySQL password
$dbname = "php-crud"; // Replace with your database name

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// SQL to create tables
$sql = "
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    date_of_birth DATE NOT NULL,
    address VARCHAR(255) NOT NULL,
    profile VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

";

// Execute the query
if ($con->multi_query($sql) === TRUE) {
    // echo 111;
} else {
    echo "Error creating tables: " . $con->error;
}

// Close connection

?>
