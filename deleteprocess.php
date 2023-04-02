<?php
require('config.php');

$Reservation_id=$_POST['ReservationID'];

$sql = "DELETE FROM reservation WHERE reservation_id ='$Reservation_id'"; 
$result = $conn->query($sql);

if ($conn->query($sql) === TRUE) {
	echo "Record deleted successfully";
} else {
	echo "Error deleting record: " . $conn->error;
}

mysqli_close($conn);

?>