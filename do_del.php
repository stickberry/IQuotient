<?php

session_start();
include 'dbh.php';

$qname = $_POST['qname'];
$idd = $_SESSION['id'];

$user = "SELECT qname FROM question WHERE qname = '$qname'";
$result = mysqli_query($conn, $user);
$qnamecheck = mysqli_num_rows($result);
if($qnamecheck > 0){
	;
} else {
	header("Location:profile.php?error=dqname");
	exit();
}

$user = "SELECT uid FROM user WHERE id = '$idd'";
$result = mysqli_query($conn, $user);
$row = mysqli_fetch_assoc($result);
$cur_user = $row['uid'];

$user = "SELECT username FROM question WHERE qname = '$qname'";
$result = mysqli_query($conn, $user);
$row = mysqli_fetch_assoc($result);
$del_user = $row['username'];

if($cur_user == $del_user || $cur_user === "elaine") {

	$sql = "SELECT uid from user WHERE id='$idd'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$username = $row['uid'];

	$query = "DELETE FROM question WHERE qname='$qname'";
	$result2 = mysqli_query($conn, $query);


	$update = "UPDATE user SET qno = qno - 1 where uid = '$username'";
	$result3 = mysqli_query($conn, $update);

	header("Location:profile.php?dsuccess");
} else {
	header("Location:profile.php?error=duser");
	exit();
}
