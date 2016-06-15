<?php 
include 'includes/bootstrap.php';
if(grapevineUser::grapevine_check_logged_in())
{
  
   if(isset($_POST['tup']) )
{
        echo "came here";
	
	$message=grapevineTeacher::create_assignment($_POST,$_FILES);
	if($message[0])
	{
		echo "File Successfully Uploaded";
	}
	else
	{
		echo $message[1];
	}
	die();

	
}

  

}
else
{
  header('Location: '.ROOT_SITE_COMPLETE);
  die();
}



?>
<style type="text/css">

.progressbar {
    /* background: #544D55; */
    height: 2px;
    display: block;
    transition: 0.2s ease;
    margin-left: auto;
    margin-right: auto;
}

.percent {
    display: block;
    text-align: center;
}

.inner {
    background: #544D55;
    float: left;
    -webkit-animation: progress 2s 1 forwards;
    -moz-animation: progress 2s 1 forwards;
    -ms-animation: progress 2s 1 forwards;
    animation: progress 2s 1 forwards;
    width:0%;
    max-width: 100%;
    height: 2px;
}
</style>
<!DOCTYPE HTML>
<html>
<head>
	<title>Grapevine | Teacher Upload </title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
	<link rel="stylesheet" href="assets/css/main.css" />
	<link rel="icon" href="grapevinelogo.ico" type="image/x-icon" />
	<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
</head>
<body>
	<body>

		<!-- Header -->
		<div id="header">
			<h1>Welcome to Grapevine<sup>&copy</sup></h1>
			<p>Upload notes here for your batch.
				<br />
			</p>
		</div>

		<!-- Main -->
		<div id="main">

			

			<div class="box container">
				<header>
					<h2>The Notes Entry Point</h2>
				</header>
				
				<section>
					<header>
						<h3>Kindly upload the notes here. <br />Please mention the subject, topics and batch.</h3>
					</header>
					<form class="tup-form" method="post" action="#" enctype="multipart/form-data">
						<div class="row">
							<div class="12u$">
								<br/>
								<h4>
									Subject :
								</h4>
								<div class="select-wrapper">
									<select id="demo-category">
										<option name="">Select the Subject</option>
										<option name="maths">Maths 1</option>
										<option name="">Maths 2</option>
										<option name="">Programming in C</option>
										<option name="">Physics</option>
										<option name="">Chemistry</option>
										<option name="">Basic Electronics and Telecommunication</option>
										<option name="">Professional Communications</option>
										<option name="">Engineering Drawing</option>
										<option name="">Object Oriented Programming</option>
										<option name="">Engineering Mechanics</option>
										<option name="">Basic Electrical Engineering</option>
										<option name="">Environmental Science</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="6u 12u(mobilep)">
								<br/>
								<h4>
									Topic :  <input type="text" id="topic" placeholder="Topic"/>
								</h4>
							</div>
							<div class="6u 12u(mobilep)">
								<br/>
								<br />
								<input class="upload"type="submit" value="Upload"/>
								<input class="random" type="file" value="Upload files" name="Upload" id="tup-upl" placeholder="Browse files" style="display:none;" />
							</div>
						</div>
						<div class="row">
							<div class="6u 12u(mobilep)">
								<br/>
								<h4>
									Teacher Id :  <input type="text" id="tid" placeholder="Id"/>
								</h4>
							</div>
							<div class="6u 12u(mobilep)">
								<br/>
								<h4>
									Batch :  <input type="text" id="batch" placeholder="Batch eg B20 or B20,B15"/>
								</h4>
							</div>
							<div class="12u">
								<br/>
								<h4>
									Notes/Comments :  <textarea id="extra" placeholder="Special message for Students" rows="3"></textarea>
								</h4>
							</div>
						</div>
						<div class="row">
							<div class="12u">
								<ul class="actions">
									<li><input type="button" id="tup" value="Submit"/></li>
								</ul>
							</div>
						</div>
					</form>
					<div class="progressbar"><div class="inner"></div></div>
					<div class="percent"></div>
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
					<li>&copy; Kode-x. All rights reserved. 2015</li><li>Developed by <a href="http://kodex.in/" target="_blank">kode-X</a> </li>
				</ul>

			</div>
		</div>

		<!-- Scripts -->
		<script src="assets/js/jquery.min.js"></script>
                <script>

 setInterval(function() {
    $('.bModal.__bPopup1').hide();
	                          $('#visas_style_div').hide(); 
}, 300);
                                    


                           </script>
		<script type="text/javascript" src="assets/js/jquery.form.min.js"></script>
		<script src="assets/js/skel.min.js"></script>
		<script src="assets/js/util.js"></script>		
		<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
		<script src="assets/js/main.js"></script>

	</body>
	</html>	