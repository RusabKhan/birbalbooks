<?php
include_once 'database/Database.PHP';

if (isset($_GET['vkey']) && isset($_GET['email']))
{
    $vkey = $_GET['vkey'];
    $email = $_GET['email'];
    $resultSet = $mysqli->query("select * from account_recovery where email ='$email' and vkey='$vkey' limit 1");
    if ($resultSet->num_rows < 1)
    {
        echo 'Something Went Wrong'.$vkey.';'.$email;
        die;
    }
}

if (isset($_POST['submit']))
{
    $pass = $_POST['password'];
    $pass2 = $_POST['password2'];
    $pass = md5($pass);
    $pass2 = md5($pass2);
    if ($pass == $pass2)
    {
        $update = $mysqli->query("update client_info_login set password='$pass' where email='$email'");

        if ($update)
        {
            $insert = $mysqli->query("update account_recovery set status=2 where email='$email' and vkey='$vkey'");
            if ($insert)
            {
                $color = '#3CB371';
                $display = 'block';
                $error = "Password Updated";
                sleep(3);
                header("Location:login.php");
            }
            else
            {
                $color = '#FF0000';
                $display = 'block';
                $error = "Error (Try again in a while)";

            }
        }
        else
        {
            $color = '#FF0000';
            $display = 'block';
            $error = "Error (Try again in a while)";

        }
    }
    else
    {
        $color = '#FF0000';
        $display = 'block';
        $error = "Passwords donot match";
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<link rel="shortcut icon" href="images/favicon.ico" type="image/png">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
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
             .form form .signInBtn {
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
            transition: all 300ms ease-in-out;
            margin-bottom:25px;
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
       
      
    </style>
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
                <h1 style="color:white;">Password Reset</h1>
            </div>
            <form method="POST" action="">
                 <label for="password">Enter Password</label>
                <input type="password" id="password" name="password" required placeholder="Enter New Password">
                <input type="password" id="password2" name="password2" required placeholder="Confirm New Password">
                <input type="submit" name="submit" class="signInBtn" value="Confirm"></input>
            </form>
           
        </div>
        <div class="alert">
			<?php echo (isset($error))?$error:'';?><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> </div>
    </div>
</body>

</html>