<?php session_start(); ?>

<!DOCTYPE html>

<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/next.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>

	<div class="wrapper">
		<div class="top-bar clearfix">
			<div class="top-bar-links">	
				<ul>
					<li><a href="login2.php">Professionals Login</a></li>
					<li><a href="login.php">User Login</a></li>
					<li><a href="admin-login.php">Admin</a></li>
					<li><a href="#">Contact Us</a></li>

				</ul>	
			</div><!--ttop-bar-links-->

		</div><!--top-bar-->
	</div><!--wrapper-->
<?php 
	if (isset($_GET['logout'])) {

			echo '<p class="info">You have successfully logged out</p>';
		}
?>





	<header class="clearfix">
		<div class="logo">
			<h1>Kidney Care</h1>
			<p>Prevention is better than cure</p>

		</div> <!--logo-->

		<div class="socialmedia">
			<ul>
				<li><a href="#"><i class="fab fa-linkedin-in fab fw"></i></li></a>
				<li><a href="#"><i class="fab fa-facebook-square fab fw"></i></a></li>
				<li><a href="#"><i class="fab fa-twitter-square fab fw"></i></a></li>
				<li><a href="#"><i class="fab fa-google-plus-square fab fw"></i></a></li>
				<li><a href="#"><i class="fab fa-instagram fab fw"></i></a></li>
			</ul>
			
		</div><!--socialmedia-->
		

	</header>


	<nav>

		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="prevention.php">Prevention</a></li>
			<li><a href="ayur.php">Ayurvedic</a></li>
			<li><a href="#">Kidney Disease</a></li>
			<li><a href="view-event-users.php">Events</a></li>
			<li><a href="add-new-org.php">Be an Organ Donor</a></li>
			<li><a href="#">Contact Us</a></li>
		</ul>

	</nav>



	

	<!-- for image and register buttons -->
	<div class="intro">
			<div class="introimage">
				<img src="img/doctor-clean6.jpg">
			</div><!--for image-->

				<div class="introtext">
					<form  style="width:25%; float:right; padding-top:25px; padding-right: 25px;" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="hosted_button_id" value="TWZ4TGKEFWCXY">
					<input type="image" style="border-width: 0px; border-color: ;" src="img/donate1.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
					<img alt="" border="0" src="https://www.paypalobjects.com/en_AU/i/scr/pixel.gif" width="1" height="1">
					</form>

					<h1>Register with us</h1>
						
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat.<br><br><br>

					<a href="add-new-user.php" class="btn btn-one">General User Account</a>
				
					<a href="request.php" class="btn btn-two">Professional Account</a>

					</p>
				
					
		</div><!--register links -->
	</div>

</body>
</html>