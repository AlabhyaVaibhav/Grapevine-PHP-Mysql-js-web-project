<?php 
/**
* Well this wrapper deals with all photo related operations such as upload display edit etc
*/
  class grapevinePhotos

    {

      
      /**
      * Uploading user media such as an image post
      * @param - the array of uploaded file containing the name path size etc
      */
      public static function upload_user_media($upload_array)
      {

        
            $uploaded=array();
            $failed=array();
            $ctr=0;
            
            $allowed=array('jpg','jpeg','png');
            
              
              
                
                if ($upload_array['Upload']['error']==0)
                {
                $temp=$upload_array['Upload']['tmp_name'];

                $name=$upload_array['Upload']['name'];
                      
                $chars="abcdefghijklmnopqrstuvxyzABCDEFGHIJKLMNOPQRSTUVXYZ0123456789";
                $rand=substr(str_shuffle($chars),0,25);
                mkdir("userdata/media/$rand");
                  
                  $ext=explode('.',$name);
                        
                  
                  $ext=strtolower(end($ext));
                    $time=time();
                    $mtime=date("c", $time);
                
                //$userID=$_SESSION['userID'];
                $final_name=md5($temp).time().'.'.$ext;
                $name_insert=ROOT_SITE_COMPLETE.'Portals/userdata/media/'.$rand.'/'.$final_name;
                $post_insert='Portals/userdata/media/'.$rand.'/'.$final_name;
                if (in_array($ext,$allowed))
                {
                        $uploaded[]  = array('name' => $name );
                        if (move_uploaded_file($temp, "userdata/media/$rand/$final_name")==true)
                        {
                          
                          

                          grapevinePhotos::fix_android_iphone_imgs($post_insert);
                          grapevinePhotos::createMedium($post_insert);
                          grapevinePhotos::createThumb($post_insert);
                          
                          /*Create the sid*/
                          
                            

                        } 
                  
                }//End of Formats
                  
                
                  
                }//End od error check

                echo $post_insert;
                return $post_insert;

              




      }
      
      
      /**
      * The method for resizing image as thumbnail of dividing factor -45 , it will be used in various places where full res is not required .To reduce site load
      * @param - path of the image
      */
      
      public static function createThumb($path)
      {



                    
              $originalFile=$path;
              $imagex=explode(".",$originalFile);
              $check_array=array('jpg','jpeg');
              if (in_array($imagex[1],$check_array))
              {
                
                    $image=$originalFile;

              }
              else
              {

                
                $image=$imagex[0].".jpg";
                
                   $images = imagecreatefrompng($originalFile);
                    $ox=imagejpeg($images, $image,100);
              }
              
              
              
              $image_dims=getimagesize($image);
              $image_width=$image_dims[0];
              $image_height=$image_dims[1];
              $new_size=($image_width+$image_height)/($image_width*($image_height/45));
              $new_width=$image_width * $new_size;
              $new_height=$image_height * $new_size;
              $new_image = imagecreatetruecolor($new_width, $new_height);
              $old_image= imagecreatefromjpeg($image);

              imagecopyresampled ($new_image,$old_image,0,0,0,0,$new_width,$new_height,$image_width,$image_height);
              imagejpeg($new_image,$imagex[0].'_thumb.jpg');
              

          


      }

      /**
      * method for resizing an image into a normal medium size with dividing factoer 200 . almost full res
      * @param - path of the site
      */

      public static function createMedium($path)
      {



                    error_reporting(0);
              $originalFile=$path;
              $imagex=explode(".",$originalFile);
              $check_array=array('jpg','jpeg');
              if (in_array($imagex[1],$check_array))
              {
                
                    $image=$originalFile;
                  
              }
              else
              {

                
                $image=$imagex[0].".jpg";
                
                   $images = imagecreatefrompng($originalFile);
                    $ox=imagejpeg($images, $image,100);
              }
              
              
              
              
              
              $image_dims=getimagesize($image);
              $image_width=$image_dims[0];
              $image_height=$image_dims[1];
              $new_size=($image_width+$image_height)/($image_width*($image_height/205));
              $new_width=$image_width * $new_size;
              $new_height=$image_height * $new_size;
              $new_image = imagecreatetruecolor($new_width, $new_height);
              $old_image= imagecreatefromjpeg($image);

              imagecopyresampled ($new_image,$old_image,0,0,0,0,$new_width,$new_height,$image_width,$image_height);
              imagejpeg($new_image,$imagex[0].'_medium.jpg');
              

          


      }
      public static function fix_android_iphone_imgs($post_insert)
      {
              $originalFile=$post_insert;
              $path=$post_insert;
                  $imagex=explode(".",$originalFile);
                  $check_array=array('jpg','jpeg');
                  if (in_array($imagex[1],$check_array))
                  {
                    
                        $image=$originalFile;
                      
                  }
                  else
                  {

                    
                    $image=$imagex[0].".jpg";
                    
                       $images = imagecreatefrompng($originalFile);
                        $ox=imagejpeg($images, $image,100);
                  }

                $path=$image;       
                $image = imagecreatefromjpeg($path);
                  $exif = exif_read_data($path);

                  if (!empty($exif['Orientation']))
                   {
                    switch ($exif['Orientation']) {
                      case 3:
                        $image = imagerotate($image, 180, 0);
                         break;
                      case 6:
                        $image = imagerotate($image, -90, 0);
                        
                        break;
                      case 8:
                        $image = imagerotate($image, 90, 0);
                        
                        break;
                    }
                  }
                    else
                    {
                      
                    }
                    imagejpeg($image, $path);


      }
      

      }


?>