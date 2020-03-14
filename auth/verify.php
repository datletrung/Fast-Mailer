<?php
session_start();  
require('../connect.php');
$token = $_GET['token'];
//var_dump($token);
$query = "SELECT * FROM `users` WHERE token='$token';";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
$count = mysqli_num_rows($result);
if ($count == 1){
	$data['status'] = 'ok';
	$query = "UPDATE `users` SET `token`='' WHERE `token`='$token';";
	$result = mysqli_query($link, $query) or die(mysqli_error($link));
	if ($count == 1){
		//$data['status'] = 'ok';
		header('Location: /auth');
		exit;
	}else{
		echo "<p>Something went wrong! Please try again later.</p>";
		//$data['status'] = 'error1';
	}	
}else{
	echo "<p>Invalid token.</p>";
	//$data['status'] = 'error';
}
//echo json_entoken($data);
?>

