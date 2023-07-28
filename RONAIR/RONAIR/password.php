<?php
	session_start();
if (! isset($_SESSION['logged']) ||  $_SESSION['logged'] !== true) {
	header ("Location: login.php");
	exit;
}
$username = "";
$password = "";
if (isset($_POST['update'])) {
	require 'configure.php';
	
	$username = $_POST['username'];
	$password = $_POST['password'];

	$database = "ronair";

	$db_found = new mysqli(DB_SERVER, DB_USER, DB_PASS, $database );

	if ($db_found) {

		$phash = password_hash($password, PASSWORD_DEFAULT);
		$SQL = $db_found->prepare("UPDATE login SET password=? WHERE username=?");

		$SQL->bind_param('ss', $phash, $username);
		$SQL->execute();
		header("Location: password.php");
		$SQL->close();
		$db_found->close();

	}
	else {
		print "Database NOT Found ";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>profile</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/aos.css">
</head>
<body>
	<header id="header">
		<a href="#" class="logo">RONAIR<img src="media/icon.png" height=25 width=25 alt="logo"></a>
		<ul>
			<li><a href="index.php" onClick="toggle()">return</a></li>
			<li><a href="#contact" class="active" onClick="toggle()">
				<img src="media/how.png" width="18" height="20">&nbsp;<?php
		if(isset($_SESSION['logged'])){
	 echo $_SESSION['username'];
 }	
?></a></li>
		</ul>
		<div class="toggle" onClick="toggle()"></div>
	</header>
	<section id="password">
		<div class="zbox">
<img src="media/how.png" width=150 height=150 alt="user">
<p>Username: &nbsp;<span><?php
		if(isset($_SESSION['logged'])){
	 echo $_SESSION['username'];
 }	
?></span></p>
<a href="edit-profile.php">EDIT YOUR PROFILE</a>
</div>
		<div class="rbox">
		<h1>Change your password</h1><br>
		 <form METHOD="POST" ACTION="password.php">
		  	<p>Username</p>
		  	<input type="text" name="username" placeholder="Enter Username">
		  	<p>Password</p>
		  	<input type="password" name="password" placeholder="Enter Password">
		  	<input type="submit" name="update" value="Update Password"><br>
		  </form>
			</div>	
	</section>
	<script type="text/javascript">
		function toggle(){
			var header = document.getElementById("header")
			header.classList.toggle('active')
		}
	</script>
</body>
</html>