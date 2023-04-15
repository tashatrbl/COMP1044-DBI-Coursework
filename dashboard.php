<?php
session_start();

$username = $_SESSION['username'];
$actual_name = $_SESSION['actual_name'];

if ($_SESSION['logout'] == true) {
    print "<script>
        window.location='mainlogin.php'</script>";
}

?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans+Hebrew">
<link rel="stylesheet" href="style.css">
<script src="script.js" type="text/javascript"></script>

<body onload=selectRow()>
    <!-- Navigation Bar -->
    <div class="top-navbar">
        <img id="logo" src="assets/DriveNow.png"></img>
        <div id="settings__stroke">
            <div id="settings__fill" onclick="settBtnTrigger()">
                <img id="user-icon" src="assets/user-filled.svg"></img>
                <?php echo "<span id='Admin'>$actual_name</span>"; ?>
                <span id="Admin"></span>
            </div>
            <div id="settDropdown">
                <div id="userDetails"></div>
                <div id="settBtn">
                    <a href="#">Account Details</a>
                    <a href='mainlogin.php?logout=true' id='last'>Log Out</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Drawer Menu -->
    <div class="hamburger-menu">
        <input id="menu__toggle" type="checkbox" onchange=dimBG()>
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


    <div id="bgOverlay"></div>

    <?php
    require('config.php');
    $query = "SELECT reservation_id, reservation.customer_id, car_id, car_model, rental_date_start, rental_date_end, rental_cost, customer_name
            FROM reservation, customer WHERE reservation.customer_id = customer.customer_id ORDER BY rental_date_start";
    $result = mysqli_query($conn, $query);

    // create an empty array to store the results
    $reservations = array();

    // loop through each row in the result set and add it to the array
    while ($row = mysqli_fetch_assoc($result)) {
        $reservations[] = $row;
    }

    $arrLength = count($reservations);

    ?>

    <div class="dashboard">
        <div class="directory-path">
            <img src="assets/home-icon.png" id="home-icon">
            <span id="directory-text">Dashboard</span>
        </div>

        <div class="welcome">
            <img src="assets/user.png" id="pfp">
            <span>
                <h3 id="welcome-text">Welcome,</h3>
                <h1 id="welcome-text"><?php echo $actual_name ?>!</h1>
            </span>
        </div><br>
        <div class="upcoming">
            <h3>Upcoming Reservations</h3>

            <?php
            for ($i = 0; $i < 3; $i++) {
                $res_id = $reservations[$i]['reservation_id'];
                $cust_id = $reservations[$i]['customer_id'];
                $cust_name = $reservations[$i]['customer_name'];
                $car_model = $reservations[$i]['car_model'];
                $rental_date_start = $reservations[$i]['rental_date_start'];
                $rental_date_end = $reservations[$i]['rental_date_end'];
                $date = date_create($rental_date_start);

                echo "<table id = 'bubble'>";
                echo "<tr><th id= 'date'>";
                echo date_format($date, 'F');
                echo "<br>";
                echo date_format($date, 'm');
                echo "<br>";
                echo date_format($date, 'Y');
                echo "</div></th>";

                echo "<th id = 'car-model'><h3>$car_model</h3></th>";
                echo "<td id = 'car-info'> Reservation ID: $res_id<br>
                Customer ID: $cust_id<br>
                Customer Name: $cust_name<br>
                End Date: $rental_date_end<br></td></tr>";
                echo "</table>";
            }

            ?>

        </div>

        <div class = "calendar">
            
        </div>

    </div>

</body>

</html>