<?php
require 'config/musicdb.php';

if (isset($_POST['upload'])) {
	
	$songname = $_FILES['songname']['name'];
	$songcategory = $_POST['songtype'];
	$finalresult = strtolower($songcategory);

	$songtmp = $_FILES['songname']['tmp_name'];
	$songerror = $_FILES['songname']['error'];
	$songsize = $_FILES['songname']['size'];
	echo $songerror;
	//$imagenamewithid = uniqid('IMG',false).'.'.$imagename;
	$fileinfo = pathinfo($songname);
	$fileExtension = $fileinfo['extension'];
	$songFiles =  array('m4a','M4A','mp3','MP3');

	if (in_array($fileExtension,$songFiles)) {
		$songname.str_replace(" ", "_");
		//$filewithid = uniqid().''.basename($songname);
		$filewithid = basename($songname);
		$filedestination = "all/allmusic/".$filewithid;

		if(!$songerror){
			if ($songsize < 9000000000) {
				if (move_uploaded_file($songtmp,$filedestination)) {				
					$insertsong = "INSERT INTO songs(songname,songpath,songcategory) VALUES('$songname','$filedestination','$finalresult')";
					mysqli_query($connect,$insertsong);
					header("Location:index.php");
			}else{

				header("Location:index.php?failed");
			}
		}else{
			echo "image too large";
		}
			}else{
				echo "an error occurred";
			}

	}else{
		echo "wrong file type";
	}



}
?>