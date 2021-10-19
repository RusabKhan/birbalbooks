<?php
include_once 'database/Database.PHP';
date_default_timezone_set("Asia/Karachi");


if (isset($_GET['vkey'])&&isset($_GET['username'])&&isset($_GET['id']))
{
    $vkey = $_GET['vkey'];
    $username=$_GET['username'];
    $resultSet = $mysqli->query("select * from client_info_login where isverified = 0 and vkey='$vkey' limit 1");
    if ($resultSet->num_rows == 1)
    {
         $date = date('Y-m-d H:i:s');
         $row = $resultSet->fetch_assoc();
        if($date > strtotime($row['vkeyExpire'])){
            echo'Link Expired';
            $update = $mysqli->query("delete from client_info_login where vkey='$vkey'");
            die();
        }
        $update = $mysqli->query("update client_info_login set isverified=1 where vkey='$vkey' limit 1");
       
         $last_id = $_GET['id'];
            $db = new mysqli('127.0.0.1', "birbalbo_admin", "admin@birbalbooks", "birbalbo_ledger", 3306);
        $result = $db->query("create table `${username}${last_id}_ledger` like birbalbo_ledger.client_ledger;");
        $inven = $db->query("create table `${username}${last_id}_inventory` like birbalbo_ledger.inventory;");
        if ($update && $result && $inven)
        {
            echo "Verification Complete";
            // sleep(5);
            header("location:login.php");
        }
        else
        {
            echo "something went wrong";
        }
    }
    else
    {
        echo "Account already verified.";
    }
}
else
{
    die("Something went wrong.");
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifiy</title>
    <style>
    </style>
</head>

<body>
  
</body>

</html>