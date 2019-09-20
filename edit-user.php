
<?php session_start(); ?>

<?php $_SESSION['message'] = ''; ?>

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


	if (isset($_POST['submit'])) {

	// assigning variables for display right records
	$user_id = $_POST['user_id'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$NIC = $_POST['NIC'];
	$email = $_POST['email'];
	

	//checking required fields
		
		$req_fields = array( 'user_id','first_name','last_name','NIC','email');
		
		foreach ($req_fields as $field) {
			if (empty(trim($_POST[$field]))) {
			$errors[] = $field .' is required';
			}
		}
	//checking max length

		$max_len_fields = array('first_name' => 100,'last_name' => 100,'NIC' => 50,'email' =>100);
		
		foreach ($max_len_fields as $field => $max_len) {
			if (strlen(trim($_POST[$field])) > $max_len ) {
			$errors[] = $field .' must be less than'. $max_len . ' charactors';
			}
		}

		//checking email address
		if (!is_email($_POST['email'])) {
			$errors[] = 'Email Address is invalid';
		}

		// checking if email address exists
		$email = mysqli_real_escape_string($connection,$_POST['email']);
		$query = "SELECT * FROM general_users WHERE email = '{$email}' AND guser_id != {$user_id} LIMIT 1";


		$result_set = mysqli_query($connection, $query);

		if ($result_set) {
			if (mysqli_num_rows($result_set)==1) {
				$errors[] = 'Email Address Already exists';
			}
		}

		//checking NIC number

		$NIC = mysqli_real_escape_string($connection,$_POST['NIC']);
		$query = "SELECT * FROM general_users WHERE NIC = '{$NIC}' AND guser_id != {$user_id} LIMIT 1";


		$result = mysqli_query($connection, $query);

		if ($result) {
			if (mysqli_num_rows($result)==1) {
				$errors[] = 'NIC NUMBER Already exists';
			}
		}
		if (!preg_match("/^[0-9]{9}[vVxX]$/", $NIC)) {
			$errors[] = 'Your NIC Number is not a acceptable one.';
		}

		if (empty($errors)) {
			
			// no errors found  adding new data

			$first_name = mysqli_real_escape_string($connection,$_POST['first_name']);
			$last_name = mysqli_real_escape_string($connection,$_POST['last_name']);
			

			//query
			$query = "UPDATE general_users SET first_name ='{$first_name}',last_name='{$last_name}',NIC = '{$NIC}',email = '{$email}' WHERE guser_id = {$user_id} LIMIT 1 ";


			$result = mysqli_query($connection, $query);

			if ($result) {
				// query successfull
				$_SESSION['message'] = "Information Updated";
				header('Location: view-user.php?user_updated_true');
			} else {
				$errors[] = 'Failed to update';
			}
		
		}


	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Edit General Users</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>

	<header>
		
		<div class = "loggedin"> Welcome <?php echo $_SESSION['name']; ?> <a href="logout.php">Log Out</a></div>
		

	</header>

	<div class="infor"> <?= $_SESSION['message'] ?> </div>
	<main>
	<h1>Edit General Users</h1>

		
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

		<form action="edit-user.php" class="add-user" method="post">
			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>" >

		<p>
			<label for="">First Name:</label>
			<input type="text" name="first_name"<?php echo 'value ="' . $first_name . '"'; ?>>

		</p>

		<p>
			<label for="">Last Name:</label>
			<input type="text" name="last_name"<?php echo 'value ="' . $last_name . '"'; ?>>

		</p>

		<p>
			<label for="">NIC Number:</label>
			<input type="text" name="NIC"<?php echo 'value ="' . $NIC . '"'; ?>>
		</p>

		<p>
			<label for="">Email Address:</label>
			<input type="text" name="email"<?php echo 'value ="' . $email . '"'; ?>>
		</p>

		
		<p>
			<label for="">&nbsp;</label>
			<a href="view-user.php" onclick="return confirm('Are you sure');" >Cancel</a>

			<button type="submit" name="submit" onclick="return confirm('Click OK to Update');">Update</button>

		</p>
		</form>
	</main>
</body>
</html>
<?php mysqli_close($connection);?> 