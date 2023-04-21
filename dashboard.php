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
        <div class="container">
            <div class="child">
                <div class="welcome">
                    <img src="assets/user.png" id="pfp">
                    <span>
                        <h3 id="welcome-text">Welcome,</h3>
                        <h1 id="welcome-text"><?php echo $first_name ?>!</h1>
                    </span>
                </div>

                <div class="upcoming">
                    <h3>Upcoming Reservations</h3>
                    <?php

                    if (isset($reservations[2])) {
                        $n = 3;
                    } elseif (isset($reservations[1])) {
                        $n = 2;
                    } elseif (isset($reservations[0])) {
                        $n = 1;
                    } else {
                        echo "<p> No Upcoming Reservations. </p>";
                        $n = 0;
                    }

                    for ($i = 0; $i < $n; $i++) {
                        $res_id = $reservations[$i]['reservation_id'];
                        $cust_id = $reservations[$i]['customer_id'];
                        $cust_name = $reservations[$i]['customer_name'];
                        $car_model = $reservations[$i]['car_model'];
                        $rental_date_start = $reservations[$i]['rental_date_start'];
                        $rental_date_end = $reservations[$i]['rental_date_end'];
                        $date = date_create($rental_date_start);

                        $upcoming = date_format($date, 'F') . "<br>" . date_format($date, 'j') . "<br>" . date_format($date, 'Y');

                        echo "<table id = 'bubble'>";
                        echo "<tr><th id= 'date'>";
                        echo $upcoming;
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
            </div>

            <!-- calendar php -->
            <?php
            date_default_timezone_set('Asia/Kuching');

            $reservation_dates = array();
            foreach ($reservations as $reservation) {
                $reservation_dates[] = $reservation['rental_date_start'];
            }

            if (isset($_GET['ym'])) {
                $ym = $_GET['ym'];
            } else {
                $ym = date('Y-m');
            }

            $timestamp = strtotime($ym . "-01");
            if ($timestamp === false) {
                $ym = date('Y-m');
                $timestamp = strtotime($ym . '-01');
            }

            $today = date('Y-m-d');
            $month = date('F Y', $timestamp);

            $prev = date('Y-m', strtotime('-1 month', $timestamp));
            $next = date('Y-m', strtotime('+1 month', $timestamp));

            $numDays = date('t', $timestamp);

            $str = date('N', $timestamp);

            $weeks = [];
            $week = '';

            $week .= str_repeat('<td></td>', $str - 1);

            for ($i = 1; $i <= $numDays; $i++, $str++) {
                if ($i < 10) {
                    $day = '0'. $i;
                } else {
                    $day = $i;
                }

                $date  = $ym . '-' . $day;

                if (in_array($date, $reservation_dates)) {
                    $week .= "<td class='reserved'>";
                } else {
                    $week .= "<td>";
                }            

                $day = $i;
                $week .= $day . "</td>";

                if ($str % 7 == 0 || $day == $numDays) {
                    if ($day == $numDays && $str % 7 != 0) {
                        $week .= str_repeat('<td></td>', 7 - ($str % 7));
                    }

                    $weeks[] = '<tr>' . $week . '</tr>';

                    $week = '';
                }
            }
            
            ?>

            <div class="child">
                <div class="calendarDiv">
                    <h2>CALENDAR<h2>
                            <table class="calendar">
                                <tr id="month">
                                    <td> <a href="?ym=<?php echo $prev; ?>" style="color:white;">&lt;</a></td>
                                    <th colspan="5"><?php echo $month ?></th>
                                    <td> <a href="?ym=<?php echo $next; ?>" style="color:white;">&gt;</a></td>
                                </tr>
                                <tr id="first-row">
                                    <td>Mon</td>
                                    <td>Tue</td>
                                    <td>Wed</td>
                                    <td>Thurs</td>
                                    <td>Fri</td>
                                    <td>Sat</td>
                                    <td>Sun</td>
                                </tr>
                                <?php
                                foreach ($weeks as $week) {
                                    echo $week;
                                }
                                ?>
                            </table>
                </div>
            </div>

        </div>


    </div>

</body>

</html>