<?php
    //Start session management
	session_name("CMS");
    session_start();

    //Get name and address strings - need to filter input to reduce chances of SQL injection etc.
    $username= filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);    

    //Connect to MongoDB and select database
    $mongoClient = new MongoClient();
    $db = $mongoClient->phoneDB;

    //Create a PHP array with our search criteria
    $findCriteria = [
        "Username" => $username, 
     ];

    //Find all of the customers that match  this criteria
    $cursor = $db->CMSUser->find($findCriteria);

    //Check that there is exactly one user	
    if($cursor->count() == 0){
        echo "Username not recognized. $username";
        return;
    }
    else if($cursor->count() > 1){
        echo 'Database error: Multiple customers have same email address.';
        return;	
    }
   
    //Get user
    $user = $cursor->getNext();
    
    //Check password
    if($user['Password'] != $password){
        echo 'Password incorrect.';
        return;
    }
        
    //Start session for this user
    $_SESSION['username'] = $username;
    
    //open page
    header("Location: cmsedit.php"); 
    
    //Close the connection
    $mongoClient->close();
    