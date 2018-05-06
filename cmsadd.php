


<?php
//if not logged in redirect to cms login page
session_name("CMS");
session_start();

if( !array_key_exists("username", $_SESSION) ){
		
		 header("Location: cms.php"); 
    }
    
?>


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

  <h1><b>Content Management System - Add an Item</b></h1>
  
  <form class="form" action="cmsadditem.php" id="account" method="post" enctype="multipart/form-data">
            <label><b>Name: </b></label>
            <input name="name" type="text" required>
            
            <br>
            
            <label><b>Price: </b></label>
            <input name="price" type="text" required>
            
            <br>
			
			<label><b>Stock: </b></label>
            <input name="stock" type="text" required>
            
            <br>
		
			<label><b>Image: </b></label>
            <input name="imageToUpload" type="file" required>
            
            <br>
            
            <label><b>Key: </b></label>
            <input name="key" type="text" required>
            
            <br>	
			
            <input type="submit" value="Add">
            </form>
  
</article>

<footer>Copyright &copy; iStore</footer>

</div>



</body>
</html>
