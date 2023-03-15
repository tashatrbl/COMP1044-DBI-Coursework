
<html>
    <head>
        <style>
        body{
            background-image:linear-gradient(darkgreen,lime);
            font-family:baloo;
            background-image:url("assets/bg2.jpg");
            background-repeat:no-repeat;
            background-size:cover;
            animation:spans 30s ease-in-out infinite;
            background-position:center;
        }

        @keyframes spans{
            0%{
                background-position:center;
            }
            50%{
                background-position:bottom;
                filter:hue-rotate(-50deg);
            }
            100%{
                background-position:center;
            }
        }


        @keyframes show{
            0%{
                opacity:0;
                filter:hue-rotate(320deg);
            }
            100%{
                opacity:1;
                filter:hue-rotate(0deg);
            }
        }

        @font-face{
            font-family:baloo;
            src: url("assets/Baloo-Regular.ttf");
        }

       #title-info-login-cont{
        position:absolute;
        top:40%;
        left:50%;
        transform:translate(-50%,-40%);
        width:35%;
        height:90%;
        background-color:rgba(0,250,250,0.4);
        border-width:15px;
        border-radius:15px;
        animation:show 1s ease-out 1;
        animation-fill-mode:forwards;
        opacity:0;
        filter:hue-rotate(0deg);
       }

       #mot-title{
        color:#7DB2E2;
        position:relative;
        top:0%;
        transform:translate(31%,0%);
        font-size:2.6em;
        -webkit-text-stroke-width: 1px;
  -webkit-text-stroke-color:white;
       }

       #info-title{
        position:relative;
        font-size:2.6em;
        left:5%;
        top:-5%;
        letter-spacing:1.55px;
       }

       #login-form{
       // background-color:rgba(0,255,255,0.4);
        background-color:#F8F8F8;
        position:relative;
        width:85%;
        height:45%;
        top:-5%;
        left:7.5%;
        border-width:15px;
        border-radius:15px;
       }

       #username-input{
        position:relative;
        width:85%;
        height:13%;
        border-width:1px;
        border-radius:10px;
        left:7.5%;
        top:12%;
        font-style:italic;
        border-style:hidden;
        background-color:#D9D9D9;
       }

       #password-input{
        position:relative;
        width:85%;
        height:13%;
        border-width:1px;
        border-radius:10px;
        left:7.5%;
        top:22%;
        font-style:italic;
        border-style:hidden;
        background-color:#D9D9D9;
       }

       #login-btn{
        position:relative;
        width:34%;
        height:10%;
        font-weight:bold;
        border-width:1px;
        border-radius:10px;
        top:35%;
        left:32%;
        color:white;
        background-color:#6BA0D0;
        border-style:hidden;
        transition:background-color 0.4s ease-in;
       }

       #login-btn:hover{
        background-color:lime;
        color:green;
       }

      
       
        </style>
    </head>
    <body>

    <div id="title-info-login-cont">
        <h1 id="mot-title">Drive Now</h1>
        <h1 id="info-title">&nbsp;&nbsp;&nbsp;Making Car Rental<br /> Easier For Customers</h1>

     
        <form id = "login-form" onsubmit="return false" >
        <label for="username" style="font-style:italic;font-family: 'Roboto';color: #636363;font-size:1.1em;font-weight:bold;position:relative;top:11.5%;left:4.5%;"><img width="9.5%" height="9.5%" style="position:relative;top:1.5%;left:1.8%;"src="assets/user-filled.svg"></img>Username</label>
        <input id="username-input" placeholder="enter username" name="username"></input>
        <label for="password" id="labelpass" style="font-style:italic;position:relative;top:21.5%;left:14%;font-family: 'Roboto';color: #636363;font-size:1.1em;font-weight:bold;"><img width="8.5%" height="8.5%"src="assets/shield-lock.svg" style="position:relative;left:-93%;top:12.5%;">Password</label>
        <input id="password-input" placeholder="enter password" type="password" name="password"></input>
        <button type="submit" id="login-btn" onclick="playButton()">Sign in</button>
        </form>


    </div>

        <script>
           function playButton(){
            var audio = new Audio('button.mp3');
            audio.play();
           }
        </script>
    </body>
</html>