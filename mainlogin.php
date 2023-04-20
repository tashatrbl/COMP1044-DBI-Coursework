<html>
<?php
session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    print "<script> alert('You have been logged out!');</script>";
    session_start();

    $_SESSION['logout'] = true;
}

?>

<head>
    <style>
        .login {
            position: absolute;
            margin-left: auto;
            width: 95%;
        }

        #mainlogo,
        #slogan {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }

        #mainlogo {
            margin-top: 100px;
            width: 360px;
        }

        #slogan {
            width: 500px;
            margin-top: 10px;
        }

        .login-form {
            background-color: #F8F8F8;
            position: relative;
            margin-left: auto;
            margin-right: auto;
            margin-top: 40px;
            width: 500px;
            height: 400px;
            border-width: 15px;
            border-radius: 15px;
            padding: 40px 0 0 100px;

        }

        #input {
            position: relative;
            width: 400px;
            height: 45px;
            border-width: 1px;
            border-radius: 10px;
            border-style: hidden;
            background-color: #D9D9D9;
            margin-bottom: 50px
        }

        #input:active {
            background-color: #D9D9D9;
        }

        #label {
            font-family: 'Roboto', sans-serif;
            font-weight: 300;
            font-size: 20px;
            color: #636363;
        }

        #login-btn {
            position: relative;
            width: 300px;
            height: 50px;
            margin-top: 20px;
            margin-left: 50px;
            font-family: 'Roboto', sans-serif;
            font-weight: bold;
            font-size: 30px;
            border-radius: 15px;
            color: white;
            background-color: #7DB2E2;
            border-style: hidden;
        }

        #login-btn:hover {
            background-color: #528BC0;
        }

        #usernameIcon {
            width: 9.5%;
            height: 9.5%;
            position: relative;
        }

        #passIcon {
            width: 8.5%;
            height: 8.5%;
            position: relative;
        }
    </style>
</head>

<body>
    <div class="login">
        <img id="mainlogo" src="assets/DriveNow.webp"></img><br>
        <img id="slogan" src="assets/Slogan.webp"></img>

        <div class="login-form">
            <form action="checklogin.php" method="POST">
                <img id="usernameIcon" src="assets/user-filled.svg"></img>
                <label id="label" for="username">Username</label><br>
                <input type="text" id="input" name="username" required><br>
                <img id="passIcon" src="assets/shield-lock.svg"></img>
                <label id="label" for="password">Password</label><br>
                <input type="password" id="input" name="password"  required><br>
                <button type="submit" id="login-btn" onclick="playButton()">Sign in</button>
            </form>
        </div>

    </div>
</body>

</html>