<?php

    // Connect to database 
    $con = mysqli_connect("localhost","root","","htl_proj_g9");
    
    // mysqli_connect("servername","username","password","database_name")
 
    // Get all from hotel table
    $sql = "SELECT * FROM `hotel`";
    $all_locs = mysqli_query($con,$sql);
	
	//Get data from roomtier table
	$sql = "SELECT * FROM `roomtier`";
    $all_roomtier = mysqli_query($con,$sql);
	
?>	


<!doctype html>
<html>
<h1> Add a Reservation
  </h1>
  <body>
    <details>
      <summary> Plan Your Visit </summary>
      <p>
        Where would you like to stay today?
 
 <form action = "reserve.php" method="POST">
        <label>Select a Location</label>
        <select name="hlocation">
            <?php 
                while ($locs = mysqli_fetch_array(
                        $all_locs,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $locs["hlocation"];
                ?>">
                    <?php echo $locs["hlocation"];
                    ?>
                </option>
            <?php 
                endwhile; 
            ?>
        </select>
	  
			 
    <br>
	<br><br>
     When would you like to stay?
     <br><br><label for "Duration"> Check-In Date: </label>
     <input type = "text" name = "CheckIn" placeholder="YYYY-MM-DD">
      <br><br>
     <label for "Check-out"> Check-Out Date: </label>
     <input type = "text" name = "CheckOut" placeholder = "YYYY-MM-DD">
      </br></br>
     </br></br>
	 
	 How many guests?
      <br><br>
     <label for "Guests"> Guests: </label>
     <input type = "text" name = "Guests">
     </br></br>
     What kind of room?
      <br> <br>
	  
        <label>Room Type:</label>
        <select name="roomTier">
            <?php 
                while ($roomtier = mysqli_fetch_array(
                        $all_roomtier,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $roomtier["roomTier"];
                ?>">
                    <?php echo $roomtier["roomTier"];
                    ?>
					
                </option>
            <?php 
                endwhile; 
            ?>
        </select>
		<label>Room Floor:</label>
        <input type = "text" name = "roomFloor">

     </p>
     </details> 
       <details>
         <summary> Guest Information and Payment </summary>
           <p>
            <label for "fname"> First Name: </label>
            <input type = "text" name = "First_Name" placeholder = "Guest's First Name">
             </br> </br>
  
           <label for "lname"> Last Name: </label>
            <input type = "text" name = "Last_Name" placeholder = "Guest's Last Name">
              </br> </br>
  
            <label for "address"> Address: </label>
            <input type = "text" name = "Street" placeholder = "Guest's Address">
             </br> </br>
  
            <label for "city"> City: </label>
            <input type = "text" name = "City" placeholder = "Guest's City">
             </br> </br>
  
            <label for "state"> State: </label>
            <input type = "text" name = "State" placeholder = "Guest's State">
             </br> </br>
  
            <label for "country"> Country: </label>
            <input type = "text" name = "Country" placeholder = "Guest's Country">
             </br> </br>
  
            <label for "zipCode"> Zip Code: </label>
            <input type = "text" name = "Zip_Code" placeholder = "Guest's Zip Code">
             </br> </br>
   </br> </br>
    <label for "cardNum"> Card Number: </label>
            <input type = "text" name = "Card_Number" placeholder = "Guest's Saved Card Number">
            </br> </br>
             <label for "cardCVV"> CVV: </label>
            <input type = "text" name = "CVV" placeholder = "Guest's Saved Card CVV"> 
            </br> </br>
             <label for "cardExpDate"> Expiration Date: </label>
            <input type = "text" name = "Expiration_Date" placeholder = "Guest's Saved Card Expiration Date">
</br> </br>
<button onclick = "location.href = 'reserve.php'" id = "addReservationBackButton"> Reserve </button>
           </p>
            </form>
      </details>
       
     <button onclick = "location.href = 'customerPage.html'" id = "addReservationBackButton"> Cancel </button>
	
	
  </body>
</html>