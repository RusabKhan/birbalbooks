<?php
include_once 'database/Database.PHP';
require_once('PHPMailer/PHPMailerAutoload.php');


$mail = new PHPMailer();
$mail->IsSMTP();
$mail->CharSet="UTF-8";
$mail->SMTPSecure = 'ssl';
$mail->Host = "smtp.mail.birbalbooks.com"; 
$mail->Port = 465;
$mail->Username = 'recovery@birbalbooks.com';
$mail->Password = 'recovery@birbalbooks.com';
$mail->SMTPAuth = false;
$mail->IsHTML(true);  
$mail->SMTPKeepAlive = false;   
$mail->Mailer = “smtp”; // don't change the quotes!
$mail->SMTPDebug = 4;


if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    //generate vkey
        $vkey = md5(rand(999,999999).date('Y-m-d H:i:s'));

//check 
$check = $mysqli->query("select * from client_info_login where email='$email'and  isverified=1");
if($check->num_rows<1){
    echo'Unverified Account.';
    die;
}


 $check = $mysqli->query("select * from account_recovery where email='$email'and status=1");
 if($check->num_rows<1){
    
        //insert
        $insert = $mysqli->query("insert into account_recovery (email,vkey,status)values('$email','$vkey',1)");

        if ($insert) {
           
            $reciever = $email;
            $subject = "Password Recovery";
            $message = '<html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title></title>
        </head>
        <body>
          <div style="text-align:left;font-size:15px;font-family: "Poppins", sans-serif;padding:0 0 0 10px;display:block;height:80%;width:100%">
<h2>Password Reset Request</h2>
<a>This is an automated email with your confirm password reset request link. 
<a href="http://birbalbooks.com/confirmRecovery.php?vkey='.$vkey.'&email='.$email.'">Click Here</a> to Recover Account your account and start managing your record in the most modern way possible!<a/>
</div>
 </body>
        </html>';
            $headers .= "MIME-Version 1.0" . "\r\n";
            $headers .= "Content-type:text/html; charset=UTF-8" . "\r\n";
            
            $mail->setFrom('AccountRecovery@birbal.com');
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->AddAddress($email);
            $retval=$mail->Send();
            if($retval)
            {
              /*  $mail_string = $mail->getSentMIMEMessage();
  imap_append($ImapStream, $folder, $mail_string, "\\Seen");*/
                 $color = '#3CB371';
                 $display='block';
                 $error="Check Your Email For Instructions";
            }
            else{
                 $color = '#FF0000';
                 $display='block';
                 $error="Error (Try again email in a while)";
            }
            }
            else{
                 $color = '#FF0000';
                 $display='block';
                 $error="Error (Try again db in a while)";
            }
    }
    else{ 
                 $color = '#FF0000';
                 $display='block';
                 $error="Already in progress (Check your email)";
        
    }
    }
?>


<!DOCTYPE html>
<html lang="en">
 <link rel="shortcut icon" href="images/favicon.ico" type="image/png">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Recover your BirbalBooks account Password.">
    <title>Recover Password</title>
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
            padding: 15px 0;
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

        .form form .signUpBtn {
            padding: 10px 8px;
            border-radius: 50px;
            width: 100%;
            text-align: center;
            border: solid 1px #2f4f4f;
            background: #fff;
            transition: all 300ms ease-in-out;
        }

        .form form .signUpBtn:hover {
            color: white;
            background: #2f4f4f;
        }

        .error {
            display: none;
            color: red;
            margin-left: 20px;
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
	.wrapper{
        display: flex;
        height: 100vh;
        width: 100vw;
        align-items: center;
        vertical-align: middle;
        justify-content: center;
	}
	.closebtn:hover {
		color: white;
	}
    </style>
</head>
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
                <h1 style="color:white;background-color:#2f4f4f;">Recover Password</h1>
            </div>
            <form method="POST" action="">
                <label for="email">Enter your email</label>
                <input type="email" id="email" name="email" placeholder="Enter Your Email" required>
                <input type="submit" name="submit" class="signUpBtn" value="Recover"></input>
            </form>
              </div>
             </div>
            <div class="alert">
			<?php echo (isset($error))?$error:'';?><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> </div>
    </div>
</body>
</html>