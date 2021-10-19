<?php
session_start();
$mysqli = new mysqli('127.0.0.1', "birbalbo_emp_client_info", "acc_client_info", "birbalbo_ledger", 3306);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} 
else
{
    
}