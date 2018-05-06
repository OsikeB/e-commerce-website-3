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

  <h1><b>Content Management System - Edit/Remove an Item</b></h1>
  
  <?php

        //Connect to MongoDB and select database
        $mongoClient = new MongoClient();
        $db = $mongoClient->phoneDB;
        
        //Find all products
        $phones = $db->Phones->find();

        //Output results onto page
        if($phones->count() > 0){
            
            
            foreach ($phones as $document) {
                echo '<div class="items">';
				echo '<div class="item">';
				echo '<div class="itemimage">';
				echo '<img src="images/' . $document["image"] . '"' .  'height="137px" width="270px;">';
				echo '</div>';
				echo '<div class="itemdesc">';
                echo $document["name"] . " - " . "£" . $document["price"] ;
				echo '</div>';
				echo '<div class="edit">';
				echo '<form class="cmsbutton" action="cmsitemedit.php"  method="post">';
				echo '<input name="prodID" type="text" style="display:none;"  value="' . $document["_id"] . '" required>';
				echo '<input type="submit" value="Edit">';
            	echo '</form>';
				echo '</div>';
				echo '</div>';
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
