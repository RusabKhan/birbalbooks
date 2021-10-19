<?php
include 'database.php';

$sql =file_get_contents("php://input");
$result = $mysqli->query($sql);
$inven = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
array_push($inven, array("item_name" => $row['item_name'],"loss" => $row['loss'],"profit" => $row['profit']));
 }
} 
echo json_encode($inven);
