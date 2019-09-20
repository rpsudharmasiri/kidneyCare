<?php session_start(); ?>
<?php require_once( 'inc/connection.php' );	?>
<?php require_once( 'inc/functions.php' );	?>




<!DOCTYPE html>

<html>
<head>
	<title>Edit Comment</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
	<body style="background-color: #ddd">

	<main>
			<?php 

				$user_id = '';
				if (isset($_POST['q_id'])) {
					
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
						echo"</div>";
						


					
						# code...
								$com_id = $_POST['com_id'];	
								$q_id 	= $_POST['q_id'];
								$pro_id = $_POST['pro_id'];
								$com_body = $_POST['com_body'];
								$com_date = $_POST['com_date'];
					
						echo "<div>";
						echo "<form method = 'POST' action = '".edit_comment($connection)."'>
								<input type = 'hidden' name = 'com_id' value = '".$com_id."'>
								<input type = 'hidden' name = 'q_id' value = '".$q_id."'>
								<input type = 'hidden' name = 'pro_id' value = '".$pro_id."'>
								<input type = 'hidden' name = 'com_date' value = '".$com_date."'>

								<textarea style = 'width:400px; height:80px; resize:none;' name ='com_body'>".$com_body."</textarea>


								<button style ='width:100px; height:30px; background-color:#282828; border:none; color:white;cursor:pointer;' type='submit' name='commentsubmit'>Edit</button>
								
								</form>";

						echo"</div>";

					
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