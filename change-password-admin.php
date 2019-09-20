
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

	//$user_id	='';
	$name = '';
	$email = '';


	

	if (isset($_SESSION['a_id'])) {
		//getting user id
		$user_id = mysqli_real_escape_string($connection, $_SESSION['a_id']);

		if (!$user_id == $_SESSION['a_id'] ) {
			header("Location: admin.php");

		}

		$query = "SELECT * FROM admin WHERE a_id = {$_SESSION['a_id']} LIMIT 1";
		//executing query
		$result_set = mysqli_query($connection, $query);

		//checking query
		if ($result_set) {
			if (mysqli_num_rows($result_set) == 1) {
				//valid user found

				$result = mysqli_fetch_assoc($result_set);

					$name = $result['name'];

					$email = $result['email'];

			}else{
				//user not found
				header('Location: admin.php?err=user_not_found');
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
			$query = "UPDATE admin SET password ='{$hashed_password}' WHERE a_id = {$_SESSION['a_id']} LIMIT 1 ";


			$result = mysqli_query($connection, $query);

			if ($result) {
				// query successfull
				header('Location: admin.php?password_updated_true');
				$_SESSION['message'] = " Password changed ";
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
	<br>
	<h1> Change Password</h1>
	<br>



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

		<form action="change-password-admin.php" class="add-user" method="post">
			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>" >

		<p>
			<label for="">Name:</label>
			<input type="text" name="name"<?php echo 'value ="' . $name . '"'; ?>disabled>

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
			<a href="admin.php"onclick="return confirm('Are you sure');">Cancel</a>
			<button type="submit" name="submit" onclick="return confirm('Click OK to change password');">change password</button>

		</p>
		</form>
	</main>
</body>
</html>
<?php mysqli_close($connection);?> 