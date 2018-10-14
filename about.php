<?php 
include_once 'dbh.php';
include_once 'header.php';

if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$subject = $_POST['subject'];
	$mailFrom = $_POST['mail'];
	$message = $_POST['message'];

	$mailTo = "nshakohi4@gmail.com";
	$headers = "From: ".$mailFrom;
	$txt = "You have received an E-mail from ".$name.".\n\n".$message;

	mail($mailTo, $subject, $txt, $headers);
	echo "<script>alert('Mail sent..Thank You'); window.location.href='index.php?mail=success';</script>";
}

echo "<div style='text-align:center;'>";
echo "<h1>"."About the Website:"."</h1>";
echo "<h4>"."This website is social site where one can connect to the world and share their views upon the society."."<br>";
echo "One can upload images and comment on various posts to express their views!!"."</h4>"."<br>"."<br>";
echo "<h1>"."About Us:"."</h1>";
echo "<h4>"."This website was coded and developed by NIKHIL SHAKOHI and SHANMUKH SUDHEENDRA"."<br>";
echo "This website was designed out of our own interest.. Any suggestions or comments are encouraged!"."<br><br><br>";
echo "Contact for any query or suggestion at:"."</h4>";
?>
<form class="contact-form" action="about.php" method="POST">
	<input type="text" name="name" placeholder="Full Name" required><br><br>
	<input type="mail" name="mail" placeholder="Your E-mail" required><br><br>
	<input type="subject" name="subject" placeholder="Subject" required><br><br>
	<textarea name="message" placeholder="Your Message" required></textarea><br>
	<button type="submit" name="submit">Send Mail</button><br><br>
</form>
<?php
echo "</div>";