<?php session_start(); ?>
<?php require_once( 'inc/connection.php' );	 ?>
<?php 

	//checking if a user is logged in
	if(!isset($_SESSION['pro_id'])) {

		header('Location: login2.php');
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Professionals Page</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/next.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>

<body>

		<div class="wrapper">
		<div class="top-bar clearfix">
			<div class="top-bar-links">	
				<ul>
					
					
					
					<li><div class="infor"> Last Action   |    </div></li>
					<li class="welcome"> Welcome  <?php echo $_SESSION['first_name']; ?> <a href="logout.php" onclick="return confirm('Are you sure you want to logout?');">  |  Log Out</a></li>

				</ul>	
			</div><!--ttop-bar-links-->

		</div><!--top-bar-->
	</div><!--wrapper-->

	
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

		
		<div class = "loggedin">  </a></div>

	</header>

	<nav>
		<ul>
			<li><a href="home.php">Home</a></li>
			<li><a href="questions.php">Questions</a></li>
			<li><a href="posts.php">Posts</a></li>
			<li><a href="view-org-users.php">FIND AN ORGAN DONOR</a></li>
			<li><a href="#">Services</a></li>
			<li><a href="view-event-users.php">Events</a></li>
			<li><a href="my-pro.php">My profile</a></li>
		</ul>

	</nav>
		

<div class="pro">
		<div class="proimage">
			<img src="img/pic2.jpg">
		</div><!--for image-->

			<div class="protext">

					<h1>Share your experience.</h1>
					<a href="add-post.php" class="btn">Post from here</a><br><br><br>

			</div>
</div>

</body>
</html>
<?php mysqli_close($connection);?> 