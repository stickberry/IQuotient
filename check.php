<?php

session_start();
include 'dbh.php';

$ans = $_POST['ans'];
$qname = $_POST['qname'];

$idd = $_SESSION['id'];
$sql = "SELECT uid from user WHERE id='$idd'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$username = $row['uid'];

$sql = "SELECT username from question WHERE qname='$qname'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$quid = $row['username'];

if($username == $quid) {
	header("Location:user.php?error=yourquery");
	exit();
}

if ($ans == 1 || $ans == 2 || $ans == 3 || $ans == 4)
{
	$sql = "SELECT copt FROM question WHERE qname='$qname'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$cans =  $row['copt'];

	$idd = $_SESSION['id'];
	$sql = "SELECT uid from user WHERE id='$idd'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$username = $row['uid'];

	if($ans == $cans) {

		$update = "UPDATE user SET score = score + 10, cans = cans + 1 where uid = '$username'";
		$result3 = mysqli_query($conn, $update);
		include 'rank.php';
		$insert = "INSERT INTO correct (quname, usid) VALUES ('$qname', '$username')";
		$result3 = mysqli_query($conn, $insert);

		$update = "UPDATE question SET solved = solved + 1 where qname = '$qname'";
		$result3 = mysqli_query($conn, $update);
		header("Location:user.php?correct");
		exit();
	} else {

		$update = "UPDATE user SET score = score - 3 where uid = '$username'";
		$result3 = mysqli_query($conn, $update);
		include 'rank.php';
		header("Location:user.php?wrong");
		exit();
	}

} else {
	header("Location:user.php?error=opt");
}
