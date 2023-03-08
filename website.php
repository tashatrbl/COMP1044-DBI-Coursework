<html>
	<head>
		<link rel="stylesheet" href="main.css">
	</head>
	
	<body>
	<div id = "gear-1"></div>
	<div id = "gear-2"></div>
	<div id = "gear-3"></div>
	<div id='header'></div>
	<div id="titlecont">
	    <div id="titlebackdrop"></div>
		<h1 id="mainTitle">CAR RENTAL RESERVATION</h1>
	</div>
	
	<div id="formcontainer">
		<p id="login-title" class="login">STAFF LOGIN</p>
		<form id="login-form" onsubmit="return false" class="login">
		<!--<label for="username">Username:</label>-->
  <input type="text" id="username" name="username"placeholder="Enter Username"><br>

  <!--<label for="password">Password:</label>-->
  <input type="password" id="password" name="password"placeholder="Enter Password"><br>

  <input type="submit" id="loginbtn" value="LOGIN">
  </form>
  
  <button id='backbtn' onclick='back()'>BACK</button>
  
  <p id='username-handle'>Username : XXXXXXXXX</p>
  <button id='newreservebtn'>New Reservation</button>
   <button id='updatereservebtn'>Update Reservation</button>
    <button id='cancelreservebtn'>Cancel Reservation</button>
  
  <div id="reservation-box-1">
	</div>
	
 <div id="reservation-box-2">
	</div>
	
 <div id="reservation-box-3">
	</div>
	
  </div>
   <div id="reservation-box-2"></div>
    <div id="reservation-box-3"></div>
	</div>
	
	<div id='footer'></div>
		<div id="transition"></div>
		<script src="main.js"></script>
		<?php 
			require("main.php")
		?>
	</body>
</html>