
<?php session_start(); ?>

<?php require_once( 'inc/connection.php' );	 ?>
<?php require_once('inc/functions.php'); ?>
<?php 

	//checking if a user is logged in
	if(!isset($_SESSION['a_id'])) {

		header('Location: admin-login.php');
}

?>

<?php 

	$errors = array();

	$user_id	='';
	$first_name = '';
	$last_name = '';
	$NIC = '';
	$email = '';
	

	if (isset($_GET['user_id'])) {
		//getting user id
		$user_id = mysqli_real_escape_string($connection, $_GET['user_id']);

		$query = "SELECT * FROM general_users WHERE guser_id = {$user_id} LIMIT 1";
		//executing query
		$result_set = mysqli_query($connection, $query);

		//checking query
		if ($result_set) {
			if (mysqli_num_rows($result_set) == 1) {
				//valid user found

				$result = mysqli_fetch_assoc($result_set);

					$first_name = $result['first_name'];
					$last_name = $result['last_name'];
					$NIC = $result['NIC'];
					$email = $result['email'];

			}else{
				//user not found
				header('Location: view-user.php?err=user_not_found');
			}
			
		}else{
			//query failed
			//header('Location: view-user.php?err=query_failed');
			echo ("error" . mysqli_error($connection));

		}

	}


?>


<!DOCTYPE html>
<html>
<head>
	<title>Details of the questioner</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>

	<header>
		
		<div class = "loggedin"> Welcome <?php echo $_SESSION['name']; ?> <a href="logout.php">Log Out</a></div>
		

	</header>
	<main>
	<h1>Details of the questioner</h1>

		<a href="view-user.php">Cancel</a>

		<?php 
			if (!empty($errors)) {

				echo '<div class = "errmsg">';
				echo '<b>There are errors in your form.</b><br>';
				foreach ($errors as $error) {
					$error = ucfirst(str_replace("_"," ",$error));
					echo $error . '<br>';
				}

				echo '</div>';
			}



		?>

		<form action="" class="add-user" method="post">
			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>" >

		<p>
			<label for="">First Name:</label>
			<input type="text" name="first_name"  <?php echo 'value ="' . $first_name . '"'; ?> disabled>

		</p>

		<p>
			<label for="">Last Name:</label>
			<input type="text" name="last_name"<?php echo 'value ="' . $last_name . '"'; ?>disabled>

		</p>

		<p>
			<label for="">NIC Number:</label>
			<input type="text" name="NIC"<?php echo 'value ="' . $NIC . '"'; ?>disabled>
		</p>

		<p>
			<label for="">Email Address:</label>
			<input type="text" name="email"<?php echo 'value ="' . $email . '"'; ?>disabled>
		</p>

		
		<p>
			<label for="">&nbsp;</label>

		</p>
		</form>
	</main>
</body>
</html>
<?php mysqli_close($connection);?> 