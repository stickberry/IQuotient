<?php

session_start();
include 'dbh.php';

$qname = $_POST['qname'];
$ques = $_POST['ques'];
$opt1 = $_POST['opt1'];
$opt2 = $_POST['opt2'];
$opt3 = $_POST['opt3'];
$opt4 = $_POST['opt4'];
$copt = $_POST['copt'];
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

	$query = "INSERT INTO question (qname, ques, opt1, opt2, opt3, opt4, copt, date, username)
	        VALUES ('$qname', '$ques', '$opt1', '$opt2', '$opt3', '$opt4', '$copt', '$date', '$username')";
	$result2 = mysqli_query($conn, $query);

	$update = "UPDATE user SET qno = qno + 1 where uid = '$username'";
	$result3 = mysqli_query($conn, $update);

	header("Location:profile.php?asuccess");
} else {
	header("Location:profile.php?error=acopt");
}
