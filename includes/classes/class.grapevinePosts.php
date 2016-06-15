<?php


class grapevinePosts
{


	/**
	* Search Posts
	*/
	public static function search_posts($q)
	{
		

		$queryAll=DB::getInstance()->query("SELECT * FROM assignements WHERE `topic` LIKE '%$q%'  UNION  SELECT * FROM assignements WHERE `subject` LIKE '%$q%' UNION  SELECT * FROM assignements WHERE `batch_name` LIKE '%$q%'");
		
		if($queryAll->rowCount())
		{
				return $queryAll->results();
				
		}
		else
		{
			return -1;
		}	
	}
	public static function get_posts()
	{
		$query=DB::getInstance()->query("SELECT * FROM assignements WHERE batch_name= ? ORDER BY id DESC LIMIT 5",array(grapevineUser::get_val($_SESSION['userID'],"batch")));
	
		return $query->results();
	}
	public static function file_return($url)
	{
		$file=explode(".",$url);
		$file=array_reverse($file);
		return $file[0];
	}
}

?>