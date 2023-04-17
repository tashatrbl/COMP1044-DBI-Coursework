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

         // Display the search form
         echo "<form method='get'>";
         echo "<label for='search'>Search Reservation ID:</label>";
         echo "<input type='text' name='search' id='search'>";
         echo "<button type='submit'>Search</button>";
         echo "</form>";

        //Display the data in a table
        echo "<table>";
                    echo "<tr><th>Select</th><th>Reservation ID</th><th>Customer ID</th><th>Car ID</th><th>Car Model</th><th>Rental Start Date</th><th>Rental End Date</th><th>Total Rental Cost (RM)</th></tr>";
                foreach ($data as $row) {
                echo "<tr>
                            <td>
                            <input type='checkbox' name='selected[]' value='".$row["reservation_id"]."' 
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
                            <input type='checkbox' name='selected[]' value='".$row["reservation_id"]."' 
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
           // Show confirmation message before deleting the record
            function deleteReservation() {
                const checkboxes = document.getElementsByName('selected[]');
                const selectedIds = [];
                for (let i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].checked) {
                        selectedIds.push(checkboxes[i].value);
                    }
                }
                if (selectedIds.length === 0) {
                    alert('Please select at least one record to delete.');
                } else {
                    const confirmation = confirm('Are you sure you want to delete the selected reservation(s)?\nReservation ID(s): ' + selectedIds.join(', ') + '\n');
                    if (confirmation) {
                        const reservationIdInputs = document.getElementsByName('reservationid');
                        for (let i = 0; i < reservationIdInputs.length; i++) {
                            const reservationIdInput = reservationIdInputs[i];
                            if (selectedIds.includes(reservationIdInput.value)) {
                                reservationIdInput.parentNode.parentNode.remove();
                            }
                        }
                        const xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function () {
                            if (this.readyState === 4 && this.status === 200) {
                                alert('Reservation(s) deleted successfully.');
                            }
                        };
                        xhr.open('POST', 'delete-reservation-action.php', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.send('selected=' + selectedIds.join(','));
                    }
                }
            }

        </script>

        <form action="deleteprocess.php" method="POST">
            <input type="hidden" name="selected[]" id="selected">
            <button type="submit">Delete</button>
        </form>

        <script>
            var selectedReservationIds = [];

            function autofillForm() {
                selectedReservationIds = [];
                var checkboxes = document.getElementsByName("selected[]");
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].checked) {
                        selectedReservationIds.push(checkboxes[i].value);
                    }
                }
                document.getElementById('selected').value = selectedReservationIds.join(',');
            }

            var checkboxes = document.getElementsByName("selected[]");
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].addEventListener('change', autofillForm);
            }
        </script>


    </div>
