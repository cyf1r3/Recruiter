<?php
    require_once 'process.php';
    session_unset();     // unset $_SESSION variable for the runtime 
    session_destroy();   // destroy session data in storage
    unset($_SESSION['username']);
    header('location:index.html');

?>