<?php 

session_start();

date_default_timezone_set('Asia/Calcutta');

if (isset($_POST['submit'])) {
	
	include 'dbh.php';
/*
	$uid = $_POST['uid'];
	$pwd = $_POST['pwd'];	
*/
	$uid = mysqli_real_escape_string($conn, $_POST['uid']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

	//Error Handlers
	//empty inputs
	if (empty($uid) || empty($pwd)) {
		echo "<script>alert('Login is Empty'); window.location.href='index.php?login=empty';</script>";
		exit();
	} else {
		$sql = "SELECT * FROM users WHERE user_uid='$uid' OR user_email = '$uid'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck < 1) {
			echo "<script>alert('Wrong credentials'); window.location.href='index.php?errornousers';</script>";
		exit();
		} else {
			if ($row = mysqli_fetch_assoc($result)) {
				//Dehashing the password
				$hashedPwdCheck = password_verify($pwd, $row['user_pwd']);
				if ($hashedPwdCheck == false) {
					echo "<script>alert('Username or password is wrong'); window.location.href='index.php?errpwd';</script>";
					exit();
				} elseif ($hashedPwdCheck == true) {
					//Log in the user here
					$_SESSION['u_id'] = $row['user_id'];
					$_SESSION['u_first'] = $row['user_first'];
					$_SESSION['u_last'] = $row['user_last'];
					$_SESSION['u_email'] = $row['user_email'];
					$_SESSION['u_uid'] = $row['user_uid'];
					$useridval = $row['user_id'];
					$date = date('Y-m-d H:i:s');
					$sqldate = "INSERT INTO logintime (userid, date) VALUES ('$useridval', '$date')";
					mysqli_query($conn, $sqldate);
					echo "<script>alert('Login Success...'); window.location.href='index.php?login=success';</script>";
					exit();
				}
			}
		}
	}
} else {
		header("Location: index.php?login=error");
		exit();
	}