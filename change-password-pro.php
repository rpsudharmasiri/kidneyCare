
<?php session_start(); ?>
<?php $_SESSION['message'] = ''; ?>
<?php require_once( 'inc/connection.php' );	 ?>
<?php require_once('inc/functions.php'); ?>
<?php 

	//checking if a user is logged in
	if(!isset($_SESSION['pro_id'])) {

		header('Location: login2.php');
}

?>

<?php 

	$errors = array();

	//$user_id	='';
	$first_name = '';
	$last_name = '';
	$pro_for = '';
	$email = '';
	

	if (isset($_SESSION['pro_id'])) {
		//getting user id
		$user_id = mysqli_real_escape_string($connection, $_SESSION['pro_id']);

		if (!$user_id == $_SESSION['pro_id'] ) {
			header("Location: professionals.php");

		}

		$query = "SELECT * FROM pro WHERE pro_id = {$_SESSION['pro_id']} LIMIT 1";
		//executing query
		$result_set = mysqli_query($connection, $query);

		//checking query
		if ($result_set) {
			if (mysqli_num_rows($result_set) == 1) {
				//valid user found

				$result = mysqli_fetch_assoc($result_set);

					$first_name = $result['first_name'];
					$last_name = $result['last_name'];
					$pro_for = $result['pro_for'];
					$email = $result['email'];

			}else{
				//user not found
				header('Location: edit-my-pro.php?err=user_not_found');
			}
			
		}else{
			//query failed
			//header('Location: view-user.php?err=query_failed');
			echo ("error" . mysqli_error($connection));

		}

	}


	if (isset($_POST['submit'])) {

	// assigning variables for display right records
	//$user_id = $_POST['user_id'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	
	

	//checking required fields
		
		$req_fields = array('password','confirm_password');
		
		foreach ($req_fields as $field) {
			if (empty(trim($_POST[$field]))) {
			$errors[] = $field .' is required';
			}
		}
	//checking max length

		$max_len_fields = array('password' => 100);
		
		foreach ($max_len_fields as $field => $max_len) {
			if (strlen(trim($_POST[$field])) > $max_len ) {
			$errors[] = $field .' must be less than'. $max_len . ' charactors';
			}
		}

	



		//checking NIC number
		if ($password==$confirm_password) {
			
		}else{

			$errors[] = "Your didn't typed your password twice correctly";
		}
		//checking the password is in valid format
		
		$uppercase = preg_match('@[A-Z]@', $password);
		$lowercase = preg_match('@[a-z]@', $password);
		$number    = preg_match('@[0-9]@', $password);

		if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
  				
				$errors[] = "Your password must have at least 8 digits,one uppercase letter,one lowercase letter and one number ";

		}





		if (empty($errors)) {
			
			// no errors found  adding new data

			$password = mysqli_real_escape_string($connection,$_POST['password']);
			$hashed_password = sha1($password);
			
			

			//query
			$query = "UPDATE pro SET password ='{$hashed_password}' WHERE pro_id = {$_SESSION['pro_id']} LIMIT 1 ";


			$result = mysqli_query($connection, $query);

			if ($result) {
				// query successfull
				$_SESSION['message'] = " Password changed ";
				header('Location: my-pro.php?password_updated_true');
			} else {
				$errors[] = 'Failed to update password';
			}
		
		}


	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Change password</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>

	<header>
		
		<div class = "loggedin"> Welcome <?php echo $_SESSION['first_name']; ?> <a href="logout.php">Log Out</a></div>
		

	</header>
	<div class="infor"> <?= $_SESSION['message'] ?> </div>
	<main>
	<h1> Change Password</h1>

		<a href="my-pro.php">Cancel</a>

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

		<form action="change-password-pro.php" class="add-user" method="post">
			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>" >

		<p>
			<label for="">First Name:</label>
			<input type="text" name="first_name"<?php echo 'value ="' . $first_name . '"'; ?>disabled>

		</p>

		<p>
			<label for="">Last Name:</label>
			<input type="text" name="last_name"<?php echo 'value ="' . $last_name . '"'; ?>disabled>

		</p>

		

		<p>
			<label for="">Email Address:</label>
			<input type="text" name="email"<?php echo 'value ="' . $email . '"'; ?>disabled>
		</p>
		<p>
			<label for="">Enter New Password:</label>
			<input type="password" name="password">

		</p>
		<p>
			<label for="">Confirm Password:</label>
			<input type="password" name="confirm_password">

		</p>

		
		<p>
			<label for="">&nbsp;</label>
			<button type="submit" name="submit" onclick="return confirm('Click OK to change password');">change password</button>

		</p>
		</form>
	</main>
</body>
</html>
<?php mysqli_close($connection);?> 