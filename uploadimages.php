<?php
include_once "dbh.php";



if(isset($_POST['submitimage'])) {
foreach ($_POST as $submitimage => $val)
{
/*     echo htmlspecialchars($name . ': ' . $val) . "\n";
  */   echo $val;
	/*	$target = "images/".basename($_FILES['image']['name']);
	$image = $_FILES['image']['name'];
	$text = $_POST['text'];
*/
/*	$text = $_POST['text'];  */
	$image = $_FILES['file']['name'];

		$fileName = $_FILES['file']['name'];
		$fileTmpName = $_FILES['file']['tmp_name'];
		$fileSize = $_FILES['file']['size'];
		$fileError = $_FILES['file']['error'];
		$fileType = $_FILES['file']['type'];
		
		$fileExt = explode('.', $fileName);
		$fileActualExt = strtolower(end($fileExt));

		$allowed = array('jpg', 'jpeg', 'png', 'pdf');

		if (in_array($fileActualExt, $allowed)) {
			if ($fileError === 0) {
				if ($fileSize < 1000000) {
					$fileNameNew = basename($_FILES['file']['name']);
					$target = 'images/'.$fileNameNew;
					move_uploaded_file($fileTmpName, $target);
					$sql = "INSERT INTO images (userid, image) VALUES ('$val', '$image');";
					mysqli_query($conn, $sql); 
					header("Location: index.php?uploadsucess");
					exit();
					} else {
					echo "Your file is too big";
				}
			} else {
				echo "There was an error uploading your file!";
			}
		} else {
			echo "You cannot upload files of this type, Select the correct file first!";
		}	
	
	

}

}
