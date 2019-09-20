<?php session_start(); ?>
<?php require_once( 'inc/connection.php' );	?>
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

//getting list of posts
$query = "SELECT * FROM posts ORDER BY post_id";
$users = mysqli_query($connection,$query);

if ($users) {
	while ($user = mysqli_fetch_assoc($users)){

		$user_list .= "<tr>";
		$user_list .= "<td>{$user['post_id']}</td>";
		$user_list .= "<td>{$user['pro_id']}</td>";
		$user_list .= "<td>{$user['post_title']}</td>";
		$user_list .= "<td>{$user['post_body']}</td>";
		$user_list .= "<td>{$user['post_date']}</td>";
		$user_list .= "<td><a href = \"view-pro-for-posts.php?user_id={$user['pro_id']}\">Details</a></td>";
		$user_list .= "<td><a href = \"delete-posts.php?user_id={$user['pro_id']}\"onclick=\"return confirm('Are you sure you want to permenantly remove this Post?');\">Delete</a></td>";

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
	<title>View posts</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

	<header>
		
		<div class = "loggedin"> Welcome <?php echo $_SESSION['name']; ?> <a href="logout.php">Log Out</a></div>

	</header>
	<div class="infor"> <?= $_SESSION['message'] ?> </div>
	

	<main>
		<h1>View posts</h1>

		<table class="masterlist">
			<tr>
				
				<th>post ID</th>
				<th>pro ID</th>
				<th>Title</th>
				<th>Post</th>
				<th>Posted At</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>

			<?php echo $user_list; ?>

		</table>
		
	</main>

</body>
</html>