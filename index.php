<html>
<head>
</head>
<body>
	<a href="../auth/">Login</a>
	<a href="../auth/logout.php">Logout</a>
	<a href="../mailer">Mailer</a>
</body>
</html>

<?php
session_start();
require('getip.php');
if($_SESSION['username'] != "" && $_SESSION['username'] != $ip){
	echo "Logged in as ".htmlentities($_SESSION['username']);	
}
?>