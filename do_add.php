<?php

session_start();
include 'dbh.php';

$qname = mysqli_real_escape_string($conn, $_POST['qname']);
$ques = mysqli_real_escape_string($conn, $_POST['ques']);
$opt1 = mysqli_real_escape_string($conn, $_POST['opt1']);
$opt2 = mysqli_real_escape_string($conn, $_POST['opt2']);
$opt3 = mysqli_real_escape_string($conn, $_POST['opt3']);
$opt4 = mysqli_real_escape_string($conn, $_POST['opt4']);
$copt = mysqli_real_escape_string($conn, $_POST['copt']);
$date = date("Y-m-d");

$idd = $_SESSION['id'];

$sql = "SELECT qname FROM question WHERE qname='$qname'";
$result = mysqli_query($conn, $sql);
$qnamecheck = mysqli_num_rows($result);
if($qnamecheck > 0){
	header("Location:profile.php?error=aqname");
	exit();
}

if($opt1 == $opt2 || $opt1 == $opt3 || $opt1 == $opt4 || $opt2 == $opt3 || $opt2 == $opt4 || $opt3 == $opt4) {
	header("Location:profile.php?error=aopt");
	exit();
}

if($copt == 1 || $copt == 2 || $copt == 3 || $copt == 4) {

	$sql = "SELECT uid from user WHERE id='$idd'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$username = $row['uid'];

	$encrypted_copt = password_hash($copt,PASSWORD_DEFAULT);
	$query = "INSERT INTO question (qname, ques, opt1, opt2, opt3, opt4, copt, date, username)
	        VALUES ('$qname', '$ques', '$opt1', '$opt2', '$opt3', '$opt4', '$encrypted_copt', '$date', '$username')";
	$result2 = mysqli_query($conn, $query);

	$update = "UPDATE user SET qno = qno + 1 where uid = '$username'";
	$result3 = mysqli_query($conn, $update);

	header("Location:profile.php?asuccess");
} else {
	header("Location:profile.php?error=acopt");
}
