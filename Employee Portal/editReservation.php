<?php
$conn = new mysqli("localhost", "root", "", "hotel_db");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reservationID = $_POST['reservationID'];
    $roomNum = $_POST['roomNum'];
    $checkInDate = $_POST['checkInDate'];
    $checkOutDate = $_POST['checkOutDate'];

    // get room rate
    $sql = "SELECT rt.rate FROM RoomTier rt 
            JOIN Room r ON r.roomTier = rt.roomTier 
            WHERE r.roomNum = '$roomNum'";
    $result = $conn->query($sql);
    $rate = ($result->num_rows > 0) ? $result->fetch_assoc()['rate'] : null;

    if ($rate) {
        // calculate bill
        $nights = (new DateTime($checkInDate))->diff(new DateTime($checkOutDate))->days;
        $bill = $rate * $nights;

        // update reservation
        $updateSql = "UPDATE reservations 
                      SET roomNum = '$roomNum', checkInDate = '$checkInDate', 
                          checkOutDate = '$checkOutDate', bill = '$bill' 
                      WHERE reservationID = '$reservationID'";
        $conn->query($updateSql);

        //  availability
        $conn->query("UPDATE Room SET availability = false WHERE roomNum = '$roomNum'");

        echo "Reservation updated and room availability updated.";
    } else {
        echo "Room or rate not found.";
    }
}

$conn->close();
?>
