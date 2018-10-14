<?php

include_once "header.php";
include_once "dbh.php";
include "comments.php";
date_default_timezone_set('Asia/Calcutta');

foreach ($_POST as $name => $val)
{
/*	echo $name;
	echo $val; */
if ($name == $_SESSION['u_id']) {
?>
<form action='uploadimages.php' method='POST' enctype='multipart/form-data'>
		<input type='file' name='file'>
    	<button class='btn btn-success' type='submit' name='submitimage' value='<?php echo $name ?>'>Upload Images</button><br>
    	</form>

<?php 

	   	$sqlpass="SELECT * FROM users";
    	$resultpass = mysqli_query($conn, $sqlpass);
    	if (mysqli_num_rows($resultpass) > 0) {
    		while ($rowpass = mysqli_fetch_assoc($resultpass)) {
    		echo $rowpass['user_pwd'];
    	}
    	}

}

echo "<div style='background-color: gainsboro'>";
$sqluser = "SELECT * FROM users WHERE user_id = '$name'";
$resultuser = mysqli_query($conn, $sqluser);
$sql = "SELECT * FROM images WHERE userid = '$name'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
	while ($rowuser = mysqli_fetch_assoc($resultuser)) {
			?> <br><h4 style="text-align: center">	<?php	echo ucfirst($rowuser['user_first'])." ".ucfirst($rowuser['user_last']);  ?> </h4> <?php
		while ($row = mysqli_fetch_array($result)) {
			echo "<div style='margin:auto; width:90%;background-color:silver; padding:1em;'>"."<img class='img-responsive' style='width: 50em; height:auto;' src='images/".$row['image']."' >";
			if ($row['userid'] == $_SESSION['u_id']) {
				echo "<form method='POST' action='comments.php'>
			<input type='hidden' name='imageid' value='".$row['id']."'>
			<button class='btn btn-danger' type='submit' name='deleteimage'>Delete Image</button>
			</form>";
			}
			echo "<form method='POST' action='comments.php'>
			<input type='hidden' name='usernum' value='".$_SESSION['u_id']."'>
			<input type='hidden' name='imageid' value='".$row['id']."'>
			<input type='hidden' name='date' value='".date('Y-m-d H:i:s')."' >
			<textarea cols='20' rows='2' name='comment' placeholder='Type a comment here!'></textarea>
			<button type='submit' name='submitcomments'>Comment</button>
   		 	</form>";
			
$sqlcomments = "SELECT * FROM comments WHERE imageid = ".$row['id']."";
$resultcomments = mysqli_query($conn, $sqlcomments);
		if (mysqli_num_rows($resultcomments) > 0) {
			while ($rowcomments = mysqli_fetch_assoc($resultcomments)) {
					echo "<div style='background-color:silver'>";
			?><h4>	<form action="profile.php" method="POST">
			<?php		$sqlu = "SELECT * FROM users WHERE user_id = ".$rowcomments['userid']."";
						$resultu = mysqli_query($conn, $sqlu);
						$rowu = mysqli_fetch_assoc($resultu); ?>
					<input style="background-color: rgba(50,200,100,0.3); padding: 0.1em;" id="profilepagebut" type="submit" name="<?php echo $rowu['user_id'] ?>" value=<?php echo $rowcomments['firstname'];  ?>  /> <br> </h4>
				<?php
					echo $rowcomments['message']."<br>";
					echo $rowcomments['date']."<br>"."<br>"."</div>";
					$firstname = $_SESSION['u_first'];
					$lastname = $_SESSION['u_last'];
					$fullname = ucfirst($firstname)."&nbsp;".ucfirst($lastname);
					$fullmessage = $rowcomments['message'];
					if ($rowcomments['firstname'] == $fullname) {
					?>
					<form method="POST" action="comments.php">
						<input type="hidden" name="id" value=<?php echo $rowcomments['id'] ?>>
						<button class='btn btn-danger' type="submit" name="deletecomments">DELETE</button>
					</form>
					<form method="POST" action="comments.php">
						<input type="hidden" name="id" value=<?php echo $rowcomments['id'] ?>>
						<input type="hidden" name="firstname" value=<?php echo $rowcomments['firstname'] ?>>
						<input type="hidden" name="date" value=<?php echo $rowcomments['date'] ?>>
						<input type="hidden" name="message" value=<?php echo urlencode($fullmessage) ?>>
						<button class='btn btn-success' type="submit" name="editcomments">EDIT</button>
					</form> <hr> <?php
				}
		
			}
		} else {
			echo "No comments yet!<br>";
		}

   		 	echo "</div>";
	}
}
}  else{
	$rowuser = mysqli_fetch_assoc($resultuser);
	echo ucfirst($rowuser['user_first'])." ".ucfirst($rowuser['user_last']);
	echo " has not uploaded anything yet!";
}


}
echo "</div>";