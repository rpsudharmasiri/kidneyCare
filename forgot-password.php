<?php session_start(); ?>

<?php require_once( 'inc/connection.php' );	 ?>

<?php 

if (isset($_POST["submit"])) {

	$email = mysqli_real_escape_string($connection,$_POST['email']);

	//checks the email address is exists
	$query = "SELECT guser_id FROM general_users WHERE email = '$email'";
	$users = mysqli_query($connection,$query);

	if (mysqli_num_rows($users) == 1) {
		
		//adding random string
		$str = "0123456789qwertyasdfghjklzxcv";
		//shufulling added string 
		$str = str_shuffle($str);
		//choosing string in shuffuled string
		$str = substr($str, 0, 15);
		//url that sends to the user to reset password
		$url = "https://domain.com/kidney/reset-password.php?token=$str&email=$email";
		

	//mail($email, "Reset password", "To reset your password please refer this link: $url","from: hhhsuranjith@gmail.com\r\n");

	//setting the token in database
	$query = "UPDATE general_users SET token='$str' WHERE email= '$email'";
	$data = mysqli_query($connection,$query);

	
	echo"We sent a link to your entered email address,";


	}else{
		echo " Please enter the email address that you used for registration";
		
	}

}


?>





<!DOCTYPE html>
<html>
<head>
	<title>forgot</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

	<div class = "login">
			
		<form action = "forgot-password.php" method = post>
			
			<fieldset>
				
				<legend><h1>Forgot Password</h1></legend>

				<p>
					<label for = "">Email:</label>
					<input type="text" name="email" placeholder="Email Address">

				</p>
				

				<p>
					<button type ="submit" name ="submit">request</button>

				</p>
			</fieldset> 

		</form>


	</div>>

</body>
</html>

<?php mysqli_close($connection);?> 