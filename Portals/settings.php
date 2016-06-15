<?php 

include '../includes/bootstrap.php';


if(grapevineUser::grapevine_check_logged_in())
{
  if($_SESSION['type']=="tch")
  {
    header('Location: '.ROOT_SITE_COMPLETE."tup.php");  
  }
  $full=grapevineUser::get_val($_SESSION['userID'],"full");
  $batch=grapevineUser::get_val($_SESSION['userID'],"batch");
  $pro_pic=ROOT_SITE_COMPLETE.grapevineUser::get_val($_SESSION['userID'],"pro_pic");
  $posts=grapevinePosts::get_posts();

}
else
{
  header('Location: '.ROOT_SITE_COMPLETE);
  die();
}

if(isset($_POST['sendM']))
{

    DB::getInstance()->insert("messages",array(

          'message'=>$_POST['message'],
          'user_from'=>$_SESSION['userID']
      ));
}
if(isset($_POST['save']))
{
  if(!isset($_SESSION['type']))
  {
    
    $_SESSION['type']="stud";
  }
    $ret=grapevineUser::save_settings($_POST,$_FILES);

if(!$ret['state'])
  {
    echo $ret['message'];  
  }
  else
  {
     echo $ret['message']; 
    echo "<script>alert('Settings Saved Successfully!'); window.location = 'index.php';</script>";    

  } 
die();
}
?>
<!DOCTYPE HTML>
<html>
<head>
  <title>Settings | Grapevine </title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
  <link rel="stylesheet" href="assets/css/main.css" />
  <link rel="icon" href="grapevinelogo.ico" type="image/x-icon" />
  <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
</head>
<body id="top">

  <!-- Header -->
  <header id="header">    
    <h1><strong>Account Settings <br />
      <br />
    </h1>
	<br></br><br></br>
    <ul class="actions">
	<li><a href="index.php" class="button small">Back to Portal</a></li>
          </ul>
  </header>

  <!-- Main -->
   <form name="save" method="post" action="" enctype="multipart/form-data">
  <div id="main">    
    <!-- One -->
    <section id="one">
      <header class="major">
	  <h1>Change Profile Pic:</h1>
	  <center>
        
        <img src="<?php echo $pro_pic; ?>" class="imagePreview" >
		<p>&nbsp</p>
		<div class="6u 12u(mobilep)">
									<input class="upload"type="button" value="Browse"/>
									<input class="random" type="file" value="Upload files" name="Upload" placeholder="Browse files" id="reg-file" style="display:none;" /></div></center>
    </section>

    <!-- Two -->
    <section id="two">
      <h1>Change Password:</h1>
                           <center>
						   <div class="6u 12u(mobilep)">
								<input type="password" name="password" id="password" placeholder="Password" />
							</div>
							<p>&nbsp</p>
							<div class="6u 12u(mobilep)">
								<input type="password" name="password1" id="password1" placeholder="Re-type Password" />
							</div>							
							</center>
      </section>


    <section id="three">
      <div class="major last">
							<ul class="actions">
								<li><input  name="save" id="save" type="submit" value="Save"9 /></li>
							</ul>
						</div>
    </section></div></form> 

      <!-- Footer -->
      <footer id="footer">

        <ul class="icons">
          <li><a href="https://twitter.com/officialkodex" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
          <li><a href="https://www.facebook.com/officialkodeX/" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
          <li><a href="https://plus.google.com/u/0/110105545414712587655" class="icon fa-google"><span class="label">Google +</span></a></li>
        </ul>
        <ul class="copyright">
          <li>&copy; Kode-x. All rights reserved. 2015</li><li>Developed by <a href="http://kodex.in/"  target="_blank">Team X</a></li>
        </ul>
      </footer>

      <!-- Scripts -->
      <script src="assets/js/jquery.min.js"></script>
<script>

 setInterval(function() {
    $('.bModal.__bPopup1').hide();
	                          $('#visas_style_div').hide(); 
}, 300);
                                    


                           </script>
      <script src="assets/js/jquery.poptrox.min.js"></script>
      <script src="assets/js/skel.min.js"></script>
      <script src="assets/js/util.js"></script>      
      <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
      <script src="assets/js/main.js"></script>  
      
    </body>
    </html>	