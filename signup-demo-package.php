<?php

include_once 'database/Database.PHP';
require_once('PHPMailer/PHPMailerAutoload.php');
date_default_timezone_set("Asia/Karachi");

$display='none';

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->CharSet="UTF-8";
$mail->SMTPSecure = 'ssl';
$mail->Host = gethostbyname("smtp.mail.birbalbooks.com"); 
$mail->Port = 465;
$mail->Username = 'accounts@birbalbooks.com';
$mail->Password = 'accounts@birbal.com';
$mail->SMTPAuth = FALSE;
$mail->IsHTML(true);  
$mail->SMTPKeepAlive = FALSE;   
$mail->Mailer = “smtp”; // don't change the quotes!
$mail->SMTPDebug = 4;

$error = null;

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $pass2 = $_POST['password2'];

    if ($pass != $pass2) {
        $display='block';
        $error .= "<p>passwords donot match</p>";
    } else {
        //All tests passed.
        $email = $mysqli->real_escape_string($email);
        $pass = $mysqli->real_escape_string($pass);
        $pass2 = $mysqli->real_escape_string($pass2);
        $username = explode("@", $email);
        $date = date('Y-m-d');
        $exp_time = date("Y-m-d H:i:s", strtotime('+6 hours'));
        //generate vkey
        $vkey = md5(time() . $email);

        //insert
        $pass = md5($pass);
        $insert = $mysqli->query("insert into client_info_login (email,password,username,joindate,accType,isVerified,vkey,vkeyExpire,subscriptionDate)
    values('$email','$pass','$username[0]','$date',0,0,'$vkey','$exp_time','$date')");

        if ($insert) {
            $last_id = $mysqli->insert_id;
            $db = new mysqli('127.0.0.1', "birbalbo_admin", "admin@birbalbooks", "birbalbo_ledger", 3306);
            if ($db->connect_errno) {
                 $color = '#FF0000';
                 $display='block';
                 $error="Connection Error";
                        } 
                
            
            $reciever = $email;
            $subject = "Email Verification";
         $message='<html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title></title>
        </head>
        <body>
          <div style="text-align:left;font-size:15px;font-family: "Poppins", sans-serif;padding:0 0 0 10px;display:block;height:80%;width:100%">
<h2>Thank You For Choosing Our Services!</h2>
<a>This is an automated email with your confirm registration link,
this link will expire in 6 hours. Here is our <a href="https://birbalbooks.com/tutorial.html">Video Tutorial</a> on how to use our ledger.
<a href="http://birbalbooks.com/verify.php?vkey='.$vkey.'&username='.$username[0].'&id='.$last_id.'">Click Here</a> to verify your account and start managing your record in the most modern way possible!<a/>
</div>
 </body>
        </html>';
            $headers = "From: signup@birbalbooks.com \r\n";
            $headers .= "MIME-Version 1.0" . "\r\n";
            $headers .= "Content-type:text/html; charset=UTF-8" . "\r\n";
            
            $mail->setFrom('Signup@BirbalBooks.com');
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->AddAddress($email);
            $retval=$mail->Send();
            if($retval)
            {
               // $mail->copyToFolder("Sent");
                //  save_mail($mail);
                //$mail_string = $mail->getSentMIMEMessage();
                 //imap_append($ImapStream, $folder, $mail_string, "\\Seen");
               // $mail->copyToFolder("Sent"); 
               
                 $color = '#3CB371';
                 $display='block';
                 $error="Verification Email Sent (MAY TAKE UPTO 5 MINUTES)";
            }
            else{
                 $color = '#FF0000';
                 $display='block';
                 $error="Error (Try again in a while)";
            }
            }
            else{
                 $color = '#FF0000';
                 $display='block';
                 $error="Email Already In Use";
            }
        }
        
    }
    
    
    
     
    function save_mail()
{
    
    //The first line connects to your inbox over port 143
$mbox = imap_open("{imap.s19.hosterpk.com:993/imap/novalidate-cert}", "accounts@birbalbooks.com", "accounts@birbal.com")or die("can't connect: " . imap_last_error());
//imap_append() appends a string to a mailbox. In this example your SENT folder.
// Notice the 'r' format for the date function, which formats the date correctly for messaging.
imap_append($mbox, "{imap.s19.hosterpk.com:993/imap/novalidate-cert}INBOX.Sent",
   $mail->getSentMIMEMessage()
    );

// close mail connection.
imap_close($mbox);

/*
    
//The first line connects to your inbox over port 143
$mbox = imap_open("{23.111.187.131/imap/ssl:993}", "accounts@birbalbooks.com", "accounts@birbal.com")or die("can't connect: " . imap_last_error());
//imap_append() appends a string to a mailbox. In this example your SENT folder.
// Notice the 'r' format for the date function, which formats the date correctly for messaging.
imap_append($mbox, "{23.111.187.131/imap/ssl:993}INBOX.Sent",
    "From: me@example.com\r\n".
    "To: ".$to."\r\n".
    "Subject: ".$subject."\r\n".
    "Date: ".date("r", strtotime("now"))."\r\n".
    "\r\n".
    $body.
    "\r\n"
    );

// close mail connection.
imap_close($mbox);*/
    /*
    //You can change 'Sent Mail' to any other folder or tag
    echo imap_open("{s19.hosterpk.com:143}INBOX", $mail->Username, $mail->Password)or die("can't connect: " . imap_last_error().'u'.$mail->Username.'message'.$mail->getSentMIMEMessage());

    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
   // $imapStream = imap_open($path,'' , '')or die("can't connect: " . imap_last_error());
    $result = imap_append($mbox, "{s19.hosterpk.com:993}INBOX.Sent", $mail->getSentMIMEMessage());
    imap_close($imapStream);
    return $result;*/
}
?>


<!DOCTYPE html>
<html lang="en">
	<!--Favicon-->
 <link rel="shortcut icon" href="images/favicon.ico" type="image/png">
</head>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Start your free 7 days trial with BirbalBooks.">
    <title>Sign Up For Birbal Books</title>
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
            height:30px;
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
            margin-bottom: 10px;
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
	.link{
            height:10px;
            font-size:12px;
            float:right;
           margin-bottom: 30px;
            
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
                <h1 style="color:white;background-color:#2f4f4f;">Sign Up</h1>
            </div>
            <form method="POST" action="">
                <label for="email">Enter your email</label>
                <input type="email" id="email" name="email" placeholder="Enter Your Email" required>
                <label for="password">Enter Password</label>
                <input type="password" id="password" name="password" minlength="8" required placeholder="Enter Password">
                <input type="password" id="password2" name="password2" minlength="8" required placeholder="Re-Enter Password">
                <a class ="link" href="login.php">Already a member?</a>
                <input type="submit" name="submit" class="signUpBtn"></input>
            </form>
            
        </div>
        </div>
        	<div class="alert">
			<?php echo (isset($error))?$error:'';?><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> </div>
    </div>
</body>

</html>