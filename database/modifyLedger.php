<?php
include_once 'database.php';

$requestPayload = file_get_contents("php://input");
$query = $requestPayload;
$lastid = null;

if ($mysqli->query($query) === TRUE) {
    $lastid = mysqli_insert_id($mysqli);
    echo "Insert successfull :" . $lastid;
} else {
    echo "Error  " . $mysqli->error;
}
//echo $data;
