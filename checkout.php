<?php

//Extract the product IDs that were sent to the server
$prodIDs= $_POST['prodIDs'];
$prodNames= $_POST['prodNames'];

//Convert JSON string to PHP array 
$productArray = json_decode($prodIDs, true);
$productNames = json_decode($prodNames, true);

//Output the IDs of the products that the customer has ordered
echo '<h1>Products Sent to Server</h1>';
for($i=0; $i<count($productArray); $i++){
    echo '<p>Product ID: ' . $productArray[$i]['id'] . '. Count: ' . $productArray[$i]['count'] . '</p>';
}

for($i=0; $i<count($productNames); $i++){
    echo '<p>Product Names: ' . $productNames[$i] . '</p>';
}

//Start session management
session_start();

if( array_key_exists("loggedInUserEmail", $_SESSION) ){
		
		storeOrder();
    }
    else{
        echo 'Please log in before placing an order';
    }

function storeOrder() {
$custEmail = $_SESSION['loggedInUserEmail'];
//Connect to database
$mongoClient = new MongoClient();

//Select a database
$db = $mongoClient->phoneDB;

//Extract the order details 
$prodNames= json_decode(filter_input(INPUT_POST, 'prodNames'));
$prodIDs= json_decode(filter_input(INPUT_POST, 'prodIDs'));
$totalPrice= filter_input(INPUT_POST, 'tPrice');


//Construct PHP array with data
$orderData = [
    "productNames" => $prodNames,
    "totalPrice" => $totalPrice,
	"custEmail" => $custEmail,
	"date" => date("d/m/Y"),
	"_id" => new MongoId($id)
];

//Save the order in the database
$returnVal = $db->Orders->save($orderData);

//Extract the product IDs that were sent to the server
$prodIDs= $_POST['prodIDs'];

//Convert JSON string to PHP array 
$productArray = json_decode($prodIDs, true);
	
//update stock
for($i=0; $i<count($productArray); $i++){
	
	$findCriteria = new MongoID($productArray[$i]['id']);
	
	//Find product
	$cursor = $db->Phones->findOne(array('_id', $findCriteria));
	
	$newdata = array('$inc'=>array("stock"=> -1));
	
	$db->Phones->update(array('_id' => $findCriteria), $newdata);		
	
	
	
}
	
	
//Echo result back to user
if($returnVal['ok']==1){
    header("Location: success.php");
	
}
else {
    echo 'Error placing order';
}

//Close the connection
$mongoClient->close();

	
}