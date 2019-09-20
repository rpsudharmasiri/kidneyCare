<?php session_start(); ?>
<?php require_once( 'inc/connection.php' );	 ?>
<?php 

	//checking if a user is logged in
	if(!isset($_SESSION['guser_id']) AND !isset($_SESSION['pro_id'])) {

		header('Location: index.php');
}

if(!isset($_SESSION['message'])){
		$_SESSION['message'] = "";
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Users</title>
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

	</header>

	<nav>
		<ul>
			<li><a href="home.php">Home</a></li>
			<li><a href="questions.php">questions</a></li>
			<li><a href="posts.php">Posts</a></li>
			<li><a href="professionals.php">Professionals</a></li>
			<li><a href="users.php">Users</a></li>
			<li><a href="#">Contact Us</a></li>
		</ul>

	</nav>
	

	<div class="home1">
			<div class="home1image">
				<img src="img/home1.png">
			</div><!--for image-->

				<div class="home1text">
					<h1>Recently Added</h1><br>
					<p><br><br><br>

					
					<button class="btn btn-one" onclick="window.Location.href = 'questions.php';" >Questions</button>
					
					<button class="btn btn-two" onclick="window.Location.href = 'posts.php';" >Posts</button>

					</p>
				
					
				</div><!--register links -->
	</div>

</body>
</html>
<?php mysqli_close($connection);?> 