<?php
require('config.php');

// $reservationid = $_POST['reservationid'];

// $sqldelete=mysqli_query($conn,"DELETE FROM reservation WHERE reservation_id ='$reservationid'");

$selectedIds = explode(',', $_POST['reservationid']);

$success = true;

foreach ($selectedIds as $reservationId) {
    $sqldelete = "DELETE FROM reservation WHERE reservation_id = '$reservationId'";
    if (!mysqli_query($conn, $sqldelete)) {
        $success = false;
    }
}

if ($success) 
{
	print "<script>alert('This reservation deleted successfully!'); 
	window.location='delete-reservation.php'</script>";
}
else
{
	print"<script> alert('The reservation ID is not valid. Please check again.');
	window.location='delete-reservation.php'</script>";

}

mysqli_close($conn);

?>