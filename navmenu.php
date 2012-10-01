<?php
  // Generate the navigation menu
  echo '<hr />';
  if (isset($_SESSION['username'])) 
  {
    echo '<a href="index.php">Home</a> &#10084; ';
    echo '<a href="">My Profile</a> &#10084; ';
    echo '<a href="popular_questions.php">Popular questions</a> &#10084; ';
    echo '<a href="ask_question.php">Ask QnA!</a> &#10084; ';
    echo '<a href=""></a> &#10084; ';
    echo '<a href="logout.php">Log Out (' . $_SESSION['username'] . ')</a>';
  }
  else 
  {
    echo '<a href="login.php">Log In</a> &#10084; ';
    echo '<a href="signup.php">Sign Up</a>';
  }
  echo '<hr />';
?>
