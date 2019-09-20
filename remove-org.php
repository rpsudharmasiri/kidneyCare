
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
	
	if (isset($_GET['user_id'])) {
		//getting user id
		$user_id = mysqli_real_escape_string($connection, $_GET['user_id']);

		$query = " DELETE FROM organs WHERE org_id = {$user_id} LIMIT 1";

		$result = mysqli_query($connection , $query);

		if ($results) {
			header('Location: view-accepted-org.php?msg=failed_to_delete');
			

		}else{
			$_SESSION['message'] = " Selected Organ donor removed from the request list ";
			header('Location: view-accepted-org.php?msg=post_deleted');
		}



	}else{
		header('Location: view-accepted-org.php');

	}
?>

<?php mysqli_close($connection);?> 