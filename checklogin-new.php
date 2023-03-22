<?php 
    require('config.php');

    if(isset($_POST)){
        $username = $_POST['username'];
        $password = $_POST['password'];
		$password_encrypted = openssl_encrypt($password,"AES-128-CTR","comp1044",0,'1111111111111000');
		
		
		//code to show encrypted password entered on form
			$jsc = "alert('" . $password_encrypted  . "')";
			echo "<script>".$jsc."</script>";

       
        $data = mysqli_query($conn,"SELECT * From staff WHERE username='$username' and password='$password_encrypted'");

        $num_rows = mysqli_num_rows($data);
        
        if($num_rows>0)
        {   
            print "<script>alert('Welcome admin!');
            window.location= 'dashboard.php'</script>";
         }
        else
        {

            print"<script> alert('Username or password is incorrect! Please enter again.');
            window.location='mainlogin.php'</script>";

    }
    }
?>
