
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
	
	$event_title = '';
	$event_location = '';
	$event_date = '';
	$event_time = '';
	$event_dis = '';
	

	if (isset($_GET['user_id'])) {
		//getting user id
		$user_id = mysqli_real_escape_string($connection, $_GET['user_id']);

		$query = "SELECT * FROM events WHERE event_id = {$user_id} LIMIT 1";
		//executing query
		$result_set = mysqli_query($connection, $query);

		//checking query
		if ($result_set) {
			if (mysqli_num_rows($result_set) == 1) {
				//valid user found

				$result = mysqli_fetch_assoc($result_set);

					
					$event_title = $result['event_title'];
					$event_location = $result['event_location'];
					$event_date = $result['event_date'];
					$event_time = $result['event_time'];
					$event_dis = $result['event_dis'];

			}else{
				//user not found
				header('Location: view-events-admin.php?err=user_not_found');
			}
			
		}else{
			//query failed
			//header('Location: view-user.php?err=query_failed');
			//echo ("error" . mysqli_error($connection));

		}

	}


	if (isset($_POST['submit'])) {

	// assigning variables for display right records
					$user_id = $_POST['user_id'];
					$event_title = $_POST['event_title'];
					$event_location = $_POST['event_location'];
					$event_date = $_POST['event_date'];
					$event_time = $_POST['event_time'];
					$event_dis = $_POST['event_dis'];
	

	//checking required fields
		
		$req_fields = array('user_id','event_title','event_location','event_date','event_time','event_dis');

		foreach ($req_fields as $field) {

			if (empty(trim($_POST[$field]))) {
				$errors[] = $field .' required';
			}

		}

		//checking max length

		$max_len_fields = array('event_title' => 100,'event_location' => 100,'event_dis' => 200);

		foreach ($max_len_fields as $field => $max_len) {

			if (strlen(trim($_POST[$field])) > $max_len) {
				$errors[] = $field .' must be less than '. $max_len . ' charactors';
			}

		}
		
		if (empty($errors)){
			// no errors found  adding new record

			$event_title = mysqli_real_escape_string($connection , $_POST['event_title']);
			$event_location  = mysqli_real_escape_string($connection , $_POST['event_location']);
			$event_date  = mysqli_real_escape_string($connection , $_POST['event_date']);
			$event_time  = mysqli_real_escape_string($connection , $_POST['event_time']);
			$event_dis  = mysqli_real_escape_string($connection , $_POST['event_dis']);


 
			$query = "UPDATE events SET event_title = '{$event_title}', event_location ='{$event_location}', event_date = '{$event_date}', event_time = '{$event_time}', event_dis = '{$event_dis}' WHERE event_id = {$user_id} LIMIT 1";

			$results = mysqli_query($connection,$query);

			if ($results) {
				

				$_SESSION['message'] = "Event updated";
				header('Location: admin.php?error=0');
			}

			else{
				echo ("error" . mysqli_error($connection));
				header('Location: admin.php?error=1');

		}

	}	

}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Edit events</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>

	<header>
		
		<div class = "loggedin"> Welcome <?php echo $_SESSION['name']; ?> <a href="logout.php" onclick="return confirm('Are you sure you want to logout?');">Log Out</a></div>
		

	</header>
	<div class="infor"> <?= $_SESSION['message'] ?> </div>
	
	<main>
	<h1>Edit events</h1>

		

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

		<form action="edit-events.php" class="add-user" method="post">
			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>" >

		<p>
			<label for="">Title:</label>
			<input type="text" name="event_title"<?php echo 'value ="' . $event_title . '"'; ?>>

		</p>

		<p>
			<label for="">Location:</label>
			<input type="text" name="event_location"<?php echo 'value ="' . $event_location . '"'; ?>>

		</p>

		

		<p>
			<label for="">Date:</label>
			<input type="Date" name="event_date"<?php echo 'value ="' . $event_date . '"'; ?>>
		</p>
		<p>
			<label for="">Time:</label>
			<input type="Time" name="event_time"<?php echo 'value ="' . $event_time . '"'; ?>>
		</p>
		<p>
		<label for="">Discription:</label>
		<input type="text" name="event_dis"<?php echo 'value ="' . $event_dis . '"'; ?>>
		
		<p>
			<label for="">&nbsp;</label>
			<a href="admin.php"onclick="return confirm('Are you sure');">Cancel</a>
			<button type="submit" name="submit" onclick="return confirm('Click OK to Update');">Update</button>

		</p>
		</form>
	</main>
</body>
</html>
<?php mysqli_close($connection);?> 