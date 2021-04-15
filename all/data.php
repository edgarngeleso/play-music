<?php
require "../config/musicdb.php";
$sql = "SELECT * FROM songs";
$result = mysqli_query($connect,$sql);
$all = mysqli_num_rows($result);
if ($all>0) {
	$all = mysqli_fetch_all($result,MYSQLI_ASSOC);
	echo json_encode($all);
}else{
	echo "no music";
}
?>