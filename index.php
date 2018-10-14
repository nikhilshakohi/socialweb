	<?php
include_once 'header.php';
include_once 'dbh.php';

if (isset($_SESSION['u_id'])) {
	$sql = "SELECT * FROM users";
	$result	= mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row  = mysqli_fetch_assoc($result)) {
			$id = $row['user_id'];
			$sqlImg = " SELECT * FROM profileimg WHERE userid='$id' ";
			$resultImg = mysqli_query($conn, $sqlImg);
			while ($rowImg = mysqli_fetch_assoc($resultImg)) {
				echo "<div class='container-fluid' style='background-color:gainsboro;'>";
				echo "<div style='style='text-align:center;'overflow:hidden;position:relative'>";
					if (($rowImg['status'] == 0) && ($_SESSION['u_id'] == $id)) {
						$sessionid = $_SESSION['u_id'];
						$filename = "uploads/profile".$sessionid."*";
						$fileinfo = glob($filename);
						$filetext = explode(".",$fileinfo[0]);
						$fileactualext = $filetext[1];
						echo "<div style='width:100%;height:30em;position:relative;'>";
						echo "<div style='text-align:center;'>"."<img id='profilepic' src='uploads/profile".$_SESSION['u_id'].".".$fileactualext."?".mt_rand()."'>";
						echo "<h4>".$row['user_uid']."</h4>"."</div>";
						echo "<form action='uploads.php' method='POST' enctype='multipart/form-data'>
						<input type='file' name='file'>
						<button class='btn btn-success' type='submit' name='submit'>Change Profile Image</button>
						</form>";
						echo "<form action='deleteprofileimg.php' method='POST'>
						<button class='btn btn-danger' type='submit' name='submit'>Delete profile image</button>
						</form>";
						echo "</div>";
					} elseif ($rowImg['status'] == 1 && ($_SESSION['u_id'] == $id)) {
						echo "<div style='width:100%;position:relative;'>";
						echo "<div style='text-align:center;'>"."<img id='profilepic' src='uploads/profiledefault.jpg'>";
						echo "<h4>".$row['user_uid']."</h4>"."</div>";
						echo "<form action='uploads.php' method='POST' enctype='multipart/form-data'>
						<input type='file' name='file'>
						<button class='btn btn-success' type='submit' name='submit'>Upload Profile Image</button>
						</form>";
						echo "</div>";
						}
						echo "</div>"."<div>";
					if ($_SESSION['u_id'] == $id) {
						echo "<div style='position:relative;width:100%;margin:auto; font-size:1.5em;text-align:center;padding:1em;'>";
						echo "Your details:"."<br>"."<label> Name: </label>";
						echo ucfirst($_SESSION['u_first'])." ".ucfirst($_SESSION['u_last'])."<br>";
						echo "<label> Email: </label>".$_SESSION['u_email']."<br>";
						echo "<label> Username: </label>".$_SESSION['u_uid'];
						?>
					<form action="profile.php" method="POST">
						<input style="background-color: rgba(20,50,150,0.3);padding: 0.5em;" id="profilepagebut" type="submit" name="<?php echo $row['user_id'] ?>" value=<?php echo "My"."&nbsp;"."Profile"/* $row['user_first']."_".$row['user_last']; */ ?> />
					
				<?php
						echo "</div>";	
	
			
						echo "<div style='width:100%;margin-left:auto;margin-right:auto;background-color:silver; text-align:center;position:relative;'>";
						echo "<h1>"."Users you may know:"."</h1>."."<br>";
						$sql = "SELECT * FROM users";
						$result	= mysqli_query($conn, $sql);
						$sqlImg = "SELECT * FROM profileimg";
						$resultImg = mysqli_query($conn, $sqlImg);
						if (mysqli_num_rows($result) > 0) {
							while ($row  = mysqli_fetch_assoc($result)) {
							if ($row['user_id'] != $_SESSION['u_id']) {

								$firstn = ucfirst($row['user_first']);
								$lastn = ucfirst($row['user_last']);
								$fullname = $firstn.'&nbsp;'.$lastn; 
				?>
					<form action="profile.php" method="POST">
						<input style="background-color: rgba(20,50,150,0.3);padding: 1em; border-radius: 1.5em; font-size: 1.2em;" id="profilepagebut" type="submit" name="<?php echo $row['user_id'] ?>" value=<?php echo $fullname; ?> />

				<?php					}
								if (mysqli_num_rows($resultImg) > 0) {
									while ($rowImg  = mysqli_fetch_assoc($resultImg)) {
										if ($rowImg['userid'] != $_SESSION['u_id']) {
											if ($rowImg['status'] == 0) {
												echo "<img id='profilepicdisplay' src='uploads/profile".$rowImg['userid']."."."jpg"."?".mt_rand()."'>";
												echo "<br>";
												break;
											} elseif ($rowImg['status'] == 1) {
												echo "<img id='profilepicdisplay' src='uploads/profiledefault.jpg'>";
												echo "<br>";
												break;
											}
										?> </form>	
										<?php
										}
										echo "<br><br>";
										break;
									}
								}
							}
							echo "</div>";
							echo "</div>";
						}
					} else {
								echo "</div>";
							echo "</div>";
							}
				}
			}
		} else {
			echo "There are no users";
			}		
	} else {
		echo "<section  style='text-align: center;'>";
		echo "<h2>Home</h2>";
		echo "<h3>Signup to have more FUN!</h4>".'<button class="btn btn-primary" style="padding: 0.5em;" onclick="signup()"> Sign up</button>';
		echo "<div>"."<img class='img-responsive' style='margin:auto; width:60%;' src='homepic.jpg'"."</div>";
		echo "</section> ";
		}
echo "</div>";
?>



<script type="text/javascript">

</script>			
		
<?php
	include_once 'footer.php';
?>