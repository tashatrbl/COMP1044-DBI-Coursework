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

    <div class="manage-Form">
        <div class="directory-path">
            <img src="assets/home-icon.png" id="home-icon">
            <span id="directory-text" onclick="interfere('dashboard.php')" style="cursor:pointer;">Dashboard</span>
            <span id="directory-text"> > </span>
            <span id="directory-text"> Manage Reservation </span>
        </div>
        <h1>Manage Reservation</h1>

        <?php
        require('config.php');

        // Define the sort options
        $sort_options = array(
            "reservation_id" => "Sort by Reservation ID",
            "customer_id" => "Sort by Customer ID",
            "car_id" => "Sort by Car ID",
            "car_model" => "Sort by Car Model",
            "rental_date_start" => "Sort by Rental Date Start",
            "rental_date_end" => "Sort by Rental Date End",
            "rental_cost" => "Sort by Rental Cost"
        );

        // Check if a sort option has been selected
        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];
        } else {
            $sort_by = "reservation_id";
        }

        // Define the query based on the sort option
        if ($sort_by == "reservation_id") {
            $query = "SELECT reservation_id, customer_id, car_id, car_model, rental_date_start, rental_date_end, rental_cost, actual_name FROM reservation, staff WHERE reservation.username = staff.username ORDER BY reservation_id";
        } else if ($sort_by == "customer_id") {
            $query = "SELECT reservation_id, customer_id, car_id, car_model, rental_date_start, rental_date_end, rental_cost, actual_name FROM reservation, staff WHERE reservation.username = staff.username ORDER BY customer_id";
        } else if ($sort_by == "car_id") {
            $query = "SELECT reservation_id, customer_id, car_id, car_model, rental_date_start, rental_date_end, rental_cost, actual_name FROM reservation, staff WHERE reservation.username = staff.username ORDER BY car_id";
        } else if ($sort_by == "car_model") {
            $query = "SELECT reservation_id, customer_id, car_id, car_model, rental_date_start, rental_date_end, rental_cost, actual_name FROM reservation, staff WHERE reservation.username = staff.username ORDER BY car_model";
        } else if ($sort_by == "rental_date_start") {
            $query = "SELECT reservation_id, customer_id, car_id, car_model, rental_date_start, rental_date_end, rental_cost, actual_name FROM reservation, staff WHERE reservation.username = staff.username ORDER BY rental_date_start";
        } else if ($sort_by == "rental_date_end") {
            $query = "SELECT reservation_id, customer_id, car_id, car_model, rental_date_start, rental_date_end, rental_cost, actual_name FROM reservation, staff WHERE reservation.username = staff.username ORDER BY rental_date_end";
        } else if ($sort_by == "rental_cost") {
            $query = "SELECT reservation_id, customer_id, car_id, car_model, rental_date_start, rental_date_end, rental_cost, actual_name FROM reservation, staff WHERE reservation.username = staff.username ORDER BY rental_cost";
        }

        // Display the search form
        echo "<form method='get'>";

        // Display the dropdown menu
        echo "<label for='sort_by'>Sort By:</label>";
        echo "<select name='sort_by' id='sort_by' onchange='this.form.submit()'>";
        foreach ($sort_options as $option_value => $option_text) {
            if ($sort_by == $option_value) {
                echo "<option value='" . $option_value . "' selected>" . $option_text . "</option>";
            } else {
                echo "<option value='" . $option_value . "'>" . $option_text . "</option>";
            }
        }
        echo "</select>";

        // display remaining labels and search button
        echo "<label for='Fname' id='label'>Search Reservation ID:</label>";
        echo "<input type='text' name='search'>";
        echo "<button id = 'searchBtn' type='submit'>SEARCH</button>";
        echo "</form>";

        // Execute the query and display the results
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            echo "<table class = 'table'>";

            echo "<tr id= 'first-tr'><th>Select</th><th>Reservation ID</th><th>Customer ID</th><th>Car ID</th><th>Car Model</th><th>Rental Start Date</th><th>Rental End Date</th><th>Total Rental Cost (RM)</th><th>Approved By</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>
                    <input type='radio' id='manageCheck' name='selected[]' value='" . $row["reservation_id"] . "' 
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
        }

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
                    echo "<tr id = 'first-tr'><th>Select</th><th>Reservation ID</th><th>Customer ID</th><th>Car ID</th><th>Car Model</th><th>Rental Start Date</th><th>Rental End Date</th><th>Total Rental Cost (RM)</th><th>Approved By</th></tr>";
                    foreach ($data as $row) {
                        echo "<tr>
                            <td>
                            <input type='radio' id ='manageCheck' name='selected[]' value='" . $row["reservation_id"] . "' 
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
                } else {
                    echo "<h2>No results found for Reservation ID: " . $search_term . "</h2>";
                }
            }
        }
        //Close the database connection
        mysqli_close($conn);
        ?>

        <br>
        <form action="managepage.php" method="POST">
            <input type="hidden" name="reservationid" id="reservationid">
            <button type="submit" id="manageBtn" onclick="autofillForm(); document.getElementById('reservationid').value = selectedReservationId;">MANAGE</button>
        </form>
    </div>

</body>

</html>