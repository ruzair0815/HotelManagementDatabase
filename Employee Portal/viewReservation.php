<?php

$conn = new mysqli("localhost", "root", "", "hotel_db");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $reservationID = $_POST['reservationID'];
    echo "Searching for Reservation ID: $reservationID<br>";

    // get reservation details
    $sql = "SELECT * FROM reservations WHERE reservationID = '$reservationID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Reservation ID: " . $row['reservationID'] . "<br>";
            echo "Customer ID: " . $row['custID'] . "<br>";
            echo "Room Number: " . $row['roomNum'] . "<br>";
            echo "Bill: $" . $row['bill'] . "<br>";
            echo "Check-In Date: " . $row['checkInDate'] . "<br>";
            echo "Check-Out Date: " . $row['checkOutDate'] . "<br><hr>";
        }
    } else {
        echo "No reservation found for ID: $reservationID";
    }
}

$conn->close();
?>
