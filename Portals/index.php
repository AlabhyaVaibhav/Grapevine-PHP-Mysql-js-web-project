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

?>
<!DOCTYPE HTML>
<html>
<head>
  <title>Students Portal </title>
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
    <a href="#" class="image avatar"><img src="<?php echo $pro_pic; ?>" alt="" /></a>
    <h1><strong><?php echo $full; ?></strong> | <?php echo $batch; ?> <br />
      <br />
    </h1>
    <ul class="actions">
      <li><a href="settings.php" class="button small">Settings</a></li>
      <li><a href="logout.php" class="button small">Logout</a></li>      
      
    </ul>
  </header>

  <!-- Main -->
  <div id="main">

    <!-- One -->
    <section id="one">
      <header class="major">
        <h2>Welcome ! Onboard <?php echo $full; ?><br />
        </h2>
      </header>
      <p>
        Usually students seek precise and brief annotations right before the examinations for getting a summary or quick revision of their syllabus. But being Engineering students, we seek notes for a first glance at the curriculum on the night before the exam. We tend to look for something compact, systematic,labor-saving and well ordered. This Portal serves the very purpose. So you can put your mind at ease and find all the 
        study material related to our subjects including the ones that you've probably missed while it was circulated. You will find it all here, whatever you need, whenever you need it.  You won't have to waste more time in hunting for notes for regular revisions Or for Mid/End Semester preparations. 


        
      </p>
      <ul class="actions">
        <li><a href="#two" class="button">Assignments</a></li>


      </ul>
    </section>

    <!-- Two -->
    <section id="two">
      <h2>Recent Notes and Assignments</h2>
      <div class="row">
        <?php foreach ($posts as $key => $post) {
          ?>
          <article class="6u 12u$(xsmall) work-item">
            <?php $file_image=grapevinePosts::file_return($post->file_uid);

            $file_image=str_replace("doc","docx",$file_image);
            $file_image=str_replace("ppt","pptx",$file_image);
            $file_image=str_replace("docxx","docx",$file_image);
            $file_image=str_replace("pptxx","pptx",$file_image);
            $file_path=$file_image.".png";
            $existing=array('docx','pptx','txt','pdf','zip');
            ?>
            <?php if(in_array($file_image,$existing)){ ?> 
            <img src="../images/<?php echo $file_image.".png"; ?>" alt="" />
            <?php } else 
             {?>
            <img src="../images/file.png" alt="" />
            <?php } ?>
            


            
            <h3><?php echo $post->topic; ?></h3>
            <p><?php echo $post->desc; ?></p><br>
            <a href="<?php echo ROOT_SITE_COMPLETE.$post->file_uid; ?>" target="_blank">Download</a>
          </article>
          <?php  } ?>
        </div>
        <center>
          <ul class="actions">
            <li><a href="<?php echo ROOT_SITE_COMPLETE."search_notes/"; ?>" class="button" target="_blank">See all Notes</a></li>
          </ul>
        </center>

      </section>


    <section id="three">
      <h2>Get In Touch</h2>
      <p>Have an issue or want to upload solutions, suggestions etc.,</p>
      <div class="row">
        <div class="8u 12u$(small)">
          <form method="post" action="">
            <div class="row uniform 50%">
              <div class="6u 12u$(xsmall)"><input type="text" name="name" id="name" placeholder="Name" /></div>
              <div class="6u$ 12u$(xsmall)"><input type="email" name="email" id="email" placeholder="Email" /></div>
              <div class="12u$"><textarea name="message" id="message" placeholder="Message" name="message" rows="4"></textarea></div>
            </div>
                    <ul class="actions">
            <li><input type="submit" name="sendM"value="Send Message" /></li>
          </ul>
</form>

        </div>
        <div class="4u$ 12u$(small)">
          <ul class="labeled-icons">
             <li>
              <h3 class="icon fa-home"><span class="label">Address</span></h3>
              Admins:<br/>
              Sarthak Mishra, <br/>5B-93,KP-10<br />
              Alabhya Vaibhav, <br/>4B-496,KP-7<br />	
            </li>
            <li>
              <h3 class="icon fa-mobile"><span class="label">Phone</span></h3>
              +91-9717833422, +91-9078025169
            </li>
            <li>
              <h3 class="icon fa-envelope-o"><span class="label">Email</span></h3>
              <a href="#">support@kodex.in</a>
            </li>
          </ul>
        </div>
      </div>
    </section>
    </div>
    <section>

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