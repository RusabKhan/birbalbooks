<?php

require_once('PHPMailer/PHPMailerAutoload.php');
date_default_timezone_set("Asia/Karachi");
include_once 'database/Database.PHP';

$display = 'none';
if (isset($_POST['send']))
{
    
    $email=$_POST['email'];
	$TID=$_POST['TID'];
	$pNum=$_POST['pnumber'];
	$amount=$_POST['amount'];
	$date=$_POST['date'];
    $payment=$_POST['paymentMethod'];
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->CharSet = "UTF-8";
    $mail->SMTPSecure = 'ssl';
    $mail->Host = "ssl://smtp.mail.birbalbooks.com";
    $mail->Port = 465;
    $mail->Username = 'billings@birbalbooks.com';
    $mail->Password = 'billings@birbalbooks.com';
    $mail->SMTPAuth = true;
    $mail->IsHTML(true);
    $mail->SMTPKeepAlive = true;
    $mail->Mailer = “smtp”; // don't change the quotes!
    $mail->SMTPDebug = 4;

    $reciever = 'billings@birbalbooks.com';
    $subject = "SUPPORT REQUEST";
    $headers = "From:$email \r\n";
    $headers .= "MIME-Version 1.0" . "\r\n";
    $headers .= "Content-type:text/html; charset=UTF-8" . "\r\n";

	$message  = '<h5>Transaction Details Below</h5>';
	$message .= '<br>Transaction Email: </br>'.$email;
	$message .= '<br>Transaction ID: </br>'.$TID;
	$message .= '<br>Transaction Number: </br>'.$pNum;
	$message .= '<br>Transaction Date: </br>'.$date;
	$message .= '<br>Transaction amount: </br>'.$amount;
	$message .= '<br>Transaction Through: </br>'.$payment;

    $mail->setFrom($email);
    $mail->Subject = 'CONFIRM PURCHASE';
    $mail->Body = $message;
    $mail->AddAddress('billings@birbalbooks.com');
    $retval = $mail->Send();
    if ($retval)
    {
        
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

        $pass=rand ( 10000000 , 99999999 );
        $username = explode("@", $email);
        $date = date('Y-m-d');
        $exp_time = date("Y-m-d H:i:s", strtotime('+6 hours'));
        //generate vkey
        $vkey = md5(time() . $email);

        //insert
        $pass2=$pass;
        $pass = md5($pass);
        $insert = $mysqli->query("insert into client_info_login (email,password,username,joindate,accType,isVerified,vkey,vkeyExpire,subscriptionDate)
    values('$email','$pass','$username[0]','$date',0,0,'$vkey','$exp_time','$date')");

        if ($insert) {
            $last_id = $mysqli->insert_id;
            $db = new mysqli('127.0.0.1', "birbalbo_admin", "admin@birbalbooks", "birbalbo_ledger", 3306);
            if ($db->connect_errno) {
                 $color = '#FF0000';
                 $display='block';
                 $result="Connection Error";
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
<h2>Thank You For Choosing Our Services</h2>
<a>This is an automated email with your confirm registration link,
this link will expire in 6 hours. You have been granted privelages of demo account once we verify your data you will be automatically upgraded to premium. The demo account is free to use for 7 days.
<a href="http://birbalbooks.com/verify.php?vkey='.$vkey.'&username='.$username[0].'&id='.$last_id.'">Click Here</a> to verify your account and start managing your record in the most modern way possible!<a/>
<a style="color:red;">YOUR PASSWORD IS:'.$pass2.'<a/>
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
                 $result="Check Your Email For Instructions(MAY TAKE UPTO 5 MINUTES)";
            }
            else{
                 $color = '#FF0000';
                 $display='block';
                 $result="Error (Try again in a while)";
            }
            }
            else{
                 $color = '#FF0000';
                 $display='block';
                 $result="Kindly Use Your Demo Account Until We Verify Your Data.";
            }
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
<html lang="zxx">

<head>

<!-- Global site tag (gtag.js) - Google Ads: 611685687 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-611685687"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-611685687');
</script>

	<meta charset="utf-8">
	<title>Subscribe to BirbalBooks</title>

	<!-- mobile responsive meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="Purchase subscription to BirbalBooks Automated Online Ledger Today!.">
	<!-- ** Plugins Needed for the Project ** -->
	<!-- Bootstrap -->
	<link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
	<!-- FontAwesome -->
	<link rel="stylesheet" href="plugins/fontawesome/font-awesome.min.css">
	<!-- Animation -->
	<link rel="stylesheet" href="plugins/animate.css">
	<!-- Prettyphoto -->
	<link rel="stylesheet" href="plugins/prettyPhoto.css">
	<!-- Owl Carousel -->
	<link rel="stylesheet" href="plugins/owl/owl.carousel.css">
	<link rel="stylesheet" href="plugins/owl/owl.theme.css">
	<!-- Flexslider -->
	<link rel="stylesheet" href="plugins/flex-slider/flexslider.css">
	<!-- Flexslider -->
	<link rel="stylesheet" href="plugins/cd-hero/cd-hero.css">
	<!-- Style Swicther -->
	<link id="style-switch" href="css/presets/preset3.css" media="screen" rel="stylesheet" type="text/css">

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
	<!--[if lt IE 9]>
      <script src="plugins/html5shiv.js"></script>
      <script src="plugins/respond.min.js"></script>
    <![endif]-->

	<!-- Main Stylesheet -->
	<link href="css/style.css" rel="stylesheet">

	<!--Favicon-->
  <link rel="shortcut icon" href="images/favicon.ico" type="image/png">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/favicon/favicon-144x144.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/favicon/favicon-72x72.png">
	<link rel="apple-touch-icon-precomposed" href="img/favicon/favicon-54x54.png">
	<style>
		.contant_ul li {
			margin-top: 25px;
		}

		.contant_ul .sub_li {
			margin: 0;
			padding-left: 15px;
		}

		.contact form input,
		.contact form textarea {
			margin-bottom: 15px !important;
		}

		.contact .btn {
			background: #2f4f4f;
			color: #fff;
		}
		
		.alert {
		position: absolute;
		/*bottom: 0;*/
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
	</style>
</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NTXF2WS"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

	<div class="body-inner">

			<!-- Header start -->

		<header id="header" class="fixed-top header" role="banner">
			<a class="navbar-brand navbar-bg" href="index.html"><img class="img-fluid float-right" src="images/logo-birbal.png"
					alt="birbalbooks logo"></a>
			<div class="container">
				<nav class="navbar navbar-expand-lg navbar-dark">
					<button class="navbar-toggler ml-auto border-0 rounded-0 text-white" type="button"
						data-toggle="collapse" data-target="#navigation" aria-controls="navigation"
						aria-expanded="false" aria-label="Toggle navigation">
						<span class="fa fa-bars"></span>
					</button>

					<div class="collapse navbar-collapse text-center" id="navigation">
						<ul class="navbar-nav ml-auto">
							<li class="nav-item">
								<a class="nav-link" href="index.html">Home</a>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
									aria-haspopup="true" aria-expanded="false">
									Company
								</a>
								<div class="dropdown-menu">
									<a class="dropdown-item" href="about.html">About Us</a>
									<a class="dropdown-item" href="faq.html">Faq</a>
								
								</div>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
									aria-haspopup="true" aria-expanded="false">
									Services
								</a>
								<div class="dropdown-menu">
									<a class="dropdown-item" href="accounting-software.html">Accounting Software</a>
									<a class="dropdown-item" href="bookkeeping-services.html">Bookkeeping Services</a>
									
								</div>
							</li>
								<li class="nav-item">
							<a class="nav-link" href="pricing.html">Purchase</a>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
									aria-haspopup="true" aria-expanded="false">
									How to use
								</a>
							<div class="dropdown-menu">
									<a class="dropdown-item" href="tutorial.html">Video Tutorial</a>
									<a class="dropdown-item" href="formulla.html">Formulla</a>
								<!--  <a class="dropdown-item" href="inventory.html">Instructions</a>-->
								</div>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="blog/BirbalsBlog.html">Blog</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="contact.php">Contact</a>
							</li>
							<li class="nav-item login">
								<a href="login.php" class="nav-link">Login</a>
							</li>
							<li class="nav-item join">
								<a href="signup-demo-package.php" class="nav-link">Try For Free</a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<!--/ Header end -->

		<div id="banner-area">
			<img src="images/banner/banner1.jpg" alt="birbalbooks banner" />
			<div class="parallax-overlay"></div>
			<!-- Subpage title start -->
			<div class="banner-title-content">
				<div class="text-center">
					<h1 style="color:white;">Purchase</h1>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb justify-content-center">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item text-white" aria-current="page">Purchase</li>
						</ol>
					</nav>
				</div>
			</div><!-- Subpage title end -->
		</div><!-- Banner area end -->


		<!-- Contact section -->
		<section class="contact container">
			<div class="row">
				<div class="col-md-12 heading">
					<span class="title-icon float-left"><i class="fa fa-envelope"></i></span>
					<h2 class="title">Subscription form</h2>
				</div>
			</div>

			<div class="row">

				<div class="col-md-6">
						<form method="POST" action="" role="form">
						<div class="input-group">
							<input type="email" class="form-control" placeholder="Enter Email" name="email" required="">
						</div>
						<div class="input-group">
							<input type="number" class="form-control" placeholder="Enter Transaction ID" name="TID" required="">
						</div>
						<div class="input-group">
							<input type="number" class="form-control" placeholder="Enter Transaction Phone Number" name="pnumber" required="">
						</div>
						<div class="input-group">
							<input type="number" class="form-control" placeholder="Enter Transaction Amount" name="amount" required="">
						</div>
						<div class="input-group">
							<input type="date" class="form-control" placeholder="Enter Transaction Date" name="date" required="">
						</div>
						<div class="input-group mb-3">
                          <div class="input-group-prepend">
                           <label class="input-group-text" for="inputGroupSelect01">Payment Through</label>
                           </div>
                        <select class="custom-select" id="inputGroupSelect01" name="paymentMethod" required="">
                           <option selected value="1">EasyPaisa</option>
                           <option value="2">MobiCash</option>
                        </select>
                    </div>
						<button type="submit" name="send" class="btn">Send</button>
					</form>
				</div>
				<div class="col-md-6">
					<ul class="unstyled contant_ul">
						<h5>HOW TO PURCHASE</h5>
					<li class="sub_li">1. EasyPaisa Or MobiCash the amount to this number +923313340390</li>
					<li class="sub_li">2. Fill out the form</li>
					<li class="sub_li">3. Wait while we verify your provided data.(AT MOST 6 HOURS)</li>
					<div style="height:50px;"></div>
					<h5>FOR QUERIES REGARDING PURCHASE</h5>
						<b><i class="fa fa-envelope-o"> </i> Email:</b>
						<li class="sub_li">billings@birbalbooks.com</li>
					</ul>
				</div>
			</div>
		</section>


<!-- Footer start -->
<footer id="footer" class="footer">
	<div class="container">
	  <div class="row">
		<div class="col-sm-6 footer-widget">
		  <h3 class="widget-title">Recent Posts</h3>
		  <div class="col-sm-6 footer-widget">
					<div class="latest-post-items media">
						<div class="latest-post-content media-body">
							<h4><a href="blog/modern-day-bookkeeping.html">BOOKKEEPING AND LEDGER</a></h4>
							<p class="post-meta">
								<span class="author">Posted by BirbalBooks</span>
							</p>
						</div>
					</div><!-- 2nd Latest Post end -->
		  <div class="latest-post-items media">
			<div class="latest-post-content media-body">
			  <h4><a href="blog/How-Pakistani-businesses-survived-during-coronavirus-lockdown.html">How Pakistani Businesses
				Survivied Through Lockdown</a></h4>
			  <p class="post-meta">
				<span class="author">Posted by BirbalBooks</span>
			  </p>
			</div>
		  </div><!-- 1st Latest Post end -->

		</div>
		</div>
		<!--/ End Recent Posts-->


		

		<div class="col-sm-6 footer-widget footer-about-us">
		  <h3 class="widget-title">About BirbalBooks</h3>
		  <p>We are a young Pakistani company that help users keep track of their records using our state of the art automated ledger.</p>
		  <div class="row">
			<div class="col-md-6">
			  <h4>Email:</h4>
			  <p>contact@birbalbooks.com</p>
			</div>
			<div class="col-md-6">
			  <h4>Phone No.</h4>
			  <p>+(92) 3313340390 (WHATSAPP ONLY)</p>
			</div>
		  </div>
		</div>
		<!--/ end about us -->

	  </div><!-- Row end -->
	</div><!-- Container end -->
  </footer><!-- Footer end -->

	<!-- Copyright start -->
	<section id="copyright" class="copyright angle">
		<div class="container">
		  <div class="row">
			<div class="col-md-12 text-center">
			  <ul class="footer-social unstyled">
				<li>
				  <a title="Facebook" href="https://www.facebook.com/Birbalbooks/"target="_blank">
					<span class="icon-pentagon wow bounceIn"><i class="fa fa-facebook"></i></span>
				  </a>
				  <a title="Google+" href="https://www.google.com/search?rlz=1C1RLNS_enPK745PK745&biw=1366&bih=657&sxsrf=ALeKk02g6pahgzkFVuL_D9cluPsaSzLnUw%3A1598545235933&ei=U91HX8vPOIHBlwTk0re4CA&q=birbalbooks&oq=birbalbooks&gs_lcp=CgZwc3ktYWIQAzIECCMQJzIECCMQJzIECCMQJzIGCAAQBxAeMgYIABAHEB4yBggAEAcQHjIGCAAQBxAeUOQjWOQjYO4maABwAHgAgAHeAYgBsAOSAQMyLTKYAQCgAQGqAQdnd3Mtd2l6wAEB&sclient=psy-ab&ved=0ahUKEwiLxceH5bvrAhWB4IUKHWTpDYcQ4dUDCA0&uact=5"target="_blank">
					<span class="icon-pentagon wow bounceIn"><i class="fa fa-google-plus"></i></span>
				  </a>
				  <a title="instagram" href="https://www.instagram.com/birbalbooks/"target="_blank">
					<span class="icon-pentagon wow bounceIn"><i class="fa fa-instagram"></i></span>
				  </a>
				</li>
			  </ul>
			</div>
		  </div>
  

		<!-- Copyright start -->
		<section id="copyright" class="copyright angle">
			<div class="container">

				<div class="col-md-12 text-center">
					<div class="copyright-info">
						&copy; All rights reserved . <span> <a>Birbal</a></span>
					</div>
				</div>
			</div>
			<!--/ Row end -->
			<div id="back-to-top" data-spy="affix" data-offset-top="10" class="back-to-top affix position-fixed">
				<button class="btn btn-primary" title="Back to Top"><i class="fa fa-angle-double-up"></i></button>
			</div>
			<!--/ Container end -->
		</section>
		<!--/ Copyright end -->

	</div><!-- Body inner end -->
<div class="alert">
			<?php echo (isset($result))?$result:'';?><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> </div>
	<!-- jQuery -->
	<script src="plugins/jQuery/jquery.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="plugins/bootstrap/bootstrap.min.js"></script>
	<!-- Style Switcher -->
	<script type="text/javascript" src="plugins/style-switcher.js"></script>
	<!-- Owl Carousel -->
	<script type="text/javascript" src="plugins/owl/owl.carousel.js"></script>
	<!-- PrettyPhoto -->
	<script type="text/javascript" src="plugins/jquery.prettyPhoto.js"></script>
	<!-- Bxslider -->
	<script type="text/javascript" src="plugins/flex-slider/jquery.flexslider.js"></script>
	<!-- CD Hero slider -->
	<script type="text/javascript" src="plugins/cd-hero/cd-hero.js"></script>
	<!-- Isotope -->
	<script type="text/javascript" src="plugins/isotope.js"></script>
	<script type="text/javascript" src="plugins/ini.isotope.js"></script>
	<!-- Wow Animation -->
	<script type="text/javascript" src="plugins/wow.min.js"></script>
	<!-- Eeasing -->
	<script type="text/javascript" src="plugins/jquery.easing.1.3.js"></script>
	<!-- Counter -->
	<script type="text/javascript" src="plugins/jquery.counterup.min.js"></script>
	<!-- Waypoints -->
	<script type="text/javascript" src="plugins/waypoints.min.js"></script>
	<!-- google map -->
	<script
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places"></script>
	<script src="plugins/google-map/gmap.js"></script>

	<!-- Main Script -->
	<script src="js/script.js"></script>
	<!-- Localization -->
	<script>
		var request = new XMLHttpRequest();
		let elements = document.querySelector("body > div.body-inner > section.contact.container > div:nth-child(2) > div:nth-child(2) > ul");

		var plan = ['0', '599', '3299'];
		var data = '';
		request.open('GET', "https://api.ipdata.co?api-key=test", true);

		request.onload = async function () {
			if (this.status >= 200 && this.status < 400) {
				// Success!
				data = JSON.parse(this.response);
				if (data.country_name != "Pakistan") {
				
				element.children[1].textContent = `1. Payoneer the amount to the following info:
				Bank name:
First Century Bank

Bank address:
525 Federal Street Bluefield, WV–Bluefield, USA

Routing (ABA):
061120084

Account number:
4026142138808

Account type:
CHECKING

Beneficiary name:
Rusab Khan`
;
				}
			}
		};
		request.send();
		//document.querySelector("body > div.body-inner > section.contact.container > div:nth-child(2) > div:nth-child(2) > ul")
	</script>

</body>

</html>