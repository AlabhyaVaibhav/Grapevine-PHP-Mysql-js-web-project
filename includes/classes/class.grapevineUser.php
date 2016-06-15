<?php

  /**
  *The Main GrapeVine User Class Dealing with all methods involved with the end user such as getting user info or creating an account etc
  */

  class grapevineUser
  {

            /**
            *This is the method that will be used to get info for login validation
            * @param - username or email of the person
            */

            public static function get_basic_login_info($user)
            {

              $query=DB::getInstance()->query("SELECT password,id FROM users WHERE username=? or email=?",array($user,$user));
              $results=$query->results();
              return $results[0];



            }
              /**
            *This is the method that will be used to get all info from the current logged user
            * @param - user id $_SESSION['userID'];
            */

              public static function get_basic_info($userID)
              {

                $query=DB::getInstance()->query("SELECT id,full,color,cov_pic,pro_pic,username,email,online FROM users WHERE id=?",array($userID));
                $results=$query->results();
                return $results[0];



              }
            /**
            * Validate supplied password and username or email with the correct ones
            * @param - supplied password
            * @param - username or email
            */
            public static function initiate_login($password,$userem)
            {


              $query=DB::getInstance()->query("SELECT id FROM users WHERE (password=?) AND (username=? or email=?)",array($password,$userem,$userem));
              if($query->rowCount())
              { 

                $_SESSION['userID']=$rows->id;
                return true;
              }
              else
              {

                return false;//Wrong Creds
            } 

        } 
            /**
            *Check if any user with the given username exists or not
            * @param - name of the user
            */

            public static function check_username_duplication($user)
            {
              $query=DB::getInstance()->query("SELECT id FROM users WHERE username =?",array($user));

              if ($query->rowCount())
              {
                return 1;
              }
              else

              {

                return 0;
              }
            }
            /**
            *Check if any instance of the given email exists or not
            * @param - the email id
            */


            public static function check_email_duplication($email)
            {


              $query=DB::getInstance()->query("SELECT id FROM users WHERE email =?",array($email));

              if ($query->rowCount())
              {
                return 1;
              }
              else

              {

                return 0;
              }


            }
     
            public static function check_roll_duplication($roll)
            {


              $query=DB::getInstance()->query("SELECT id FROM users WHERE roll =?",array($roll));

              if ($query->rowCount())
              {
                return 1;
              }
              else

              {

                return 0;
              }


            }
              /**
              *Method for creating an account
              * @param - $_POST array containing the email,password,etc
              */  
              public static function create_new_account($data,$upload_array)
              {


                $message="";
                $params= array('message' => $message, 'state'=>false);



                  //Check Email Address

                if($_SESSION['type']!="tch")
                {
                  /*We get the email adress on the basis of the teacher id provided , so this becomes redundant*/
                  if( !preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $data['email']) )
                  {
                    $params['message']="Please enter a valid email address";
                    return $params;
                  }

                        //Check Email Duplication
                  if( grapevineUser::check_email_duplication($data['email']))
                  {

                    $params['message']="Please enter a different email id";
                    return $params;
                  }

                  //Check Roll Duplication
                  if( grapevineUser::check_roll_duplication($data['roll']))
                  {

                    $params['message']="This Roll No has already registered!";
                    return $params;
                  }
                  grapevineUser::send_email($data['email']);

                }

                if( !$data['password']){

                  $params['message']='Please enter your password';
                  return $params;
                }
                if($data['password']!=$data['password1'])
                {
                  $params['message']="Password entered by you doesn't match";
                  return $params;

                }
                if(!preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/", $data['password']) )
                {
                  $params['message']="Please enter a password of atleast 8 characters containing one uppercase letter and a number ";
                  return $params;
                }
                if($_SESSION['type']!="tch")
                {
                  if(!is_numeric($data['roll']))
                  {
                    $params['message']="Please enter a valid roll number";
                    return $params;
                  }
                }
                else
                {
                  if(grapevineTeacher::authenticate_teacher($data['roll']))
                  {

                  }
                  else
                  {
                    $params['message']="Please enter a valid teacher id";
                  }
                }
                $batch=$data['batch'];

                if($_SESSION['type']!="tch")
                { 
                  if(strlen($batch)<=3)
                  {
                    $batch[0]=strtoupper($batch[0]);
                    if(is_numeric($batch[1])&&is_numeric($batch[2]))
                    {
                          //return true;
                    }
                    else
                    {
                      $params['message']="Please enter a valid batch eg B20";
                      return $params;
                    }
                  }
                  else
                  {

                    $params['message']="Please enter a valid batch eg B20";
                    return $params;
                  }
                }
                $type=$_SESSION['type'];

                if($type=="stud")
                {
                  $token="";
                }
                else
                {
                  $chars="abcdefghijklmnopqrstuvxyzABCDEFGHIJKLMNOPQRSTUVXYZ0123456789";
                  $rand=substr(str_shuffle($chars),0,25);
                //if(grapevineTeacher::authenticate_teacher())
                //grapevineUser::send_email();
                  $token=md5($rand);
                  $data['email']="";
                }

                /*Teacher -> Id , Dept || Stud -> id , batch*/



              //Upload image
                if(!empty($upload_array))
                {
                  $image_url=grapevinePhotos::upload_user_media($upload_array);
                }
                else
                {
                  $image_url="images/prof.png";
                }


                $password = base64_encode($data['password']);

                  //Create New Account

                $query=DB::getInstance()->insert("users",array(


                  'full'    =>$data['full'],
              'password'=>$password,//Main Version Has This hashed
              'email'   =>$data['email'],
              'roll'    =>$data['roll'],
              'batch'   =>$data['batch'],
              'mob' =>    $data['mob'],
              'type'=>  $type,
              'activated_hash'=>$token,
              'pro_pic'=>$image_url



              ));



                $params['state']=true;



                return $params;             


              }

            public static function save_settings($data,$upload_array)
              {
 


                $message="";
                $params= array('message' => $message, 'state'=>false);
                               

                if( $data['password']){                 
                
                if($data['password']!=$data['password1'])
                {
                  $params['message']="Password entered by you doesn't match";
                  return $params;

                }
                if(!preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/", $data['password']) )
                {
                  $params['message']="Please enter a password of atleast 8 characters containing one uppercase letter and a number ";
                  return $params;
                }

                   $password = base64_encode($data['password']);
                 $query=DB::getInstance()->update("users",array('id','=',$_SESSION['userID']),array('password'=>$password));
                
              }                 



              //Upload image
                if($upload_array['Upload']['error']==0)
                {
                   $image_url=grapevinePhotos::upload_user_media($upload_array);
                  
                   $query=DB::getInstance()->update("users",array('id','=',$_SESSION['userID']),array('pro_pic'=>'Portals/'.$image_url));
                  

                }
                else
                {
                  $image_url="images/prof.png";
                }


                 
               
               
                $params['state']=true;
                return $params;  

            }           


                
            


           

              /**
        * Create cookie for remember me feature
        * @param - $userID
        */
              public static function user_create_cookie($userID)
              {


                $chars="qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890!@#$%^&*()_+";
                $sid=substr(str_shuffle($chars),0,85);
                $number_of_days =364;
                $date_of_expiry = time() + 60 * 60 * 24 * $number_of_days ;

                setcookie( "cookieAuth", $sid, $date_of_expiry,'/' ); 
                setcookie("user",$userID,$date_of_expiry,'/');  
                $vals=DB::getInstance()->update("users",array("id","=",$userID),array("cookie"=>$sid));


              }
        /**
        * Validate Session 
        */
        public static function grapevine_check_logged_in()
        {

          if(isset($_SESSION['userID']))
          {

            return true;


          }
          else
          {
            return false;

          }



        } 
        /**
        * Validate cookie for remember me
        */
        public static function validate_cookie()
        {

          if(isset($_COOKIE['cookieAuth']) && isset($_COOKIE['user']))
          {


            $givenCookie=$_COOKIE['cookieAuth'];
            $vals=DB::getInstance()->query("SELECT cookie,type FROM users WHERE id=?",array($_COOKIE['user']));

            $cookieDbs=$vals->results();
            $cookieDb=$cookieDbs[0]->cookie;
            
            if ($cookieDb==$givenCookie)
            {
              
              $_SESSION['userID']=$_COOKIE['user'];
          
            
            
              if($cookieDbs[0]->type=="tch")
              {
                $_SESSION['type']="tch";
                header('Location: '.ROOT_SITE_COMPLETE."tup.php");
                die();
              }
              else
              {
                
                $_SESSION['type']="stud";
                header('Location: '.ROOT_SITE_COMPLETE."Portals/index.php");
                die();  
              }
              


            }
            else
            {

              unset($_COOKIE['cookieAuth']);
              unset($_COOKIE['user']);
              session_destroy();
              
              
                //Process Logout , Show him our level of Sophistication
            }

          }
          else
          {



          }


        } 
        /**
        * The Method for using singleton values
        * @param - id of the user whose value is to be obtained
        * @param - the value such as name , username, pro_pic
        */
        public static function get_val($userID,$field)
        {



          $vals=DB::getInstance()->query("SELECT {$field} FROM users WHERE id = ?",array($userID));

          $rs= $vals->results();
          return $rs[0]->$field;
        }
        /**
        * Well during reg we need to diffrentiate btw stud and tch
        * @param - Stud or teacher
        */
        public static function set_session_tstud($param)
        {

          $_SESSION['type']=$param;
        }

        public static function get_vineMates()
        {
          $query=DB::getInstance()->query("SELECT * FROM users WHERE batch= ? ",array(grapevineUser::get_val($_SESSION['userID'],"batch")));
          return $query->results();
        }
        public static function send_email($email)
        {

                              // Mandrill Api
                require_once 'mandrill-api-php/src/Mandrill.php'; //Not required with Composer
                $mandrill = new Mandrill('kbrA4OcOlKi5gATc0jsHkg');
                try {
                  $mandrill = new Mandrill('kbrA4OcOlKi5gATc0jsHkg');
                  $template_name = 'welcome';
                  $template_content = array(
                    array(
                      'name' => 'example name',
                      'content' => 'example content'
                      )
                    );
                  $message = array(
                    'html' => '<p>Example HTML content</p>',
                    'text' => 'Example text content',
                    'subject' => 'Welcome to Grapevine!',
                    'from_email' => 'support@kodex.in',
                    'from_name' => 'Grapevine',
                    'to' => array(
                      array(
                        'email' => $email,
                        'name' => 'Recipient Name',
                        'type' => 'to'
                        )
                      ),
                    'headers' => array('Reply-To' => 'message.reply@example.com'),
                    'important' => false,
                    'track_opens' => null,
                    'track_clicks' => null,
                    'auto_text' => null,
                    'auto_html' => null,
                    'inline_css' => null,
                    'url_strip_qs' => null,
                    'preserve_recipients' => null,
                    'view_content_link' => null,
                    'bcc_address' => 'message.bcc_address@example.com',
                    'tracking_domain' => null,
                    'signing_domain' => null,
                    'return_path_domain' => null,
                    'merge' => true,
                    'merge_language' => 'mailchimp',
                    'global_merge_vars' => array(
                      array(
                        'name' => 'merge1',
                        'content' => 'merge1 content'
                        )
                      ),
                    'merge_vars' => array(
                      array(
                        'rcpt' => 'recipient.email@example.com',
                        'vars' => array(
                          array(
                            'name' => 'merge2',
                            'content' => 'merge2 content'
                            )
                          )
                        )
                      )
                    );
$async = false;
$ip_pool = 'Main Pool';    
$result = $mandrill->messages->sendTemplate($template_name, $template_content, $message, $async, $ip_pool);

                    /*
                    Array
                    (
                        [0] => Array
                            (
                                [email] => recipient.email@example.com
                                [status] => sent
                                [reject_reason] => hard-bounce
                                [_id] => abc123abc123abc123abc123abc123
                            )
                    
                    )
                    */
} catch(Mandrill_Error $e) {
                    // Mandrill errors are thrown as exceptions
  echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
                    // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
  throw $e;
}




} 

} 
?>	