<?php 

include 'includes/bootstrap.php';
if($_GET['code']!="0215")
{
	die("Admin access only");

}

$query=DB::getInstance()->query("SELECT * FROM `users` WHERE 1 ORDER BY id DESC");
echo "<pre>";

print_r($query->results());
echo "</pre>";

?>