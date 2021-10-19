<?php
include 'database.php';
$db=$_SESSION['database'];
$sql = "SELECT * FROM ".$db."_inventory";
$result = $mysqli->query($sql);
$inven = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
array_push($inven, array("id" => $row['id'], "itemname" => $row['item_name'], "itemrate" => $row['item_rate']));
    }
} 
echo json_encode($inven);
