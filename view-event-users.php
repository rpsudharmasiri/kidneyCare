<?php session_start(); ?>
<?php require_once( 'inc/connection.php' );	 ?>
<?php 

	//checking if a user is logged in

?>




<!DOCTYPE html>

<html>
<head>
	<title>Events</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/next.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>
<body >

	<div class="wrapper">
		<div class="top-bar clearfix">
			<div class="top-bar-links">	
				//<ul>
					

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
			<li><a href="index.php">Home</a></li>
			<li><a href="prevention.php">Prevention</a></li>
			<li><a href="ayur.php">Ayurvedic</a></li>
			<li><a href="#">Kidney Disease</a></li>
			<li><a href="view-event-users.php">Events</a></li>
			<li><a href="add-new-org.php">Be an Organ Donor</a></li>
			<li><a href="#">Contact Us</a></li>
			
		</ul>

	</nav>
	

	<main>

		<h1>Events</h1>

		<?php 

$user_list = '';

//getting list of users
$query = "SELECT * FROM events ";
$users = mysqli_query($connection,$query);

if ($users) {
	while ($user = mysqli_fetch_assoc($users)){

					echo "<div class ='event-box'>";

					echo "<p id='event_title'>".$user['event_title']."</p>";
					echo "In ".$user['event_location']."&emsp;&emsp;";

					echo "On ".$user['event_date']."<br><br><br>";


					echo $user['event_dis'];

					/*echo "<form class= 'view-more' method='POST' action='view_more_events_users.php'>
							<input type ='hidden' name='event_id' value='".$user['event_id']."'>
							<button>View More >></button>
							</form>";*/

					echo "</p></div>";


	}
}
else{
	echo "Database query failed";
}

?>
	
	</main>


</body>
</html>