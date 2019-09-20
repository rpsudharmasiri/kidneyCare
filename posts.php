<?php session_start(); ?>
<?php require_once( 'inc/connection.php' );	 ?>


<!DOCTYPE html>

<html>
<head>
	<title>Posts</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body style="background-color: #ddd;">

	<header>
		
		<div class = "loggedin"> Welcome <a href="logout.php">Log Out</a></div>

	</header>
	

	<main>
		<h1>Posts</h1>

			<?php 


			//getting list of users
			$query = "SELECT * FROM pro INNER JOIN posts ON pro.pro_id = posts.pro_id";
			$users = mysqli_query($connection,$query);

			if ($users) {
				while ($user = mysqli_fetch_assoc($users)){

					
					echo "<div class = 'posts'><p>";

					echo "From <br><p>".$user['pro_for']." : ";
					echo $user['first_name']." ";
					echo $user['last_name']."<br><br>";

					echo "At ".$user['post_date']."</p><br>";
					
					echo "Title : ".$user['post_title']."<br><br>";
					echo $user['post_body'];
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