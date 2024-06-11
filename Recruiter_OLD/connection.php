<?php

//Creating variables
$host = "localhost";
$username = "root";
$password = "";

//starting a session
session_start();

//Creating connection
$con = new mysqli($host, $username, $password);

//selecting the database i.e. recruitcrm in this case
mysqli_select_db($con, 'recruitcrm');

//If the connection fails, it outputs the error
if(mysqli_connect_errno()) {  
    die("Failed to connect with MySQL: ". mysqli_connect_error());  
}

?>