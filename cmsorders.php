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

  <h1><b>Content Management System - Customer Orders</b></h1>
  
  <div id="orderlabels">
  	<div class="orderlabel">Order ID</div>
  	<div class="orderlabel">Order Date</div>
  	<div class="orderlabel">Customer Email</div>
  	<div class="orderlabel">Items</div>
  	<div class="orderlabel">Total</div>
  </div>
  
  <?php

        //Connect to MongoDB and select database
        $mongoClient = new MongoClient();
        $db = $mongoClient->phoneDB;
        
        //Find all products
        $Orders = $db->Orders->find();

        //Output results onto page
        if($Orders->count() > 0){
            
            
            foreach ($Orders as $document) {
                echo '<div id="order">';

				echo '<div class="orderdetail">' . $document["_id"] . '</div>';
				echo '<div class="orderdetail">' . $document["date"] . '</div>';
				
				echo '<div class="orderdetail">' . $document["custEmail"] . '</div>';
				echo '<div class="orderdetail">' . implode("<br>", $document["productNames"]) . '</div>';
				echo '<div class="orderdetail">£' . $document["totalPrice"] . '</div>';

				echo '</div>';

	
              
            }
            
        }

        //Close the connection
        $mongoClient->close();

        ?>
  
  
   
  
  	
</article>

<footer>Copyright &copy; iStore</footer>

</div>


</body>
</html>
