<?php
/*
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
*/
session_start();
include('../phpmailer/class.smtp.php');
include('../phpmailer/class.phpmailer.php');
include('../getip.php');
require('../connect.php');
date_default_timezone_set('America/Edmonton');

if(isset($_POST['register'])){   
//Genarate token 
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charactersLength = strlen($characters);
$randomString = '';
for ($i = 0; $i < 31; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
}
$token = $randomString;
//Get date
$date = date('Y-m-d H:i:s');
//Read data from ajax
$username = strtolower(mysqli_real_escape_string($link, $_POST['username']));
$password = mysqli_real_escape_string($link, $_POST['password']);
$email = strtolower(mysqli_real_escape_string($link, $_POST['email']));
$displayname = mysqli_real_escape_string($link, $_POST['displayname']);
$ip = get_client_ip();

/*
$username = 'root';
$password = 'tatdat';
$email = 'letrungcaotung@gmail.com';
$displayname = 'Lee Tin';
echo $username,$email,$password,$displayname,$ip;
*/

$query = "SELECT * FROM `users` WHERE username='$username' or email='$email'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
//print_r(mysqli_query($link, $query) or die(mysqli_error($link)));
$count = mysqli_num_rows($result);
if ($count > 0){
	$data['status'] = 'error';
}else{
	$query = "INSERT INTO `users`(`username`, `ip`, `password`, `display_name`, `email`, `token`, `position`, `status`, `time_create`) 
	          VALUES ('$username', '$ip', '$password', '$displayname', '$email', '$token', '0', '0', '$date')";
	//print_r(mysqli_query($link, $query) or die(mysqli_error($link)));
	if (mysqli_query($link, $query)){
		$url = "http://".$_SERVER['SERVER_NAME']."/auth/verify.php?token=$token";
		$body = "<h2>Welcome $displayname (".htmlentities($username).") to Fast Mailer</h2></br><p>Please click <a href='$url'>here</a> to verify your account or go to this link:<p></br>$url";
		$title = "Fast Mailer Account";
		$url = "http://".$_SERVER['SERVER_NAME']."/phpmailer/mail.php?username=$username&email=$email&body=$body&title=$title";
		$url = str_replace(" ", "%20", $url);
		//print_r($url);
		$mail = file_get_contents($url);
		//var_dump($mail);
		if($mail == "success"){
			$data['status'] = 'ok';    
		}else{
			$query = "DELETE FROM `users` WHERE `username`='$username' and `email`='$email'";
			$result = mysqli_query($link, $query) or die(mysqli_error($link));
			$data['status'] = 'error1';
		}
		
	}else{	
		$data['status'] = 'error1';
	}
}
echo json_encode($data);
}
?>