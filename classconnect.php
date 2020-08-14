<?php
session_start();
ob_start();
$_SESSION['userID'] = 5;
$_SESSION['u_name'] = "Albert";
error_reporting(1);
//echo phpversion();
class con{
 public function connect()
 {
   return  $connect= new mysqli("localhost","root","","ndb");
 }
}
?>