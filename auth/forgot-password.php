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
	<script type="text/javascript" src="forgot-password.js"></script>
</head>
<body>
<div class="login-wrap">
  <div class="login-html">
    <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Forgot password</label>
	<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
	<div class="login-form">      
		<div class="sign-in-htm">
			<form method="post" action="" onsubmit="return clicked();">
				<div class="group">
					<label for="email" class="label">Username or Email Address</label>
					<input id="email" name="email" type="text" class="input">
				</div>
				<div class="group">
					<input type="submit" name="recover" class="button" value="Recover password">
				</div>
				<div id="error"></div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<a href='/auth'>Sign in</a>
				</div>
				<div class="foot-lnk">
					<a href='/'>Home page</a>
				</div>
			</form>
		</div>
	</div>
  </div>
</div>
</body>
</html>


