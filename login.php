<?php session_start();?>
<?php
include_once 'database/Database.PHP';
date_default_timezone_set("Asia/Karachi");

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = md5($_POST['password']);
    $resultSet = $mysqli->query("select * from client_info_login where email='$email' and password='$pass'");
     $row = $resultSet->fetch_assoc();
    if($resultSet->num_rows < 1){
                 $color = '#FF0000';
                 $display='block';
                 $error="Incorrect Credentials";
    }
    else if($row['isVerified'] == 0){
                 $color = '#FF0000';
                 $display='block';
                 $error='Account Not Verfied (Check Your Email Inbox And Spam For Verification Email)';
    }
    else{
        header('location: ledger/mainPage.php');
        $_SESSION['loggedon'] = true;
        $_SESSION['database'] = $row['username'].$row['id'];
        $_SESSION['password'] = $pass;
        $_SESSION['email'] = $email;
   
    //$date = date('Y-m-d');
    //$jDate = date('Y-m-d', strtotime($row['joinDate'] . ' + 7 days'));

/*
    if (loginVerification($row)) {
          $_SESSION['loggedon'] = true;
         $_SESSION['database'] = $row['username'].$row['id'];
          $_SESSION['password'] = $pass;
           $_SESSION['email'] = $email;
           
       header('location: ledger/mainPage.php');
       exit;
       
    } else {
                 $color = '#FF0000';
                 $display='block';
                $error='Subscription Expired';
    }*/
    }
}
    

function loginVerification($row)
{
       $date = date('Y-m-d');
       $TDate = date('Y-m-d', strtotime($row['subscriptionDate'] . ' + 7 days'));
       $MDate = date('Y-m-d', strtotime($row['subscriptionDate'] . ' + 30 days'));
       $YDate = date('Y-m-d', strtotime($row['subscriptionDate'] . ' + 180 days'));
       
   // if ($row['isVerified'] == 1) {
       
            if ($row['accType'] == 0 && $date < $TDate) {
                return true;
            } else if ($row['accType'] == 1 && $date < $MDate) {
              
                return true;
            } elseif ($row['accType'] == 2 && $date < $YDate) {
               
                return true;
            }
            else{
                 return false;
            }
   // }
    /*else{ 
                 $err='Account Not Verfied';
                 return false;
    }*/
}
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login to your BirbalBooks Account.">
    <title>Birbal Books | Sign In</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins&display=swap');

 @media only screen and (max-width: 600px) {
     body{
        width: 100%;
            height: 100%;
     }
     body .main  {
            width: 100%;
            height: 100%;
           
            }
             body .main .form {
            width: 100%;
            height: 100%;
           min-height:100%;
            }
            body .main .logo {
           display:none;
            }

            .form form .signUpBtn {
            padding: 10px 8px;
            border-radius: 50px;
            width: 100%;
            height:70px;
            text-align: center;
            border: solid 1px #2f4f4f;
            background: #fff;
            transition: all 300ms ease-in-out;
        }
           
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            background: #fafafa;
            font-family: 'Poppins', sans-serif;
        }

        body {
            width: 100vw;
            height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .main {
            width: 50%;
            height: 700px;
            max-height: 70%;
            display: flex;
            background: #fff;
            overflow: hidden;
            border-radius: 5px;
            box-shadow: 0px 0px 25px -10px #ccc;
        }

        .logo {
            background-image: url('images/logo-birbal.png');
            background-size: 50%;
            background-color: #eee;
            background-position: center;
            background-repeat: no-repeat;
            border-right: solid 1px #eee;
            width: 50%;
        }

        .form {
            width: 50%;
        }

        .form .heading {
            /*padding: 15px 0;*/
            text-align: center;
            background: #2f4f4f;
            color: #fff;
            margin-bottom: 50px;
        }

        .form .heading h3 {
            background: transparent;
        }

        .form form {
            padding: 20px;
        }

        .form form label {
            margin: 5px 0;
            display: block;
        }

        .form form input {
            outline: none;
            display: block;
            padding: 10px 8px;
            width: 100%;
            border-radius: 50px;
            border: solid 1px #eee;
            margin-bottom: 25px;
            transition: all 300ms ease-in-out;
        }

        .form form input:focus {
            border-color: #2f4f4f;
        }

        .form form .signInBtn {
            padding: 10px 8px;
            border-radius: 50px;
            width: 100%;
            text-align: center;
            border: solid 1px #2f4f4f;
            background: #fff;
            transition: all 300ms ease-in-out;
        }

        .form form .signInBtn:hover {
            color: white;
            background: #2f4f4f;
        }

        .error {
            display: none;
            color: red;
            margin-left: 20px;
        }
         .link{
            height:10px;
            font-size:12px;
            float:right;
           margin-bottom: 30px;
            
        }
        .alert {
		position: absolute;
		bottom: 0;
		width: 100%;
		background-color: <?=$color?>;
		color: white;
		transition: 0.5s;
		text-align: center;
		visibility: <?=$display?>;
        transition: visibility 0s, opacity 0.5s linear;
        margin-bottom:auto;
	}
	
	.closebtn {
		margin-left: 15px;
		color: black;
		font-weight: bold;
		float: right;
		font-size: 22px;
		line-height: 20px;
		cursor: pointer;
		transition: 0.3s;
		background: transparent;
	}
	
	.closebtn:hover {
		color: white;
	}
	.wrapper{
        display: flex;
        height: 100vh;
        width: 100vw;
        align-items: center;
        vertical-align: middle;
        justify-content: center;
	}
    </style>
</head>
 <link rel="shortcut icon" href="images/favicon.ico" type="image/png">
<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NTXF2WS"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <div class="wrapper">
    <div class="main">
        <div class="logo"></div>
        <div class="form">
            <div class="heading">
                <h1 style="color:white;background-color:#2f4f4f;">Sign In</h1>
            </div>
            <form action="" method="POST">
                <label for="email">Enter your email</label>
                <input type="email" id="email" name="email" placeholder="Enter Your Email" required>
                <label for="password">Enter Password</label>
                <input type="password" id="password" name="password" required placeholder="Enter Password">
                 <a class ="link" href="recoveraccount.php">Forgot Password?</a>
                <button type="submit" name="login" class="signInBtn">Sign In</button>
            </form>
            <p class="error">Inavlid</p>
        </div>
    </div>
    	<div class="alert">
			<?php echo (isset($error))?$error:'';?><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> </div>
			</div>
</body>

</html>