<?php session_start(); ?>
<?php $_SESSION['message'] = ''; ?>
<?php require_once( 'inc/connection.php' );	 ?>

<?php 

	//checking if a user is logged in
	if(!isset($_SESSION['guser_id'])) {

		header('Location: login.php');
}


if(!isset($_SESSION['message'])){
		$_SESSION['message'] = "";
	}

?>

<?php


	$errors = array();

	$q_title = '';
	$q_body = '';
	$id 	= '';

	if (isset($_POST['submit'])) {
		
		$q_title = $_POST['q_title'];
		$q_body = $_POST['q_body'];

		//checking required fields

		$req_fields = array('q_title','q_body');

		foreach ($req_fields as $field) {

			if (empty(trim($_POST[$field]))) {
				$errors[] = $field .' required';
			}

		}

		//checking max length

		$max_len_fields = array('q_title' => 100,'q_body' => 200);

		foreach ($max_len_fields as $field => $max_len) {

			if (strlen(trim($_POST[$field])) > $max_len) {
				$errors[] = $field .' must be less than '. $max_len . ' charactors';
			}

		}
		
		if (empty($errors)){
			// no errors found  adding new record

			$q_title = mysqli_real_escape_string($connection , $_POST['q_title']);
			$q_body  = mysqli_real_escape_string($connection , $_POST['q_body']);
			//global $id;
			//$id = $_SESSION['guser_id'];
			//$id = (int)$id;

 
			$query = " INSERT INTO questions(guser_id,q_title,q_body,q_date) VALUES ('{$_SESSION['guser_id']}','{$q_title}','{$q_body}', NOW() )";

			$results = mysqli_query($connection,$query);

			if ($results) {
				

				//rederecting to home page
				$_SESSION['message'] = "Your question uploaded successfully";
				header('Location: home.php?error=0');
			}

			else{
				//echo ("error" . mysqli_error($connection));
				header('Location: home.php?error=1');

		}

	}	

}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Ask questions</title>

	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/next.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>

<body>

	<div class="wrapper">
		<div class="top-bar clearfix">
			<div class="top-bar-links">	
				<ul>
					
					
					
					<li><div class="infor"> Last Action   |   <?= $_SESSION['message'] ?> </div></li>
					<li class="welcome"> Welcome  <?php echo $_SESSION['first_name']; ?> <a href="logout.php" onclick="return confirm('Are you sure you want to logout?');">  |  Log Out</a></li>

				</ul>	
			</div><!--ttop-bar-links-->

		</div><!--top-bar-->
	</div><!--wrapper-->

<header class="clearfix">

	<div class="logo">
			<h1>Kidney Care</h1>
			<p>Prevention is better than cure</p>

		</div> <!--logo-->

		<div class="socialmedia">
			<ul>
				<li><a href="#"><i class="fab fa-linkedin-in fab fw"></i></li></a>
				<li><a href="#"><i class="fab fa-facebook-square fab fw"></i></a></li>
				<li><a href="#"><i class="fab fa-twitter-square fab fw"></i></a></li>
				<li><a href="#"><i class="fab fa-google-plus-square fab fw"></i></a></li>
				<li><a href="#"><i class="fab fa-instagram fab fw"></i></a></li>
			</ul>
			
		</div><!--socialmedia-->

		
	<div class = "loggedin">  </a></div>

</header>

	<nav>
		<ul>
			<li><a href="home.php">Home</a></li>
			<li><a href="questions.php">Questions</a></li>
			<li><a href="posts.php">Posts</a></li>
			<li><a href="view-org-users.php">Find an Organ Donor</a></li>
			<li><a href="#">Services</a></li>
			<li><a href="view-event-users.php">Events</a></li>
			<li><a href="my.php">My profile</a></li>
		</ul>

	</nav>
	<div class="infor"> <?= $_SESSION['message'] ?> </div>
	<br>
	<h1>Ask your question in breif</h1>


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

		<form action="add-q.php" method="post" class="add-q-form">

		<p>
			<label for="">Title</label>
			<input type="text" name="q_title" <?php echo'value ="' . $q_title . '"'; ?>>
		</p>

		<p>
			
			<label for="">Question</label>
			
			<textarea name ="q_body" style = 'width:530px; height:200px; resize:none;' <?php echo'value ="' . $q_body . '"'; ?>></textarea>
			
	
		</p>
		
		<p>
			
			<label for="">&nbsp;</label>
			<a href="users.php" onclick="return confirm('Are you sure you want to leave this page?');">Cancel</a>
			<button type="submit" name="submit" onclick="return confirm('Click OK to post');">upload</button>

		</p>

	</form>


	</main>


</body>
</html>
<?php mysqli_close($connection);?> 