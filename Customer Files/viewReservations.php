<?php 
	$conn = mysqli_connect("localhost","root","","htl_proj_g9");
	$sql = "SELECT * FROM RESERVATIONS";
	$all_res = mysqli_query($conn,$sql);
?>

<!doctype html>
<html>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
  <h1> Your Reservations
    </h1>
    <button onclick = "location.href = 'customerPage.html'" id = "viewReservationsBackButton"> Back </button>
<table style = "width = 400%">
   <tr>
      <th> Reservation ID </th>
      <th> Bill </th>
      <th> Check-In Date </th>
       <th> Check-Out Date </th>
    </tr>
	

		<?php
		while($res = mysqli_fetch_array(
			$all_res,MYSQLI_ASSOC)):;
		?>
		<tr>
			<td><?php echo $res['reservationID'];?> </td>
			<td> <?php echo $res['bill'];?>  </td>
			<td><?php echo $res['checkInDate'];?>  </td>
			<td><?php echo $res['checkOutDate'];?>  </td>
		</tr>
       <?php 
        endwhile; 
            ?>
</table>			
  </html>