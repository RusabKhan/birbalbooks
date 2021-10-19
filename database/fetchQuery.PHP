<?php
include 'database.php';
$sql =file_get_contents("php://input");
$result = $mysqli->query($sql);
$isExist = false;

if ($result->num_rows > 0) {
   $isExist=true;
}

echo ($isExist);
