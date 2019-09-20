<?php session_start(); ?>
<?php require_once( 'inc/connection.php' );	?>
<?php require_once( 'inc/functions.php' );	?>

			<?php 

				$user_id = '';
				if (isset($_POST['com_id'])) {
					
				$com_id = mysqli_real_escape_string($connection, $_POST['com_id']);
				
				//getting list of users
				$query = "DELETE FROM comments  WHERE  com_id = '$com_id' LIMIT 1";
				$users = mysqli_query($connection,$query);

				
			$results = mysqli_query($connection,$query);

			if ($results) {
				
				//rederecting to home page
				header('Location: questions.php');
				die();
				
				$_SESSION['message'] = "Comment deleted";
						}

			else{
				header('Location: comment-questions.php');
				//echo ("error" . mysqli_error($connection));
				
						}

			}
?>	
