<?php

session_start();
include 'dbh.php';

$ans = mysqli_real_escape_string($conn, $_POST['ans']);
$qname = mysqli_real_escape_string($conn, $_POST['qname']);

$idd = $_SESSION['id'];
$sql = "SELECT uid from user WHERE id='$idd'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$username = $row['uid'];

$sql = "SELECT username from question WHERE qname='$qname'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$quid = $row['username'];

if ($ans == 1 || $ans == 2 || $ans == 3 || $ans == 4)
{
	$sql = "SELECT * FROM question WHERE qname='$qname'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);

	$hash_copt = $row['copt'];
	$hash = password_verify($ans, $hash_copt);

	$idd = $_SESSION['id'];
	$sql = "SELECT uid from user WHERE id='$idd'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$username = $row['uid'];

	if($hash != 0) {

		$update = "UPDATE user SET score = score + 10, cans = cans + 1 where uid = '$username'";
		$result3 = mysqli_query($conn, $update);
		include 'rank.php';
		$insert = "INSERT INTO correct (quname, usid) VALUES ('$qname', '$username')";
		$result3 = mysqli_query($conn, $insert);

		$update = "UPDATE question SET solved = solved + 1 where qname = '$qname'";
		$result3 = mysqli_query($conn, $update);
		echo "<span class = 'green-text result col s6 offset-s1'> Correct answer. +10 points. </span>";
	} else {

		$update = "UPDATE user SET score = score - 3 where uid = '$username'";
		$result3 = mysqli_query($conn, $update);

		$stmt = $conn->prepare("SELECT * FROM attempt WHERE uid = ? AND qname = ?");
		$stmt->bind_param("ss", $username, $qname);
		$stmt->execute();
		$result = $stmt->get_result();
		$rowNum = $result->num_rows;

		if($rowNum <1) {
			$insert =  "INSERT INTO attempt (qname, uid, try) VALUES ('$qname', '$username', 1)";
			$result6 = mysqli_query($conn, $insert);
			include 'rank.php';

		echo "<span class = 'red-text result col s6'> &emsp; &emsp; &emsp; Wrong answer. -3 points. 1 try left. </span>";
			
		} else {
			$update = "UPDATE attempt SET try = 2, status = 1 WHERE uid = '$username' AND qname = '$qname' ";
			$result = mysqli_query($conn, $update);
			include 'rank.php';
			echo "we";
			
		}
	}

} else {
	echo "<span class = 'red-text result col s6 offset-s1'> Invalid answer. Try again. </span>";
}
