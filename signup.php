<?php
	// Start the session
	require_once('startsession.php');
	require_once('connectvars.php');
	
	$showform = '';			// variable to decide when to make the form visible
	
	// If logged in as another user, then don't allow sign-up.
	if(isset($_SESSION['SESS_MEMBER_ID']))
	{
		echo '<p>You are logged in as '.$_SESSION['username'].'. Please <a href=\'logout.php\'>log out</a> to sign-up for another account.</p>';
		exit();
	}
	
	$err_msg = '';
	
	if(isset($_POST['submit']))
	{
	// Connect to the database
	$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die('Error connecting to database');
		
	// Grab the variables from POST array
	if(@get_magic_quotes_gpc())																// always check for this before mysqli_real_escape_string
	{
		$_POST['username'] = stripslashes($_POST['username']);
		$_POST['password'] = stripslashes($_POST['password']);
		$_POST['repass'] = stripslashes($_POST['repass']);
	}
	$username = mysqli_real_escape_string($dbc,trim($_POST['username']));
	$password = mysqli_real_escape_string($dbc,trim($_POST['password']));
	$repass = mysqli_real_escape_string($dbc,trim($_POST['repass']));
	

	// Check if username and password are not empty
	if(!empty($username) && !empty($password))
	{
		// Check if the username is unique
		$query = "SELECT * FROM user_info WHERE username = '$username'";
		$data = mysqli_query($dbc,$query) or die('Error querying database for the first time.');

		if(mysqli_num_rows($data) == 0)
		{// username is unique
			if($password == $repass)
			{// Insert the data into the table
				$querys = "INSERT INTO user_info (username,password) VALUES ('$username',SHA('$password'))";
				$data2 = mysqli_query($dbc,$querys) or die('Error querying database for the second time');
				echo '<p>QUERY COMPLETED</p>';
			}
			else
			{
				$err_msg = '<p>Passwords in both fields do not match</p>';
			}
		}
		else
		{
			$err_msg = '<p>This username has already been taken. Please choose a different username.</p>';
			echo $err_msg;
			$err_msg = '';
			$showform = 1;			// keep showing the form as new username has to be entered
		}
	}
	else
	{
		$err_msg = '<p>Please fill in all the fields to continue.</p>';
	} 
	if($err_msg == '' and $showform != 1)
	 {
	 	echo '<p>Congratulations! You have successfully signed up at QnA.</p>';
	 	echo	 '<p>Please <a href="login.php">Login</a> to continue.';
	 	$showform = 2;																					// Do NOT show the form again
	 }
	 else
	 {
	 	echo $err_msg;
	 }
	}
if(empty($showform) or $showform == 1)
{
?>

<html>
	<head>
        <script type="text/javascript" src="check.js"></script>
		<title>Sign Up</title>
		<meta charset="UTF-8" />
		<meta name="Designer" content="Piyush Madan">
		<meta name="Author" content="Piyush Madan">
		<link rel="stylesheet" type="text/css" href="css/reset.css">
		<link rel="stylesheet" type="text/css" href="css/structure.css">
	</head>

	<body onload="process()">
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="box login">
			<fieldset class="boxBody">
	  			<label>Username</label>
                <input type="text" name="username" tabindex="1" id="username" value = "<?php if(isset($username)) {echo $username;} ?>"placeholder="e.g. John" required>

	  	  		<label>Password</label>
	  	  		<input type="password" name="password" tabindex="1" required>
	  	  		<label>Re-enter Password</label>
	  	  		<input type="password" name="repass" tabindex="1" required>
	  	  		<input type="submit" name="submit" class="btnLogin" value="Send confirmation mail" tabindex="4">
                <span id="check" class="rLink">
			</fieldset>
		</form>
	</body>
</html>

<?php
}
?>



