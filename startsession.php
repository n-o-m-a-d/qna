<?php
	// Start the session
	session_start();
	
	// If user is not logged in via session, try logging in with cookies
	if(!isset($_SESSION['username']) || !isset($_SESSION['SESS_MEMBER_ID']))
	{
		if(isset($_COOKIE['user']) and isset($_COOKIE['userid']))
		{
			$_SESSION['username'] = $_COOKIE['user'];
			$_SESSION['SESS_MEMBER_ID'] = $_COOKIE['userid'];
		}
	}
?>
