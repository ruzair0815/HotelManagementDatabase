<!doctype html>
<html>

<head>
    <title>Reservation Status</title>
</head>
<h1> Reservation Status
  </h1>
<body>
    <center>
        <?php

		// Connect to database 
		$conn = mysqli_connect("localhost","root","","htl_proj_g9");
        
        // Taking all values from the form data(input)
        $hlocation = $_REQUEST['hlocation']; // Location
        $CheckIn = $_REQUEST['CheckIn']; //Check-In
        $CheckOut =  $_REQUEST['CheckOut']; //Check-Out
        $Guests = $_REQUEST['Guests']; //Guests
		$RoomType = $_REQUEST['roomTier']; //roomTier
        $RoomFloor = $_REQUEST['roomFloor']; //roomFloor
        $First_Name = $_REQUEST['First_Name']; //First_Name
		$Last_Name = $_REQUEST['Last_Name']; //Last_Name
		$Street = $_REQUEST['Street']; //Street
		$City = $_REQUEST['City']; //City
		$State = $_REQUEST['State']; //State
		$Country = $_REQUEST['Country']; //Country
		$Zip_Code = $_REQUEST['Zip_Code']; //Zip_Code
		$Card_Number = $_REQUEST['Card_Number']; //Card_Number
		$CVV = $_REQUEST['CVV']; //CVV
		$Expiration_Date = $_REQUEST['Expiration_Date']; //Expiration_Date
		
		$RoomNum = 204;
		
		$sql = "SELECT * FROM roomtier where roomTier = '$RoomType'";
		$billrow = mysqli_query($conn,$sql);
		$bill = $billrow->fetch_array()[1] ?? '';
		
		
		// Get custID
		$sql = "SELECT custID FROM customer where CFName = '$First_Name' and cLName =  '$Last_Name'";
		$custIDrow = mysqli_query($conn,$sql);
		$custID = $custIDrow->fetch_array()[0] ?? '';
		
        // Create a reservation
		$sql = "INSERT INTO reservations  VALUES (NULL, $RoomNum, $custID, $bill, '$CheckIn','$CheckOut')";
		
               if(mysqli_query($conn, $sql)){
            echo "<h3>Reservation successful.</h3>"; 
        } else{
            echo "Reservation unsuccessful. " 
                . mysqli_error($conn);
        }
       
        // Close connection
        mysqli_close($conn);
        ?>
    </center>
	 <button onclick = "location.href = 'customerPage.html'" id = "reservationHomeButton"> Home </button>
</body>

</html>