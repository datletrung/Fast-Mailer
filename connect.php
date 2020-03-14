<?php
$link = mysqli_connect("localhost", "onetimemail", "Tatdat0922", "onetimemail");

if (!$link){
    die("Database Connection Failed" . mysqli_error($link));
}

$select_db = mysqli_select_db($link, 'onetimemail');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($link));
}
//echo "Success";
?> 