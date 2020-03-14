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
#$user = "zncuvzqgnm";
$user = mysqli_real_escape_string($link, $_POST['user']);
$usermail = "$user@mail.tdkiller.tk";

$path = "/home/$user/mailbox/new";
$output = shell_exec("sudo ls $path");
if (strlen($output)>0){
	$output = explode("\n", $output);
	unset($output[count($output)-1]);
	
	foreach($output as $file){
		$data = shell_exec("sudo cat $path/$file");
		$from = mysqli_real_escape_string($link, substr($data, strpos($data,"From")+6, strpos($data,"\n", strpos($data,"From"))-6-strpos($data,"From")));
		$date = date('Y-m-d H:i:s',strtotime(substr($data, strpos($data,"Date")+6, strpos($data,"\n", strpos($data,"Date"))-6-strpos($data,"Date"))));
		$subject = mysqli_real_escape_string($link, substr($data, strpos($data,"Subject")+9, strpos($data,"\n", strpos($data,"Subject"))-9-strpos($data,"Subject")));
		$to = mysqli_real_escape_string($link, substr($data, strpos($data,"To")+4, strpos($data,"\n", strpos($data,"To"))-4-strpos($data,"To")));
		$boundary = "--".substr($data, strpos($data,"boundary")+10, strpos($data,"\n", strpos($data,"boundary"))-10-strpos($data,"boundary")-1);
		if (strpos($data,"Content-Transfer-Encoding:",strpos($data,"Content-Transfer-Encoding:")+1) > strpos($data,"Content-Type: text/html;")){
			$body = mysqli_real_escape_string($link, substr($data, strpos($data,"\n", strpos($data,"Content-Transfer-Encoding:",strpos($data,"Content-Transfer-Encoding:")+1))+1, strpos($data, $boundary, strpos($data,"Content-Transfer-Encoding:",strpos($data,"Content-Transfer-Encoding:")+1))-1-strpos($data,"\n", strpos($data,"Content-Transfer-Encoding:",strpos($data,"Content-Transfer-Encoding:")+1))));
		}else{			
			$body = mysqli_real_escape_string($link, substr($data, strpos($data,"\n", strpos($data,"Content-Type: text/html;"))+1, strpos($data, $boundary, strpos($data,"Content-Type: text/html;"))-1-strpos($data,"\n", strpos($data,"Content-Type: text/html;"))));
		}	
		
		#echo $to;
		#echo quoted_printable_decode($body);
		$query = "SELECT * FROM `data`";
		if (mysqli_query($link, $query)){
			$query = "INSERT INTO `data` (`from`, `to`, `subject`, `body`, `time_receive`, `ip`) 
					  VALUES ('$from', '$to', '$subject', '$body', '$date', '$ip')";
			if (mysqli_query($link, $query)){
				$f = fopen("storage/$file", 'w');
				if ($f){
					fwrite($f, $data);
					fclose($f);
					shell_exec("sudo rm $path/$file");
				}		
			}
		}	
	}
}
$query = "SELECT * FROM `data` WHERE `to`='$usermail' ORDER BY `time_receive` DESC";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
$count = mysqli_num_rows($result);
if ($count != 0){
	$i=0;
	$data['status'] = 'ok';
	while ($row = mysqli_fetch_assoc($result)){
		$data['detail'][$i]['id'] = htmlentities($row['id']);
		$data['detail'][$i]['from'] = htmlentities($row['from']);
		$data['detail'][$i]['subject'] = htmlentities($row['subject']);
		$data['detail'][$i]['body'] = quoted_printable_decode($row['body']);
		$data['detail'][$i]['time'] = htmlentities($row['time_receive']);
		$i++;
	}
}else{
	$data['status'] = 'empty';
	//echo "Mailbox empty!";
}
echo json_encode($data);
?>