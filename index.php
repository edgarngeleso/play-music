<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="all/app.css">
</head>
<body>

<div id="songsCont">
	<div style="position: fixed;width: 100%;height: 25px;
	background-color: orange;">Seach songs
	<input type="text" id="searchSong" placeholder="search song..." style="border:none;border-radius: 5px;height: 22px; width: 30%;">
	</div>
	<div id="searched" style="margin-top: 30px;"></div>
	<div id="songcredentials"></div>
</div>

<div id="sidebar">
	<div id="place" style="color:rgb(167,67,89);"></div>
	<hr>
	<div><audio id="audio">one</audio></div>
	
	<div id="barCont" style="width: 80%; height: 20px;background-color: white;margin-left: 5px;">
		<div id="bar" style="height: 10px; margin-top: 5px;"></div>
		<b id="elapsed" style="position: absolute;margin-left: 82%;font-size: 20px;margin-top: 1px;overflow: hidden;width: 30%;">0/0:0</b>
	</div>
	<img src="all/songpic/default.jpg" id="img">
	<div id="buttons">
		<b id="previous">&#9198</b>
		<b id="play">&#9205</b>
		<b id="next">&#9197</b>
	</div>
</div>
</body>
<script type="text/javascript" src="all/app.js"></script>
<script type="text/javascript">
	let str = "Edgar was here";
	console.log(str.replace("","_"))
</script>
</html>