<?php
    //Start session management
    session_start();

    //Get name and address strings - need to filter input to reduce chances of SQL injection etc.
    $email= filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);    

    //Connect to MongoDB and select database
    $mongoClient = new MongoClient();
    $db = $mongoClient->phoneDB;

    //Create a PHP array with our search criteria
    $findCriteria = [
        "email" => $email, 
     ];

    //Find all of the customers that match  this criteria
    $cursor = $db->Users->find($findCriteria);

    //Check that there is exactly one user
    if($cursor->count() == 0){
        echo 'Email not recognized.';
        return;
    }
    else if($cursor->count() > 1){
        echo 'Database error: Multiple customers have same email address.';
        return;
    }
   
    //Get user
    $user = $cursor->getNext();
    
    //Check password
    if($user['password'] != $password){
        echo 'Password incorrect.';
        return;
    }
        
    //Start session for this user
    $_SESSION['loggedInUserEmail'] = $email;
    
    //Inform web page that login is successful
    header("Location: success.php"); 
    
    //Close the connection
    $mongoClient->close();
    