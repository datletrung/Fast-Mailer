<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require('../connect.php');
require('../getip.php');

$username = strtolower(mysqli_real_escape_string($link, $_GET['username']));
$password = mysqli_real_escape_string($link, $_GET['password']);
$code = mysqli_real_escape_string($link, $_GET['code']);
$ip = get_client_ip();
$date = date('Y-m-d H:i:s');
/*$url = 'domain';
$username = 'tatdat';
$password = 'tatdat';*/

if (empty($code)){
	$query = "SELECT * FROM `users` WHERE (`username`='$username' or `email`='$username') and `password`='$password'";
	$result = mysqli_query($link, $query) or die(mysqli_error($link));
	$count = mysqli_num_rows($result);
	$row = mysqli_fetch_assoc($result);
	if ($count == 1){
		$query1 = "UPDATE `users` SET `ip`='$ip', `last_login`='$date' WHERE `username`='$username'";
		if (mysqli_query($link, $query1)){
			if ($row['token'] == ""){
				$data['status'] = '1';
			}else{
				$data['status'] = '0';
			}
		}else{
			$data['status'] = '0';
		}	
		
	}else{
		$data['status'] = '0';
	}
	
	echo $data['status'];
	
}else{
	$query = "SELECT * FROM `users` WHERE (username='$username' or email='$username') and password='$password'";
	$result = mysqli_query($link, $query) or die(mysqli_error($link));
	$count = mysqli_num_rows($result);
	$row = mysqli_fetch_assoc($result);
	if ($count == 1){
		$query1 = "UPDATE `users` SET `ip`='$ip', `last_login`='$date', `token_qr`='$code' WHERE `username`='$username'";
		if (mysqli_query($link, $query1)){
			if ($row['token'] == ""){
				$data['status'] = '1';
			}else{
				$data['status'] = '0';
			}
		}else{
			$data['status'] = '0';
		}	
	}else{
		$data['status'] = '0';
	}
	echo $data['status'];
}

?>