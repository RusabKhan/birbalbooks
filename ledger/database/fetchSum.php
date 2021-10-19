<?php
include 'database.php';

$sql = "select ((select sum(balance) from {$_SESSION['database']}_ledger where credit=1)-
(select sum(balance) from {$_SESSION['database']}_ledger where debit=1)) as balance,(SELECT SUM(itm_count)from {$_SESSION['database']}_ledger) AS total_count";
$result = $mysqli->query($sql);
$inven = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['balance'] > 0) {
            array_push($inven, array(
                "transID" => "", "date" => "", "itemname" => "sum", "detail" => "Sum of past record(s)", "itm_count" => $row['total_count'], "item_rate" => "", "balance" => $row['balance'], "credit" => "1"
            ));
        } else if ($row['balance'] < 0) {
            array_push($inven, array(
                "transID" => "", "date" => "", "itemname" => "sum", "detail" => "Sum of past record(s)", "itm_count" => $row['total_count'], "item_rate" => "", "balance" => $row['balance'], "debit" => "1"
            ));
        }
        else{break;}
    }

    echo json_encode($inven);
} else {
    echo trigger_error('Invalid query: ' . $mysqli->error);
}
