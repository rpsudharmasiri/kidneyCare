
<?php session_start(); ?>


<?php require_once('inc/connection.php' );	 ?>
<?php require_once('inc/functions.php'); ?>

<?php 

	$errors = array();

	$first_name = '';
	$last_name = '';
	$pro_for = '';
	$email = '';
	$password = '';


	if (isset($_POST['submit'])) {

	// assigning variables for display right records
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$pro_for = $_POST['pro_for'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];

	//checking required fields
		
		$req_fields = array('first_name','last_name','pro_for','email','password','confirm_password');
		
		foreach ($req_fields as $field) {
			if (empty(trim($_POST[$field]))) {
			$errors[] = $field .' is required';
			}
		}
	//checking max length

		$max_len_fields = array('first_name' => 100,'last_name' => 100,'pro_for' => 50,'email' =>100,'password' =>100);
		
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
		$query = "SELECT * FROM pro WHERE email = '{$email}'  LIMIT 1";


		$result_set = mysqli_query($connection, $query);

		if ($result_set) {
			if (mysqli_num_rows($result_set)==1) {
				$errors[] = 'Email Address Already exists';
			}
		}

		// checking if email address exists
		$email = mysqli_real_escape_string($connection,$_POST['email']);
		$query = "SELECT * FROM request WHERE email = '{$email}'  LIMIT 1";


		$result_set = mysqli_query($connection, $query);

		if ($result_set) {
			if (mysqli_num_rows($result_set)==1) {
				$errors[] = 'Sorry : Email Address you entered is already in our request list.';
			}
		}


		//checking password matching each other
		if ($password==$confirm_password) {
			
		}else{

			$errors[] = "Your typed passwords do not match!";
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

			$query = "INSERT INTO request (first_name, last_name, pro_for, email, password) VALUES 
			('{$first_name}','{$last_name}','{$pro_for}','{$email}','{$hashed_password}')";

			$result = mysqli_query($connection, $query);

			if ($result) {
				// query successfull
				
				header('Location: request-success.php');
	
	
	


			} else {
				$errors[] = 'Failed to register';
			}
		
		}


	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Professionals Registration</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>

	<header>
		
	</header>

	<main>
	<h1>Professionals Registration</h1>
	


	<h3>Tell us about yourself</h3>

		
		<?php 

		//display errors

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

		<form action="request.php" class="add-pro" method="post">
			
			<label for="">First Name:</label>
			<input type="text" name="first_name"<?php echo 'value ="' . $first_name . '"'; ?>>

		</p>

		<p>
			<label for="">Last Name:</label>
			<input type="text" name="last_name"<?php echo 'value ="' . $last_name . '"'; ?>>

		</p>

		<p>
			<label for="">Profession:</label>

			<select id="List" name="pro_for">

				<option value="Consultant">Consultant</option>
				<option value="Doctor">Doctor</option>
				<option value="Professor">Professor</option>
				<option value="lecturer">lecturer</option>
				<option value="Ayurwedic">Ayurwedic</option>
				<option value="Pharmasist">Pharmasist</option>
				<option value="other">Other</option>

			</select>

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
			<button type="submit" name="submit" onclick="return confirm('Click OK to Register');">Register</button>

		</p>
		</form>
		
	</main>
	
</body>
</html>
<?php mysqli_close($connection);?> 