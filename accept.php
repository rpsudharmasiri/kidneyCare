
<?php session_start(); ?>

<?php $_SESSION['message'] = ''; ?>

<?php require_once( 'inc/connection.php' );	 ?>
<?php require_once('inc/functions.php'); ?>
<?php 

	if(!isset($_SESSION['a_id'])) {

		header('Location: admin-login.php');
}

?>

<?php 

	$errors = array();

	$user_id	='';
	$first_name = '';
	$last_name = '';
	$pro_for = '';
	$email = '';
	$password = '';
	

	if (isset($_GET['user_id'])) {
		//getting user id
		$user_id = mysqli_real_escape_string($connection, $_GET['user_id']);

		$query = "SELECT * FROM request WHERE pro_id = {$user_id} LIMIT 1";
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
					$password = $result['password'];

			$query = "INSERT INTO pro (first_name, last_name, pro_for, email, password) VALUES 
			('{$first_name}','{$last_name}','{$pro_for}','{$email}','{$password}')";

				$result = mysqli_query($connection, $query);

			if ($result) {
					// query successfull
					//delete request from request table

						$query = " DELETE FROM request WHERE pro_id = {$user_id} LIMIT 1";

							$result = mysqli_query($connection , $query);

								if ($results) {
									header('Location: view-request.php?msg=failed_to_delete');
									

									}else{
											$_SESSION['message'] = " Selected professioner removed from the database ";
												header('Location: view-pro.php?msg=post_deleted');
								}



					header('Location: view-requests.php');
					$_SESSION['message'] = "Professioner added";

							} else {
								$errors[] = 'Failed to register';
									}

										}else{
												//user not found
												header('Location: view-requests.php?err=user_not_found');
											}
			
						}else{


				}

			}

?>

<?php mysqli_close($connection);?> 