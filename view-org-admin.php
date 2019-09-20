<?php session_start(); ?>
<?php require_once( 'inc/connection.php' );	 ?>
<?php 

	//checking if a user is logged in
	if(!isset($_SESSION['a_id'])) {

		header('Location: admin-login.php');
}
?>







<!DOCTYPE html>

<html>
<head>
	<title>Organ Donators</title>
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
		<h1>Organ Donors Requests</h1>

		<?php 

$user_list = '';

//getting list of users
$query = "SELECT * FROM organs WHERE acc = 0 ORDER BY org_id";
$users = mysqli_query($connection,$query);

if ($users) {
	while ($user = mysqli_fetch_assoc($users)){

		echo "<div class ='view-org-box'>";

		echo "<div id = 'show-personal'>";
		echo 	"Request ID : "."{$user['org_id']}<br>";
		echo	"Name   :  "."{$user['first_name']}"." ";
		echo	"{$user['last_name']}&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;";
		echo	"NIC Number    :  "."{$user['NIC']}&emsp;&emsp;&emsp;&emsp;&emsp;";
		echo	"Blood group   :   "."{$user['blood_group']}&emsp;&emsp;&emsp;&emsp;&emsp;";
		echo	"Age    :  "."{$user['age']}<br>";
		
		echo "</div>";

		echo  "<div id = 'show-contact'>";
		echo	"Email Address   :  "."{$user['email']}<br>";
		echo	"Contact Number    :   "."{$user['phone_num']}<br><br>";
		echo  "</div>";
		
		echo  "<div id = 'show-address' >";
		echo	"Address line 1   :   "."{$user['address1']}<br>";
		echo	"Address line 2    :  "."{$user['address2']}<br>";
		echo	"City    :  "."{$user['city']}<br>";
		echo	"District   :  "."{$user['district']}";
		echo  "</div>";
		

		//echo"<a href = \"accept-org.php?user_id={$user['org_id']}\"onclick=\"return confirm('Are you sure you want to Confirm this donor request?');\">Accept</a>";

		//echo"<a href = \"reject-org.php?user_id={$user['org_id']}\"onclick=\"return confirm('Are you sure you want to remove this donor request?');\">Decline</a>";

		
					//accept button
						echo "<form  action = 'mail.php' method = 'POST'>
								
								<input type = 'hidden' name = 'org_id' value = '".$user['org_id']."'>
								<input type = 'hidden' name = 'email' value = '".$user['email']."'>
								<input type = 'hidden' name = 'first_name' value = '".$user['first_name']."'>

								<button style ='width:100px; height:30px; background-color:green; border:none; color:white;cursor:pointer; float:right; margin-right:2px; margin-bottom:20px; border-radius:4px;' type='submit' name='acceptorg'onclick=\"return confirm('Are you sure you want to Confirm this donor request?');\">Accept</button>
								</form>";
								//decline button
						echo "<form  action = 'mail-for-decline-org.php' method = 'POST'>
								
								<input type = 'hidden' name = 'org_id' value = '".$user['org_id']."'>
								<input type = 'hidden' name = 'email' value = '".$user['email']."'>
								<input type = 'hidden' name = 'first_name' value = '".$user['first_name']."'>

								<button style ='width:100px; height:30px; background-color:red; border:none; color:white;cursor:pointer; float:right; margin-right:2px; margin-bottom:20px;border-radius:4px;' type='submit' name='declineorg'onclick=\"return confirm('Are you sure you want to remove this donor request?');\">Decline</button>
								</form><br>

								";

						
		echo "<br></div>";				

	}
}
else{
	echo "Database query failed";
}

?>

	
	</main>


</body>
</html>