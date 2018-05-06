<?php
	include('common.php');
	outputHead();
?>
<body>

<div class="container">

<?php
	outputHeader();
?>

<?php
	outputNav();
?>


<article>
	
  <h1>Account</h1>
	
	<input id="logoutInput" type="submit" value="logout" onclick="logout()">
	
	<form class="form" action="saveUserForm.php" id="editUser" method="post">
  	<h2>Edit user Details</h2>
	  <input type="submit" value="Edit">
	</form>
	
	<form class="form" action="userOrders.php" id="userOrders" method="post">
  	<h2>View your orders</h2>
	  <input type="submit" value="View Orders">
	</form>
	

	<form class="form" action="loginUser.php" id="account" method="post">  
 	<br>
  	<h2>Log in</h2>
  	
	  Email Address:<br>
	  <input type="text" name="email" required>
	  <br><br>
	  Password:<br>
	  <input type="password" name="password" required>
	  <br>
	  <br>
	  <input type="submit" value="Log in">
	</form> 
	
	
	<br>
	<br>
 	
  	<form class="form" action="addUser.php" id="register" method="post">
  	<h2>Register</h2>
	  Name:<br>
	  <input type="text" name="name" required>
	  <br>
	  Email Address:<br>
	  <input type="text" name="email" required>
	  <br>
	  Password:<br>
	  <input type="password" name="password" required>
	  <br>
	  Postcode:<br>
	  <input type="text" name="postcode" required>
	  <br>
	  Contact Number:<br>
	  <input type="text" name="contact" required>
	  
	  <br><br>
	  <input type="submit" value="Register">
	</form>
	
	
</article>


<script>
	 //Global variables 
            var request = new XMLHttpRequest();
			var accountForm = document.getElementById("account").innerHTML;
			var registerForm = document.getElementById("register").innerHTML;
			var logoutButton = document.getElementById("logoutInput").innerHTML;
            
            //Check login when page loads
            window.onload = checkLogin();
            
            //Checks whether user is logged in.
            function checkLogin(){
                //Create event handler that specifies what should happen when server responds
                request.onload = function(){
                    if(request.responseText === "ok"){
						console.log(request.responseText);
                        document.getElementById("account").style.display = "none";
						document.getElementById("register").style.display = "none";
						document.getElementById("logoutInput").style.display = "block";
						document.getElementById("editUser").style.display = "block";
						document.getElementById("userOrders").style.display = "block";
                    }
                    else{
                        console.log(request.responseText);
                        document.getElementById("account").style.display = "block";
						document.getElementById("register").style.display = "block";
						document.getElementById("logoutInput").style.display = "none";
						document.getElementById("editUser").style.display = "none";
						document.getElementById("userOrders").style.display = "none";
                    }
                };
                //Set up and send request
                request.open("GET", "checkLogin.php");
                request.send();
            }
			
			//Logs the user out.
            function logout(){
                //Create event handler that specifies what should happen when server responds
                request.onload = function(){
                    checkLogin();
                };
                //Set up and send request
                request.open("GET", "logout.php");
                request.send();
            }
	</script>
	
<footer>Copyright &copy; iShop</footer>

</div>

</body>
</html>
