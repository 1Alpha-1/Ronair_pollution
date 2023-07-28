<?php
$username = "";
$password = "";
$fullname="";
$email="";
$date="";
$address="";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require 'configure.php';

	$username = $_POST['username'];
	$password = $_POST['password'];
	$fullname = $_POST['fullname'];
	$email = $_POST['email'];
	$date = $_POST['date'];
	$address = $_POST['address'];


	$database = "ronair";

	$db_found = new mysqli(DB_SERVER, DB_USER, DB_PASS, $database );

	if ($db_found) {		
		$SQL = $db_found->prepare('SELECT * FROM login WHERE username = ?');
		$SQL->bind_param('s', $username);
		$SQL->execute();
		$result = $SQL->get_result();

		if ($result->num_rows > 0) {
			$_SESSION['error'] = "*Username is taken";
		}
		else {
			$phash = password_hash($password, PASSWORD_DEFAULT);
			$SQL = $db_found->prepare("INSERT INTO login (fullname, email, dob, address, username, password) VALUES (?, ?, ?, ?, ?, ?)");
			$SQL->bind_param('ssssss', $fullname, $email, $date, $address, $username, $phash);
			$SQL->execute();

			header ("Location: login.php");
		}
	}
	else {
		$_SESSION['error'] = "Database Not Found";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sign Page</title>
	
</head>
<body>
	<header id="header">
		<a href="#" class="logo">RONAIR<img src="media/icon.png" height=25 width=25 alt="logo"></a>
		<ul>
        <li><a href="login.php" onClick="toggle()" class="ron-h">Home</a></li>
    </ul>
		<div class="toggle" onClick="toggle()"></div>
	</header>
	<section class="ron-sign">
	<div id="ron-main">
	<div class="ronbox">
		<h1>SIGN UP</h1>
		  <form METHOD ="POST" ACTION ="signup.php">
		  	<input type="text" name="fullname" placeholder="Enter fullname">
		  	<input type="email" name="email" placeholder="Enter Email">
		  	<input type="date" name="date">
		  	<input type="text" name="address" placeholder="Address with Postcode">
		  	<input type="text" name="username" placeholder="Enter Username" required>
		  	<input type="password" name="password" placeholder="Enter Password" required>
		  	<input type="submit" name="submit" value="Sign Up"><br>
		  	<span class="ront">Already have an account?</span> <a href="login.php">Login</a>
		  </form><br>
		  <?php
				if(isset($_SESSION['error'])){
					?>
					<div class="alert">
						<?php echo $_SESSION['error']; ?>
					</div>
					<?php
					unset($_SESSION['error']);
					}
					?>
	</div>
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
