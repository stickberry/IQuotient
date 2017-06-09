<?php

session_start();
include 'dbh.php';

$uid = mysqli_real_escape_string($conn, $_POST['uid']);
$email = $_POST['email'];
$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
$cpwd = mysqli_real_escape_string($conn, $_POST['cpwd']);
$first = $_POST['first'];
$last = $_POST['last'];

$sql = "SELECT uid FROM user WHERE uid='$uid'";
$result = mysqli_query($conn, $sql);
$uidcheck = mysqli_num_rows($result);

$sql = "SELECT email FROM user WHERE email='$email'";
$result = mysqli_query($conn, $sql);
$emailcheck = mysqli_num_rows($result);

if ($uidcheck > 0) {
	header("Location:index.php?error=username");
	exit();
} else if ($emailcheck > 0) {
	header("Location:index.php?error=email");
	exit();
} else if($pwd != $cpwd) {
	header("Location:index.php?error=pwdmatch");
	exit();
} else if (strlen($uid) < 6){
	header("Location:index.php?error=uidlength");
	exit();
} else if (strlen($pwd) < 6) {
	header("Location:index.php?error=pwdlength");
	exit();
}
else {
 	$encrypted_password = password_hash($pwd,PASSWORD_DEFAULT);
	$sql = "INSERT INTO user (email,uid, pwd, cpwd,qno,score,rank,cans, first,last)
        VALUES ('$email', '$uid', '$encrypted_password', '$encrypted_password',0,0,0,0, '$first','$last')";
	$result = mysqli_query($conn, $sql);
	header("Location: index.php?success");
}

	
