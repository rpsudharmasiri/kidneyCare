
<?php session_start(); ?>
<?php $_SESSION['message'] = ''; ?>

<?php require_once('inc/connection.php' );	 ?>
<?php require_once('inc/functions.php'); ?>
<?php 

	//checking if a user is logged in
	if(!isset($_SESSION['a_id'])) {

		header('Location: admin-login.php');
}

?>

<?php 

	$errors = array();

	$name = '';
	$email = '';
	$password = '';


	if (isset($_POST['submit'])) {

	// assigning variables for display right records
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];

	//checking required fields
		
		$req_fields = array('name','email','password','confirm_password');
		
		foreach ($req_fields as $field) {
			if (empty(trim($_POST[$field]))) {
			$errors[] = $field .' is required';
			}
		}
	//checking max length

		$max_len_fields = array('name' => 100,'email' =>100,'password' =>100);
		
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
		$query = "SELECT * FROM admin WHERE email = '{$email}'  LIMIT 1";


		$result_set = mysqli_query($connection, $query);

		if ($result_set) {
			if (mysqli_num_rows($result_set)==1) {
				$errors[] = 'Email Address Already exists';
			}
		}

		//checking NIC number

		/*$NIC = mysqli_real_escape_string($connection,$_POST['NIC']);
		$query = "SELECT * FROM general_users WHERE NIC = '{$NIC}'  LIMIT 1";


		$result = mysqli_query($connection, $query);

		if ($result) {
			if (mysqli_num_rows($result)==1) {
				$errors[] = 'NIC NUMBER Already exists';
			}
		}
		*/
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

			$name = mysqli_real_escape_string($connection,$_POST['name']);
			$password = mysqli_real_escape_string($connection,$_POST['password']);

			$hashed_password = sha1($password);

			$query = "INSERT INTO admin (name, email, password) VALUES 
			('{$name}','{$email}','{$hashed_password}')";

			$result = mysqli_query($connection, $query);

			if ($result) {
				// query successfull
				$_SESSION['message'] = " $name , successfully added as a Admin ";
				header('Location: admin.php');

			} else {
				$errors[] = 'Failed to register';
			}
		
		}


	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Add new admin</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>

	<header>

		<div class = "loggedin"> Welcome <?php echo $_SESSION['name']; ?> <a href="logout.php">Log Out</a></div>
		

	</header>
	<div class="infor"> <?= $_SESSION['message'] ?> </div>
	<main>
	<h1>Add new admin</h1>

		
		<?php 

		//display errors

			if (!empty($errors)) {

				echo '<div class = "errmsg">';
				echo '<b>There are errors in your form.</b><br><br>';
				foreach ($errors as $error) {
					$error = ucfirst(str_replace("_"," ",$error));
					echo $error . '<br>';
				}

				echo '</div>';
			}



		?>

		<form action="add-new-admin.php" class="add-pro" method="post">

		<p>
			<label for="">Name:</label>
			<input type="text" name="name"<?php echo 'value ="' . $name . '"'; ?>>

		</p>

		<p>
			<label for="">Email Address:</label>
			<input type="text" name="email"<?php echo 'value ="' . $email . '"'; ?>>
		</p>

		<p>
			<label for="">Password:</label>
			<input type="password" name="password">
		</p>

		<p>
			<label for="">Confirm Password:</label>
			<input type="password" name="confirm_password">

		</p>

		<p>
			<label for="">&nbsp;</label>
			<a href="admin.php">Cancel</a>
			<button type="submit" name="submit">ADD</button>

		</p>
		</form>
		
	</main>
</body>
</html>
<?php mysqli_close($connection);?> 