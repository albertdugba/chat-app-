<?php
$welcomeMessage = "<h1>Welcome Message</h1>";
$isloggedIn = true;
$username = 'Brian';



function welcomeUser($username){
    echo 'Welcome User   '.$username.'';
}

if($isloggedIn){
    welcomeUser()
}else{
    echo "Please sign in;";
}