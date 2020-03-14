<?php
session_start();
unset($_SESSION['username']);
session_destroy();
echo "<div onload = 'history.go(-1);'/>";
header('Location: /');
exit;
?>