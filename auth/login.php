<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
session_start();
require('../connect.php');
require('../getip.php');
if(isset($_POST['login'])){
$username = strtolower(mysqli_real_escape_string($link, $_POST['username']));
$password = mysqli_real_escape_string($link, $_POST['password']);
$url = mysqli_real_escape_string($link, $_POST['next']);
$ip = get_client_ip();
$date = date('Y-m-d H:i:s');
/*$url = 'domain';
$username = 'tatdat';
$password = 'tatdat';*/

$query = "SELECT * FROM `users` WHERE (username='$username' or email='$username') and password='$password'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
$count = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);
if ($count == 1){
	$query1 = "UPDATE `users` SET `ip`='$ip', `last_login`='$date' WHERE `username`='$username'";
	if (mysqli_query($link, $query1)){
		if ($row['token'] == ""){
			//echo $row['token'];
			$_SESSION['username'] = $row['username'];
			$data['status'] = 'ok';
			if ($url != ""){
				$data['status'] = $url;
			}
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