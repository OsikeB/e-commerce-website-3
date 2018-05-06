<?php
    //Start session management
	session_name("CMS");
    session_start();

    //Remove all session variables
    session_unset(); 

    //Destroy the session 
    session_destroy(); 

    //Echo result to user
    echo 'ok';