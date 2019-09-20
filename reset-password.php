<?php require_once( 'inc/connection.php' );	 ?>
<?php 
	//matches email and token
	if (isset($_GET["email"]) && isset($_GET["token"])) {
	
	$email = mysqli_real_escape_string($connection,$_GET['email']);
	$token = mysqli_real_escape_string($connection,$_GET['token']);

		$query = "SELECT guser_id FROM general_users WHERE email = '$email' AND token='$token'";
		$users = mysqli_query($connection,$query);

		if (mysqli_num_rows($users) > 0){

			$str = "0123456789qwertyasdfghjklzxcv";
			//shufulling added string
			$str = str_shuffle($str);
			//choosing string in shuffuled string
			$str = substr($str, 0,5);

			$password = sha1($str);

			//saving generated password in database

			$query = "UPDATE general_users SET password='$password',token ='' WHERE email='$email'";
			$data = mysqli_query($connection,$query);

			echo "Your password is : $str ";

		}else{
			echo "Please check your link!";
		}


	}else{

		header("Location: index.php");
	}



?>
<?php mysqli_close($connection);?> 