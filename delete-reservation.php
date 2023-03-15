<html>
    <head>
        <style>
            body{
            font-family:baloo;
            background-image:url("assets/bg2.jpg");
            background-repeat:no-repeat;
            background-size:cover;
            margin:0;
            filter:blur(200%);
            }

            @font-face{
            font-family:baloo;
            src: url("assets/Baloo-Regular.ttf");
        }

        #top-navbar{
            position:fixed;
            width:100%;
            height:7%;
            background-color:#7DB2E2;
            top:0%;
            border-right-width:0px;
            border-top-width:0px;
            border-left-width:0px;
            border-bottom-width:5px;
            border-style:solid;
            border-color:darkblue;
        }

        #side-navbar{
            position:fixed;
            width:17%;
            height:93%;
            background-color:#7DB2E2;
            top:7%;
            border-right-width:5px;
            border-top-width:0px;
            border-left-width:0px;
            border-bottom-width:0px;
            border-style:solid;
            border-color:darkblue;
        }

        #top-user-show{
            position:relative;
            color:white;
            border-style:double;
            border-width:1.5px;
            border-color:white;
            border-radius:10px;
            width:9%;
            height:50%;
            background-color:#7DB2E2;
            font-weight:100;
            font-size:0.75em;
            top:-150%;
            left:89%;
        }

        #drive-title{
            position:relative;
            color:white;
            font-size:1.7em;
            top:-30%;
            left:1.5%;
        }

        #admin-cont{
            position:absolute;
            width:25%;
            height:350%;
            top:155%;
            left:20%;
        }

        .dashboard-opt{
            margin:auto;
            line-height:400%;
            color:white;
            letter-spacing:0.5px;
            position:relative;
            width:100%;
            height:10%;
            top:5%;
            //text-align:center;
            text-indent:-10px;
            transition:background-color 0.5s ease-in;
        }
        .dashboard-opt:hover{
            background-color:#5C96CB;
            border-style:solid;
            border-top-width:3px;
            border-bottom-width:3px;
            border-left-width:0px;
            border-right-width:0px;
            border-color:cyan;
        }

        #deletereservation-opt{
            background-color:#5C96CB;
            border-style:solid;
            border-top-width:3px;
            border-bottom-width:3px;
            border-left-width:0px;
            border-right-width:0px;
            border-color:cyan;
        }

        #white-backdrop{
            width:100%;
            height:100%;
            background-image:linear-gradient(to right bottom,rgba(255,255,255,0.4),rgba(0,0,0,0.7));
        }
        </style>
    </head>

    <body>
        <div id='white-backdrop'></div>
        <div id="top-navbar">
        <h1 id="drive-title">DriveNow</h1>
            <div id="top-user-show">
           <img width="80%" height="80%" style="position:relative;top:4%;left:-25%;"src="assets/user-filled.svg"></img>
           <div style="position:relative;top:-70%;left:40%;font-weight:100;">Admin</div>
            </div>
         
        <div id="side-navbar">
        <div id="dashboard-opt" onclick="interfere('dashboard.php')" class="dashboard-opt"><img src="assets/home-icon.png" width="35px" height="35px" style="position:relative;top:13%;left:8.5%;"><span style="position:relative;left:13%;">Dashboard</span></div>
            <div id="addreservation-opt" onclick="interfere('add-reservation.php')" class="dashboard-opt"><img src="assets/add-icon.png" width="37px" height="37px" style="position:relative;top:20%;left:8%;"><span style="position:relative;left:12%;">Add Reservation</span></div>
            <div id="managereservation-opt" onclick="interfere('manage-reservation.php')" class="dashboard-opt"><img src="assets/manage-icon.png" width="33px" height="33px" style="position:relative;top:20%;left:8.5%;"><span style="position:relative;left:13%;">Manage Reservation</span></div>
            <div id="deletereservation-opt" onclick="interfere('delete-reservation.php')" class="dashboard-opt"><img src="assets/delete-icon.png" width="33px" height="33px" style="position:relative;top:20%;left:9.5%;"><span style="position:relative;left:13%;">Delete Reservation</span></div>
        </div>


        

        <script>
             var navigationdelay = 700
            var audio = new Audio('assets/interface.mp3');
            function interfere(link){
                audio.play();
                setTimeout(()=>{
                 if(window.location.href == link)
                  return;
                  window.location.href = link
                },navigationdelay);
            }

        </script>
    </body>
</html>