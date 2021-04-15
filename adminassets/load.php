<?php
require '../config/musicdb.php';

if (isset($_POST['songs'])) {
		$songtype = $_POST['songs'];
		echo $songtype;
		/*$retrieve = "SELECT * FROM songs WHERE songcategory=$songtype";
		$result = mysqli_query($connect,$retrieve);
		$rowdata=mysqli_num_rows($result);
		if ($rowdata>=$count) {
			$all = mysqli_fetch_all($result,MYSQLI_ASSOC);
			echo json_encode($all);
		}else{
			echo "no more information";
		}*/
	}