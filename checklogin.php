<?php
require('config.php');

if (isset($_POST)) {
    session_start();
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_encrypted = openssl_encrypt($password, "AES-128-CTR", "comp1044", 0, '1111111111111000');

    //code to show encrypted password entered on form
    $jsc = "alert('" . $password_encrypted  . "')";
    echo "<script>" . $jsc . "</script>";

    $data = mysqli_query($conn, "SELECT * From staff WHERE username ='$username' and password = '$password_encrypted'");
    $row = mysqli_fetch_assoc($data);
    $actual_name = $row['actual_name'];

    $num_rows = mysqli_num_rows($data);

    if ($num_rows > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['actual_name'] = $actual_name;
        $_SESSION['logout'] = false;
        print "<script>alert('Welcome " . $actual_name . "!');
            window.location= 'dashboard.php'</script>";
    } else {

        print "<script> alert('Username or password is incorrect! Please enter again.');
            window.location='mainlogin.php'</script>";
    }
}

