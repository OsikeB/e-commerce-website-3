<?php
	include('common.php');
	outputHead();
?>
<body>

<div class="container">

<?php
	outputHeader();
?>

<nav>
  <ul>
    <li><a href="cmsAdd.php">Add an Item</a></li>
    <li><a href="cmsEdit.php">Edit/Remove an Item</a></li>
    <li><a href="cmsOrders.php">Customer Orders</a></li>
    <li><a href="cms.php">Login / Logout</a></li>
  </ul>
</nav>


<article>
	
  <h1>Content Management System - Account</h1>
  
	<input id="logoutInput" type="submit" value="logout" onclick="logout()">
	
		
	<form class="form" action="cmsLoginUser.php" id="account" method="post">  
 	<br>
  	<h2>Log in</h2>
  	
	  Username:<br>
	  <input type="text" name="username" required>
	  <br><br>
	  Password:<br>
	  <input type="password" name="password" required>
	  <br>
	  <br>
	  <input type="submit" value="Log in">
	</form> 
	
  	
	
</article>


<script>
	 //Global variables 
            var request = new XMLHttpRequest();
			var accountForm = document.getElementById("account").innerHTML;

            
            //Check login when page loads
            window.onload = checkLogin();
            
            //Checks whether user is logged in.
            function checkLogin(){
                //Create event handler that specifies what should happen when server responds
                request.onload = function(){
                    if(request.responseText === "ok"){
						console.log(request.responseText);
                        document.getElementById("account").style.display = "none";
						document.getElementById("logoutInput").style.display = "block";

                    }
                    else{
                        console.log(request.responseText);
                        document.getElementById("account").style.display = "block";
						document.getElementById("logoutInput").style.display = "none";
                    }
                };
                //Set up and send request
                request.open("GET", "cmsCheckLogin.php");
                request.send();
            }
			
			//Logs the user out.
            function logout(){
                //Create event handler that specifies what should happen when server responds
                request.onload = function(){
                    checkLogin();
                };
                //Set up and send request
                request.open("GET", "cmsLogout.php");
                request.send();
            }
	</script>
	
<footer>Copyright &copy; iShop</footer>

</div>

</body>
</html>
