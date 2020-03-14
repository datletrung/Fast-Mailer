<?php
session_start();
require('../phpmailer/class.smtp.php');
require('../phpmailer/class.phpmailer.php');
require('../connect.php');
if(isset($_POST['submit'])){
$email = strtolower(mysqli_real_escape_string($link, $_POST['email']));
//$email = 'admin';

$query = "SELECT * FROM `users` WHERE email='$email' or username='$email'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
$count = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);
$displayname = $row['display_name'];
$email = $row['email'];
$username = $row['username'];
if ($count == 1){
	//Genarate token 
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < 31; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];		
	}
	$token = $randomString;
	//Set token in db
	$query = "UPDATE `users` SET `token`='$token' WHERE `email`='$email';";
	if (mysqli_query($link, $query)){
		$link = "http://".$_SERVER['SERVER_NAME']."/auth/recover.php?token=$token";
		$body = "<h2>Welcome back, $displayname (".htmlentities($username).")!</h2></br><p>Please click <a href='$link'>here</a> to recover your account or go to this link:<p></br>$link";
		$title = "Fast Mailer Account";
		$url = "http://".$_SERVER['SERVER_NAME']."/phpmailer/mail.php?username=$username&email=$email&body=$body&title=$title";
		$url = str_replace(" ", "%20", $url);
		$mail = file_get_contents($url);
		//var_dump($mail);
		if($mail == "success"){
			$data['status'] = 'ok';    			
		}else{
			$data['status'] = 'error';			
		}
	}
}else{
	$data['status'] = 'error1';
}
echo json_encode($data);
}
?>