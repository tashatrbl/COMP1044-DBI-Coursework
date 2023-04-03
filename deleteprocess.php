<?php
require('config.php');

$Reservation_id=$_POST['ReservationID'];

$sql = "DELETE FROM reservation WHERE reservation_id ='$Reservation_id'"; 
$result = $conn->query($sql);

if ($conn->query($sql) === TRUE) 
{
	print "<script>alert('This reservation deleted successfully!'); 
	window.location='delete-reservation2.php'</script>";
}
else
{
	print"<script> alert('The reservation ID is not valid. Please check again.');
	window.location='delete-reservation2.php'</script>";

}

mysqli_close($conn);

?>
