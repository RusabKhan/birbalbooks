<?php
include 'database.php';

$data = date("Y/m/d");
$sql = "SELECT * FROM {$_SESSION['database']}_ledger where logdate='${data}'";
$result = $mysqli->query($sql);
$inven = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
array_push($inven, array("transID" => $row['transaction_id'],"date" => $row['logDate'], "itemname" => $row['item_name'], "detail" => $row['detail']
, "itm_count" => $row['itm_count'], "item_rate" => $row['item_rate'], "debit" => $row['debit'], "credit" => $row['credit'], "balance" => $row['balance']));
 }
} else
{
    echo'empty';
}
echo json_encode($inven);
