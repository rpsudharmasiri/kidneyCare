<?php

	function is_email($email)
	{
		return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i" ,$email));
	}
?>
<?php 
ob_start();
function set_comment($connection)
{
		$q_id    = '';
		$pro_id = '';
		$com_body = '';
		$com_date  = '';
		$errors = array();

	if (isset($_POST['commentsubmit'])) {
		
		

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

		foreach ($max_len_fields as $field => $max_len) 
			{
			if (strlen(trim($_POST[$field])) > $max_len) {
				$errors[] = $field .' must be less than '. $max_len . ' charactors';
				echo "Comment must be less than 200 charactors";
				}
			}

		
		$query = "SELECT * FROM comments WHERE com_body = '{$com_body}' AND pro_id = '{$pro_id}' AND q_id = '{$q_id}'LIMIT 1";


		$result_set = mysqli_query($connection, $query);

		if ($result_set) {
			if (mysqli_num_rows($result_set)==1) {
				$errors[] = 'Email Address Already exists';
				echo "comment already inserted";
				header('Location: questions.php');
			}
		}
		
		if (empty($errors)){
			// no errors found  adding new record
			
			$com_body  = mysqli_real_escape_string($connection , $_POST['com_body']);

			$query = " INSERT INTO comments(q_id,pro_id,com_body,com_date) VALUES ('{$q_id}','{$pro_id}','{$com_body}','{$com_date}')";

			$results = mysqli_query($connection,$query);

			if ($results) {
				
				//rederecting to home page

					}

			else{
				header('Location: comment-questions.php');
				//echo ("error" . mysqli_error($connection));
				
						}

					}	

		}
}
	
ob_end_flush()
?>

<?php 
ob_start();
	function getcomments($connection){

				
				if (isset($_POST['q_id'])) {
					
				$q_id = mysqli_real_escape_string($connection, $_POST['q_id']);
				
				//getting list of users
				$query = "SELECT * FROM pro INNER JOIN comments ON pro.pro_id = comments.pro_id WHERE q_id = {$q_id}";
				$users1 = mysqli_query($connection,$query);

				if ($users1) {
					while ($user1 = mysqli_fetch_assoc($users1)){

						echo "<div class ='comment-box'>";
						echo "<p>".$user1['pro_for']." : ";
						
						echo $user1['first_name']." ";
						echo $user1['last_name'].'&emsp;&emsp;&emsp;';

						echo "&emsp;".$user1['com_date']."</p>";

						echo "<p1>".nl2br($user1['com_body']);
						
						echo "</p1> ";

						if (isset($_SESSION['pro_id'])) {
							if ($_SESSION['pro_id'] == $user1['pro_id']) {


							echo "
								<form class='delete-form' method='POST' action='delete-comment.php'>
								<input type = 'hidden' name='com_id' value='".$user1['com_id']."'>
								<button type='submit' name='commentdelete' onclick=\"return confirm('Are you sure you want to delete this comment?');\">Delete</button>
								</form>
							<form class='edit-form' method='POST' action='edit-comment.php'>
									<input type = 'hidden' name='com_id' value='".$user1['com_id']."'>
									<input type = 'hidden' name='q_id' value='".$user1['q_id']."'>
									<input type = 'hidden' name='pro_id' value='".$user1['pro_id']."'>
									<input type = 'hidden' name='com_date' value='".$user1['com_date']."'>
									<input type = 'hidden' name='com_body' value='".$user1['com_body']."'>
									<button type='submit' name='commentedit'>Edit</button>
								</form>";
								
									}
								}
								echo"<br></div>";
							}
						}
				else{
					echo "Database query failed";
					}
			}
	}
ob_end_flush();
?>

<?php 
ob_start();
function edit_comment($connection)
{
		$com_id    = '';
		$q_id    = '';
		$pro_id = '';
		$com_body = '';
		$com_date  = '';
		$errors = array();

	if (isset($_POST['commentsubmit'])) {
		
		$com_id = $_POST['com_id'];
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

		foreach ($max_len_fields as $field => $max_len) 
			{
			if (strlen(trim($_POST[$field])) > $max_len) {
				$errors[] = $field .' must be less than '. $max_len . ' charactors';
				echo "Comment must be less than 200 charactors";
				}
			}
		
		if (empty($errors)){
			// no errors found  adding new record
			
			$com_body  = mysqli_real_escape_string($connection , $_POST['com_body']);

			$query = " UPDATE comments SET com_body = '$com_body' WHERE q_id = $q_id AND com_id = $com_id LIMIT 1";

			$results = mysqli_query($connection,$query);

			if ($results) {
				
				//rederecting to home page
				header('Location: questions.php');


				}

			else{
				header('Location: comment-questions.php');
				//echo ("error" . mysqli_error($connection));
				
						}

					}	

		}
}
ob_end_flush();
?>	

<?php
ob_start();
function delete_comment($connection){
		
		if (isset($_POST['commentdelete'])) {
				
				$com_id = mysqli_real_escape_string($connection, $_POST['com_id']);

				$queryd = "DELETE FROM comments  WHERE  com_id = '$com_id' LIMIT 1";
				$users2 = mysqli_query($connection,$queryd);
	
			$results1 = mysqli_query($connection,$queryd);

			if ($results1) {
				//rederecting to home page
				
				$_SESSION['message'] = "Comment deleted";
			}

			else{
				header('Location: comment-questions.php');
			
			}

		}
		else{
			echo "cannot fin";
		}

}
ob_end_flush();
?>




