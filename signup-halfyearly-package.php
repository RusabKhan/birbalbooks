<?php

include_once 'database/database.php';
require_once('PHPMailer/phpmailerautoload.php');


$mail = new PHPMailer();
$mail->IsSMTP();
$mail->CharSet="UTF-8";
$mail->SMTPSecure = 'ssl';
$mail->Host = "ssl://smtp.gmail.com"; 
$mail->Port = 465;
$mail->Username = 'rusabkhan7@gmail.com';
$mail->Password = 'Thekhanrules';
$mail->SMTPAuth = true;
$mail->IsHTML(true);  


$error = null;

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $pass2 = $_POST['password2'];

    if ($pass != $pass2) {
        $error .= "<p>passwords donot match</p>";
    } else {
        //All tests passed.
        $email = $mysqli->real_escape_string($email);
        $pass = $mysqli->real_escape_string($pass);
        $pass2 = $mysqli->real_escape_string($pass2);
        $username = explode("@", $email);
        $date = date('Y-m-d');


        //generate vkey
        $vkey = md5(time() . $email);

        //insert
        $pass = md5($pass);
        $insert = $mysqli->query("insert into client_info_login (email,password,username,joindate,accType,isVerified,vkey)
    values('$email','$pass','$username[0]','$date',2,0,'$vkey')");

        if ($insert) {
            $reciever = $email;
            $subject = "Email Verification";
            $message = "<a href='http://localhost/birbal/birbalhomepage/verify.php?vkey=$vkey'>Register Account</a>";
            $headers = "From: signup@birbalbooks.com \r\n";
            $headers .= "MIME-Version 1.0" . "\r\n";
            $headers .= "Content-type:text/html; charset=UTF-8" . "\r\n";
            
            $mail->setFrom('BirbalSignup@birbal.com');
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->AddAddress($email);
            $retval=$mail->Send();
            if($retval)
            {
                header('location:thankyou.php');
            }
            else{
                echo "Mailer Error: " . $mail->ErrorInfo;
                echo !extension_loaded('openssl')?"Not Available":"Available";
            }
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NTXF2WS');</script>
<!-- End Google Tag Manager -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birbal Books | Purchase</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins&display=swap');

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
    </style>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/png">
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NTXF2WS"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <div class="main">
        <div class="logo"></div>
        <div class="form">
            <div class="heading">
                <h3>Sign Up</h3>
            </div>
            <form method="POST" action="">
                <label for="email">Enter your email</label>
                <input type="email" id="email" name="email" placeholder="Enter Your Email" required>
                <label for="password">Enter Password</label>
                <input type="password" id="password" name="password" required placeholder="Enter Password">
                <input type="password" id="password2" name="password2" required placeholder="Re-Enter Password">
                <input type="submit" name="submit" class="signUpBtn">Sign up</input>
            </form>
            <p class="error">Inavlid</p>
        </div>
    </div>
</body>

</html>