<?php
	session_start();
if (! isset($_SESSION['logged']) ||  $_SESSION['logged'] !== true) {
	header ("Location: login.php");
	exit;
}
$username = "";
$email = "";
$dob = "";
$address = "";
$fullname = "";
if (isset($_POST['update'])) {
	require 'configure.php';
	
	$username = $_POST['username'];
	$email = $_POST['email'];
	$dob = $_POST['dob'];
	$address = $_POST['address'];
	$fullname = $_POST['fullname'];

	$database = "ronair";

	$db_found = new mysqli(DB_SERVER, DB_USER, DB_PASS, $database );

	if ($db_found) {

		$SQL = $db_found->prepare("UPDATE login SET fullname=?, email=?, dob=?, address=?, username=? WHERE username=?");

		$SQL->bind_param('sssss', $fullname, $email, $dob, $address, $username);
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
			<li><a href="password.php" onClick="toggle()">return</a></li>
			<li><a href="#contact" class="active" onClick="toggle()">
				<img src="media/how.png" width="18" height="20">&nbsp;<?php
		if(isset($_SESSION['logged'])){
	 echo $_SESSION['username'];
 }	
?></a></li>
		</ul>
		<div class="toggle" onClick="toggle()"></div>
	</header>
	<section id="profile">
		<div class="pbox">
		<h1>Edit your profile</h1><br>
		 <form METHOD="POST" ACTION="edit-profile.php">
		  	<p>Fullname</p>
		  	<input type="text" name="fullname" placeholder="Enter fullname">
		  	<p>Email</p>
		  	<input type="email" name="email" placeholder="Enter email">
		  	<p>Date of bith</p>
		  	<input type="date" name="dob">
		  	<p>Address</p>
		  	<input type="text" name="address" placeholder="Enter address and code">
		  	<p>Username</p>
		  	<input type="text" name="username" placeholder="Enter Username">
		  	<input type="submit" name="update" value="Update information"><br>
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