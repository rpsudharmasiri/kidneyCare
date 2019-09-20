<?php session_start(); ?>
<?php $_SESSION['message'] = ''; ?>
<?php require_once( 'inc/connection.php' );	 ?>

<?php 

	//checking if a user is logged in
	if(!isset($_SESSION['a_id'])) {

		header('Location: admin-login.php');
}


if(!isset($_SESSION['message'])){
		$_SESSION['message'] = "";
	}

?>

<?php


	$errors = array();

	$event_id = '';
	$event_title = '';
	$event_location = '';
	$event_date = '';
	$event_time = '';
	$event_dis = '';
	//$id 	= '';

	if (isset($_POST['submit'])) {
		

		$event_title = $_POST['event_title'];
		$event_location = $_POST['event_location'];
		$event_date = $_POST['event_date'];
		$event_time = $_POST['event_time'];
		$event_dis = $_POST['event_dis'];

		//checking required fields

		$req_fields = array('event_title','event_location','event_date','event_time','event_dis');

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


 
			$query = " INSERT INTO events (a_id,event_title,event_location,event_date,event_time,event_dis) VALUES ('{$_SESSION['a_id']}','{$event_title}','{$event_location}', '{$event_date}' , '{$event_time}','{$event_dis}')";

			$results = mysqli_query($connection,$query);

			if ($results) {
				

				$_SESSION['message'] = "Your event uploaded successfully";
				header('Location: admin.php?error=0');
			}

			else{
				//echo ("error" . mysqli_error($connection));
				header('Location: admin.php?error=1');

		}

	}	

}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Add new event</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

	<header>
		
		<div class = "loggedin"> Welcome <?php echo $_SESSION['name']; ?> <a href="logout.php">Log Out</a></div>

	</header>
	<div class="infor"> <?= $_SESSION['message'] ?> </div>
	<h1>Add new event page</h1>


	<main>
		
	
		<?php 

			if (!empty($errors)) {

				echo '<div class = "errmsg">';
				echo '<b>There are some errors in your form.</b><br><br>';
				foreach ($errors as $error) {
					$error = ucfirst(str_replace("_"," ",$error));
				 	echo $error. '<br>';
				 } 
				 echo '<div>';
			}
			
		?>

		<form action="add-event.php" method="post" class="add-q-form">

		<p>
			<label for="">Title</label>
			<input type="text" name="event_title" <?php echo'value ="' . $event_title . '"'; ?>>
		</p>

		<p>
			<label for="">Location</label>
			<input type="text" name="event_location" <?php echo'value ="' . $event_location . '"'; ?>>
		</p>

		<p>
			<label for="">Date</label>

			<input type="Date" min="2000-01-01" name="event_date" <?php echo'value ="' . $event_date . '"'; ?>>
		</p>

		<p>
			<label for="">Time</label>
			<input type="Time" name="event_time" <?php echo'value ="' . $event_time . '"'; ?>>
		</p>

		<p>
			
			<label for="">Discription</label>
			
			<textarea name ="event_dis" style = 'width:530px; height:200px; resize:none;' <?php echo'value ="' . $event_dis . '"'; ?>></textarea>
			
	
		</p>
		
		<p>
			
			<label for="">&nbsp;</label>
			<a href="admin.php" onclick="return confirm('Are you sure you want to leave this page?');">Cancel</a>
			<button type="submit" name="submit" onclick="return confirm('Click 'OK' to upload');">Upload</button>

		</p>

	</form>


	</main>


</body>
</html>
<?php mysqli_close($connection);?> 