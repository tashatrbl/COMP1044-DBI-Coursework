<html>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans+Hebrew">
<link rel="stylesheet" href="style.css">
<script src="script.js" type="text/javascript"></script>

<body>
    <div id="top-navbar">
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

    <div class="hamburger-menu">
        <input id="menu__toggle" type="checkbox" />
        <label class="menu__btn" for="menu__toggle">
            <span ></span>
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

    <div id="manage-Form">
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
            $query = "SELECT reservation_id, customer_id, car_id, car_model, rental_date_start, rental_date_end, rental_cost FROM reservation ORDER BY reservation_id";
        } else if ($sort_by == "customer_id") {
            $query = "SELECT reservation_id, customer_id, car_id, car_model, rental_date_start, rental_date_end, rental_cost FROM reservation ORDER BY customer_id";
        } else if ($sort_by == "car_id") {
            $query = "SELECT reservation_id, customer_id, car_id, car_model, rental_date_start, rental_date_end, rental_cost FROM reservation ORDER BY car_id";
        } else if ($sort_by == "car_model") {
            $query = "SELECT reservation_id, customer_id, car_id, car_model, rental_date_start, rental_date_end, rental_cost FROM reservation ORDER BY car_model";
        } else if ($sort_by == "rental_date_start") {
            $query = "SELECT reservation_id, customer_id, car_id, car_model, rental_date_start, rental_date_end, rental_cost FROM reservation ORDER BY rental_date_start";
        } else if ($sort_by == "rental_date_end") {
            $query = "SELECT reservation_id, customer_id, car_id, car_model, rental_date_start, rental_date_end, rental_cost FROM reservation ORDER BY rental_date_end";
        } else if ($sort_by == "rental_cost") {
            $query = "SELECT reservation_id, customer_id, car_id, car_model, rental_date_start, rental_date_end, rental_cost FROM reservation ORDER BY rental_cost";
        }

        // Execute the query and display the results
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>Select</th><th>Reservation ID</th><th>Customer ID</th><th>Car ID</th><th>Car Model</th><th>Rental Start Date</th><th>Rental End Date</th><th>Total Rental Cost (RM)</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>
                    <input type='radio' name='selected[]' value='".$row["reservation_id"]."' 
                    data-reservationid='".$row["reservation_id"]."'
                    </td>
                    <td>" . $row["reservation_id"] . "</td>
                    <td>" . $row["customer_id"] . "</td>
                    <td>" . $row["car_id"] . "</td>
                    <td>" . $row["car_model"] . "</td>
                    <td>" . $row["rental_date_start"] . "</td>
                    <td>" . $row["rental_date_end"] . "</td>
                    <td>" . $row["rental_cost"] . "</td>
                </tr>";          
        }
    }
        
        // Display the dropdown menu
        echo "<form method='get'>";
        echo "<label for='sort_by'>Sort By:</label>";
        echo "<select name='sort_by' id='sort_by' onchange='this.form.submit()'>";
        foreach ($sort_options as $option_value => $option_text) {
            if ($sort_by == $option_value) {
                echo "<option value='".$option_value."' selected>".$option_text."</option>";
            } else {
                echo "<option value='".$option_value."'>".$option_text."</option>";
            }
        }
        echo "</select>";

        // Display the search form
        echo "<form method='get'>";
        echo "<label for='search'>Search Reservation ID:</label>";
        echo "<input type='text' name='search' id='search'>";
        echo "<button type='submit'>Search</button>";
        echo "</form>";

        // Check if a search term has been entered
        if (isset($_GET['search'])) {
            $search_term = $_GET['search'];
        
            if (!empty($search_term)) {
                $query = "SELECT * FROM reservation WHERE reservation_id = ?";
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
                    echo "<h2>Search Results for Reservation ID: ".$search_term."</h2>";
                    echo "<table>";
                    echo "<tr><th>Select</th><th>Reservation ID</th><th>Customer ID</th><th>Car ID</th><th>Car Model</th><th>Rental Start Date</th><th>Rental End Date</th><th>Total Rental Cost (RM)</th></tr>";
                foreach ($data as $row) {
                echo "<tr>
                            <td>
                            <input type='radio' name='selected[]' value='".$row["reservation_id"]."' 
                            data-reservationid='".$row["reservation_id"]."'
                            </td>
                            <td>" . $row["reservation_id"] . "</td>
                            <td>" . $row["customer_id"] . "</td>
                            <td>" . $row["car_id"] . "</td>
                            <td>" . $row["car_model"] . "</td>
                            <td>" . $row["rental_date_start"] . "</td>
                            <td>" . $row["rental_date_end"] . "</td>
                            <td>" . $row["rental_cost"] . "</td>
                        </tr>";          
                        }
                            echo "</table>";
                        } else {
                            echo "<h2>No results found for Reservation ID: ".$search_term."</h2>";
                        }
            }
        }
        //Close the database connection
        mysqli_close($conn);
        ?>
    
        <script>
            var selectedReservationId;

            function autofillForm() {
                var checkboxes = document.getElementsByName("selected[]");
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].checked) {
                        selectedReservationId = checkboxes[i].getAttribute("data-reservationid");
                        break;
                    }
                }
                console.log("Selected Reservation ID: " + selectedReservationId);
            }

            var checkboxes = document.getElementsByName("selected[]");
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].addEventListener('change', autofillForm);
            }
        </script>


        <br>
        <form action="managepage.php" method="POST">
            <input type="hidden" name="reservationid" id="reservationid">
            <button type="submit" onclick="document.getElementById('reservationid').value = selectedReservationId;">Manage</button>
        </form>

    </div>

    <div id="settings">
        <input id="settings__toggle" type="checkbox" />
    </div>

</body>

</html>
