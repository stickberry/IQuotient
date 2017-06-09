<?php

session_start();
include 'dbh.php';

$pwd = $_POST['pwd'];
$npwd = $_POST['npwd'];
$ncpwd = $_POST['ncpwd']; 
$idd = $_SESSION['id'];

$sql = "SELECT * from user WHERE id='$idd'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$hash_pwd = $row['pwd'];
$hash = password_verify($pwd, $hash_pwd);

if($hash == 0) {

	//echo "Username or password is incorrect!";
	header("Location: change.php?error=old");
	exit();
}

$username = $row['uid'];
//$password = $row['pwd'];
/*
if ($password != $pwd) {
	header("Location: change.php?error=old");
	exit();
}
else
*/
if($ncpwd != $npwd) {
	header("Location: change.php?error=new");
	exit();
} else if(strlen($npwd) <6) {
	header("Location: change.php?error=length");
	exit();
} else {
	$encrypted_password = password_hash($npwd,PASSWORD_DEFAULT);
	$update = "UPDATE user SET pwd = '$encrypted_password', cpwd = '$encrypted_password' WHERE id = '$idd'";
	$result = mysqli_query($conn, $update);
	header("Location: change.php?success");
	exit();
}
