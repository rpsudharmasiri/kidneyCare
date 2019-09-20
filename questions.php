<?php session_start(); ?>
<?php require_once( 'inc/connection.php' );	 ?>
<?php require_once( 'inc/functions.php' );	?>

<?php 

$user_list = '';

//getting list of users


?>




<!DOCTYPE html>

<html>
<head>
	<title>Questions</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/next.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>

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
			<li><a href="home.php">Home</a></li>
			<li><a href="questions.php">questions</a></li>
			<li><a href="posts.php">Posts</a></li>
			<li><a href="professionals.php">Professionals</a></li>
			<li><a href="users.php">Users</a></li>
			<li><a href="#">Contact Us</a></li>
		</ul>

	</nav>

<div  style="background-color: #ddd;">
	<main>
		<h1>Questions</h1>

		<?php 
			$query = "SELECT * FROM general_users INNER JOIN questions ON general_users.guser_id = questions.guser_id";
			$users = mysqli_query($connection,$query);

			if ($users) {
				while ($user = mysqli_fetch_assoc($users)){

					
					echo "<div class ='ques-box'><p>";

					echo "From <br><p>".$user['first_name']." ";
					echo $user['last_name']."<br><br>";

					echo "At ".$user['q_date']."</p><br>";

					echo "Title : ".$user['q_title']."<br><br>";
					echo $user['q_body'];

					echo "<form class= 'view-more' method='POST' action='comment-questions.php'>
							<input type ='hidden' name='q_id' value='".$user['q_id']."'>
							<button style='color:purple;'>View More >></button>
							</form>";
					echo "</p></div>";
				}
			}
			else{
				echo "Database query failed";
			}
		?>

	</main>
</div>

</body>
</html>