<?php
session_start();
require('../getip.php');
$ip = get_client_ip();
//echo $_SESSION['username'],$ip;
if($_SESSION['username'] != "" && $_SESSION['username'] != $ip){
	header('Location: redirect.php');
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Fast Mailer</title>	
	<link rel="icon" href="../assets/image/icon.ico"> 
	<link rel="shortcut icon" href="../assets/image/icon.ico"/>
	<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
	<link rel="stylesheet" href="../assets/css/style.css">
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="process.js"></script>
</head>

<body>
<div class="login-wrap">
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
		<div class="login-form">
			<div class="sign-in-htm">
			<form method="post" action="" onsubmit="return login();">
				<div class="group">
					<label for="user" class="label">Username</label>
					<input id="user" name="user" type="text" class="input">
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" name="pass" type="password" class="input" data-type="password">
				</div>
				<div class="group">
					<input type="submit" name="sign-in" class="button" value="Sign In">
				</div>
			</form>
			<form>
				<div class="group">
					<input type="submit" name="sign-in" class="button" onclick="window.location.href='scan-login.php';return false;" value="Sign In With QR Code">
				</div>
				<div id="error1"></div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<a href="forgot-password.php">Forgot Password?</a>
				</div>
				<div class="foot-lnk">
					<a href="/">Home Page</a>
				</div>
			</form>
			
			</div>
			<div class="sign-up-htm">
			<form method="post" action="" onsubmit="return register();">
				<div class="group">
					<label for="displayname" class="label">Full Name</label>
					<input id="displayname" name="displayname" type="text" class="input">
				</div>
				<div class="group">
					<label for="user" class="label">Username</label>
					<input id="user1" name="user" type="text" class="input">
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass1" name="pass" type="password" class="input" data-type="password">
				</div>
				<div class="group">
					<label for="pass" class="label">Repeat Password</label>
					<input id="passc" name="passc" type="password" class="input" data-type="password">
				</div>
				<div class="group">
					<label for="user" class="label">Email Address</label>
					<input id="email" name="email" type="text" class="input">
				</div>
				<div class="group">
					<center><input type="checkbox" id="tos" name="tos">By using our site, you agree to the following <a href='../Terms-of-Service.pdf'>Terms of Service</a></input></center>
				</div>
				<div class="group">
					<input type="submit" class="button" value="Sign Up">
				</div>
				<div id="error2"></div>
			</form>
			</div>
		</div>
	</div>
</div>

</body>

</html>