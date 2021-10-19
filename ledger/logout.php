<?php
    session_start();
    unset($_SESSION['loggedon']);
     session_destroy();
    header('location: http://www.birbalbooks.com/login.php');
?>