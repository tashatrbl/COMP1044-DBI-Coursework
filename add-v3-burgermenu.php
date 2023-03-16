<html>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans+Hebrew">

<head>
    <style>
        body {
            font-family: 'IBM Plex Sans Hebrew';
            background-image: url("assets/bg2.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            margin: 0;
            filter: blur(200%);
        }

        #logo {
            width: 10%;
            padding: 8px 0 0 55px;
        }

        #sign-in__stroke {
            width: 166px;
            height: 35px;
            border: 2px solid #FFFFFF;
            border-radius: 30px;
            float: right;
            margin-top: 15px;
            margin-right: 20px;
        }

        #sign-in__fill {
            width: 166px;
            height: 35px;
            border-radius: 30px;
            background-color: #7DB2E2;
        }

        #sign-in__fill:hover {
            background-color: #63A0D9;
            transition: background-color 0.2s ease-in;
        }

        #Admin {
            font-family: 'IBM Plex Sans Hebrew';
            color: #FFFFFF;
            font-weight: bold;
            float: right;
            margin-top: 6px;
            margin-right: 50px;
        }

        #user-icon {
            margin-top: 4px;
            margin-left: 10px;
            filter: invert(100%);
            height: 25px;
        }

        #top-navbar {
            position: fixed;
            width: 100%;
            height: 8%;
            background-color: #7DB2E2;
            top: 0%;
            border-right-width: 0px;
            border-top-width: 0px;
            border-left-width: 0px;
            border-bottom-width: 5px;
            border-style: solid;
            border-color: darkblue;
        }

        #side-navbar {
            font-weight: bold;
            position: fixed;
            width: 17%;
            height: 93%;
            background-color: #7DB2E2;
            top: 7%;
            border-right-width: 5px;
            border-top-width: 0px;
            border-left-width: 0px;
            border-bottom-width: 0px;
            border-style: solid;
            border-color: darkblue;
        }

        #sidebar-icons {
            filter: invert(100%);
            width: 33px;
            height: 33px;
            position: relative;
            top: 20%;
            left: 3%;
        }

        #pos-sidebar-text {
            position: relative;
            top: 10%;
            left: 13%;
        }

        .dashboard-opt {
            margin: auto;
            line-height: 400%;
            color: white;
            letter-spacing: 0.5px;
            position: relative;
            border-color: #7DB2E2;
            border-style: solid;
            border-top-width: 3px;
            border-bottom-width: 3px;
            border-left-width: 0px;
            border-right-width: 0px;
            width: 100%;
            height: 10%;
            text-indent: -10px;
        }

        .dashboard-opt:hover {
            background-color: #62A0D9;
            border-style: solid;
            border-top-width: 3px;
            border-bottom-width: 3px;
            border-left-width: 0px;
            border-right-width: 0px;
            border-color: #5C96CB;
            transition: background-color 0.5s ease-in;
            transition: border-color 0.6s;
        }

        #addreservation-opt {
            background-color: #62A0D9;
            border-style: solid;

            border-color: #5C96CB;
        }

        #white-backdrop {
            width: 100%;
            height: 100%;
            background-color: white;
        }

        #menu__toggle:checked+.menu__btn>span::before,
        #menu__toggle:checked+.menu__btn>span::after {
            top: 0;
        }

        #menu__toggle:checked~.menu__box {
            left: 0 !important;
        }

        .menu__btn {
            position: fixed;
            top: 35px;
            left: 20px;
            width: 26px;
            height: 26px;
            cursor: pointer;
            z-index: 1;
        }

        .menu__btn>span,
        .menu__btn>span::before,
        .menu__btn>span::after {
            display: block;
            position: absolute;
            width: 100%;
            height: 2px;
            background-color: #FFFFFF;
        }

        .menu__btn>span::before {
            content: '';
            top: -8px;
        }

        .menu__btn>span::after {
            content: '';
            top: 8px;
        }

        .menu__box {
            display: block;
            position: fixed;
            top: 0;
            left: -100%;
            width: 300px;
            height: 100%;
            margin: 0;
            padding: 80px 0;
            list-style: none;
            background-color: #7DB2E2;
            box-shadow: 2px 2px 6px rgba(0, 0, 0, .4);
            transition-duration: .5s;
        }

        .menu__item {
            display: block;
            padding: 15px 0px 0px 0px;
            color: #333;
            font-size: 20px;
            font-weight: 600;
            text-decoration: none;
            transition-duration: .5s;
        }

        .menu__item:hover {
            background-color: #62A0D9;
        }
        }
    </style>
</head>

<body>
    <div id='white-backdrop'></div>
    <div id="top-navbar">
        <img id="logo" src="assets/DriveNow.png"></img>
        <div id="sign-in__stroke">
            <div id="sign-in__fill">
                <img id="user-icon" src="assets/user-filled.svg"></img>
                <span id="Admin">Admin</span>
            </div>
        </div>
    </div>

    <!--
    <div id="side-navbar">
        <div id="dashboard-opt" onclick="interfere('dashboard.php')" class="dashboard-opt">
            <img id="sidebar-icons" src="assets/home-icon.png">
            <span id="pos-sidebar-text">Dashboard</span>
        </div>
        <div id="addreservation-opt" onclick="interfere('add-reservation.php')" class="dashboard-opt">
            <img id="sidebar-icons" src="assets/add-icon.png">
            <span id="pos-sidebar-text">Add Reservation</span>
        </div>
        <div id="managereservation-opt" onclick="interfere('manage-reservation.php')" class="dashboard-opt">
            <img id="sidebar-icons" src="assets/manage-icon.png">
            <span id="pos-sidebar-text">Manage Reservation</span>
        </div>
        <div id="deletereservation-opt" onclick="interfere('delete-reservation.php')" class="dashboard-opt">
            <img id="sidebar-icons" src="assets/delete-icon.png">
            <span id="pos-sidebar-text">Delete Reservation</span>
        </div>
    </div>
    -->

    <div class="hamburger-menu">
        <input id="menu__toggle" type="checkbox" />
        <label class="menu__btn" for="menu__toggle">
            <span></span>
        </label>
        <ul class="menu__box">
            <li><a class="menu__item" onclick="interfere('dashboard.php')" class="dashboard-opt">
                    <img id="sidebar-icons" src="assets/home-icon.png">Dashboard</a></li>
            <li><a class="menu__item" onclick="interfere('add-reservation.php')" class="dashboard-opt">
                    <img id="sidebar-icons" src="assets/add-icon.png">About</a></li>
            <li><a class="menu__item" onclick="interfere('manage-reservation.php')" class="dashboard-opt">
                    <img id="sidebar-icons" src="assets/manage-icon.png">>Team</a></li>
            <li><a class="menu__item" onclick="interfere('delete-reservation.php')" class="dashboard-opt">
                    <img id="sidebar-icons" src="assets/delete-icon.png">>Contact</a></li>
        </ul>
    </div>

    <div id="add-Form">

    </div>


    <div id="logout">

    </div>

    <script>
        var navigationdelay = 700
        var audio = new Audio('assets/interface.mp3');
        function interfere(link) {
            audio.play();
            setTimeout(() => {
                if (window.location.href.includes(link))
                    return;
                window.location.href = link
            }, navigationdelay);
        }
    </script>
</body>

</html>