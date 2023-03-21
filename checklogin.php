<?php 
    require('config.php');

    if(isset($_POST)){
        $username = $_POST['username'];
        $password = $_POST['password'];

       
        $data = mysqli_query($conn,"SELECT * From staff WHERE username='$username' and password='$password'");

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
