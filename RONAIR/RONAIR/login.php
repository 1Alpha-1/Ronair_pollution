<?php
	session_start();

	if(isset($_POST['login'])){
		require 'configure.php';

		$username = $_POST['username'];

		if(!isset($_SESSION['attempt'])){
			$_SESSION['attempt'] = 0;
		}

		if($_SESSION['attempt'] == 3){
			$_SESSION['error'] = 'Attempt limit reached';
		}
		else{
			$sql = "SELECT * FROM login WHERE username = '$username'";
			$query = $conn->query($sql);
			if($query->num_rows > 0){
				$row = $query->fetch_assoc();
				if(password_verify($_POST['password'], $row['password'])){
					$_SESSION["logged"] = true;
					$_SESSION["username"] = $username;
					$_SESSION['success'] = 'Login successful';
					header ('location: index.php');
					unset($_SESSION['attempt']);
				}
				else{
					$_SESSION['error'] = 'Password incorrect';
					$_SESSION['attempt'] += 1;
					if($_SESSION['attempt'] == 3){
						$_SESSION['attempt_again'] = time() + (10*60);
					}
				}
			}
			else{
				$_SESSION['error'] = 'No account with that username';
				$_SESSION['attempt'] += 1;
					if($_SESSION['attempt'] == 3){
						$_SESSION['attempt_again'] = time() + (10*60);
					}
			}

		}

	}
	else{
		$_SESSION['error'] = 'Fill up login form first';
	}

	if(isset($_SESSION['attempt_again'])){
		$now = time();
		if($now >= $_SESSION['attempt_again']){
			unset($_SESSION['attempt']);
			unset($_SESSION['attempt_again']);
		}
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>index</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/aos.css">
</head>
<body>
	<header id="header">
		<a href="#" class="logo">RONAIR<img src="media/icon.png" height=25 width=25 alt="logo"></a>
		<ul>
			<li><a href="#about" onClick="toggle()">About</a></li>
			<li><a href="#contact" onClick="toggle()">Contact</a></li>
			<li><a href="#blog" onClick="toggle()">blog</a></li>
			<li><a href="signup.php" class="active" onClick="toggle()" onmouseover="openForm()">Sign Up</a></li>
		</ul>
		<div class="toggle" onClick="toggle()"></div>
	</header>
	<section id="home">
		<h2>RONAIR</h2>
		<div class="nbox" data-aos="fade-down">
		<h1>Login Here</h1>
		 <form METHOD="POST" ACTION="login.php">
		  	<p>Username</p>
		  	<input type="text" name="username" placeholder="Enter Username">
		  	<p>Password</p>
		  	<input type="password" name="password" placeholder="Enter Password">
		  	<input type="submit" name="login" value="Login"><br>
		  </form>
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
	</section>
	<section id="about">
		<div data-aos="fade-down">
				<img src="media/icon.png" width="300" height="200">
		    </div>
			<div data-aos="fade-down">
				<h1 class="abt-hh">OUR MISSION AND VISION</h1>
				<p>We are a company that is dedicated to creating awareness about air pollution and the adverse effects it has on the environment. By joining our team, you can help bring this dream to pass. We are a group of young people who have come togeher from all walks of life, religion, races and even continents. Sign upnow and become a RONAIR PATRON!</p>
				<a href="">CONTINUE READING</a>
			</div>
	</section>
	<section id="blog">
			<div class="blog-a" data-aos="fade-down">
				<a href="https://www.nrdc.org/stories/air-pollution-everything-you-need-know"><img src="media/blog1.png" alt="blog1"></a>
				<p class="blogt">OUR PLANET IS IN DANGER</p>
				<a href="#">Click on the image to read more</a>
			</div>
			<div class="blog-b"  data-aos="fade-down">
				<a href="https://waqi.info/"><img src="media/blog2.png" alt="blog2"></a>
				<p class="blogt">LET'S HELP STOP AIR POLLUTION</p>
				<a href="#">Click on the image to read more</a>
			</div>
	</section>
	<section id="contact">
		<div class="huh" data-aos="fade-down">
			<video preload="auto" autoplay="autoplay" type="video/webm" src="media/b.webm" loop muted></video>
		</div>
		<div data-aos="fade-down">
			<form action="POST" class="ind-new" action="#">
				  <div class="contact-main">
				    <h1 class="yh">GET IN TOUCH WITH US</h1>
				  </div>

				  <div class="contact-sub">
				    <input type="text" placeholder="Name" name="name">
				    <input type="text" placeholder="Email address" name="mail">
				    <input type="text" placeholder="Enter Message" name="message" id="message">
				    <label>
				      <input type="checkbox" checked="checked" name="subscribe"> Daily Newsletter
				    </label>
				  </div>
				  <div class="contact sub">
				    <input type="submit" value="Subscribe">
				  </div>
				</form>
		</div>
	</section>
	<footer>
		<p class="ron-copyright">Copyright@2020, RONAIR.</p>
		<a href="#" class="logo">RONAIR<img src="media/icon.png" height=55 width=55 alt="logo"></a>
		<div class="ron-social">
			<img src="media/facebook.png" alt="facebook">
			<img src="media/twitter.png" alt="twitter">
			<img src="media/instagram.png" alt="instagram">
			<img src="media/tumblr.png" alt="tumblr">
			<img src="media/pinterest.png" alt="pinterest">
		</div>
	<button onclick="topFunction()" id="ron-up" title="back to top">Top</button>
	</footer>
	<div id="ronPopup">
      <div class="ron-popup" id="novapForm">
        <div class="ronp">
        <h1 class="ron-1">Get a free Air Quality Pollution Monitor home testing kit as a reward when you sign up</h1>
        <img src="media/popup.jpeg" alt="kit-picture">
        <a href="signup.php">SIGN UP</a>
        <p id="ron-g">*Click outside the pop-up to close</p>
      </div>
      </div>
    </div>
	<script type="text/javascript">
		function toggle(){
			var header = document.getElementById("header")
			header.classList.toggle('active')
		}

		function openForm() {
        document.getElementById("ronPopup").style.display="block";
      }
      
      function closeForm() {
        document.getElementById("ronPopup").style.display= "none";
      }

      window.onclick = function(event) {
        var modal = document.getElementById('ronPopup');
        if (event.target == modal) {
          closeForm();
        }
      }
	</script>
	<script src="js/aos.js"></script>
	<script type="text/javascript">
		AOS.init({
			duration:1100,
		});
	</script>
	<script>
var mybutton = document.getElementById("ron-up");

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 540 || document.documentElement.scrollTop > 540) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
	</script>
</body>
</html>