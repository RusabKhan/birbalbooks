<?php session_start();?>
<?php
include_once 'database/Database.PHP';


if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = md5($_POST['password']);
    $resultSet = $mysqli->query("select * from client_info_login where email='$email' and password='$pass'");
    
    $row = $resultSet->fetch_assoc();
    

    //$date = date('Y-m-d');
    //$jDate = date('Y-m-d', strtotime($row['joinDate'] . ' + 7 days'));


    if (loginVerification($row,$pass,$email)) {
          $_SESSION['loggedon'] = true;
          echo  $_SESSION['loggedon'];
        header('location: ledger/mainPage.php');
        exit;
       
    } else {
        echo 'errors with verify';
    }
} else {
    echo 'errors with login' . error_get_last();
}

function loginVerification($row,$pass,$email)
{
       //$date = date('Y-m-d');
       //$jDate = date('Y-m-d', strtotime($row['joinDate'] . ' + 7 days'));
       
    if ($row['isVerified'] == 1) {
       
       /* if ($row['email'] = $email && $row['PASSWORD'] == $pass) {
            if ($row['accType'] == 0 &&  $jDate < $date) {
                $_SESSION['role_id'] = $row['accType'];
                $_SESSION['name'] = $row['username'];
                return true;
            } else if ($row['accType'] == 1 && $jDate < $date) {
              
                $_SESSION['role_id'] = $row['accType'];
                $_SESSION['name'] = $row['username'];
                return true;
            } elseif ($row['accType'] == 2 && $jDate < $date) {
                $_SESSION['role_id'] = $row['accType'];
                $_SESSION['name'] = $row['username'];
                return true;
            }
        }*/
        
        return true;
    }
    return false;
}
?>
