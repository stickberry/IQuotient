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

$user = "SELECT qname FROM question WHERE qname = '$qname'";
$result = mysqli_query($conn, $user);
$qnamecheck = mysqli_num_rows($result);
if($qnamecheck > 0){
	;
} else {
	header("Location:profile.php?error=mqname");
	exit();
}

$idd = $_SESSION['id'];

$user = "SELECT uid FROM user WHERE id = '$idd'";
$result = mysqli_query($conn, $user);
$row = mysqli_fetch_assoc($result);
$cur_user = $row['uid'];

$user = "SELECT username FROM question WHERE qname = '$qname'";
$result = mysqli_query($conn, $user);
$row = mysqli_fetch_assoc($result);
$del_user = $row['username'];

if($opt1 == $opt2 || $opt1 == $opt3 || $opt1 == $opt4 || $opt2 == $opt3 || $opt2 == $opt4 || $opt3 == $opt4) {
	header("Location:profile.php?error=amopt");
	exit();
}

if($cur_user == $del_user ) {

	if($copt == 1 || $copt == 2 || $copt == 3 || $copt == 4) {
		$sql = "SELECT uid from user WHERE id='$idd'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$username = $row['uid'];

		$update = "UPDATE question SET 
				   ques = '$ques',
				   opt1 = '$opt1',
				   opt2 = '$opt2',
				   opt3 = '$opt3',
				   opt4 = '$opt4',
				   copt = '$copt'
				   WHERE qname='$qname'";
		$result3 = mysqli_query($conn, $update);
			
		header("Location: profile.php?msuccess");
    exit();
	} else {
		header("Location: profile.php?error=mcopt");
	  exit();
  }
} else {
	header("Location: profile.php?error=muser");
  exit();
}
