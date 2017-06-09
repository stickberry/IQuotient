<?php

include 'dbh.php';

$idd = $_SESSION['id'];
$sql = "SELECT * FROM user WHERE id = '$idd'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

echo "<li class='collection-item'>Questions Contributed  <span class='badge'>".$row['qno']."</span></li>
<li class='collection-item'>Correct Answers <span class='badge'>".$row['cans']."</span></li>
<li class='collection-item'>Rank<span class='badge'>".$row['rank']."</span></li>";
