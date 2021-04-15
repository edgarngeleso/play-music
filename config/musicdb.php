<?php
$host = "localhost";
$servername = "root";
$password = "";
$dbname = "music";
/*
$host = "localhost";
$servername = "id15781310_7307";
$password = "4N7sBq+zX>g8\gGb";
$dbname = "	id15781310_dreamrise";
*/

$connect = mysqli_connect($host,$servername,$password,$dbname);

if (!$connect) {
	echo "no connection";
}