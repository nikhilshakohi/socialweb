<?php

include_once 'dbh.php';
include_once 'header.php';
				
if (isset($_POST['searchuser'])) {
	$search = mysqli_real_escape_string($conn,$_POST['search']);
	$sql = "SELECT * FROM users WHERE user_first LIKE '%$search%' OR user_last LIKE '%$search%' OR user_uid LIKE '%$search%'";
	$result = mysqli_query($conn, $sql);
	$count = mysqli_num_rows($result);
	if ($count == 0) {
		echo 'There are no matching results';
	} else {
		echo "There are ".$count." users";
		while ($row = mysqli_fetch_assoc($result)) {
			$fname = $row['user_first'];
			$lname = $row['user_last'];
			$id = $row['user_id'];
			
		$fullname = ucfirst($fname)."&nbsp;".ucfirst($lname);

				$username = ucfirst($row['user_uid']);
				?>
					<form action="profile.php" method="POST">
						<input style="background-color: rgba(20,50,150,0.3);padding: 1em; border-radius: 1.5em; font-size: 1.2em;" id="profilepagebut" type="submit" name="<?php echo $row['user_id'] ?>" value=<?php echo $fullname."---".$username;  ?>  /> <br><br>

				<?php	}
	}
}
