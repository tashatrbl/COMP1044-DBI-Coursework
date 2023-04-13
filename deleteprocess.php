<?php
require('config.php');

$reservationid = $_POST['reservationid'];

$sqldelete=mysqli_query($conn,"DELETE FROM reservation WHERE reservation_id ='$reservationid'");

if ($sqldelete) 
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
