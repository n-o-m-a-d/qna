<?php
	require_once('connectvars.php');
	require_once('startsession.php');
	require_once('header.php');
	require_once('navmenu.php');
	
	if(isset($_SESSION['SESS_MEMBER_ID']))
	{
		$user_id = $_SESSION['SESS_MEMBER_ID'];
		// show the questions followed by the user.
		
		// Connect to the database
		$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die('Error connecting to database');
		
		// Extract the questions followed by the user
		$query = "SELECT qs.qid, qs.question,qs.votes FROM user_info AS ui INNER JOIN questions_followed AS qf USING (user_id) INNER JOIN question_stats AS qs  USING (qid) WHERE ui.user_id = '$user_id' ORDER BY qs.votes DESC, qs.time DESC";
		$data = mysqli_query($dbc,$query) or die('Error querying database.');
		
		// if user hasn't followed any question, show him the popular questions.
		if(mysqli_num_rows($data) == 0)
		{
			echo '<p>You have not followed any question yet.</p>';
			echo '<p>Here\'s a list of <a href="popular_questions.php">popular questions</a> that you may like.';
		}
		
		// Display the questions along with tags and number of votes
		else
		{
			while($row = mysqli_fetch_array($data))
			{
				$question = $row['question'];
				$votes = $row['votes'];
								
				if(!empty($row['qid']))
				{
					echo "<p>Votes: $votes Question: $question</p>";
				}
			}
		}
	}
	else
	{
		require_once('popular_questions.php');		
	}
?>
