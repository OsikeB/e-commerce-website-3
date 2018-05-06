<?php
//Connect to MongoDB
$mongoClient = new MongoClient();

//Select a database
$db = $mongoClient->phoneDB;

//Extract the data that was sent to the server
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

//Create a PHP array with our search criteria
$findCriteria = [
    "name" => $name, 
 ];

//Find all of the customers that match  this criteria
$cursor = $db->Phones->find($findCriteria);

//Output the results
echo "<h1>Results</h1>";
foreach ($cursor as $document){
	
	echo "<p>";
   echo "Recommending: " . $document['name'];
   echo "</p>";
   
	echo '<div class="items">';
				echo '<div class="item">';
				echo '<div class="itemimage">';
				echo '<img src="images/' . $document["image"] . '"' .  'height="137px" width="270px;">';
				echo '</div>';
				echo '<div class="itemdesc">';
				
                echo $document["name"] . " - " . "£" . $document["price"] ;
				echo '</div>';
				echo '<div class="addto">';
				echo '<a href="#" onclick=\'addToBasket("' . $document["_id"] . '", "' . $document["name"] . '", "' . $document["price"] . '");\'>ADD TO BASKET</a>';
				echo '</div>';
				echo '</div>';
				echo '</div>';	
}

//Close the connection
$mongoClient->close();


