<html>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans+Hebrew">
<link rel="stylesheet" href="style.css">
<script src="script.js" type="text/javascript"></script>

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
        <h1>Add Reservation</h1>
        <h3>Customer Details</h3>

        <Form action="addcustomerprocess.php" method="POST">
            <div class="custSection">
                <label for="Fname" id="label">First Name:</label>
                <input type="text" name="Firstname" placeholder="i.e John" required>
                <label for="Lname" id="label">Last Name:</label>
                <input type="text" name="Lastname" placeholder="i.e Doe" required><br>
                <label for="phone" id="label">Phone Number:</label>
                <input type="tel" name="Telnum" placeholder="(1)-233-4439" required><br>
                <input type="submit" value="Submit">
            </div>
        </form>

        <!-- div for ripple effect to reveal car information AFTER customer details are FILLED -->
        <div class="carSection">
            <h3>Car Details</h3>
            <label for="carType">Select Car Type:</label>
            <div id="selector">
                <select>
                    <option value="1">Luxurious Car</option>
                    <option value="2">Sports Car</option>
                    <option value="3">Classics Car</option>
                </select>
            </div> <br>

            <!-- Horizontal Scroll Menus-->
            <!-- Note: These should only appear depending on car type selections-->
            <label for="carType">Select Car Model:</label>
            <div class="luxCarMenu">
                <div class="modelBoxes">
                    Rolls Royce Phantom
                    <img src="">
                    <div class="radioBtn">
                        <input type="radio" value="RRP" name="luxCarSel">
                        <label for="radio">SELECT</label><br>
                    </div>
                </div>

                <div class="modelBoxes">
                    Bentley Continental Flying Spur
                    <img src="">
                    <div class="radioBtn">
                        <input type="radio" value="BCFS" name="luxCarSel">
                        <label for="radio">SELECT</label><br>
                    </div>
                </div>

                <div class="modelBoxes">
                    Mercedes Benz CLS 350
                    <img src="">
                    <div class="radioBtn">
                        <input type="radio" value="MBC" name="luxCarSel">
                        <label for="radio">SELECT</label><br>
                    </div>
                </div>

                <div class="modelBoxes">
                    Jaguar S Type
                    <img src="">
                    <div class="radioBtn">
                        <input type="radio" value="JST" name="luxCarSel">
                        <label for="radio">SELECT</label><br>
                    </div>
                </div>
            </div>

            <div class="rentalDates">
                <label for="start">Rental Start Date:</label>
                <input type="date" id="start" name="trip-start" value="2018-07-22" min=today max="2018-12-31">
                <label for="start">Rental End Date:</label>
                <input type="date" id="start" name="trip-start" value="2018-07-22" min=today max="2018-12-31">
            </div>


            <button id="submit">CHECK AVAILABILITY</button>
        </div>
    </div>

    </div>
    </div>

</body>

</html>
