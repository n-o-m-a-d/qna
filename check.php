<?php    
    require_once('connectvars.php');
    
    $username = $_GET['username'];

    $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die('Error connecting to database');
    
    $query = "SELECT * FROM user_info WHERE username = '$username'";
    $data = mysqli_query($dbc,$query) or die('Error querying database.');

    if(mysqli_num_rows($data) != 0){                // username already exists
        echo 'Username not available';
    }
    else{
        echo 'Username available';
    }

?>
