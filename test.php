<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

$username = "datletrung";
$token = "asguioiashg89yoghad";
$link = "http://".$_SERVER['SERVER_NAME']."/auth/recover.php?token=$token";
$body = "<h2>Welcome back, $displayname ($username)!</h2></br><p>Please click <a href='$link'>here</a> to recover your account or go to this link:<p></br>$link";
$title = "Ocean Name Account";
$email = "letrungcaotung@gmail.com";

$url = "http://".$_SERVER['SERVER_NAME']."/phpmailer/mail.php?username=$username&email=$email&body=$body&title=$title";
$url = str_replace(" ", "%20", $url);
$mail = file_get_contents($url);
echo $mail;
?>