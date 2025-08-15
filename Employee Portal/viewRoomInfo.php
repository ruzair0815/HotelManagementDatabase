<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roomNum = $_POST['roomNum'];

    $conn = new mysqli("localhost", "root", "", "hotel_db");
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    // get room details and rate
    $sql = "SELECT r.roomNum, r.floor, r.availability, r.numBeds, r.roomTier, r.roomView, rt.rate
            FROM Room r
            LEFT JOIN RoomTier rt ON r.roomTier = rt.roomTier
            WHERE r.roomNum = '$roomNum'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "Room Number: " . $row['roomNum'] . "<br>";
        echo "Floor: " . $row['floor'] . "<br>";
        echo "Availability: " . ($row['availability'] ? "Yes" : "No") . "<br>";
        echo "Rate: $" . ($row['rate'] ?? 'Not Available') . "<br>";
        echo "Number of Beds: " . $row['numBeds'] . "<br>";
        echo "Room Tier: " . $row['roomTier'] . "<br>";
        echo "Room View: " . ($row['roomView'] ?? 'Not Available') . "<br>";
    } else {
        echo "No room found.";
    }

    $conn->close();
}
?>
