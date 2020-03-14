<?php
session_start();  
require('../connect.php');
if(isset($_POST['submit'])){   
	$token = $_POST['token'];
	$password = $_POST['password'];
	/*$token = '123';
	$password = 'test';*/
	$query = "SELECT * FROM `users` WHERE token='$token';";
	$result = mysqli_query($link, $query) or die(mysqli_error($link));
	$count = mysqli_num_rows($result);
	if ($count == 1){
			$query = "UPDATE `users` SET `token`='', `password`='$password' WHERE `token`='$token';";
			if (mysqli_query($link, $query)){
				$data['status'] = 'ok';
				//echo "done";
			}else{
				$data['status'] = 'error';			
				//echo "something went wrong";
			}
	}else{
		$data['status'] = 'error1';
		//echo "invalid token";
	}
echo json_encode($data);
}
?>