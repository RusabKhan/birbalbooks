<?php
include 'database.php';

$sql =file_get_contents("php://input");
$result = $mysqli->query($sql);
$inven = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
array_push($inven, array("MONTH" => $row['Month'],"SUM" => $row['SUM']));
 }
} 
echo json_encode($inven);
