<?php
	session_start();

include 'dbh.php';

if (!$conn) {
 die(' Connection failed ');
}


$uid = mysqli_real_escape_string($conn, $_POST['uid']);
$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);


$sql = "SELECT * FROM user WHERE uid = '$uid' "; 
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$hash_pwd = $row['pwd'];
$hash = password_verify($pwd, $hash_pwd);

if($hash == 0) {

	echo "Username or password is incorrect!";
	header("Location: index.php?error=mismatch");
	exit();
}

$sql = "SELECT * FROM user where uid='$uid' AND pwd='$hash_pwd'"; 
$result = mysqli_query($conn, $sql);


if(!$row = mysqli_fetch_assoc($result)) {

	echo "Username or password is incorrect!";
	header("Location: index.php?error=mismatch");
} else {
	$_SESSION['id'] = $row['id'];
	header("Location: user.php");
}
