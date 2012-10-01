<?php
	require_once('connectvars.php');
	require_once('startsession.php');
	require_once('header.php');
	require_once('navmenu.php');
	$err_msg = '';
	$show_form = 1;
	if (isset($_POST['submit']))
	{
		// don't display the form anymore
		$show_form = 0;
			
		// connect to the database.
		$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die('Error connecting to database.');

		// fetch the variables from post
		$tag1 = mysqli_real_escape_string($dbc,trim($_POST['tag1'])); 
		$tag2 = mysqli_real_escape_string($dbc,trim($_POST['tag2'])); 
		$tag3 = mysqli_real_escape_string($dbc,trim($_POST['tag3']));
		$question =  mysqli_real_escape_string($dbc,trim($_POST['question']));
		
		// no 2 tag fields should have the same tag
		if((($tag1 == $tag2) and (!empty($tag1))) or (($tag1 == $tag3) and (!empty($tag3))) or (($tag3 == $tag2) and (!empty($tag2))) or (empty($question)))
		{
			$err_msg = '<p>Please make sure that no 2 tag fields have the same value and question is not left blank.</p>';
			$show_form = 1;
		}
		
		else
		{
			// insert the tags in tags table, if already present, increase the count.
			$tags = array();	// an array to store all the tags
			array_push($tags,$tag1);
			array_push($tags,$tag2);
			array_push($tags,$tag3);
			foreach($tags as $tag => $value)
			{
				if(!empty($value))								// if tag1, tag2 etc are not empty
				{
						// check whether this tag already exists
						$query = "SELECT * FROM tags WHERE tag = '$value'";
						$data = mysqli_query($dbc,$query) or die('Error querying database 1st time.');
						if(mysqli_num_rows($data) == 0)
						{
							// tag does not exist => insert into the database
							$query1 = "INSERT INTO tags(tag,count) VALUES('$value', '1')";
							$data1 = mysqli_query($dbc,$query1) or die('Error querying database 2nd time');
						}
						else
						{	
							// tag already exists, => increase the tags count in the database
							$query1 = "UPDATE tags SET count =count+1 WHERE tag = '$value'";
							$data = mysqli_query($dbc,$query1) or die('Error querying database 3rd time.');
						}
				}
			}
		// insert the question in the database.
		$asker_id =  $_SESSION['SESS_MEMBER_ID'];
		$query2 = "INSERT INTO question_stats (question, asker_id) VALUES ('$question', '$asker_id')";
		$data2 = mysqli_query($dbc,$query2) or die('Error querying database 4th time.');
		echo '<h1>Congratulations!!</h1>';
		echo '<p>Your question has been posted. Please wait for a reply from the other awesome members of QnA. </p>';
		echo '<a href="index.php">Home</a>';
		}
	}
	if($show_form == 1)
	{
?>
<html>
	<h1> Ask your question</h1>
	<body>
		<p><?php echo $err_msg; ?></p>
		<form method="POST" action="<?php echo $_SERVER[PHP_SELF]; ?>">
			Tag 1<input type="text" name="tag1"/><br/><br/><br/>
			Tag 2<input type="text" name="tag2"/><br/><br/><br/>
			Tag 3<input type="text" name="tag3"/><br/><br/><br/>
			<textarea name="question"></textarea><br/><br/>
			<input type="submit" name="submit" value="Ask" />
		</form>
	</body>
</html>
<?php
}
?>
