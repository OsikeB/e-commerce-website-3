<?php
//Connect to database
$mongoClient = new MongoClient();

//Select a database
$db = $mongoClient->phoneDB;

//Select a collection 
$collection = $db->Users;

//Extract the data that was sent to the server
$name= filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$postcode = filter_input(INPUT_POST, 'postcode', FILTER_SANITIZE_STRING);
$contact = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING);

//Convert to PHP array
$dataArray = [
    "name" => $name, 
    "email" => $email, 
    "password" => $password,
	"postcode" => $postcode, 
    "contact" => $contact
 ];
 
//Add the new product to the database
$returnVal = $collection->insert($dataArray);

//Echo result back to user
if($returnVal['ok']==1){
    header("Location: success.php");
	
	//Makes sure code doesnt run when redirected
	exit;
}
else {
    echo 'Error adding user';
}

//Close the connection
$mongoClient->close();