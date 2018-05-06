<?php
    //Start session management
    session_name("CMS");
    session_start();
    
    if( array_key_exists("username", $_SESSION) ){
        echo "ok";
    }
    else{
        echo 'Not logged in.';
    }
