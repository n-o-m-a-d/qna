<?php
	// start the session
	session_start();
	
	// if user is logged into session, delete session variables
	if(isset($_SESSION['SESS_MEMBER_ID']))
	{
		$_SESSION = array();
		
		// Delete session cookie
		if(isset($_COOKIE[session_name()]))
		{
			setcookie(session_name(),'',time()-3600);
		}
		
		// Destroy the session
		session_destroy();
	}
	if(isset($_COOKIE['user']))
	{setcookie('user','',time()-3600);
	setcookie('userid','',time()-3600);}
	
	// Redirect to the login page
	$homepage = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/login.php';
	header('location: '.$homepage);
?>
