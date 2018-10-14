<?php
include_once "header.php";
include_once "dbh.php";

if (isset($_POST['submitcomments'])) {
		$imageidnum = $_POST['imageid'];
		$message = $_POST['comment'];
		$date = $_POST['date'];
		$uid = $_POST['usernum'];
		$firstname = $_SESSION['u_first'];
		$lastname = $_SESSION['u_last'];
		$fullname = ucfirst($firstname)."&nbsp;".ucfirst($lastname);
		
		$sql = "INSERT INTO comments (userid, date, message, firstname, imageid) VALUES ('$uid', '$date', '$message', '$fullname', '$imageidnum')";
		$result = mysqli_query($conn, $sql);
		echo "Your comment is placed succesfully...";
	?>	<button onclick='window.location.href="index.php"'> Home </button>	<?php	
}

if (isset($_POST['editcomments'])) {
	$id = $_POST['id'];
	$firstname = $_POST['firstname'];
	$date = $_POST['date'];
	$message = $_POST['message'];
/*	foreach ($_POST as $fullmessage => $value) { $_POST[$fullmessage] = $value; } 
*/
	echo "<form method='POST' action='comments.php'>
		<input type='hidden' name='id' value= '".$id."'>
		<input type='hidden' name='firstname' value= '".$firstname."'>
		<input type='hidden' name='date' value= '".$date."'>
		<textarea name='message'>".urldecode($message)."</textarea><br>
		<button type='submit' name='editedcommentssubmit'>Edit</button>
	</form>";
}

if (isset($_POST['editedcommentssubmit'])) {
	$id = $_POST['id'];
	$firstname = $_POST['firstname'];
	$date = $_POST['date'];
	$message = $_POST['message'];
	
		$sql = "UPDATE comments SET message='$message' WHERE id='$id'";
		$result = mysqli_query($conn, $sql);
		echo "Your comment is edited succesfully...";
	?>	<button onclick='window.location.href="index.php"'> Home </button>	<?php	
	
}

if (isset($_POST['deletecomments'])) {
	$id = $_POST['id'];

	$sql = "DELETE FROM comments WHERE id='$id'";
	$result = mysqli_query($conn, $sql);
	echo "Your comment is deleted succesfully...";
	?>	<button onclick='window.location.href="index.php"'> Home </button>	<?php	

}

if (isset($_POST['deleteimage'])) {
	$id = $_POST['imageid'];
	
	$sqlimage = "DELETE FROM images WHERE id='$id'";
	$sqlcomments = "DELETE FROM comments WHERE imageid='$id'";
	$resultimage = mysqli_query($conn, $sqlimage);
	$resultcomments = mysqli_query($conn, $sqlcomments);
	echo "Your image is deleted succesfully...";
	?>	<button onclick='window.location.href="index.php"'> Home </button>	<?php	


}