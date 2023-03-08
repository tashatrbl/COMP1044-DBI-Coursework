<?php
			echo "<script type='text/javascript'> 
			        document.getElementById('loginbtn').addEventListener('click',()=>{
				  var buttonaudio = new Audio('button-click.mp3');
				  buttonaudio.play();
			      for(i=0;i<document.getElementsByClassName('login').length;i++){
					  document.getElementsByClassName('login')[i].style.display = 'none'
				  }
				  document.getElementById('formcontainer').style.width = '50%'
				   document.getElementById('formcontainer').style.height = '68%'
				    document.getElementById('formcontainer').style.top = '66%'
					document.getElementById('username-handle').style.visibility = 'visible'
					})
               </script>";
		?>