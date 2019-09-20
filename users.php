<?php session_start(); ?>
<?php require_once( 'inc/connection.php' );	 ?>

<?php 

	//checking if a user is logged in
	if(!isset($_SESSION['guser_id'])) {

		header('Location: login.php');
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Users Page</title>

	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/next.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>

<body>

	<div class="wrapper">
		<div class="top-bar clearfix">
			<div class="top-bar-links">	
				<ul>
					
					
					
					<li><div class="infor"> Last Action   |   <?= $_SESSION['message'] ?> </div></li>
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
			<li><a href="view-org-users.php">Find an Organ Donor</a></li>
			<li><a href="#">Services</a></li>
			<li><a href="view-event-users.php">Events</a></li>
			<li><a href="my.php">My profile</a></li>
		</ul>

	</nav>
	




	<div class="use">
			<div class="useimage">
				<img src="img/qu.png">
			</div><!--for image-->

				<div class="usetext">

					<h1>Your not alone....</h1>
					<a href="add-q.php" class="btn">Ask from Professionals</a><br><br><br>

				</div>
	</div>

</body>
</html>
<?php mysqli_close($connection);?> 