<?php
session_start();

if(isset($_SESSION['userid']) || (trim($_SESSION['userid']) == '')){
	header ('location: login.php');
	exit();
}

$session_id=$_SESSION['userid'];
$session_id=$_SESSION['username'];

?>