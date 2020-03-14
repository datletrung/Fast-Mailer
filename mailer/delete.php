<?php
/*
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
*/
require('../getip.php');
require('../connect.php');

date_default_timezone_set('America/Edmonton');
$date = date('Y-m-d H:i:s');
$ip = get_client_ip();

if($_POST['submit']){
	$email = $_POST['user'];
	$query = "SELECT * FROM `email` WHERE `email` = '$email' and `status` = 1";
	$result = mysqli_query($link, $query) or die(mysqli_error($link));
	$count = mysqli_num_rows($result);
	if ($count > 0){
		while ($row = mysqli_fetch_assoc($result)){
			$id = $row['id'];
			$user = $row['email'];
			shell_exec("sudo userdel -r ".$user);
			$query = "UPDATE `email` SET `status`=0, `time_check`='$date' WHERE `id`='$id'";
			if (mysqli_query($link, $query)){
				$data['status'] = 'ok';
			}else{
				$data['status'] = 'error';
				break;
			}
		}
	}else{
		$data['status'] = 'empty';
	}
}else{
	$query = "SELECT * FROM `email` WHERE `status` = 1";
	$result = mysqli_query($link, $query) or die(mysqli_error($link));
	$count = mysqli_num_rows($result);
	if ($count > 0){
		while ($row = mysqli_fetch_assoc($result)){
			$id = $row['id'];
			$user = $row['email'];
			if (strtotime($date) - strtotime($row['time_create']) >= 82800){
			#if (strtotime($date) - strtotime($row['time_create']) >= 10){
				shell_exec("sudo userdel -r ".$user);
				$query = "UPDATE `email` SET `status`=0, `time_check`='$date' WHERE `id`='$id'";
				if (mysqli_query($link, $query)){
					$data['status'] = 'ok';
				}else{
					$data['status'] = 'error';
					break;
				}
			}else{
				$query = "UPDATE `email` SET `time_check`='$date' WHERE `id`='$id'";
				if (mysqli_query($link, $query)){
					$data['status'] = 'ok';
				}else{
					$data['status'] = 'error';
					break;
				}
			}
		}
	}else{
		$data['status'] = 'empty';
	}
}
echo json_encode($data);
?>