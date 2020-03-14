<?php
/*
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
*/

session_start();
require('../getip.php');
if($_SESSION['username'] != "" && $_SESSION['username'] != $ip){
	echo "Logged in as ".htmlentities($_SESSION['username']);	
}
?>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Fast Mailer</title>	
	<link rel="icon" href="../assets/image/icon.ico"> 
	<link rel="shortcut icon" href="../assets/image/icon.ico"/>
	<link rel="stylesheet" href="../assets/css/table.css">
	<link rel="stylesheet" href="../assets/css/style-mailer.css">
	<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="process.js"></script>
</head>
<body>
	<!---<a href="../auth/">Login</a>--->
	<!---<a href="../auth/logout.php">Logout</a>--->
	<button class="button" id="create" type="button" onclick="create();" style="width:100%">Create new email</button><br><br>
	<center><div class="noti" id="noti"></div></center><br>
	<button style="display:none" class="button" id="refresh" type="button" onclick="update();" style="width:100%">Refresh</button>
	<div id="result">
		<table id='resulttable'></table>
	</div>
	<br>
	<div id="msg"></div>
</body>
</html>