<html>

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
    <div class="del-Form">

        <div class="directory-path">
            <img src="assets/home-icon.png" id="home-icon">
            <span id="directory-text" onclick="interfere('dashboard.php')" style="cursor:pointer;">Dashboard</span>
            <span id="directory-text"> > </span>
            <span id="directory-text"> Delete Reservation </span>
        </div>

        <h1>Delete Reservation</h1>

        <?php
        require('config.php');

        $query = "SELECT *, actual_name FROM reservation, staff WHERE reservation.username = staff.username";
        $result = mysqli_query($conn, $query);

        //Retrieve the data
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        // Display the search form
        echo "<form method='get'>";
        echo "<label for='Fname' id='label'>Search Reservation ID:</label>";
        echo "<input type='text' name='search'>";
        echo "<button id = 'searchBtn' type='submit'>SEARCH</button>";
        echo "</form>";
        //Display the data in a table
        echo "<table class = 'table'>";
        echo "<tr id= 'first-tr'><th>Select</th><th>Reservation ID</th><th>Customer ID</th><th>Car ID</th><th>Car Model</th><th>Rental Start Date</th><th>Rental End Date</th><th>Total Rental Cost (RM)</th><th>Approved By</th></tr>";
        foreach ($data as $row) {
            echo "<tr id = 'row'>
                            <td >
                            <input type='checkbox' id = 'deleteCheck' name='selected[]' value='" . $row["reservation_id"] . "' 
                            data-reservationid='" . $row["reservation_id"] . "'>
                            </td>
                            <td>" . $row["reservation_id"] . "</td>
                            <td>" . $row["customer_id"] . "</td>
                            <td>" . $row["car_id"] . "</td>
                            <td>" . $row["car_model"] . "</td>
                            <td>" . $row["rental_date_start"] . "</td>
                            <td>" . $row["rental_date_end"] . "</td>
                            <td>" . $row["rental_cost"] . "</td>
                            <td>" . $row["actual_name"] . "</td>
                    </tr>";
        }
        echo "</table>";

        // Check if a search term has been entered
        if (isset($_GET['search'])) {
            $search_term = $_GET['search'];

            if (!empty($search_term)) {
                $query = "SELECT *, actual_name FROM reservation, staff WHERE reservation.username = staff.username AND reservation_id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $search_term);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);

                if (empty($data)) {
                    echo "No Results Found For Reservation ID: " . $search_term;
                }

                // Display the search results
                if (count($data) > 0) {
                    echo "<h2>Search Results for Reservation ID: " . $search_term . "</h2>";
                    echo "<table class = 'table'>";
                    echo "<tr id= 'first-tr'><th>Select</th><th>Reservation ID</th><th>Customer ID</th><th>Car ID</th><th>Car Model</th><th>Rental Start Date</th><th>Rental End Date</th><th>Total Rental Cost (RM)</th><th>Approved By</th></tr>";
                    foreach ($data as $row) {
                        echo "<tr>
                            <td>
                            <input type='checkbox' id = 'deleteCheck' name='selected[]' value='" . $row["reservation_id"] . "' 
                            data-reservationid='" . $row["reservation_id"] . "'
                            </td>
                            <td>" . $row["reservation_id"] . "</td>
                            <td>" . $row["customer_id"] . "</td>
                            <td>" . $row["car_id"] . "</td>
                            <td>" . $row["car_model"] . "</td>
                            <td>" . $row["rental_date_start"] . "</td>
                            <td>" . $row["rental_date_end"] . "</td>
                            <td>" . $row["rental_cost"] . "</td>
                            <td>" . $row["actual_name"] . "</td>
                        </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<h2>No results found for Reservation ID: " . $search_term . "</h2>";
                }
            }
        }

        //Close the database connection
        mysqli_close($conn);
        ?>
        <br>

        <button id="delete" type="submit" onclick=revealAlertBox()>DELETE</button>

        <script>
            var checkboxes = document.getElementsByName("selected[]");
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].addEventListener('change', autofillForm);
            }
        </script>

        <div id="alertOverlay"></div>

        <div id="alertBox">
            <p style="font-size: 20px; font-weight: bold;">The following records will be deleted:</p>
            <div id="alertBoxContent">
                <span id="text"></span>
            </div>

            <div id="alertBoxButtons">
                <form action="deleteprocess.php" method="POST">
                    <button id="cancel" type="button" onclick="closeAlertBox()">CANCEL</button>
                    <input type="hidden" name="reservationid" id="reservationid">
                    <button id="delete" type="submit" onclick="deleteReservation(); document.getElementById('reservationid').value = selectedReservationId;">PROCEED</button>
                </form>
            </div>

        </div>

    </div>

</html>