<?php
require('config.php');

$selectedReservations = $_POST['selected'];
$reservationIds = implode(',', $selectedReservations);

$sqldelete = mysqli_query($conn, "DELETE FROM reservation WHERE reservation_id IN ($reservationIds)");

if ($sqldelete) 
{
    print "<script>alert('Selected reservations deleted successfully!'); 
    window.location='delete-reservation2.php'</script>";
}
else
{
    print"<script> alert('An error occurred while deleting the selected reservations. Please try again.');
    window.location='delete-reservation2.php'</script>";

}

mysqli_close($conn);
?>
