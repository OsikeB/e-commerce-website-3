<?php
//Connect to database
$mongoClient = new MongoClient();

//Select a database
$db = $mongoClient->phoneDB;

//Select a collection 
$collection = $db->Phones;

//Extract the data that was sent to the server
$name= filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);
$stock = filter_input(INPUT_POST, 'stock', FILTER_SANITIZE_STRING);
$key = filter_input(INPUT_POST, 'key', FILTER_SANITIZE_STRING);

//Extract the product IDs that were sent to the server
$prodID= $_POST['prodID'];



//Convert to PHP array
$dataArray = [
    "name" => $name, 
    "price" => $price, 
    "stock" => floatval($stock),
    "key" => $key
 ];

//save to the database
$findCriteria = new MongoID($prodID); 
$cursor = $db->Phones->findOne(array('_id', $findCriteria));
$newdata = array('$set'=>array("name" => $name, "price" => $price, "stock" => floatval($stock), "key" => $key));
$returnVal = $db->Phones->update(array('_id' => $findCriteria), $newdata);
 

//Echo result back to user
if($returnVal['ok']==1){
    header("Location: cmsedit.php");
	
	//Makes sure code doesnt run when redirected
	exit;
}
else {
    echo 'Error adding item';
}

//Close the connection
$mongoClient->close();