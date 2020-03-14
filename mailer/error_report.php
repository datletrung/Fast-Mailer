<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);


$date = "Sat, 7 Mar 2020 21:19:48 -0700";
$date1 = "2020-03-08 20:20:20";
echo date('Y-m-d H:i:s',strtotime($date));
?>