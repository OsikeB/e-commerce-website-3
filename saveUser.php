<?php
//Connect to database
$mongoClient = new MongoClient();

//Select a database
$db = $mongoClient->phoneDB;

//Extract the customer details 
$name= filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$postcode = filter_input(INPUT_POST, 'postcode', FILTER_SANITIZE_STRING);
$contact = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING);
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);

//Construct PHP array with data
$customerData = [
    "name" => $name,
    "password" => $password,
	"email" => $email,
	"postcode" => $postcode,
	"contact" => $contact,
    "_id" => new MongoId($id)
];

//Save the product in the database - it will overwrite the data for the product with this ID
$returnVal = $db->Users->save($customerData);
    
//Echo result back to user
if($returnVal['ok']==1){
    header("Location: success.php");
}
else {
    echo 'Error saving customer';
}

//Close the connection
$mongoClient->close();
