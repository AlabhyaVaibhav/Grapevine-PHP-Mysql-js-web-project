<?php 

 class grapevineTeacher
 {


 	/**
	* @param post array of the tid,file etc 
 	*/
 	public static function create_assignment($post_array,$file_array)
 	{

 			$teacherID=$post_array['tid'];
 			$message=array();
 			$message[0]=false;
 			
 			$topic=$post_array['topic'];
 			$subject=$post_array['subject'];
 			$batch=$post_array['batch'];
 			if(!$topic)
 			{
 				$message[1]="Please enter a topic";
 				return $message;

 			}
 			if(!$subject)
 			{
 				$message[1]="Please enter a subject";
 				return $message;
 			}
 			if(!$teacherID)
 			{
 				$message[1]="Please enter a teacher id";
 				return $message;
 			}
 			if(strlen($batch)<=3)
 			{
 				$batch[0]=strtoupper($batch[0]);
 				if(is_numeric($batch[1])&&is_numeric($batch[2]))
 				{
 					//return true;
 				}
 				else
 				{
 					$message[1]="Please enter a valid batch eg B20";
 					return $message;
 				}
 			}
 			else
 			{
 				//Multiple Batch Upload
 				$batch_arrays=explode(",",$batch);
 				foreach ($batch_arrays as $key => $batchs) {
 					$batchs[0]=strtoupper($batchs[0]);
 				if(is_numeric($batchs[1])&&is_numeric($batchs[2]))
 				{
 					//return true;
 				}
 				else
 				{
 					$key=$key+1;
 					$message[1]="Please enter a valid batch eg B20 for batch no. ".$key;
 					return $message;
 				}
 					
 				}
 			}
 			
 			if(empty($file_array))
 			{
 				
 				$message[1]="Please upload a file ";
 				return $message;
 			}

 			if(grapevineTeacher::authenticate_teacher($teacherID))
 				{	
 						$uid=grapevineTeacher::upload_file($file_array);
 						$batch_array=explode(",", $batch);
 						if(sizeof($batch_array)>1)
 						{
 							foreach ($batch_array as $key => $value) {
			 								$query=DB::getInstance()->insert("assignements",array(

										
										't_id'    =>$teacherID,
										'batch_name'=>$value,//Main Version Has This hashed
										'subject'   =>$subject,
										'topic'    =>$topic,
										'desc'    =>$post_array['extra'],
										'date'    =>time(),
										'file_uid'=>$uid

											));
 								
 							}
 						}
 						else
 						{
 						  $query=DB::getInstance()->insert("assignements",array(

							
							't_id'    =>$teacherID,
							'batch_name'=>$batch,//Main Version Has This hashed
							'subject'   =>$subject,
							'topic'    =>$topic,
							'desc'    =>$post_array['extra'],
							'date'    =>time(),
							'file_uid'=>$uid

								));
 						}
 				}	
 				else
 				{
 					$message[1]="Please enter a valid teacher id";
 					return $message;
 				}
 				$message[0]=true;
 				return $message;
 	}	
 	public static function authenticate_teacher($tid)
 	{
 		//Algorithm to verify teacher goes here
 		return true;
 	}
 	public static function upload_file($upload_array)
 	{

 		$uploaded=array();;
						$failed=array();;
						$ctr=0;
						
							
								
								
								$temp=$upload_array['Upload']['tmp_name'];

								$name=$upload_array['Upload']['name'];
											
								$chars="abcdefghijklmnopqrstuvxyzABCDEFGHIJKLMNOPQRSTUVXYZ0123456789";
						 		$rand=substr(str_shuffle($chars),0,25);
						 		mkdir("userdata/assignments/$rand");
									
									$ext=explode('.',$name);
												
									
									$ext=strtolower(end($ext));
									  $time=time();
						        $mtime=date("c", $time);
								
								//$userID=$_SESSION['userID'];
								$final_name=md5($temp).time().'.'.$ext;
								$name_insert=ROOT_SITE_COMPLETE.'userdata/assignments/'.$rand.'/'.$final_name;
								$post_insert='userdata/assignments/'.$rand.'/'.$final_name;
								
												$uploaded[] = array('name' => $name );
												if (move_uploaded_file($temp, "userdata/assignments/$rand/$final_name")==true)
												{
													
													

													
													
													/*Create the sid*/
													
														

												}	
									
								
								
								return $post_insert;
												
								


 	}
 }

?>