<?php
require "../config/musicdb.php";
if (isset($_POST['value'])) {
	$value = "%".$_POST['value']."%";
	if (!empty($value)) {
		$sql = "SELECT * FROM songs WHERE songname LIKE ? OR songcategory LIKE ?";
		$connection = mysqli_stmt_init($connect);
		if (mysqli_stmt_prepare($connection,$sql)) {
			mysqli_stmt_bind_param($connection,"ss",$value,$value);
			mysqli_stmt_execute($connection);
			//mysqli_stmt_store_result($connection);
			$data = mysqli_stmt_get_result($connection);
			$all = mysqli_num_rows($data);
			if ($all>0) {
		
				while ($row = mysqli_fetch_assoc($data)) {
				echo "<div id='songname'>
					<span >".$row['songname']."</span>
					</div>
					<button><a download=".$row['songname']." href=".$row['songpath'].">download</a></button>";
				}
			}else{
				echo "no results found";
			}
	}else{
		echo "an error occurred";
	}
	}
	
}else{
	echo "no value";
}