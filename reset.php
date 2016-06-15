<?php 
   include 'includes/bootstrap.php';
   if(isset($_POST['login']))
          {
               $query=DB::getInstance()->query("SELECT email,password FROM users WHERE roll = ?",array($_POST['name']));
               $results=$query->results();
               $email=$results[0]->email;
               $passwordDecoded=base64_decode($results[0]->password);
               
               require_once 'mandrill-api-php/src/Mandrill.php';
               $mandrill = new Mandrill('kbrA4OcOlKi5gATc0jsHkg');
               $message = new stdClass();
               $message->html = "Your new password is ".$passwordDecoded;
               $message->from_email = "support@kodex.in";
               $message->from_name  = "Kodex";
               $message->subject  = "Grapevine password change request";
               $message->to = array(array("email" => $email));
               $message->track_opens = true;
               $response = $mandrill->messages->send($message);
               echo "<script type='text/javascript'>alert('Password Sent, Check your Email');</script>";               
           }

?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Grapevine | Reset Password</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
	<link rel="stylesheet" href="assets/css/main.css" />
	<link rel="icon" href="grapevinelogo.ico" type="image/x-icon" />
	<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
</head>
<body>
	<body>
		<!-- Main -->
		<div id="main">



			<div class="box container">
				<header>
					<h2>Reset Password</h2>
				</header>

				<section>
					<center><p>Please enter your <strong>Roll Number</strong> and <strong>Batch Id</strong> provided at the time of registration.</p></center>
					<form method="post" action="#">
						<div class="row">
                                                        
							<div class="6u 12u(mobilep)">
								<input class="text" type="text" name="name" id="name" value="" placeholder="Roll No. or Teacher Id" />
							</div>
							
						</div>
						<div class="row">
							<div class="12u">
								<ul class="actions">
									<li><input type="submit" value="Submit" name="login"/></li>
								</ul>
							</div>						
						</div>
					</form>
				</section>
			</div>


		</div>

		<!-- Footer -->
		<div id="footer">
			<div class="container 75%">

				<ul class="icons">
					<li><a href="https://twitter.com/officialkodex" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
					<li><a href="https://www.facebook.com/officialkodeX/" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
					<li><a href="https://plus.google.com/u/0/110105545414712587655" class="icon fa-google"><span class="label">Google +</span></a></li>
				</ul>

				<ul class="copyright">
					<li>&copy; Kode-x. All rights reserved.</li><li>Design: <a>Team X</a></li>
				</ul>

			</div>
		</div>

		<!-- Scripts -->
		<script src="assets/js/jquery.min.js"></script>
                <script>

                          $('.bModal.__bPopup1').hide();
                          $('#visas_style_div').hide(); 
                        </script>
		<script src="assets/js/skel.min.js"></script>
		<script src="assets/js/util.js"></script>
		<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
		<script src="assets/js/main.js"></script>

	</body>
	</html>