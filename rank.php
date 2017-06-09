<?php

include 'dbh.php';

$sql = "SELECT * FROM user ORDER BY score DESC";
$result = mysqli_query($conn, $sql);
$counter = 0;

 while($row = mysqli_fetch_assoc($result)) {

 	$cur_id = $row['id'];
 	if($row['score'] == 0)
 		$query = "UPDATE user SET rank = 0 WHERE id = '$cur_id'";
 	else {
 		$counter = $counter + 1;
 		$query = "UPDATE user SET rank = '$counter' WHERE id = '$cur_id'";
 		//echo $query;
 		$result3 = mysqli_query($conn, $query);
 	}
 }
