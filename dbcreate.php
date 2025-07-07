
<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'Faculty';

// Create a connection using MySQLi
$con = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connection successful<br>";
}

// SQL to create a database
// $sql = "CREATE DATABASE demodb";
// $result = mysqli_query($con, $sql); // Use mysqli_query for executing the SQL

// if ($result) {
//     echo "Database created successfully<br>";
// } else {
//     echo "Failed to create database: " . mysqli_error($con);
// }

// $sql = "INSERT INTO `tb` (`Name`, `Surname`) VALUES ('Neha', 'Gosavi')";

$sql = "CREATE TABLE profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    designation VARCHAR(255) NOT NULL,
    department VARCHAR(255) NOT NULL,
    bio TEXT NOT NULL,
    expertise VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone VARCHAR(15) NOT NULL
)";

$result = mysqli_query($con, $sql); // Use mysqli_query for executing the SQL

if ($result) {
    echo "Database Data Inserted successfully<br>";
} else {
    echo "Failed to Insert data: " . mysqli_error($con);
}

// Close the connection
mysqli_close($con);
?>
