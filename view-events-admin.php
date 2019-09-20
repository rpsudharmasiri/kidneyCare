<?php session_start(); ?>
<?php require_once( 'inc/connection.php' );	 ?>
<?php 

	//checking if a user is logged in
	if(!isset($_SESSION['a_id'])) {

		header('Location: admin-login.php');
}

if(!isset($_SESSION['message'])){
		$_SESSION['message'] = "";
	}
?>


<?php 

$user_list = '';

//getting list of users
$query = "SELECT * FROM admin INNER JOIN events ON admin.a_id = events.a_id";

$users = mysqli_query($connection,$query);

if ($users) {
	while ($user = mysqli_fetch_assoc($users)){

		$user_list .= "<tr>";
		$user_list .= "<td>{$user['event_id']}</td>";
		$user_list .= "<td>{$user['name']}</td>";
		$user_list .= "<td>{$user['event_title']}</td>";
		$user_list .= "<td>{$user['event_location']}</td>";
		$user_list .= "<td>{$user['event_date']}</td>";
		$user_list .= "<td>{$user['event_time']}</td>";
		$user_list .= "<td>{$user['event_dis']}</td>";
		$user_list .= "<td><a href = \"edit-events.php?user_id={$user['event_id']}\">Edit</a></td>";
		$user_list .= "<td><a href = \"delete-event.php?user_id={$user['event_id']}\"onclick=\"return confirm('Are you sure you want to permenantly remove this event?');\">Delete</a></td>";

		$user_list .= "</tr>";


	}
}
else{
	echo "Database query failed";
}

?>




<!DOCTYPE html>

<html>
<head>
	<title>View evnts</title>
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
			<li><a href="#">Services</a></li>
			<li><a href="#">About Us</a></li>
			
		</ul>

	</nav>
	

	<main>
		<h1>View events</h1>

		<table class="masterlist">
			<tr>
				
				<th>ID</th>
				<th>Hosted by</th>
				<th>Title</th>
				<th>Location</th>
				<th>Date</th>
				<th>Time</th>
				<th>Discription</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>

			<?php echo $user_list; ?>

		</table>
	
	</main>


</body>
</html>