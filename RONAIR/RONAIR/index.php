<?php
	session_start();
if (! isset($_SESSION['logged']) ||  $_SESSION['logged'] !== true) {
	header ("Location: login.php");
	exit;
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
			<li><a href="#blog" onClick="toggle()">Blog</a></li> 
			<li><a href="#contact" onClick="toggle()">Contact</a></li> 
			<li><a href="#c" onClick="toggle()">City: <?php
	$user_ip =getenv('REMOTE_ADDR');
	$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip_$user_ip"));
	$city = $geo["geoplugin_city"];
	echo "".$city."";
	?></a></li>
			<li><a href="password.php" onClick="toggle()">Profile</a></li>
			<li><a href="logout.php" onClick="toggle()">Log out</a></li>
			<li><a href="#contact" class="active" onClick="toggle()">
				<img src="media/how.png" width="18" height="20">&nbsp;<?php
		if(isset($_SESSION['logged'])){
	 echo $_SESSION['username'];
 }	
?></a></li>
		</ul>
		<div class="toggle" onClick="toggle()"></div>
	</header>
	<section id="home">
		<h1 class="jiji">RONAIR</h1>
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
			<form action="POST" class="gg-new" action="#">
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
				  <div class="contact-sub">
				    <input type="button" value="Send" onClick="openForm()">
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
	<div id="rona-popup">
      <div class="rv-popup" id="popupForm">
        <div class="rj">
        <h1 class="rp-1">FAQS</h1>
        <p id="uu">can i check this form all the time?</p>
        <p>Yes you can</p>
        <p id="uu">who are your major stakehoders?</p>
        <p>All of our users</p>
        <p id="uu">what can i do to join?</p>
        <p>You joined when you registered</p>
        <p id="uu">who is in charge here?</p>
        <p>Our governing body is in Geneva, yes like the UN</p><br>
<form method="POST" class="gg-new" action="mailto:ronaldboateng777@gmail.com">
				  <div class="contact-sub">
				    <input type="text" placeholder="Name" name="name">
				    <input type="text" placeholder="Email address" name="mail">
				    <input type="text" placeholder="Enter Message" name="message" id="message">
				    <input type="button" value="Send" onclick="confSubmit(this.form);">
				  </div>
				</form>
				<p id="gh">Haven't found your answer? fill the form or <a href="index.php">Go back</a></p>
        
      </div>
      </div>
    </div>
	<script type="text/javascript">
		function toggle(){
			var header = document.getElementById("header")
			header.classList.toggle('active')
		}

		function openForm() {
        document.getElementById("rona-popup").style.display="block";
      }
      
      function closeForm() {
        document.getElementById("rona-popup").style.display= "none";
      }

      window.onclick = function(event) {
        var modal = document.getElementById('rona');
        if (event.target == modal) {
          closeForm();
        }
      }

      function confSubmit(form){
      	if (confirm("Confirm?")) {
      		form.submit();
      	}else{
      		closeForm();
      		alert("Closed");
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