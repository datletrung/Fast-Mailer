<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
if(isset($_POST['submit'])){
session_start();
require('../connect.php');
require('../getip.php');
$ip = get_client_ip();
$date = date('Y-m-d H:i:s');
$code = mysqli_real_escape_string($link, $_POST['code']);

//$data['data'] = $code;
//$data['data1'] = $ip;
$query = "SELECT * FROM `users` WHERE `ip`='$ip' and `token_qr`='$code'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
$count = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);
if ($count == 1){
	$query1 = "UPDATE `users` SET `ip`='$ip', `last_login`='$date', `token_qr`='' WHERE `token_qr`='$code'";
	if (mysqli_query($link, $query1)){
		if ($row['token'] == ""){
			$_SESSION['username'] = $row['username'];
			$data['status'] = 'ok';
		}else{
			$data['status'] = 'error1';
		}
	}else{
		$data['status'] = 'error1';
	}
}else{
	$data['status'] = 'error';
}
echo json_encode($data);
}
?>