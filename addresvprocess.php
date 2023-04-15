<?php
require('Config.php');

session_start();

$Firstname = $_POST['Firstname'];
$Lastname = $_POST['Lastname'];
$Telephone_No = $_POST['Telnum'];

$Customername = $Firstname . ' ' . $Lastname;

// Check if customer already exists in the database
$existingRecord = mysqli_query($conn, "SELECT * FROM customer WHERE customer_name='$Customername' AND contact_number='$Telephone_No'");

if (mysqli_num_rows($existingRecord) > 0) {
    // Customer already exists, use their existing customer ID
    $row = mysqli_fetch_assoc($existingRecord);
    $Customerid = $row['customer_id'];
} else {
    // Generate a unique customer ID
    do {
        $Random1 = rand(10, 99);
        $Random2 = rand(100, 999);
        $Customerid = strtolower(substr($Firstname, 0, 3)) . $Random1 . $Random2;
        $checkQuery = mysqli_query($conn, "SELECT customer_id FROM customer WHERE customer_id = '$Customerid'");
    } while (mysqli_num_rows($checkQuery) > 0);

    // Insert new customer record
    $mysqlInsert1 = mysqli_query($conn, "INSERT INTO customer (customer_id, customer_name, contact_number) 
                VALUES ('$Customerid', '$Customername', '$Telephone_No')");
}

$car_id = $_POST['car_id'];
$car_model_result = mysqli_query($conn, "SELECT car_model FROM car WHERE car_id = '$car_id'");
$car_model_row = mysqli_fetch_assoc($car_model_result);
$car_model = $car_model_row['car_model'];
$rentalstartdate = $_POST['Rentalstart'];
$rentalenddate = $_POST['Rentalend'];
$username = $_SESSION['username'];

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

$mysqlInsert2 = mysqli_query($conn, "INSERT INTO reservation (customer_id, username, car_id, car_model, rental_date_start, rental_date_end, rental_cost) 
    VALUES ('$Customerid', '$username', '$car_id', '$car_model','$rentalstartdate','$rentalenddate','$totalfee')");

if ($mysqlInsert1 && $mysqlInsert2) {
    print "<script>alert('Created reservation successfully!'); 
        window.location='dashboard.php'</script>";
    exit;
} else {
    print "<script> alert('The reservation is not valid. Please make a new reservation or check your input.');
        window.location='add-reservation.php'</script>";
}

mysqli_close($conn);
