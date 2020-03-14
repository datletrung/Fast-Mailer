<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
session_start();
require('../getip.php');
$ip = get_client_ip();
if($_SESSION['username'] != "" && $_SESSION['username'] != $ip){
	header('Location: redirect.php');
	exit;
}
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charactersLength = strlen($characters);
$code = '';
for ($i = 0; $i < 31; $i++) {
    $code .= $characters[rand(0, $charactersLength - 1)];
}
?>
<!DOCTYPE html>
<html>
<head>	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Fast Mailer</title>
	<link rel="icon" href="../assets/image/icon.ico"> 
	<link rel="shortcut icon" href="../assets/image/icon.ico"/>
	<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
	<link rel="stylesheet" href="../assets/css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript">var code = "<?php echo $code; ?>";</script>
	<script type="text/javascript" src="scan-login.js"></script>
</head>
<body>
<div class="login-wrap">
  <div class="login-html">
    <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In With QR Code</label>
	<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
	<div class="login-form">      
		<div class="sign-in-htm">
			<center><p1>Your phone and this device must have the same IP address! </p1><p2>(<?php echo $ip; ?>)</p2></center>
			<center><p1>Scan the code below to login</p1></center>
			</br>
			<center><img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo $code;?>&choe=UTF-8" title="Scan to login" /></center>
			<div id="error"></div>
			<div class="hr"></div>
			<div class="foot-lnk">
				<a href='/auth'>Sign in</a>
			</div>
			<div class="foot-lnk">
				<a href='/'>Home page</a>
			</div>
		</div>
	</div>
  </div>
</div>
</body>
</html>


