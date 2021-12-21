<?php
session_start();
if(isset($_SESSION['socialsite_userid']))
{
	$_SESSION['socialsite_userid'] = NULL;
	unset($_SESSION['socialsite_userid']);
}



header("Location: login.php");
die;