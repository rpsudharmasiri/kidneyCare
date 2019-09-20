<?php session_start(); ?>
<?php require_once( 'inc/connection.php' );	 ?>

<?php 

	//checking if a user is logged in
	if(!isset($_SESSION['pro_id'])) {

		header('Location: login2.php');
}

	if(!isset($_SESSION['message'])){
		$_SESSION['message'] = "";
	}
?>

<?php 

$user_list = '';

//getting list of users
$query = "SELECT * FROM pro WHERE pro_id = {$_SESSION['pro_id']}";
$users = mysqli_query($connection,$query);

if ($users) {
	while ($user = mysqli_fetch_assoc($users)){

		$user_list .= "<tr>";
		$user_list .= "<td>{$user['pro_id']}</td>";
		$user_list .= "<td>{$user['first_name']}</td>";
		$user_list .= "<td>{$user['last_name']}</td>";
	
		$user_list .= "<td>{$user['email']}</td>";
		$user_list .= "<td><a href = \"edit-my-pro.php?user_id={$user['pro_id']}\">Edit</a></td>";

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
	<title>Edit my profile</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

	<header>
		
		<div class = "loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> <a href="logout.php"
			onclick="return confirm('Are you sure you want to logout?');">Log Out</a></div>

	</header>
	<div class="infor"> <?= $_SESSION['message'] ?> </div>
	

	<main>
		<h1>Edit my profile</h1>

		<table class="masterlist">
			<tr>
				
				<th>ID</th>
				<th>First Name</th>
				<th>Last Name</th>
			
				<th>Email</th>
				<th>Edit</th>
				
			</tr>

			<?php echo $user_list; ?>

		</table>


		
		
	</main>
</body>
</html>