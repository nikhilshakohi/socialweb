<?php

include_once 'dbh.php';
include_once 'header.php';


echo "<div style='text-align:center'>";
echo "<h4>"."Your recent login times are: "."</h4>"." <br>";
$sql = "SELECT * FROM logintime WHERE userid='".$_SESSION['u_id']."' ORDER BY id DESC ";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
	?><br><?php echo $row['date'];?><br><?php
};
echo "</div>";