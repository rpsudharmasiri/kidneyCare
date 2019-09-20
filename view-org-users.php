<?php session_start(); ?>
<?php require_once( 'inc/connection.php' );	 ?>
<?php 

	//checking if a user is logged in
	if(!isset($_SESSION['guser_id']) AND !isset($_SESSION['pro_id'])) {

		header('Location: index.php');
}
?>
<?php 
	$blood = ''; 

?>

<?php 

if (isset($_POST['submit'])) {

	$user_list			= '';
	$blood 				= $_POST['blood_group'];


			



//getting list of users
$query = "SELECT * FROM organs WHERE acc = 1 AND blood_group = '{$blood}' ORDER BY org_id";
$users = mysqli_query($connection,$query);

if ($users) {
	while ($user = mysqli_fetch_assoc($users))
			{
		$user_list .= "<tr>";
		$user_list .= "<td>{$user['org_id']}</td>";
		$user_list .= "<td>{$user['first_name']}</td>";
		$user_list .= "<td>{$user['last_name']}</td>";
		//$user_list .= "<td>{$user['age']}</td>";
		//$user_list .= "<td>{$user['NIC']}</td>";
		//$user_list .= "<td>{$user['email']}</td>";
		//$user_list .= "<td>{$user['phone_num']}</td>";
		$user_list .= "<td>{$user['blood_group']}</td>";
		//$user_list .= "<td>{$user['address1']}</td>";
		//$user_list .= "<td>{$user['address2']}</td>";
		//$user_list .= "<td>{$user['city']}</td>";
		$user_list .= "<td>{$user['district']}</td>";

		//$user_list .= "<td><a href = \"accept-org.php?user_id={$user['org_id']}\"onclick=\"return confirm('Are you sure you Confirm this Professioner request?');\">Accept</a></td>";

		//$user_list .= "<td><a href = \"reject-org.php?user_id={$user['org_id']}\"onclick=\"return confirm('Are you sure you want to remove this Professioner request?');\">Decline</a></td>";

		$user_list .= "</tr>";
			}
		}		
else{echo "Database query failed";}
	}
else
{

$user_list = '';

//getting list of users
$query = "SELECT * FROM organs WHERE acc = 1 ORDER BY org_id";
$users = mysqli_query($connection,$query);

if ($users) {
	while ($user = mysqli_fetch_assoc($users)){

		$user_list .= "<tr>";
		$user_list .= "<td>{$user['org_id']}</td>";
		$user_list .= "<td>{$user['first_name']}</td>";
		$user_list .= "<td>{$user['last_name']}</td>";
		$user_list .= "<td>{$user['blood_group']}</td>";
		$user_list .= "<td>{$user['district']}</td>";

		//$user_list .= "<td><a href = \"accept-org.php?user_id={$user['org_id']}\"onclick=\"return confirm('Are you sure you Confirm this Professioner request?');\">Accept</a></td>";

		//$user_list .= "<td><a href = \"reject-org.php?user_id={$user['org_id']}\"onclick=\"return confirm('Are you sure you want to remove this Professioner request?');\">Decline</a></td>";

		$user_list .= "</tr>";

			}
		}
	else{echo "Database query failed";}

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
			<li><a href="admin.php">Home</a></li>
			<li><a href="view-questions.php">Questions</a></li>
			<li><a href="posts.php">Posts</a></li>
			<li><a href="#">Services</a></li>
			<li><a href="#">About Us</a></li>
			
		</ul>

	</nav>
	

	<main>
		<h1>Find an organ donor</h1>

		<form action="view-org-users.php" method="post">
			
			<p><label> Search by Blood group &nbsp;&nbsp;</label>
			<select style="width: 7%; height:30px;" id="List" name="blood_group" >

				<option value="0">select</option>
				<option value="A+">A+</option>
				<option value="B+">B+</option>
				<option value="AB+">AB+</option>
				<option value="O+">O+</option>
				<option value="A-">A-</option>
				<option value="B-">B-</option>
				<option value="AB-">AB-</option>
				<option value="O-">O-</option>

			</select>
			<button style="width: 15%" type="submit" name="submit">
				Search
			</button>

			</p>


			<?php 
				if ( $blood == "0") {
				echo "please enter a blood group";
					}
				if (!$blood == "0") {
					echo "Search results for  " .$blood. "  blood group ";			}
				
				
			?>

		</form>



<br>

		<table class="masterlist">
			<tr>
				
				<th>ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Blood group</th>
				<th>District</th>
				
			</tr>

			<?php echo $user_list; ?>

		</table>
	
	</main>


</body>
</html>