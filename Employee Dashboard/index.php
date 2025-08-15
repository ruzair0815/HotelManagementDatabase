<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Employee Profile</title>
</head>
<body>
  <div id="employeeProfile">

    <h1 style="font-size:10vw">Employee Profile</h1>

    <! getting info from employee login file -->

    <form action="index.php" method="POST" </form>

    <! php content to get and display info -->
    <?php
    
    echo "<hr>";
    
    $conn = new mysqli("localhost", "root", "", "db_hotel");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    //if employeeID matches then display info
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $empID = $_POST['empID'];
      
    // database query to get employee info
    $sql = "SELECT empID, eFName, eLname, eDept, JobTitle, joinDate 
            FROM employee
            WHERE empID = '$empID'";
      
    $result = $conn->query($sql);
      
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "Employee ID " . $row['empID'] . "<br>";
          echo "<br>";

          echo "First Name: " . $row['eFName'] . "<br>";
          echo "<br>";

          echo "Last Name: " . $row['eLName'] . "<br>";
          echo "<br>";

          echo "Department: " . $row['eDept'] . "<br>";
          echo "<br>";

          echo "Job Title: " . $row['JobTitle'] . "<br>";
          echo "<br>";

          echo "Join Date: " . $row['joinDate'] . "<br>";
          echo "<br>";
        }
      }
      else {
        echo "error loading profile. please try again later." . "<br>";
      }
    }
    else {
      echo "error." . "<br>";
    }
    
    // Close the database connection
    $conn->close();

    ?>
  </div>

  <! return home button -->
  <button onclick="Back Home">Back Home</button>
  </body>
  </html>