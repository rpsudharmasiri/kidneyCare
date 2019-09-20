<?php session_start(); ?>
<?php $_SESSION['message'] = ''; ?>
<?php require_once( 'inc/connection.php' );	 ?>

<?php 

	//checking if a user is logged in
	if(!isset($_SESSION['pro_id'])) {

		header('Location: login2.php');
}


if(!isset($_SESSION['message'])){
		$_SESSION['message'] = "";
	}

?>

<?php


	$errors = array();

	$q_id = '';
	$pro_id = '';
	$com_body = '';
	$com_date = '';
	

	

	if (isset($_POST['submit'])) {
		
		$q_id = $_POST['q_id'];
		$pro_id = $_POST['pro_id'];
		$com_body = $_POST['com_body'];
		$com_date = $_POST['com_date'];
		

		//checking required fields

		$req_fields = array('com_body');

		foreach ($req_fields as $field) {

			if (empty(trim($_POST[$field]))) {
				$errors[] = $field .' required';
				echo "Please enter a comment";
			}

		}

		//checking max length

		$max_len_fields = array('com_body' => 200);

		foreach ($max_len_fields as $field => $max_len) {

			if (strlen(trim($_POST[$field])) > $max_len) {
				$errors[] = $field .' must be less than '. $max_len . ' charactors';
			}

		}
		
		if (empty($errors)){
			// no errors found  adding new record

			
			$com_body  = mysqli_real_escape_string($connection , $_POST['com_body']);

			$query = " INSERT INTO comments(q_id,pro_id,com_body,com_date) VALUES ('{$q_id}','{$pro_id}','{$com_body}','{$com_date}')";

			$results = mysqli_query($connection,$query);

			if ($results) {
				
				//rederecting to home page
				header('Location: comment-questions.php');
				die();

				$_SESSION['message'] = "Your question uploaded successfully";
			}

			else{
				//echo ("error" . mysqli_error($connection));
		}

	}	

}
?>
