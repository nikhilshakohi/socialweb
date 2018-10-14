<?php

if (isset($_POST['submit'])) {
	
	include_once 'dbh.php';
/*
	$first = $_POST['first'];
	$last = $_POST['last'];
	$email = $_POST['email'];
	$uid = $_POST['uid'];
	$pwd = $_POST['pwd'];	
*/
	$first = mysqli_real_escape_string($conn, $_POST['first']);
	$last = mysqli_real_escape_string($conn, $_POST['last']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$uid = mysqli_real_escape_string($conn, $_POST['uid']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

	//error handlers
	//EMpty fields
	if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd)) {
		echo "<script>alert('Signup is Empty'); window.location.href='index.php?signup=empty';</script>";
		exit();
	} else {
		//input charecters validation
		if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
			echo "<script>alert('Enter valid charecters'); window.location.href='index.php?signup=invalid';</script>";
			exit();
		} else {
			//Email validation
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				echo "<script>alert('Enter valid email'); window.location.href='index.php?signup=email';</script>";
				exit();
			} else {
				$sql = "SELECT * FROM users WHERE user_uid='$uid'";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);

				if ($resultCheck > 0) {
					echo "<script>alert('User is taken'); window.location.href='index.php?signup=usertaken';</script>";
					exit();
				}
				else {
					//Hashing Password
					$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
					//Insert the user into the database
					$sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd) VALUES ('$first', '$last', '$email', '$uid', '$hashedPwd');";
					mysqli_query($conn, $sql);

					$sql = "SELECT * FROM users WHERE user_uid='$uid' AND user_first='$first'";
					$result = mysqli_query($conn, $sql);

					if (mysqli_num_rows($result) > 0) {
						while ($row = mysqli_fetch_assoc($result)) {
						$userid = $row['user_id'];
						$sql = "INSERT INTO profileimg (userid, status) VALUES ('$userid', 1)";
						mysqli_query($conn, $sql);
						echo "<script>alert('Signup Success...Login to continue'); window.location.href='index.php?signup=success';</script>";
						exit();
					}
					
				}
			}
		}
	}

}
} else {
	header("Location: header.php");
	exit();
}