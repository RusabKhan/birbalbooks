<?php
include_once '../database/Database.PHP';
require_once('../PHPMailer/PHPMailerAutoload.php');

 session_start();
    if(!$_SESSION['loggedon']){
            echo "NOT LOG IN";
        die();
    }


$SessionEmail = $_SESSION["email"];
$database = $_SESSION['database'];
$SessionPassword = $_SESSION['password'];
$display = 'none';
if (isset($_POST['emailReq']))
{
    $email = $_POST['email'];
    $newEmail = $_POST['email2'];
    $pass2 = $_POST['passwordEmail'];
   if(md5($pass2)!=$SessionPassword){
     $result = 'Password Incorrect!';
        $color = '#FF0000';
        $display = 'block';
      
    }
    else{

    if ($email == $newEmail)
    {
        $result = 'This is your current email';
        $color = '#FF0000';
        $display = 'block';
    }
    else
    {
        $update = $mysqli->query("update client_info_login set email='$newEmail' where email='$email'");
        if ($update)
        {
            $result = 'Update Successfull';
            $color = '#3CB371';
            $display = 'block';
        }
        else
        {
            $result = 'Update Failed';
            $color = '#FF0000';
            $display = 'block';
        }
    }
    }

}

if (isset($_POST['pwdReq']))
{
    $pwdNew = $_POST['passwordNew'];
    $pwdNewConfirm = $_POST['passwordNewCnfrm'];
    $pwdStore = md5($pwdNewConfirm);
    $pass = $_POST['passwordPwd'];
  if($pass !=$pwdNew && $pass!=$pwdNewConfirm )
  {
      if($pwdNew==$pwdNewConfirm){
      if($pass=$SessionPassword){
        $update = $mysqli->query("update client_info_login set password='$pwdStore' where email='$SessionEmail'");
        if ($update)
        {
            $result = 'Update Successfull';
            $color = '#3CB371';
            $display = 'block';
            
        }
        else
        {
            $result = 'Update Failed';
            $color = '#FF0000';
            $display = 'block';
        }
      }
      else{
           $result = 'Incorrect Password';
            $color = '#FF0000';
            $display = 'block';
      }
      }
      else{
           $result = 'Password donot match';
            $color = '#FF0000';
            $display = 'block';
      }
    
}
    else
    {
        $result = 'This is your current password';
        $color = '#FF0000';
        $display = 'block';
    }

}

if (isset($_POST['delReqAcc']) && isset($_POST['confirmAcc']) && strtolower($_POST['textconfirmAcc'])=='yes')
{
    if(md5($_POST['passwordDel'])==$SessionPassword){
    $update = $mysqli->query("delete from client_info_login where email='$SessionEmail'");
    if ($update)
    {
        $result = 'Delete Successfull';
        $color = '#3CB371';
        $display = 'block';
        echo "<script>window.location.href='logout.php';</script>";
        exit;
    }
    else
    {
        $result = 'Delete Failed';
        $color = '#FF0000';
        $display = 'block';
    }
    }
    else{
        $result = 'Wrong Password';
        $color = '#FF0000';
        $display = 'block';
    }

}

if (isset($_POST['delReqAccLedger'])&& isset($_POST['confirmLedger']))
{
   if($_POST['passwordclrLedger']==$SessionPassword){
     $update = $mysqli->query("delete from $database._ledger");
     if($update)
     {
        $result = 'Delete Successfull';
        $color = '#3CB371';
        $display = 'block';
     }
     else
     {
        $result = 'Delete Failed';
        $color = '#FF0000';
        $display = 'block';
     }
   }
   else{
        $result = 'Wrong Password';
        $color = '#FF0000';
        $display = 'block';
   }
}

if (isset($_POST['delReqInven'])&& isset($_POST['confirmInven']))
{
    if($_POST['passwordclrinven']==$SessionPassword){
     $update = $mysqli->query("delete from $database._Inventory");
    
    if($update)
    {
       $result = 'Delete Successfull';
       $color = '#3CB371';
       $display = 'block';
    }
    else
    {
       $result = 'Delete Failed';
       $color = '#FF0000';
       $display = 'block';
    }
    }
     else{
        $result = 'Wrong Password';
        $color = '#FF0000';
        $display = 'block';
   }
}


if (isset($_POST['messageReq']))
{
    $message=$_POST['message'];
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->CharSet = "UTF-8";
    $mail->SMTPSecure = 'ssl';
    $mail->Host = "ssl://smtp.mail.birbalbooks.com";
    $mail->Port = 465;
    $mail->Username = 'user@birbalbooks.com';
    $mail->Password = 'user@birbalbooks.com';
    $mail->SMTPAuth = true;
    $mail->IsHTML(true);
    $mail->SMTPKeepAlive = true;
    $mail->Mailer = “smtp”; // don't change the quotes!
    $mail->SMTPDebug = 4;

    $reciever = 'contact@birbalbooks.com';
    $subject = "SUPPORT REQUEST";
    $headers = "From:$SessionEmail \r\n";
    $headers .= "MIME-Version 1.0" . "\r\n";
    $headers .= "Content-type:text/html; charset=UTF-8" . "\r\n";

    $mail->setFrom($SessionEmail);
    $mail->Subject = $_POST['subject'];
    $mail->Body = $message .'  (MESSAGE CONSTRUCTED FROM SETTINGS MENU OF BIRBAL BOOKS)';
    $mail->AddAddress('contact@birbalbooks.com');
    $retval = $mail->Send();
    if ($retval)
    {
        $result = 'Message Sent';
        $color = '#3CB371';
        $display = 'block';
    }
    else
    {
        $result = 'Message Not Sent';
        $color = '#FF0000';
        $display = 'block';
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
	@import url('https://fonts.googleapis.com/css?family=Poppins&display=swap');
	* {
		padding: 0;
		box-sizing: border-box;
		font-family: 'Poppins', sans-serif;
		background-color: #f8f8ff;
		background-position: center;
		background-repeat: no-repeat;
	}
	
	#form label {
		margin: 5px 0;
		display: block;
	}
	
	#form {
		/*padding: 5px 25px 5px 5px;*/
		vertical-align: middle;
		align-items: center;
		display: block;
		height: fit-content;
		width: fit-content;
		;
	}
	
	#form .heading h3 {
		background: transparent;
		font-size: 15px;
	}
	
	#form input[type=text],
	input[type=email],
	input[type=password] {
		outline: none;
		display: inline-block;
		padding: 8px 5px;
		border-radius: 50px;
		border: solid 1px #eee;
		transition: all 300ms ease-in-out;
	}
	
	#form input[type=checkbox] {
		outline: none;
		display: inline-block;
		border-radius: 50px;
		border: solid 1px #eee;
		margin-top: 10px;
		transition: all 300ms ease-in-out;
	}
	
	#form input:focus {
		border-color: #2f4f4f;
	}
	
	#form .confirm {
		padding: 5px 3px;
		border-radius: 4px;
		text-align: center;
		border: solid 1px #2f4f4f;
		transition: all 300ms ease-in-out;
		color: black;
		background: #D3D3D3;
	}
	
	#form #confirmBox {
		width: 20px;
		height: 20px;
		text-align: center;
		vertical-align: middle;
	}
	
	#form #read-confirm-box {
		border-radius: 3px;
		margin: auto;
		float: left;
	}
	
	#form #read-confirm-box label {
		float: left;
		margin: 3px;
	}
	
	#form .confirm:hover {
		background: #2f4f4f;
		color: white;
	}
	
	#form text-area {
		min-height: 50px;
		height: 20vh;
		width: 40vw;
		float: left;
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
	
	@media only screen and (max-device-width: 480px) {
		#main,
		#wrapper
		{
			display: flex;
			/* right: 20px; */
			width: 90vw;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			/* margin-right: 50px; */
			float: right;
		}
		* {
		    padding: 0 5px;
			box-sizing: border-box;
			font-family: 'Poppins', sans-serif;
			background-color: #f8f8ff;
			background-position: center;
			background-repeat: no-repeat;
			width: 100%;
		
		
 
/* right: 10vw; */
			/* left: 10vw; */
			/* float: right; */
			/* right: 20vw; */
			/* display: flex; */
		}
	}
	
	
	</style>
</head>

<body>
	<div id="main">
		<div id="wrapper">
			<div id="form">
				<div class="heading">
					<h3>Change Your Email</h3> </div>
				<form method="POST" action="">
					<input type="email" id="email" name="email" placeholder="Enter Your Email" required>
					<input type="email" id="email2" name="email2" placeholder="Enter Your New Email" required>
					<input type="password" id="passwordEmail" name="passwordEmail" required placeholder="Enter Password">
					<input type="submit" name="emailReq" class="confirm"></input>
				</form>
			</div>
			<div id="form">
				<div class="heading">
					<h3>Change Your Password</h3> </div>
				<form method="POST" action="">
					<input type="password" id="passwordNew" name="passwordNew" minlength="8" required placeholder="Enter New Password">
					<input type="password" id="passwordNewCnfrm" name="passwordNewCnfrm" minlength="8" required placeholder="Re-Enter New Password">
					<input type="password" id="passwordPwd" name="passwordPwd" required placeholder="Enter Current Password">
					<input type="submit" name="pwdReq" class="confirm"></input>
				</form>
			</div>
			<div id="form">
				<div class="heading">
					<h3>Delete Account</h3> </div>
				<form method="POST" action="">
					<input type="password" id="passwordDel" style="float: left;" name="passwordDel" required placeholder="Enter Password">
					<div id="read-confirm-box">
						<input type="checkbox" id="confirmBoxACC" name="confirmAcc" />
						<label for="checkbox">Confirm</label>
					</div>
					<input type="text" id="textconfirmAcc" style="float: left;" name="textconfirmAcc" required placeholder="Type yes to confirm">
					<input type="submit" name="delReqAcc" class="confirm"></input>
				</form>
			</div>
			<div id="form">
				<div class="heading">
					<h3>Clear Ledger</h3> </div>
				<form method="POST" action="">
					<input type="password" id="passwordclrLedger" style="float: left;" name="passwordclrLedger" required placeholder="Enter Password">
					<div id="read-confirm-box">
						<input type="checkbox" id="confirmBoxLedger" name="confirmLedger" />
						<label for="checkbox">Confirm</label>
					</div>
					<input type="submit" name="delReqLedger" class="confirm"></input>
				</form>
			</div>
			<div id="form">
				<div class="heading">
					<h3>Clear Inventory</h3> </div>
				<form method="POST" action="">
					<input type="password" id="passwordclrinven" style="float: left;" name="passwordclrinven" required placeholder="Enter Password">
					<div id="read-confirm-box">
						<input type="checkbox" id="confirmBoxInven" name="confirmInven" />
						<label for="checkbox">Confirm</label>
					</div>
					<input type="submit" name="delReqInven" class="confirm"></input>
				</form>
			</div>
			<div id="form">
				<div class="heading">
					<h3>Contact Support</h3> </div>
				<form method="POST" action="">
					<input type="text" id="subject" name="subject" required placeholder="Subject" style="all:unset; border:1px solid #4a4a4a; width:70%">
					</textarea>
					<textarea id="message" name="message" rows="4" cols="50" placeholder="Enter message"></textarea>
					<input type="submit" name="messageReq" class="confirm" ></input>
				</form>
			</div>
		</div>
	</div>
	<div class="alert">
		<?php echo (isset($result))?$result:'';?><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> </div>
</body>

</html>