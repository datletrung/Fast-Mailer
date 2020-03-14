<?php
require('../getip.php');
require('../connect.php');

date_default_timezone_set('America/Edmonton');
$date = date('Y-m-d H:i:s');
$ip = get_client_ip();

$path = "/home/$user/mailbox/new";
$output = shell_exec("sudo ls $path");

function generateEmail($n) { 
    $characters = 'abcdefghijklmnopqrstuvwxyz'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
} 
  
if(isset($_POST['submit'])){
	$user = generateEmail(10);
	$usermail = "$user@mail.tdkiller.tk";

	$output = shell_exec("sudo adduser --disabled-password --gecos '' ".$user);
	
	if (strpos($output, "Copying files from `/etc/skel'") != null){
		$data['user'] = $user;
		$query = "SELECT * FROM `email`";
		if (mysqli_query($link, $query)){
			$query = "INSERT INTO `email` (`email`, `ip`, `time_create`)
					  VALUES ('$user', '$ip', '$date')";
			if (mysqli_query($link, $query)){
				$data['status'] = 'ok';
			} else {
				shell_exec("sudo userdel -r ".$user);
				$result = mysqli_query($link, $query) or die(mysqli_error($link));
				$data['status'] = $result;
			}
		}
	} else {
		$data['status'] = 'error';
	}
echo json_encode($data);
}
?>