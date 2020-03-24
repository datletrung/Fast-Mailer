<?php
require('connect.php');


$table = $_GET['t'];
$count = $_GET['c'];

$query = "ALTER TABLE $table AUTO_INCREMENT=$count;";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if (mysqli_query($link, $query)){
	$query = "SELECT `AUTO_INCREMENT`
			  FROM  INFORMATION_SCHEMA.TABLES
			  WHERE TABLE_SCHEMA = 'onetimemail'
			  AND   TABLE_NAME   = '$table';";
	$result = mysqli_query($link, $query) or die(mysqli_error($link));
	
	if (mysqli_query($link, $query)){
		$row = mysqli_fetch_assoc($result);
		echo $row["AUTO_INCREMENT"];
	}else{
		echo "fail";
	}
}else{
	echo "fail";
}
?>