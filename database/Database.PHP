<?php

define('DB_HOSTNAME', '127.0.0.1');
define('DB_DATABASE', 'birbalbo_client_info_basic');
define('DB_USERNAME', 'birbalbo_emp_client_info');
define('DB_PASSWORD', 'acc_client_info_basic');

$mysqli = new mysqli('127.0.0.1', "birbalbo_emp_client_info", "acc_client_info", "birbalbo_client_info_basic", 3306);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} 
else
{
}