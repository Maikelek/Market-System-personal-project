<?php

$host = "provide"; 
$user = "your"; 
$password = "informations"; 
$db = "here"; 

$conn = mysqli_connect($host, $user, $password, $db);

if($conn ->connect_error) {
   die("Connection error, try again!");
}

?> 