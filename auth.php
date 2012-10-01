<?php
	// Start Session 
	session_start();
	
	// Check whether SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['username']) || trim($_SESSION['SESS_MEMBER_ID']) == '')
	{
		header('Location: access-denied.html');
		exit();
	}
?>
