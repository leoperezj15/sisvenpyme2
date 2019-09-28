<?php
session_destroy();
if ( !isset($_SESSION["ACL"]) )
{
	header("Location:index.php");
    //require_once "control/c-login.php";
}
else
{
	header("Location:index.php");
}

?>