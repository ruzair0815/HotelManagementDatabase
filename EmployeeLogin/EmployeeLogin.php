<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Retrieve data from the form
$eid = isset($_POST['empID']) ? $_POST['empID'] : '';
$pwd = isset($_POST['password']) ? $_POST['password'] : '';

// Database connection details
$servername = "localhost";
$username = "root";
$password = ""; // Replace with your MySQL password, if set
$dbname = "hotel_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query the database
$sql = "SELECT * FROM employee WHERE empID = '$eid' AND employeePassword = '$pwd'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    echo "Login successful! Welcome Employee ID: $eid";
} else {
    echo "Invalid Employee ID or Password.";
}

$conn->close();
?>
