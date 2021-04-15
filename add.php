<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1.0" >
	<title>music</title>
	<style>
	#header{
		transform: translate(2%,5%);
		margin: auto;
	}
	#allmusic{
		margin-top: 20px;
		width: 80%;
		height: auto;
		transform: translate(2%,5%);
		margin:auto;
		border-radius: 5px;
		box-shadow: 2px 4px 15px 20px grey;
		display: grid ;
		grid-template-columns: repeat(3,1fr);
	}
		#musics{
			width: 200px;
			height:auto;
			background-color: tan;
			margin-top: 20px;
			margin-left: 20px;
			border-radius: 5px;
			display: flex;
			flex-direction: column;
			justify-content: space-around;
			align-items: center;
		}
		#musics img{
			width:150px;
			height: 150px;
			border-radius: 50%;
			object-fit: fill;
		}
		button{
			background-color: green;
			border-radius: 5px;
			width: 90%;
			border:none;
			margin-left: 5%;
		}
		.rotateimg{
			width:200px;
			height: 200px;
			border-radius: 50%;
			object-fit: fill;
			animation: rotate 3s infinite linear;
		}
				#add{
			width: 100px;
			height: 30px;
		}
		a{
			text-decoration: none;

		}
		@keyframes rotate{
			from{
				transform: rotate(0deg);
			}
			to{
				transform: rotate(360deg);
			}
		}


		@media(min-width: 300px){
			#musics{
			width: 90%;
			
		}
			#allmusic{
		grid-template-columns: repeat(1,1fr);
	}	
		}

		@media(min-width: 600px){
			#musics{
			width: 200px;
			
		}
			#allmusic{
		grid-template-columns: repeat(2,1fr);
		}	
		}
		@media (min-width: 900px){
			#allmusic{
		column-count: 3;
		grid-template-columns: repeat(3,1fr);
	}	
		}
		#songname{
			width: 100%;
			word-wrap: break-word;
		}
		#form{
			width: 300px;
			height: auto;
			display: flex;
			flex-direction: column;
			justify-content: space-around;
		}
		#container{
			display: grid;
			grid-template-columns: repeat(2,1fr);
		}
		audio{
			width: 100% !important;
		}
	</style>
</head>
<body>
	<h1 id="header">ALL ABOUT COOL MUSIC</h1>
<div id="container">
	<select onchange="selected(this)" style="height:30px;">
		<option name="all">All</option>
		<option>Country</option>
		<option>House </option>
		<option>Hip Hop</option>
		<option>Reggea</option>
	</select>
	<form id="form" action="addsong.php" method="POST" enctype="multipart/form-data">
		<input type="file" name="songname" >
		<input type="text" name="songtype" id="songtype" placeholder="add songtype" autocomplete="off">
	<button type="submit" name="upload" id="upload">Upload</button>
	</form>
</div>
<div id="selectedtype"></div>
<div id="allmusic">
	<?php

	require 'config/musicdb.php';
	$selectall = "SELECT * FROM songs";
	$result = mysqli_query($connect,$selectall);
	$available = mysqli_num_rows($result);
	if ($available < 1) {
		echo "no songs available";
	}else{
		 while($row = mysqli_fetch_assoc($result)){
	?>
	<div id="musics">
		<img src="all/songPic/default.jpg" id="image">
		<b id="songname"><?php echo $row['songname']?></b>
		<audio src="<?php echo $row['songpath'] ?>" id="mymusic" controls width

			="150"></audio>
		<b style="font-size: 30px; color:blue; cursor: pointer; text-shadow: 20px grey;" id="love">&#9829</b>
		<button id="download"><a download="<?php echo $row['songname'] ?>" href="<?php echo "all/".$row['songpath']?>">DOWNLOAD</a></button>
		<button id="play">PLAY</button>
		<button id="pause">STOP</button>
		
	</div>
	<?php 
	 }
		 }
	?>
</div>
</body>
<script type="text/javascript">
	
	document.querySelector("#play").addEventListener('click',function(e){
		//e.preventDefault();
		console.log('playing');
		document.querySelector("#mymusic").play();
		document.querySelector("#image").classList.add("rotateimg")
	});
	document.querySelector("#pause").addEventListener('click',function(){
		document.querySelector("#mymusic").pause();
		document.querySelector("#image").classList.remove("rotateimg")
	});
	


	//select and post to server
	var place = document.querySelector("#selectedtype");
	function selected(songtype){
		var x = document.getElementsByTagName('select');
  		var songs = songtype.value;
  		place.innerHTML=songs;
  		//console.log(songs)

			var request = new XMLHttpRequest();
			request.open('POST','load.php',true);
			request.setRequestHeader('Content-type','application/x-www-form-urlencoded')
			var param = "songs="+songs;

			request.onload = function(){
				if (this.status == 200) {
					console.log(this.responseText);
			/*
			let love = document.querySelector("#love");
	love.onclick = function(){
		love.style.color="green";
	}


			var mydata = JSON.parse(this.responseText);
				var output="";
				for(var i in mydata){
				
				output+=`
				
					<div id="data">

					<h5>${mydata[i].songname}
					 on ${mydata[i].songpath}</h5> 

					 ${mydata[i].songcategory}
					</div>
				`

				}
					console.log(this.responseText);
				
				}
				document.querySelector("#allmusic").innerHTML=output;*/

			}
			request.send(param);
	}
	}

let required = ['country','hip hop','house'];
let songtype = document.querySelector('songtype');
document.querySelector('#upload').addEventListener('click',()=>{
	required.map(song=>{
			console.log(song)
		})
});

</script>
</html>
