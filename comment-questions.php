<?php session_start(); ?>
<?php require_once( 'inc/connection.php' );	?>
<?php require_once( 'inc/functions.php' );	?>




<!DOCTYPE html>

<html>
<head>
	<title>view question</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
	<body style="background-color: #ddd">

	<main>
			<?php 

				//get question
				if (isset($_POST['q_id'])) {

				$q_id = $_POST['q_id'];
				
				$q_id = mysqli_real_escape_string($connection, $_POST['q_id']);
				
				//getting list of users
				$query = "SELECT * FROM general_users INNER JOIN questions ON general_users.guser_id = questions.guser_id WHERE q_id = {$q_id}";
				$users = mysqli_query($connection,$query);

				if ($users) {
					while ($user = mysqli_fetch_assoc($users)){

						echo "<div class ='ques-box'><p>";
						echo "<h2>".$user['q_title']."</h2>";
						echo "From <br><p>".$user['first_name']." ";
						echo $user['last_name']."<br><br>";

						echo "At ".$user['q_date']."</p><br>";

						 "Title : ".$user['q_title']."<br><br>";
						echo $user['q_body'];
						
						echo "</p>";
						echo"</div><br>";

						
						if (isset($_SESSION['pro_id'])) {
						# code...
					
						echo "<div>";
						echo "<form class = 'com-form' action = '".set_comment($connection)."' method = 'POST'>
								
								<input type = 'hidden' name = 'q_id' value = '".$q_id."'>
								<input type = 'hidden' name = 'pro_id' value = '".$_SESSION['pro_id']."'>
								<input type = 'hidden' name = 'com_date' value = '".date('Y-m-d H:i:s')."'>

								<textarea style = 'width:800px; height:80px; resize:none;' name ='com_body' placeholder= 'Add a comment'></textarea><br>


								<button style ='width:100px; height:30px; background-color:#282828; border:none; color:white;cursor:pointer; float:right; margin-right:195px;' type='submit' name='commentsubmit'>Comment</button>
								</form><br>";

						echo"</div>";
						echo "Comments<br><br>";

						//get comments to the specific question
						}
					getcomments($connection);
						
					}

				}
				else{
					echo "Database query failed";
				}

			}
		?>	
</main>

</body>
</html>