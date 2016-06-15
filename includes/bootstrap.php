<?php

//Inlcude config File
require_once(dirname(__FILE__) . "/config.php");

//Auto Load Classes Here

function __autoload($className)
{
   
        include "classes/class.". $className . ".php";
       
}



session_start();// The Only Place In the Whole Document Where this line comes in



/*set_error_handler("customError");*/




date_default_timezone_set("Asia/Kolkata");//INDIA --- :)
?>