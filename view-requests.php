<?php session_start(); ?>
<?php require_once( 'inc/connection.php' );	 ?>
<?php 

	//checking if a user is logged in
	if(!isset($_SESSION['a_id'])) {

		header('Location: admin-login.php');
}
?>


<?php 

$user_list = '';

//getting list of users
$query = "SELECT * FROM request ORDER BY pro_id";
$users = mysqli_query($connection,$query);

if ($users) {
	while ($user = mysqli_fetch_assoc($users)){

		$user_list .= "<tr>";
		$user_list .= "<td>{$user['pro_id']}</td>";
		$user_list .= "<td>{$user['first_name']}</td>";
		$user_list .= "<td>{$user['last_name']}</td>";
		$user_list .= "<td>{$user['pro_for']}</td>";
		$user_list .= "<td>{$user['email']}</td>";



		$user_list .= "<td><form  action = 'mail-accept-pro.php' method = 'POST'>
								
								<input type = 'hidden' name = 'pro_id' value = '".$user['pro_id']."'>
								<input type = 'hidden' name = 'email' value = '".$user['email']."'>
								<input type = 'hidden' name = 'first_name' value = '".$user['first_name']."'>

								<button style ='width:100px; height:30px; background-color:green; border:none; color:white;cursor:pointer; float:right; margin-right:2px; margin-bottom:20px; border-radius:4px;' type='submit' name='acceptpro'onclick=\"return confirm('Are you sure you want to Confirm this Professioner request?');\">Accept</button>
								</form></td>";


		$user_list .= "<td><form  action = 'mail-for-decline-pro.php' method = 'POST'>
								
								<input type = 'hidden' name = 'pro_id' value = '".$user['pro_id']."'>
								<input type = 'hidden' name = 'email' value = '".$user['email']."'>
								<input type = 'hidden' name = 'first_name' value = '".$user['first_name']."'>

								<button style ='width:100px; height:30px; background-color:red; border:none; color:white;cursor:pointer; float:right; margin-right:2px; margin-bottom:20px;border-radius:4px;' type='submit' name='declinepro'onclick=\"return confirm('Are you sure you want to remove this Professioner request?');\">Decline</button>
								</form></td>";

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
	<title>Professionals</title>
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
		<h1>Professionals Requests</h1>

		<table class="masterlist">
			<tr>
				
				<th>ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Profession</th>
				<th>Email</th>
				<th>Accept</th>
				<th>Decline</th>
			</tr>

			<?php echo $user_list; ?>

		</table>
	
	</main>


</body>
</html>