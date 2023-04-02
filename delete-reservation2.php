<html>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans+Hebrew">
<link rel="stylesheet" href="style.css">
<script src="script.js" type="text/javascript"></script>
<head>
<style>
		table, th, td {
			border: 1px solid black;
			border-collapse: collapse;
			padding: 10px;
		}
	</style>
</head>

<body>
    <!-- Navigation Bar -->
    <div class="top-navbar">
        <img id="logo" src="assets/DriveNow.png"></img>
        <div id="settings__stroke">
            <div id="settings__fill" onclick="settBtnTrigger()">
                <img id="user-icon" src="assets/user-filled.svg"></img>
                <span id="Admin">Admin</span>
            </div>
            <div id="settDropdown">
                <div id="userDetails"></div>
                <div id="settBtn" class=>
                    <a href="#">Account Details</a>
                    <a href="#">Dark Mode</a>
                    <a href="#">Log Out</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Drawer Menu -->
    <div class="hamburger-menu">
        <input id="menu__toggle" type="checkbox" />
        <label class="menu__btn" for="menu__toggle">
            <span></span>
        </label>
        <ul class="menu__box">
            <li><a class="menu__item" onclick="interfere('dashboard.php')" class="dashboard-opt">
                    <img id="sidebar-icons" src="assets/home-icon.png">
                    <span id="menu-text">Dashboard</span>
                </a></li>
            <li><a class="menu__item" onclick="interfere('add-reservation.php')" class="dashboard-opt">
                    <img id="sidebar-icons" src="assets/add-icon.png">
                    <span id="menu-text">Add Reservation</span>
                </a></li>
            <li><a class="menu__item" onclick="interfere('manage-reservation.php')" class="dashboard-opt">
                    <img id="sidebar-icons" src="assets/manage-icon.png">
                    <span id="menu-text">Manage Reservation</span>
                </a></li>
            <li><a class="menu__item" onclick="interfere('delete-reservation.php')" class="dashboard-opt">
                    <img id="sidebar-icons" src="assets/delete-icon.png">
                    <span id="menu-text">Delete Reservation</span>
                </a></li>
        </ul>
    </div>


    <!-- Form -->
    <div class="add-Form">
        <h1>Delete Reservation</h1>
    
        <?php
        require('config.php');

        $query = "SELECT * FROM reservation";
        $result = mysqli_query($conn, $query);

        //Retrieve the data
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        //Display the data in a table
        echo "<table>";
        echo "<tr><th>Customer ID</th><th>Reservation ID</th><th>Car ID</th><th>Car Model</th><th>Rental Date Start</th><th>Rental Date End</th><th>Rental Cost</th></tr>";
        foreach ($data as $row) {
            echo "<tr><td>" . $row["customer_id"] . "</td><td>" . $row["reservation_id"] . "</td><td>" . $row["car_id"] . "</td><td>" . $row["car_model"] . "</td><td>" . $row["rental_date_start"] . "</td><td>" . $row["rental_date_end"] . "</td><td>" . $row["rental_cost"] . "</td></tr>";
        }
        echo "</table>";

        //Close the database connection
        mysqli_close($conn);
        ?>

        <form action="deleteprocess.php" method="POST">
            <div class="custSection">
                <label for="Fname" id="label">Please enter the Reservation ID to be deleted:</label><br>
                <input type="text" name="ReservationID"><br>
                <input type="submit" value="Delete">
            </div>
        </form>

