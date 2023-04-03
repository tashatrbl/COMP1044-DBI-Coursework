<?php
require('config.php');

$Firstname=$_POST['Firstname'];
$Lastname=$_POST['Lastname'];
$Telephone_No=$_POST['Telnum'];

$Customername = $Firstname . ' ' . $Lastname;

// Generate a unique customer_id
do {
    $Random1 = rand(10, 99);
    $Random2 = rand(100, 999);
    $Customerid = strtolower(substr($Firstname, 0, 3)) . $Random1 . $Random2;
    $checkQuery = mysqli_query($conn, "SELECT customer_id FROM customer WHERE customer_id = '$Customerid'");
} while(mysqli_num_rows($checkQuery) > 0);

$mysqlInsert = mysqli_query($conn, "INSERT INTO customer (customer_id, customer_name, contact_number) 
        VALUES ('$Customerid', '$Customername', '$Telephone_No')");

if($mysqlInsert)
    {
        print "<script>alert('Customer information added successfully!'); 
        window.location='add-reservation.php'</script>";
    }
    else
    {

        print"<script> alert('The customer information is not valid. Please check the input fields.');
        window.location='add-reservation.php'</script>";

    }

mysqli_close($conn);

?>
