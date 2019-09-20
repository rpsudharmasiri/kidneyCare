
<?php session_start(); ?>

<?php require_once( 'inc/connection.php' );	 ?>

<?php 
//check for form subbmission


if (isset($_POST['submit'])) {
	
	$errors = array();

	//Check if the user name and password are entered
	if (!isset($_POST['email'])|| strlen(trim($_POST['email'])) < 1) {

		$errors[] = 'Username is missing / invalid';
	}

	if (!isset($_POST['password'])|| strlen(trim($_POST['password'])) < 1) {

		$errors[] = 'Password is missing / invalid';

	}



	//check if any errors in the form
	if(empty($errors)){

		//save username and password in to variables
		$email = mysqli_real_escape_string($connection,$_POST['email']);
		$password = mysqli_real_escape_string($connection,$_POST['password']);
		$hashed_password = sha1($password);

		//prepare database query
		$query = "SELECT * FROM pro WHERE email = '{$email}' AND password = '{$hashed_password}' LIMIT 1"; 

		$result_set = mysqli_query($connection, $query);

		if ($result_set) {
			
			if (mysqli_num_rows($result_set)==1) {
				//valid user found

				$user = mysqli_fetch_assoc($result_set);
					$_SESSION['pro_id'] = $user['pro_id'];
					$_SESSION['first_name'] = $user['first_name'];

				// redirect to the next page
				header('Location: professionals.php?');

			} else {
				//username and password invalid
				$errors[] = 'invalid username or password';
			}
		} else{
			$errors[] = 'Database query failed';
		}
	}	
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Professionals</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

	<div class = "login">
			
		<form action = "login2.php" method = post>
			
			<fieldset>
				
				<legend><h1>Professionals</h1></legend>

				<?php 

				if (isset($errors) && !empty($errors)) {
					echo '<p class="error">Invalid Username / Password</p>';
				}
					
				?>


				<p>
					<label for = ""></label>
					<input type="text" name="email" placeholder="Email Address">

				</p>
				<p>
					<label for =  ""></label>
					<input type="password" name="password" placeholder="Password" id="myInput">

				</p>

				<p>
					
					<input type="checkbox" onclick="myFunction()" style="width:0%; float: left;" ><span style="font-size: 12px;	">	Show Password</span>

				</p>

				<p class="log_button">
					<button id="btn1"type ="submit" name ="submit"  >Log In</button>
					<br><br>
					<button  id="btn2" formaction="index.php">Cancel</button>
					

				</p>
				
			</fieldset> 

		</form>


	</div>>
<script type="text/javascript">
 
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

</script>


</body>
</html>

<?php mysqli_close($connection);?> 