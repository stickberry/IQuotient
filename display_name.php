<?php 
        
include 'dbh.php';

	$idd = $_SESSION['id'];
    $sql = "SELECT * FROM user WHERE id = '$idd'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    echo "<li><a href = 'profile.php'> ".$row['uid']."<i class='material-icons right'>person</i></a></li>";
      
