
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



	if (isset($_GET['user_id'])) {
		//getting user id
		$user_id = mysqli_real_escape_string($connection, $_GET['user_id']);

		$query = "SELECT * FROM organs WHERE org_id = {$user_id} LIMIT 1";
		//executing query
		$result_set = mysqli_query($connection, $query);

		//checking query
		if ($result_set) {
			if (mysqli_num_rows($result_set) == 1) {
				//valid user found

			$query = "UPDATE organs SET acc = 1 WHERE org_id = {$user_id} LIMIT 1";

				$result = mysqli_query($connection, $query);


					header('Location: view-org-admin.php');
					$_SESSION['message'] = "Organ Donator added";

							} else {
								$errors[] = 'Failed to add';
									}

										}else{
												//user not found
												header('Location: view-org-admin.php?err=user_not_found');
											}
			
						}else{


				}


?>

<?php mysqli_close($connection);?> 