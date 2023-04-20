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

<body onload>
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
                <div id="userDetails">
                    <img id="sett-user" src="assets/user-filled.svg"></img>
                    <?php echo "<span id='sett-name'>$actual_name</span>"; ?>
                </div>
                <div id="settBtn">
                    <a href="mainlogin.php?logout=true" id="last">Log Out</a>
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

    <!-- Form -->
    <div class="add-Form">
        <div class="directory-path">
            <img src="assets/home-icon.png" id="home-icon">
            <span id="directory-text" onclick="interfere('dashboard.php')" style="cursor:pointer;">Dashboard</span>
            <span id="directory-text"> > </span>
            <span id="directory-text"> Add Reservation </span>
        </div>

        <h1>Add Reservation</h1>
        <h3>Customer Details</h3>
        <form action="addresvprocess.php" method="post">
            <div class="custSection">
                <label>First Name:</label>
                <input type="text" placeholder="i.e John" name="Firstname" required>
                <label>Last Name:</label>
                <input type="text" placeholder="i.e Doe" name="Lastname" required><br>
                <label>Phone Number:</label>
                <input type="text" placeholder="i.e 60123456789" name="Telnum" required>
                <br>
            </div>

            <!-- <button id="next" name="next" type="button" onclick="revealDiv()"> PROCEED </button> -->

            <!-- div for ripple effect to reveal car information AFTER customer details are FILLED -->
            <div id="carSection">
                <h3>Car Details</h3>
                <label for="carType">Select Car Type:</label>
                <div id="selector">
                    <select id="Cartype" onchange="revealCarModel()">
                        <option disabled selected value></option>
                        <option value="luxCar">Luxurious Car</option>
                        <option value="sportsCar">Sports Car</option>
                        <option value="classCar">Classics Car</option>
                    </select>
                </div> <br>

                <!-- Horizontal Scroll Menus-->
                <!-- Note: These should only appear depending on car type selections-->
                <label>Select Car Model:</label>
                <div class="luxCarMenu" for="luxCar" style='display:none'>
                    <div class="modelBoxes">
                        <p>Rolls Royce Phantom</p>
                        <img id="carImg" src="assets/Rolls Royce Phantom.jpg">
                        <div class="radioBtn">
                            <input type="radio" id="RRP" name="car_id" value="C01" onclick="setSelected('RRP', 'RRPLabel')">
                            <label for="RRP" id="RRPLabel"> SELECT</label>
                        </div>
                    </div>

                    <div class="modelBoxes">
                        <p>Bentley Continental Flying Spur</p>
                        <img id="carImg" src="assets/Bentley Flying Spur.jpg">
                        <div class="radioBtn">
                            <input type="radio" id="BCFS" name="car_id" value="C02" onclick="setSelected('BCFS', 'BCFSLabel')">
                            <label for="BCFS" id="BCFSLabel"> SELECT</label>
                        </div>
                    </div>

                    <div class="modelBoxes">
                        <p>Mercedes Benz CLS 350</p>
                        <img id="carImg" src="assets/Mercedes Benz CLS 350.jpg">
                        <div class="radioBtn">
                            <input type="radio" id="MBC" name="car_id" value="C03" onclick="setSelected('MBC', 'MBCLabel')">
                            <label for="MBC" id="MBCLabel"> SELECT</label>
                        </div>
                    </div>

                    <div class="modelBoxes">
                        <p>Jaguar S Type</p>
                        <img id="carImg" src="assets/Jaguar S Type.jpg">
                        <div class="radioBtn">
                            <input type="radio" id="JST" name="car_id" value="C04" onclick="setSelected('JST', 'JSTLabel')">
                            <label for="JST" id="JSTLabel"> SELECT</label>
                        </div>
                    </div>
                </div>

                <div class="sportsCarMenu" for="sportsCar" style='display:none'>
                    <div class="modelBoxes">
                        <p>Ferrari F430 Scuderia</p>
                        <img id="carImg" src="assets/Ferrari F430 Scuderia.jpg">
                        <div class="radioBtn">
                            <input type="radio" id="FFS" name="car_id" value="C05" onclick="setSelected('FFS', 'FFSLabel')">
                            <label for="FFS" id="FFSLabel"> SELECT</label>
                        </div>
                    </div>

                    <div class="modelBoxes">
                        <p>Lamborghini Murcielago LP640</p>
                        <img id="carImg" src="assets/Lamborghini Murcielago LP640.jpg">
                        <div class="radioBtn">
                            <input type="radio" id="LM" name="car_id" value="C06" onclick="setSelected('LM', 'LMLabel')">
                            <label for="LM" id="LMLabel"> SELECT</label>
                        </div>
                    </div>

                    <div class="modelBoxes">
                        <p>Porsche Boxster</p>
                        <img id="carImg" src="assets/Porsche Boxster.jpg">
                        <div class="radioBtn">
                            <input type="radio" id="PB" name="car_id" value="C07" onclick="setSelected('PB', 'PBLabel')">
                            <label for="PB" id="PBLabel"> SELECT</label>
                        </div>
                    </div>

                    <div class="modelBoxes">
                        <p>Lexus SC430</p>
                        <img id="carImg" src="assets/Lexus SC430.jpg">
                        <div class="radioBtn">
                            <input type="radio" id="LEX" name="car_id" value="C08" onclick="setSelected('LEX', 'LEXLabel')">
                            <label for="LEX" id="LEXLabel"> SELECT</label>
                        </div>
                    </div>
                </div>

                <div class="classCarMenu" for="classCar" style='display:none'>
                    <div class="modelBoxes">
                        <p>Jaguar MK 2</p>
                        <img id="carImg" src="assets/Jaguar MK 2.jpg">
                        <div class="radioBtn">
                            <input type="radio" id="JMK" name="car_id" value="C09" onclick="setSelected('JMK', 'JMKLabel')">
                            <label for="JMK" id="JMKLabel"> SELECT</label>
                        </div>
                    </div>

                    <div class="modelBoxes">
                        <p>Rolls Royce Silver Spirit Limousine</p>
                        <img id="carImg" src="assets/Rolls Royce Silver Spirit Limousine.jpg">
                        <div class="radioBtn">
                            <input type="radio" id="RRS" name="car_id" value="C10" onclick="setSelected('RRS', 'RRSLabel')">
                            <label for="RRS" id="RRSLabel"> SELECT</label>
                        </div>
                    </div>

                    <div class="modelBoxes">
                        <p>MG TD</p>
                        <img id="carImg" src="assets/MG TD.jpg">
                        <div class="radioBtn">
                            <input type="radio" id="MGTD" name="car_id" value="C11" onclick="setSelected('MGTD', 'MGTDLabel')">
                            <label for="MGTD" id="MGTDLabel"> SELECT</label>
                        </div>
                    </div>
                </div>


                <?php

                $month = date('m');
                $day = date('d');
                $year = date('Y');

                $today = $year . '-' . $month . '-' . $day;

                ?>
                <div class="rentalDates">
                    <label for="start">Rental Start Date:</label>
                    <input type="date" id="start" name="Rentalstart" value="<?php echo $today; ?>" min=today max="2023-12-31">
                    <label for="start">Rental End Date:</label>
                    <input type="date" id="end" name="Rentalend" value="<?php echo $today; ?>" min=today max="2023-12-31">
                </div>
                <button id="submit" type="submit" name="submit">CHECK AVAILABILITY</button>
            </div>
        </form>
    </div>


    </div>
    </div>

</body>

</html>