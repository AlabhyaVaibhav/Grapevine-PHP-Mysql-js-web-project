<?php 

include '../../includes/bootstrap.php';
if(grapevineUser::grapevine_check_logged_in())
{

		$friends=grapevineUser::get_vineMates();


}
else{
	header("Location ".ROOT_SITE_COMPLETE);
}

?>
<!DOCTYPE html>
<html lang="en-US">
<head>

	<!-- Meta tags & title /-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="robots" content="all,index,follow" />

	<title> People in your vine</title>
	
	<!-- Stylesheets /-->
	<link rel="stylesheet" type="text/css" href="css/style.css" /> <!-- Main stylesheet /-->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"> <!-- Grid framework /-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'> <!-- Open Sans /-->
	<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700' rel='stylesheet' type='text/css'> <!-- PT Sans Narrow /-->
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet"> <!-- Font Awesome /-->
	
	<link rel="shortcut icon" href="img/favicon.png" type="image/x-icon" /> <!-- Favicon /-->

</head>

<body>

	
	<section id="speakers">
		<h3>Your vinemates</h3> <!-- Section Title -->
		<div class="separator"></div>
		<div class="container">
			<div class="col-md-8 col-md-offset-2">
				<!-- Section Description -->
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			</div>
			
			<!-- First Row of people -->
			
				<?php 
				
				if($friends!="")
				{
				foreach ($friends as $key => $friend) {
					# code...
			?>
				<!-- person1 -->
				<div class="displ">


					<li>
						<div class="unhover_img">
							<img src="<?php echo ROOT_SITE_COMPLETE.$friend->pro_pic; ?>" alt="" />
						</div>
					
						<br/>
						<h1><span><?php echo $friend->full; ?></span></h1>
					</li>	
								<?php 

				} 
			}
				?>		
			</div> <!-- End First Row -->

		</div>

		

		</div>
	</section>
	<!-- //SPEAKERS SECTION -->	

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> <!-- Load jQuery -->

	<!-- jQuery Code for the View All Button -->
	
	
</body>
</html>	