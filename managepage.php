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

        <script>
        // Get all the checkboxes
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');

        // Add an event listener to each checkbox
        checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', (event) => {
            if (event.target.checked) {
            // Get the row data
            const row = event.target.closest('tr');
            const reservationId = row.cells[1].textContent;
            const customerId = row.cells[2].textContent;
            const carId = row.cells[3].textContent;
            const carModel = row.cells[4].textContent;
            const rentalStartDate = row.cells[5].textContent;
            const rentalEndDate = row.cells[6].textContent;
            const rentalCost = row.cells[7].textContent;
            
            // Populate the form fields with the row data
            document.getElementById('reservation_id').value = reservationId;
            document.getElementById('customer_id').value = customerId;
            document.getElementById('car_id').value = carId;
            document.getElementById('car_model').value = carModel;
            document.getElementById('rental_date_start').value = rentalStartDate;
            document.getElementById('rental_date_end').value = rentalEndDate;
            document.getElementById('rental_cost').value = rentalCost;
            }
        });
        });
        </script>

        <!--
        <form method='post'>
        <input type='hidden' name='update_reservation' value='true'>
        <input type='hidden' name='reservation_id' id='reservation_id'>
        <label for='customer_id'>Customer ID:</label>
        <input type='text' name='customer_id' id='customer_id'>
        <label for='car_id'>Car ID:</label>
        <input type='text' name='car_id' id='car_id'>
        <label for='car_model'>Car Model:</label>
        <input type='text' name='car_model' id='car_model'>
        <label for='rental_date_start'>Rental Date Start:</label>
        <input type='text' name='rental_date_start' id='rental_date_start'>
        <label for='rental_date_end'>Rental Date End:</label>
        <input type='text' name='rental_date_end' id='rental_date_end'>
        <label for='rental_cost'>Rental Cost:</label>
        <input type='text' name='rental_cost' id='rental_cost'>
        <button type='submit'>Update Reservation</button>
        </form>
    -->


        <!-- Form -->
        <div class="add-Form">
                <h1>Manage Reservation</h1>
                <form action="manageresvprocess.php" method="post">
                    <label>Reservation ID:</label>
                    <input type="text" name="reservationid" id="reservationid">
                <h3>Customer Details</h3>
                    <div class="custSection">
                        <label>Customer ID:</label>
                        <input type="text" name="customerid"><br>
                        <label>First Name:</label>
                        <input type="text" name="Firstname">
                        <label>Last Name:</label>
                        <input type="text" name="Lastname"><br>
                        <label>Phone Number:</label>
                        <input type="text" name="Telnum">
                        <br>
                    </div>

                <h3>Car Details</h3>
                    <div id="carSection">
                    <label>Car ID:</label>
                    <input type="text" name="carid"><br>

                    <label for="carType">Car Model Type:</label>
                    <div id="selector">
                        <select id="Cartype">
                            <option disabled selected value></option>
                            <option value="luxCar">Luxurious Car</option>
                            <option value="sportsCar">Sports Car</option>
                            <option value="classCar">Classics Car</option>
                        </select>
                    </div> <br>

                    <label>Car Model:</label>
                    <div id="selector">
                        <select id="Carmodel">
                            <option disabled selected value></option>
                            <option value="luxCar">Rolls Royce Phantom</option>
                            <option value="sportsCar">Bentley Continental Flying Spur</option>
                            <option value="classCar">Mercedes Benz CLS 350</option>
                            <option value="luxCar">Jaguar S Type</option>
                            <option value="sportsCar">Ferrari F430 Scuderia</option>
                            <option value="classCar">Lamborghini Murcielago LP640</option>
                            <option value="classCar">Porsche Boxster</option>
                            <option value="luxCar">Lexus SC430</option>
                            <option value="classCar">Jaguar MK 2</option>
                            <option value="luxCar">Rolls Royce Silver Spirit Limousine</option>
                            <option value="classCar">MG TD</option>
                        </select>
                    </div> <br>

                    <label>Car Color:</label>
                    <input type="text" name="carcolor"><br>
                    <label>Rental Per Day:</label>
                    <input type="text" name="rentalperday"><br>

                    <div class="rentalDates">
                    <label for="start">Rental Start Date:</label>
                    <input type="date" id="start" name="Rentalstart" value="2018-07-22" min=today max="2023-12-31">
                    <label for="start">Rental End Date:</label>
                    <input type="date" id="end" name="Rentalend" value="2018-07-23" min=today max="2023-12-31">
                </div>
                <button id="submit" type="submit" name="update">UPDATE</button>
            </div>
        </form>
    </div>


    </div>
    </div>

</body>

</html>         
  