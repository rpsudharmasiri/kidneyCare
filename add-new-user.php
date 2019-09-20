
<?php session_start(); ?>

<?php require_once( 'inc/connection.php' );	 ?>
<?php require_once('inc/functions.php'); ?>
<?php 

$_SESSION['message'] = '';
?>

<?php 

	$errors = array();

	$first_name = '';
	$last_name = '';
	$NIC = '';
	$email = '';
	$password = '';


	if (isset($_POST['submit'])) {

	// assigning variables for display right records
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$NIC = $_POST['NIC'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];


	//checking required fields
		
		$req_fields = array('first_name','last_name','NIC','email','password','confirm_password');
		
		foreach ($req_fields as $field) {
			if (empty(trim($_POST[$field]))) {
			$errors[] = $field .' is required.';
			}
		}
	//checking max length

		$max_len_fields = array('first_name' => 100,'last_name' => 100,'NIC' => 50,'email' =>100,'password' =>100);
		
		foreach ($max_len_fields as $field => $max_len) {
			if (strlen(trim($_POST[$field])) > $max_len ) {
			$errors[] = $field .' must be less than'. $max_len . ' charactors.';
			}
		}

		//checking email address
		if (!is_email($_POST['email'])) {
			$errors[] = 'Email Address is invalid.';
		}



		// checking if email address exists
		$email = mysqli_real_escape_string($connection,$_POST['email']);
		$query = "SELECT * FROM general_users WHERE email = '{$email}'  LIMIT 1";


		$result_set = mysqli_query($connection, $query);

		if ($result_set) {
			if (mysqli_num_rows($result_set)==1) {
				$errors[] = 'Email Address Already exists.';
			}
		}

		// checking if email address exists in pro table
		$email = mysqli_real_escape_string($connection,$_POST['email']);
		$query = "SELECT * FROM pro WHERE email = '{$email}'  LIMIT 1";


		$result_set = mysqli_query($connection, $query);

		if ($result_set) {
			if (mysqli_num_rows($result_set)==1) {
				$errors[] = 'Email Address is already registered as professioner';
			}
		}

		//checking NIC number

		$NIC = mysqli_real_escape_string($connection,$_POST['NIC']);
		$query = "SELECT * FROM general_users WHERE NIC = '{$NIC}'  LIMIT 1";


		$result = mysqli_query($connection, $query);

		if ($result) {
			if (mysqli_num_rows($result)==1) {
				$errors[] = 'NIC NUMBER Already exists.';
			}
		}

		if (!preg_match("/^[0-9]{9}[vVxX]$/", $NIC)) {
			$errors[] = 'Your NIC Number is not a acceptable one.';
		}

		//checking password matching each other
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

			$first_name = mysqli_real_escape_string($connection,$_POST['first_name']);
			$last_name = mysqli_real_escape_string($connection,$_POST['last_name']);
			$password = mysqli_real_escape_string($connection,$_POST['password']);

			$hashed_password = sha1($password);

			$query = "INSERT INTO general_users (first_name, last_name, NIC, email, password) VALUES 
			('{$first_name}','{$last_name}','{$NIC}','{$email}','{$hashed_password}')";

			$result = mysqli_query($connection, $query);

			if ($result) {
				// query successfull
				
				header('Location: user-success.php');
			} else {
				$errors[] = 'Failed to register';
			}
		
		}


	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Users</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<div class="infor"> <?= $_SESSION['message'] ?> </div>

<body>

	<header>
		
		

	</header>
	<main>
	<h1>Register with us as a user</h1>



		<?php 
			if (!empty($errors)) {

				echo '<div class = "errmsg">';
				echo '<b>There are errors in your form, please Try Again.</b><br><br>';
				foreach ($errors as $error) {
					$error = ucfirst(str_replace("_"," ",$error));
					echo $error . '<br>';
				}

				echo '</div>';
			}



		?>

		<form action="add-new-user.php" class="add-user" method="post">

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
			<label for="">Password:</label>
			<input type="password" name="password" placeholder="Must be 8 digits,one uppercase letter,one lowercase letter and one number">
		</p>

		<p>
			<label for="">Confirm Password:</label>
			<input type="password" name="confirm_password">

		</p>
		<p>
			<label for="">&nbsp;</label>
			<a href="index.php">Cancel</a>
			<button type="submit" name="submit" onclick="return confirm('Click OK to Register');">Save</button>

		</p>
		</form>
	</main>
	
</body>
</html>
<?php mysqli_close($connection);?> 