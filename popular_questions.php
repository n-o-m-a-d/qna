<?php
	// add the feature that only that questions show up in here that the user is not following
	// add the feature that when user clicks on follow for a particular question, that question disappears from this list and features in followed questions.
	require_once('startsession.php');
	require_once('header.php');
	require_once('navmenu.php');
	require_once('connectvars.php');

	// connect to the database
	$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die('Error connecting to database.');
	
	if(isset($_POST['submit']))
	{
		$qid = $_POST['to_follow'];
		$followerid = $_SESSION['SESS_MEMBER_ID'];
		
		// check if not already following
		$query1 = "SELECT * FROM questions_followed WHERE user_id = '$followerid' AND qid = '$qid'";
		$data1 = mysqli_query($dbc,$query1) or die('Error checking whether question is already followed.');
		if(mysqli_num_rows($data1) == 0)
		{	
			$query2 = "INSERT INTO questions_followed(user_id,qid) VALUES ('$followerid','$qid')";
			$data2 = mysqli_query($dbc,$query2) or die('Error following the question.');
		}
		else
		{
			// question already followed.
			echo '<p>Question is already being followed.</p>';
		}
	}
	
	// fetch the questions in decreasing order of their votes
	// display top 10 popular questions.
	// HERE ORDERING HAS TO BE DONE BY TIMESTAMP AS WELL
	$query = "SELECT * FROM question_stats ORDER BY votes DESC, time DESC LIMIT 10";
	$data = mysqli_query($dbc,$query) or die('Error querying database.');
	
	// display the questions
	while($row = mysqli_fetch_array($data))
		{
			$question = $row['question'];
			$votes = $row['votes'];
			
			if(!empty($row['qid']))
			{
				echo "<p>Votes: $votes Question: $question</p>";
				if (isset($_SESSION['SESS_MEMBER_ID']))
				{
?>
					<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<input type="hidden" name="to_follow" value="<?php echo $row['qid']; ?>">
					<input type="submit" name="submit" value="Follow">
					</form>
<?php
				}
			}
		}
?>
