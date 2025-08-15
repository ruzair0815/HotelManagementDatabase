<?php


$conn = new mysqli("localhost", "root", "", "hotel_db");


if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {


   $custID = $_POST['custID'];
   $roomNum = $_POST['roomNum'];
   $checkInDate = $_POST['checkInDate'];
   $checkOutDate = $_POST['checkOutDate'];


   // check availability
   $availabilitySql = "SELECT * FROM reservations
                       WHERE roomNum = '$roomNum'
                       AND (
                            (checkInDate <= '$checkOutDate' AND checkOutDate >= '$checkInDate')
                       )";
   $availabilityResult = $conn->query($availabilitySql);


   if ($availabilityResult->num_rows > 0) {
       echo "The room is not available for the selected dates. Please choose another room or modify the dates.";
   } else {
       // get room tier
       $roomTierSql = "SELECT roomTier FROM Room WHERE roomNum = '$roomNum'";
       $roomTierResult = $conn->query($roomTierSql);


       if ($roomTierResult->num_rows > 0) {
           $roomTierRow = $roomTierResult->fetch_assoc();
           $roomTier = $roomTierRow['roomTier'];


           // get rate
           $rateSql = "SELECT rate FROM RoomTier WHERE roomTier = '$roomTier'";
           $rateResult = $conn->query($rateSql);


           if ($rateResult->num_rows > 0) {
               $rateRow = $rateResult->fetch_assoc();
               $rate = $rateRow['rate'];


               // calculate bill
               $checkInDateObj = new DateTime($checkInDate);
               $checkOutDateObj = new DateTime($checkOutDate);
               $interval = $checkInDateObj->diff($checkOutDateObj);
               $nights = $interval->days;
               $bill = $rate * $nights;


               // add reservation
               $reservationSql = "INSERT INTO reservations (custID, roomNum, bill, checkInDate, checkOutDate)
                                  VALUES ('$custID', '$roomNum', '$bill', '$checkInDate', '$checkOutDate')";


               if ($conn->query($reservationSql) === TRUE) {
                   // update availability
                   $updateAvailabilitySql = "UPDATE Room SET availability = false WHERE roomNum = '$roomNum'";
                   if ($conn->query($updateAvailabilitySql) === TRUE) {
                       echo "Reservation added successfully and room availability updated!";
                   } else {
                       echo "Reservation added, but failed to update room availability: " . $conn->error;
                   }
               } else {
                   echo "Error: " . $reservationSql . "<br>" . $conn->error;
               }
           } else {
               echo "Rate for the room tier not found.";
           }
       } else {
           echo "Room not found.";
       }
   }
}


$conn->close();
?>
