


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

<?php
	//Extract the product ID
	$prodID = $_POST['prodID'];
	

	//Connect to MongoDB
	$mongoClient = new MongoClient();

	//Select a database
	$db = $mongoClient->phoneDB;


	//Search using id
	$findCriteria = [
	'_id' => new MongoId($prodID)
	 ];
	
	//Find product
	$cursor = $db->Phones->find($findCriteria);
	

	//Output the results as forms 
	foreach ($cursor as $phone){
		echo '<form class="form" action="cmsSaveItem.php" id="account" method="post" enctype="multipart/form-data">';
		echo '<input type="hidden" name="prodID" value="' . $phone['_id'] . '" required>';
		
		echo '<label><b>Name: </b></label>';
		echo '<input type="text" name="name" value="' . $phone['name'] . '" required><br>';
		
		echo '<label><b>Price: </b></label>';
		echo '<input type="text" name="price" value="' . $phone['price'] . '" required><br>';
		
		echo '<label><b>Stock: </b></label>';
		echo '<input type="text" name="stock" value="' . $phone['stock'] . '" required><br>';
		
		echo '<label><b>Key: </b></label>';
		echo '<input type="text" name="key" value="' . $phone['key'] . '" required><br>';
		echo '<input type="submit" value="Submit">';
		echo '</form>';
	}

	//Close the connection
	$mongoClient->close();
?>
  

  
</article>

<footer>Copyright &copy; iStore</footer>

</div>



</body>
</html>
