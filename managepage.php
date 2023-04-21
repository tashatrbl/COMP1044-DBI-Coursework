<?php
session_start();

$username = $_SESSION['username'];
$actual_name = $_SESSION['actual_name'];
$role = $_SESSION['roles'];

if ($_SESSION['logout'] == true) {
    print "<script>
        window.location='mainlogin.php'</script>";
}

/* hardcoding this because the actual name is too long :D */
if ($actual_name == 'Yap Wei Ni') {
    $split = explode(' ', $actual_name);
    $first_name = implode(" ", array_slice($split, -2));
} else {
    $first_name = explode(' ', $actual_name)[0];
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
            <img id="user-icon" src="assets/user-filled.svg"></img>
            <div id="settings__fill" onclick="settBtnTrigger()">
                <?php echo "<span><a id='Admin'>$first_name</a></span>"; ?>
            </div>
            <div id="settDropdown">
                <div id="userDetails">
                    <img id="sett-user" src="assets/user-filled.svg"></img>
                    <?php
                    echo "<h2 id='sett-name'>$first_name</h2>";
                    echo "<h3 id='role'>$role</h3>";
                    ?>
                </div>
                <div id="settBtn">
                    <a href="mainlogin.php?logout=true" id="last">Log Out</a>
                </div>
            </div>
        </div>
    </div>

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
    if (isset($_POST['reservationid'])) {
        // Use the $reservationid variable to select data from the database
        $reservationid = $_POST['reservationid'];
    } else if (isset($_GET['id'])) {
        $reservationid = $_GET['id'];
    } else {
        echo "Reservation ID not found.";
    }

    $query = "SELECT * FROM reservation WHERE reservation_id = '$reservationid'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);

    $querycustomer = "SELECT * FROM customer WHERE customer_id = '" . $row["customer_id"] . "'";
    $resultcustomer = mysqli_query($conn, $querycustomer);
    $rowcustomer = mysqli_fetch_array($resultcustomer);

    $querycar = "SELECT * FROM car WHERE car_id = '" . $row["car_id"] . "'";
    $resultcar = mysqli_query($conn, $querycar);
    $rowcar = mysqli_fetch_array($resultcar);

    $querycartype = "SELECT * FROM car_type WHERE car_type_id = '" . $rowcar["car_type_id"] . "'";
    $resultcartype = mysqli_query($conn, $querycartype);
    $rowcartype = mysqli_fetch_array($resultcartype);

    mysqli_close($conn);
    ?>

    <!-- Form -->
    <div class="add-Form">
        <div class="directory-path">
            <img src="assets/home-icon.png" id="home-icon">
            <span id="directory-text" onclick="interfere('dashboard.php')" style="cursor:pointer;">Dashboard</span>
            <span id="directory-text"> > </span>
            <span id="directory-text" onclick="interfere('manage-reservation.php')" style="cursor:pointer;"> Manage Reservation </span>
            <span id="directory-text"> > </span>
            <span id="directory-text"> Managing Reservation <?php echo $row['reservation_id']; ?> </span>
        </div>

        <h1>Manage Reservation</h1>
        <form action="manageresvprocess.php" method="post">
            <label>Reservation ID:</label>
            <input type="text" name="reservationid" id="reservationid" value="<?php echo $row['reservation_id']; ?>" readonly>
            <h3>Customer Details</h3>
            <div class="custSection">
                <label>Customer ID:</label>
                <input type="text" name="customerid" id="customerid" value="<?php echo $row['customer_id']; ?>" readonly><br>
                <label>Customer Name:</label>
                <input type="text" name="customername" value="<?php echo $rowcustomer['customer_name']; ?>" readonly>
                <label>Phone Number:</label>
                <input type="text" name="Telnum" value="<?php echo $rowcustomer['contact_number']; ?>" readonly>
                <br>
            </div>

            <h3>Car Details</h3>
            <div id="carSection">
                <label>Car ID:</label>
                <input type="text" name="carid" id="carid" value="<?php echo $row['car_id']; ?>" readonly><br>

                <label for="carType">Car Model Type:</label>
                <input type="text" name="cartype" value="<?php echo $rowcartype['type_name']; ?>" readonly>
                <br>

                <label for="carModel">Car Model:</label>
                <input type="text" id="carmodel" name="carmodel" value="<?php echo $rowcar['car_model']; ?>" readonly>
                <br>

                <label>Car Color:</label>
                <input type="text" name="carcolor" value="<?php echo $rowcar['car_colour']; ?>" readonly><br>

                <label>Rental Per Day:</label>
                <input type="text" name="rentalperday" value="<?php echo $rowcar['rental_per_day']; ?>" readonly><br>

                <div class="rentalDates">
                    <label for="start">Rental Start Date:</label>
                    <input type="date" id="start" name="Rentalstart" value="<?php echo $row['rental_date_start']; ?>" min=today max="2023-12-31">
                    <label for="start">Rental End Date:</label>
                    <input type="date" id="end" name="Rentalend" value="<?php echo $row['rental_date_end']; ?>" min=today max="2023-12-31">
                </div>
                <button id="updateBtn" type="submit" name="update">UPDATE</button>
            </div>
        </form>
    </div>


    </div>
    </div>

</body>

</html>