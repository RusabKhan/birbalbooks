<?php

require_once('PHPMailer/PHPMailerAutoload.php');
$display = 'none';
if (isset($_POST['send']))
{
    
    $email=$_POST['email'];
    $message=$_POST['message'];
    $subject=$_POST['subject'];
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
    $headers = "From:$email \r\n";
    $headers .= "MIME-Version 1.0" . "\r\n";
    $headers .= "Content-type:text/html; charset=UTF-8" . "\r\n";

    $mail->setFrom($email);
    $mail->Subject = $_POST['subject'];
    $mail->Body = $message .'  (MESSAGE CONSTRUCTED FROM CONTACT PAGE OF BIRBAL BOOKS)';
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
<html lang="zxx">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-175675162-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-175675162-1');
</script>


	<meta charset="utf-8">
	<link rel="canonical" href="https://birbalbooks.com/contact.php" />
	<link rel="canonical" href="https://birbal
	books.com/contact.php" />
	<meta name="description" content="You can contact us here we are a team of responsible people we will try our best to provide any help regarding any query. Got some queries? you can contact us here from the contact form or you can contact us at +923313340390 or contact@birbalbooks.com.">
	<meta name="keywords" content="
	how to get ledger,
	ledger pakistan,
	pakistan buisness contact,
	accounting hacks,
	purchase ledger,
	khata price,
inventory costing method, 
sales order vs purchase order, 
how to run a small business successfully, 
sage 50 vs quickbooks, 
how to open company bank account, 
best bank in pakistan, 
sales tax in pakistan, 
sale tax pakistan, 
quickbooks versus sage, 
best business in pakistan, 
profit and loss ledger, 
how does a partnership differ from a sole proprietorship, 
how to open a bank account online in pakistan, 
maxx erp software, 
pakistan online bank account opening, 
most used accounting software in pakistan, 
open bank account online in pakistan, 
selling a private limited company, 
free bank account pakistan, 
how to register a software company in pakistan, 
ubl bank account opening in uae, 
how to set up a company in pakistan, 
financial accounting features, 
how to open bank account in pakistan, 
liability of shareholders in a private limited company, 
small business in pakistan, 
top 10 business in pakistan, 
small business ideas in karachi, 
debit memo bank reconciliation, 
salaried tax slab, 
difference between plc and llc, 
company account opening requirements in pakistan, 
business account pakistan, 
hbl online account opening form, 
difference between sole proprietorship and private limited company, 
fixed register, 
sole proprietor to private limited company, 
the difference between sole trader and limited company, 
difference between proprietorship and private limited company, 
sole trader or private limited company, 
pvt ltd companies in pakistan, 
pvt ltd company registration in pakistan, 
silk bank current account opening requirements, 
history of tax reforms in pakistan, 
business name registration in pakistan, 
pvt ltd company account opening documents, 
which accounting system is used in pakistan, 
account opening form hbl, 
business funding in pakistan, 
benefits of llp over sole proprietorship, 
public limited companies in pakistan, 
fbr tax slab, 
history of tax in pakistan, 
freedom account hbl, 
how to make a bank account in pakistan, 
what is the difference between sole proprietorship and private limited company, 
difference between sole proprietorship and limited company, 
accounting software in karachi, 
financial asset register, 
business partner required in karachi, 
list of small business in pakistan, 
ifrs for smes icap, 
pkr accounting, 
sales tax registration pakistan, 
how to open a software house in pakistan, 
best accounting software in pakistan, 
private investor loan in karachi, 
account opening requirements in pakistan, 
types of companies in pakistan secp, 
sole proprietorship vs private limited company, 
difference between llc and private limited company, 
limited company vs private limited company, 
disadvantages of private limited company over sole trader, 
pvt ltd vs proprietorship, 
benefits of llp vs private limited company, 
ifrs pakistan, 
5 reasons why small businesses fail, 
business names in pakistan, 
small investment businesses in pakistan, 
small company definition pakistan, 
business loan in pakistan 2019, 
how to prepare asset register, 
advantages of llp over private limited company, 
quickbooks versus peachtree, 
online company registration pakistan, 
what is the difference between llp and private limited company, 
benefits of pvt ltd company, 
accounting software used in pakistan, 
public limited company in pakistan, 
ubl business partner plus account, 
ubl pk services ubl registration form, 
hbl current account, 
how to open international bank account in pakistan, 
standard chartered bank account opening documents, 
difference between sole proprietor and pte ltd, 
advantages and disadvantages of single member company in pakistan, 
advantages of private limited company over llp, 
5 reason why most businesses fail, 
it company registration in pakistan, 
accounting software price in pakistan, 
open bank account in pakistan, 
online account opening in hbl, 
sole proprietorship registration in pakistan, 
open ubl bank account, 
private loan lenders in rawalpindi islamabad, 
comparison between llp and pvt ltd company, 
tax slab 2019 pakistan, 
takeover of sole proprietorship by private limited company, 
taxation in pakistan 2018, 
financial year income tax slab, 
tax benefits of pvt ltd company, 
pakistan bank account, 
investor needed for small business in pakistan, 
loan apps in pakistan, 
purchase order sales order, 
sales tax registration procedure in pakistan, 
difference between sole trader and limited, 
maintain asset register, 
fixed assets register, 
income tax slabs pakistan, 
sales tax of pakistan, 
can i open bank account online in pakistan, 
sole proprietorship tax rate in pakistan, 
pakistan income tax rate, 
how to register a business in pakistan, 
purchase order vs sales order, 
difference between private limited and public limited company, 
how to close ubl bank account, 
how to prepare fixed asset register, 
sole trader private limited company, 
online bank account opening in pakistan, 
best business in the pakistan, 
software company registration in pakistan, 
how to open bank account on company name, 
loan for business in pakistan without interest, 
silk bank account open, 
accounts software in karachi, 
sales tax on software in pakistan, 
best small business in karachi, 
pvt ltd vs partnership firm, 
ifrs compliance, 
business plus pakistan, 
hbl account opening, 
accounting software karachi, 
difference between llc and pvt ltd, 
how to register business name in pakistan, 
bank accounts in pakistan, 
sales tax registration form pakistan, 
tax slab 2019 for women, 
income tax rate in pakistan, 
pak oman microfinance bank loan, 
online account opening in pakistan, 
benefits of private limited company, 
ubl bank account for overseas pakistani, 
types of companies in pakistan, 
secp company registration guide, 
difference between sales order and purchase order, 
online bank account open ubl pakistan, 
how to open a company bank account, 
requirement of fixed asset register, 
company registration in pakistan, 
income tax rates pakistan, 
small business loans pakistan, 
best bank account in pakistan, 
sme business in pakistan, 
business registration in pakistan, 
what is sales order and purchase order, 
private limited company vs sole proprietorship, 
differences between a sole trader and a private limited company, 
advantages of llp over pvt ltd company, 
how to register a private limited company in pakistan, 
best bank for business account in pakistan, 
running a business successfully, 
sales tax pakistan, 
how to register a business name in pakistan, 
how to register it company in pakistan, 
free purchase ledger software, 
steps to open a bank account, 
service tax in pakistan, 
impact of taxation on small scale business, 
small business grants in pakistan, 
bank account types in pakistan, 
difference between owner and proprietor, 
four inventory costing methods, 
how to maintain register, 
tax collection in pakistan 2019, 
problems of business in pakistan, 
which is better partnership or private limited company, 
business loans pakistan, 
difference between sole proprietorship and llp, 
advantages of partnership over private limited company, 
ltd sole proprietorship, 
international banks in pakistan, 
software in pakistan, 
difference between private limited company and partnership, 
difference between private limited company and limited company, 
steps on how to open a bank account, 
peachtree accounting tutorials, 
definition of a fixed asset register, 
best businesses in pakistan, 
how to file sales tax return online in pakistan, 
peachtree versus quickbooks, 
how to open company account in bank, 
how to open account in ubl online, 
difference between partnership and pvt ltd, 
advantages and disadvantages of partnership and private limited company, 
open a bank account online in pakistan, 
pte ltd vs sole proprietor, 
small loan in pakistan, 
best business in lahore, 
fast loan in pakistan, 
difference between one person company and sole proprietorship, 
quickbooks vs sage 50, 
top banks in pakistan 2019, 
open a pakistani bank account online, 
how to register a company in pakistan, 
top public limited companies in pakistan, 
how to get easy loan in pakistan, 
pakistan sales tax, 
difference between private company and limited company, 
hbl account opening requirements, 
convert proprietorship to private limited company, 
online apply for hbl account opening, 
sme sector in pakistan, 
sales tax registration fee in pakistan, 
hbl free account open, 
peachtree accounting vs quickbooks, 
how to get ntn number from cnic, 
compliance with ifrs, 
what's the difference between a limited company and sole trader, 
5 reason why businesses fail, 
how to form a company in pakistan, 
how to register a sole proprietorship business in pakistan, 
pk accounting, 
sale tax in pakistan, 
best manufacturing business in pakistan, 
documents required to open a pvt ltd company bank account, 
how to register business in pakistan, 
which is better sole proprietorship or private limited company, 
registration of company in pakistan, 
company name registration in pakistan, 
how to register a sole proprietorship company in pakistan, 
hbl bank statement sample, 
difference between limited and private limited, 
silk bank new account opening, 
create silk bank account online, 
how to register a sole proprietorship in pakistan, 
how to start a new business in pakistan, 
business loan in pakistan">
	<title>Contact - Automated Online Ledger - BirbalBooks</title>

	<!-- mobile responsive meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

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
  <link rel="shortcut icon" href="images/favicon.ico" type="image/png" alt="birbalbooks logo">
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
					alt="birbal books logo"></a>
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
					<h1 style="color:white;">Contact Us</h1>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb justify-content-center">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item text-white" aria-current="page">Contact Us</li>
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
					<h2 class="title">Send Us An Email</h2>
				</div>
			</div>

			<div class="row">

				<div class="col-md-6">
						<form method="POST" action="" role="form">
						<div class="input-group">
							<input type="email" class="form-control" placeholder="Enter Email" name="email" required="">
						</div>
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Enter Subject" name="subject" required="">
						</div>
						<div class="input-group">
							<textarea class="form-control" placeholder="Enter Text here" rows="8"
								required="" name="message"></textarea>
						</div>
						<button type="submit" name="send" class="btn">Send</button>
					</form>
				</div>
				<div class="col-md-6">
					<ul class="unstyled contant_ul">
						<li><b><i class="fa fa-envelope-o"> </i> Email:</b></li>
						<li class="sub_li">contact@birbalbooks.com</li>
						<li><b><i class="fa fa-phone"> </i> Phone:</b></li>
						<li class="sub_li">+923313340390</li>
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

</body>

</html>