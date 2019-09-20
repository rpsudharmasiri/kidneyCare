<?php session_start(); ?>

<?php 

	//checking if a user is logged in
	if(!isset($_SESSION['a_id'])) {

		header('Location: admin-login.php');
}
if(!isset($_SESSION['message'])){
		$_SESSION['message'] = "";
	}

?>

<!DOCTYPE html>

<html>
<head>
	<title>Admin</title>
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
					<li class="welcome"> Welcome  <?php echo $_SESSION['name']; ?> <a href="logout.php" onclick="return confirm('Are you sure you want to logout?');">  |  Log Out</a></li>

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
			<li><a href="admin.php">Home</a></li>
			<li><a href="view-questions.php">Questions</a></li>
			<li><a href="view-posts.php">Posts</a></li>
			<li><a href="view-events-admin.php">EVENTS</a></li>
			<li><a href="view-requests.php">Requests</a></li>
			<li><a href="#">About Us</a></li>
		
		</ul>

	</nav>
	

	<br><br>
	<h1 style="margin-left: 80px; ">Administrator</h1>
	<br><br>

<div class="button-admin">
	<button id="add-admin" onclick="window.location.href = 'add-new-admin.php';"><i class="fas fa-user-plus"></i> Add Admin</button>
 	

 	<button onclick="window.location.href = 'add-event.php';"><i class="far fa-calendar-alt"></i> Add new Event</button>
 	

 	<button onclick="window.location.href = 'view-org-admin.php';"><i class="fas fa-address-card"></i> Organ donor requests</button>
	

 	<button onclick="window.location.href = 'view-accepted-org.php';"><i class="fas fa-users"></i> Registered organ donors</button>

 	<button onclick="window.location.href = 'view-user.php';"><i class="fas fa-user-alt"></i> View general users</button>


 	<button onclick="window.location.href = 'view-pro.php';"><i class="fas fa-user-tie"></i> View Professionals</button>

 	<button onclick="window.location.href = 'view-admin.php';"><i class="fas fa-users-cog"></i> View Administrator</button>

 	<button onclick="window.location.href = 'change-password-admin.php';"><i class="fas fa-key"></i> Change password</button>
 	
</div>



</body>
</html>