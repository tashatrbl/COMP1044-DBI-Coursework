<?php
    require('Config.php');

    $car_id = $_POST['carid'];
    $rentalstartdate = $_POST['Rentalstart'];
    $rentalenddate = $_POST['Rentalend'];
    // $username=$_SESSION['Username'];
    $username="johnsmith";

    $rental_per_day_query = mysqli_query($conn, "SELECT rental_per_day FROM car WHERE car_id = '$car_id'");
    $rental_per_day_row = mysqli_fetch_assoc($rental_per_day_query);
    $rental_per_day = $rental_per_day_row['rental_per_day'];

    $diff = abs(strtotime($rentalenddate) - strtotime($rentalstartdate));
    $days = floor($diff / (60 * 60 * 24));
    $totalfee = $days * $rental_per_day;

    $mysqlcheckdate = "SELECT * FROM reservation WHERE car_id = ? AND 
       ((rental_date_start <= ? AND rental_date_end >= ?) OR 
        (rental_date_start <= ? AND rental_date_end >= ?) OR 
        (rental_date_start >= ? AND rental_date_end <= ?))";

    $stmt = $conn->prepare($mysqlcheckdate);
    $stmt->bind_param("sssssss", $car_id, $rentalstartdate, $rentalstartdate, $rentalenddate, $rentalenddate, $rentalstartdate, $rentalenddate);
    $stmt->execute();
    $result = $stmt->get_result();

    if (mysqli_num_rows($result) > 0) {
    echo "<script> alert('The selected rental period is not available. Please choose different dates.');
    window.location='add-reservation.php'</script>";
    exit();
    }

    $mysqlUpdate = mysqli_query($conn, "UPDATE reservation SET rental_date_start='$rentalstartdate', rental_date_end='$rentalenddate', rental_cost='$totalfee' WHERE car_id='$car_id'");
   

    if($mysqlUpdate)
    {	
         print "<script>alert('Reservation updated successfully!'); 
         window.location='dashboard.php'</script>";
         exit;
    }
    else
    {
        print"<script> alert('The reservation is not valid. Please make a new reservation or check your input.');
        window.location='managepage.php'</script>";
    }

    mysqli_close($conn);
?> 