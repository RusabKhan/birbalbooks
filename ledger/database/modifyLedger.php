<?php
include 'database.php';

$requestPayload = file_get_contents("php://input");
$lastid = null;
echo $query;
if ($mysqli->query($requestPayload) === TRUE) {
    $lastid = mysqli_insert_id($mysqli);
    echo "update successfull :" . $lastid;
} else {
    echo "Error  " . $mysqli->error;
}
//echo $data;
