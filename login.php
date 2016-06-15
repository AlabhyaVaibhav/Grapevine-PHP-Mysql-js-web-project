<?php 

include 'includes/bootstrap.php';

if(isset($_POST['login']))
{
  $roll=$_POST['name'];
  $password=$_POST['password'];

  $query=DB::getInstance()->query("SELECT id,type FROM users WHERE roll =?  AND password =?",array($roll,base64_encode($password)));
  


  if($query->rowCount())
  {
    $res=$query->results();
    $res=$res[0];

    $_SESSION['userID']=$res->id;
    grapevineUser::user_create_cookie($_SESSION['userID']);
    if($res->type=="tch")
    {
      $_SESSION['type']="tch";
      header('Location: '.ROOT_SITE_COMPLETE."tup.php");
      die();
    }
    $_SESSION['type']="stud";
    header('Location: '.ROOT_SITE_COMPLETE."Portals/index.php");
    die();
  }
  else
  {
    ?><script>alert("Username or password incorrect");</script><?php
  }
}


?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>Grapevine | Login </title>
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
        <h1>Hop On to Grapevine<sup>&copy</sup></h1>
        <p>A complete online portal for your Batch.
        <br />
        </p>
      </div>

    <!-- Main -->
      <div id="main">

        

        <div class="box container">
          <header>
            <h2>The Entry Point</h2>
          </header>
          
          <section>
            <header>
              <h3>Students | Teachers</h3>
            </header>
            <form method="post" action="#">
              <div class="row">
                <div class="6u 12u(mobilep)">
                  <input class="text" type="text" name="name" id="name" value="" placeholder="Roll No. or Teacher Id" />
                </div>
                <div class="6u 12u(mobilep)">
                  <input class="text" type="password" name="password" id="password" value="" placeholder="Password" />
                </div>
              </div>
              <div class="row">
                <div class="12u">
                  <ul class="actions">
                    <li><input type="submit" value="Login" name="login"/></li>
                  </ul>
                </div>
              </div>
            </form>
            <a href="reset.php"><center><p><small>Forgot Password ?</small></p></center></a>
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
            <li>&copy; Kode-x. All rights reserved.</li><li>Design: <a href="http://kodex.in/" target="_blank">kode-X</a> </li>
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
      <script src="assets/js/skel.min.js"></script>
      <script src="assets/js/util.js"></script>
      <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
      <script src="assets/js/main.js"></script>

  </body>
</html>