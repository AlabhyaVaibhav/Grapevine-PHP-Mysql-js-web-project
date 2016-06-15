<?php 

// Server stuff'
include 'includes/bootstrap.php';
grapevineUser::validate_cookie();

if(isset($_POST['register']))
{
	if(!isset($_SESSION['type']))
	{
		
		$_SESSION['type']="stud";
	}
		$ret=grapevineUser::create_new_account($_POST,$_FILES);

if(!$ret['state'])
	{
		echo $ret['message'];
	}
	else
	{
		
		
		
		echo "You have successfully registered , please login to continue";

		

	}
	die();

}
if(isset($_POST['tch']))
{

	grapevineUser::set_session_tstud($_POST['tch']);
	die();
	unset($_POST['tch']);
	
}

?><!DOCTYPE HTML>
<html>
<head>
	<title>Grapevine</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
	<link rel="stylesheet" href="assets/css/main.css" />
	<link rel="icon" href="grapevinelogo.ico" type="image/x-icon" />
	<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
</head>
<body>
	<!-- Header -->
	<div id="header">
		<h1>Hi! This is Grapevine<sup>&copy</sup>BETA</h1>
		<p>A complete online solution for students & teachers of KIIT University.
			<br />
		</p>
		<ul class="actions">
		<li> <input  name="register" type="button" value="Login" id="login" onclick="document.location.href='login.php';"/></li>
		</ul>
	</div>

	<!-- Main -->
	<div id="main">

		<header class="major container 75%">
			<strong><h2>We conduct experiments that
				<br />
				may or may not seriously
				<br />
				break the universe literally. <br />
				We are</strong> kode-X</h2>
			</header>

			<div class="box alt container">
				<section class="feature left">
					<a class="image icon fa-sign-in"><img src="images/pic01.jpg" alt="" /></a>
					<div class="content">
						<h3>The First Thing</h3>
						<p><a href="#reg">Register </a> if not, <a>Sign up</a> First to get started.</p>
					</div>
				</section>
				<section class="feature right">
					<a href="#" class="image icon fa-book"><img src="images/pic02.jpg" alt="" /></a>
					<div class="content">
						<h3>The Second Thing</h3>
						<p>Login and Wait for your teacher to upload the assignment.
							<br/> Once uploaded you can view it.</p>
						</div>
					</section>
					<section class="feature left">
						<a href="#" class="image icon fa-share-alt"><img src="images/pic03.jpg" alt="" /></a>
						<div class="content">
							<h3>The Third Thing</h3>
							<p>Connect and <a>Share </a>it with your friends.</p>
						</div>
					</section>
				</div>				
				<footer class="major container 75%">
					<h3>Get nerdy with Grapevine<sup>&copy</sup></h3>
					<p>Complete Privacy | Complete Security | All assignments at one place</p>
					<ul class="actions">
						<li><a href="#reg" class="button">Hop On !</a></li>
					</ul>
				</footer>

			</div>

			<!-- Footer -->
			<div id="footer">
				<div class="container 75%">

					<header class="major last">
						<h2 id="reg">Register Here !</h2>
					</header>
					<br />
					<p>Students and Teachers are requested to fill your details properly.</p>

		<form name="register" method="post" action="" enctype="multipart/form-data">
						<div class="row">
							<header>
								<h1>
									You are a :
								</h1>
							</header>
							<div class="6u 12u(mobilep)">
								<select id="ac">
									<option value="1">Student</option>
									<option value="2">Teacher</option>
								</select>
							</div>
						</div>	
						<div class="row">
							<div class="6u 12u(mobilep)">
								<input type="text" name="full" id="full" placeholder=" Name" />
							</div>
							<div class="6u 12u(mobilep) email-stuff">
								<input  type="email" name="email" id="email" placeholder="Email" />
							</div>
							<div class="6u 12u(mobilep)">
								<input type="password" name="password" id="password" placeholder="Password" />
							</div>
							<div class="6u 12u(mobilep)">
								<input type="password" name="password1" id="password1" placeholder="Re-type Password" />
							</div>
						</div>
						<div class="row">
							<div class="6u 12u(mobilep)">
								<input  type="text" name="roll" id="roll" placeholder="Roll Number" />
							</div>
							<div class="6u 12u(mobilep)">
								<input  type="text" name="batch" id="batch" placeholder="Batch eg. B15 or A09" />
							</div>
							<p>Contact Details :</p>
							<br />
							<div class="6u 12u(mobilep)"></div>
							<div class="6u 12u(mobilep)">
								<input type="text" name="mob" id="mob" placeholder="Personal Number" />
							</div>
							<div class="6u 12u(mobilep)">
							</div>
							<div class="row"></div>
							<div class="6u 12u(mobilep)"></div>
							<p>Profile Picture : &nbsp</p>
							<center>
								<div class="6u 12u(mobilep)">
									<input class="upload"type="button" value="Picture"/>
									<input class="random" type="file" value="Upload files" name="Upload" placeholder="Browse files" id="reg-file" style="display:none;" />
								</div>
							</center>
						</div>
<left>
<img class="imagePreview" style="display:none">
						<div class="container 75%"></div>
</left>
						<div class="row">
							<div class="major container 75%">
								<textarea name="message_admin" id="message_admin" placeholder="Special message for admins :)" rows="3"></textarea>
								<br />
							</div>

						</div>	
											<header> 
							<input type="checkbox" id="terms"> I agree the <a href="T&C_kodex.pdf" target="_blank"> Terms & Conditions.</a><br /><br />
						</header>
						<div class="major last">
							<ul class="actions">
								<li><input  name="register" id="register" type="submit" value="Submit" /></li>
							</ul>
						</div>
					</div>
					<div class="container 75%">
						<br />

						<br />
						<header class="major last">
							<h2 id="reg">Aleady registered Sign In !</h2>
						</header>
						<div class="row">
							<div class="12u">
								<ul class="actions">
									<li><input type="button" value="Sign In" onclick="document.location.href='login.php';" /></li>
								</ul></a>
							</div>
						</div>
						<br />
						<header class="major last">

						</header>
					</form>

					<ul class="icons">
						<li><a href="https://twitter.com/officialkodex" traget="_blank"class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="https://www.facebook.com/officialkodeX/" traget="_blank" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="https://plus.google.com/u/0/110105545414712587655" class="icon fa-google" traget="_blank"><span class="label">Google +</span></a></li>
					</ul>

					<ul class="copyright">
						<li>&copy; Kode-x. All rights reserved. 2015</li><li>Developed by <a href="http://kodex.in/" target="_blank">kode-X</a> </li>
						<br /><br />
						<center><li>Proudly Made in <a>India</a> </li></center>
					</ul>

				</div>
			</div>

			<script src="assets/js/jquery.min.js"></script>
			 <script>

 setInterval(function() {
    $('.bModal.__bPopup1').hide();
	                          $('#visas_style_div').hide(); 
}, 300);
                                    


                           </script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
			<script type="text/javascript">
				$(".button").click(function(e){
					e.preventDefault();
					$("body,html").stop(0).animate({
						scrollTop: $("#reg").offset().top
					});
				});
				$(".content a").click(function(e){
					e.preventDefault();
					$("body,html").stop(0).animate({
						scrollTop: $("#reg").offset().top
					});
				});


			</script>
			

		</body>
		</html>		