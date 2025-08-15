<!doctype html>
<html>
<head>
    <title>Logging In</title>
</head>
<h1> Logging In
  </h1>
<body>

    <center>
       <?php

		// Connect to database 
		$conn = mysqli_connect("localhost","root","","htl_proj_g9");
		
        $CID = $_REQUEST['cuID']; // CID
		$CPWD = $_REQUEST['cPassword']; // cPassword
		
		// Get custID and password from database
		$sql = "SELECT * FROM customer where custID = '$CID'";
		$custLog = mysqli_query($conn,$sql);
		$checkcustID = mysqli_num_rows($custLog);
		$pwd = mysqli_fetch_array( $custLog );
		
		//Checks if customer ID and password are correct
		if (($checkcustID == 0)||($CPWD != $pwd['cPassword'])){
			echo('Incorrect username or password -
			<a href="CustomerLogin.html">Please try again</a>.');
				mysqli_close($conn);
			}
			else {
				mysqli_close($conn);
				header("Location: customerPage.html"); 
			}
        ?>
	   
    </center>
	 
</body>

</html>