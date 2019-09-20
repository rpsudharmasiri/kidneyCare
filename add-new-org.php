
<?php session_start(); ?>

<?php require_once( 'inc/connection.php' );	 ?>
<?php require_once('inc/functions.php'); ?>
<?php 

$_SESSION['message'] = '';
?>

<?php 



	$errors = array();

	$first_name = '';
	$last_name = '';
	$dob = '';
	$age = '';
	$NIC = '';
	$email = '';
	$phone_num = '';
	$blood_group = '';
	$address1 = '';
	$address2 = '';
	$city = '';
	$district = '';

	$gender = '';




	if (isset($_POST['submit'])) {

	// assigning variables for display right records
	$first_name 		= $_POST['first_name'];
	$last_name 			= $_POST['last_name'];
	$dob 				= $_POST['dob'];
	//$age 				= $_POST['age'];
	$NIC				= $_POST['NIC'];
	$email 				= $_POST['email'];
	$phone_num 			= $_POST['phone_num'];
	$blood_group		= $_POST['blood_group'];
	$address1			= $_POST['address1'];
	$address2			= $_POST['address2'];
	$city				= $_POST['city'];
	$district			= $_POST['district'];


	//checking required fields
		
		$req_fields = array('first_name','last_name','dob','NIC','email','phone_num','blood_group','address1','address2','city','district');
		
		foreach ($req_fields as $field) {
			if (empty(trim($_POST[$field]))) {
			$errors[] = $field .' is required.';
			}
		}
	//checking max length

		$max_len_fields = array('first_name' => 100,'last_name' => 100,'NIC' => 15,'email' =>100,'phone_num' =>15,'blood_group' =>20,'address1' =>100,'address2' =>100,'city' =>100,'district' =>100);
		
		foreach ($max_len_fields as $field => $max_len) {
			if (strlen(trim($_POST[$field])) > $max_len ) {
			$errors[] = $field .' must be less than'. $max_len . ' charactors.';
			}
		}

		//checking email address
		if (!is_email($_POST['email'])) {
			$errors[] = 'Email Address is invalid.';
		}

		// checking if email address exists
		$email = mysqli_real_escape_string($connection,$_POST['email']);
		$query = "SELECT * FROM organs WHERE email = '{$email}'  LIMIT 1";


		$result_set = mysqli_query($connection, $query);

		if ($result_set) {
			if (mysqli_num_rows($result_set)==1) {
				$errors[] = 'Email Address Already exists.';
			}
		}



		$NIC = mysqli_real_escape_string($connection,$_POST['NIC']);
		$query = "SELECT * FROM organs WHERE NIC = '{$NIC}'  LIMIT 1";


		$result = mysqli_query($connection, $query);

		if ($result) {
			if (mysqli_num_rows($result)==1) {
				$errors[] = 'NIC NUMBER Already exists.';
			}
		}

		if (!preg_match("/^[0-9]{9}[vVxX]$/", $NIC)) {
			$errors[] = 'Your NIC Number is not a acceptable one.';
		}

		if (!preg_match("/^(?:0|94|\+94)?(?:(?P<area>11|21|23|24|25|26|27|31|32|33|34|35|36|37|38|41|45|47|51|52|54|55|57|63|65|66|67|81|912)(?P<land_carrier>0|2|3|4|5|7|9)|7(?P<mobile_carrier>0|1|2|5|6|7|8)\d)\d{6}$/", $phone_num)) {
			$errors[] = 'Please enter a valid phone number';
		}


		if (isset($_POST['submit'])) {
			
				$birth_date = $dob;

				$birth_date = strtotime($dob);
				$now = time();


				  $diff = $now-$birth_date;

				  $a = $diff/60/60/24/365.25;

				  $aa = floor($a);
				  $age= $aa;
		}

		/*if (isset($_POST['submit'])) {
				
				$day 				= $_POST['day'];
				$month				= $_POST['month'];
				$year 				= $_POST['year'];

				$birth = mktime(0,0,0,$month,$day,$year);

				$dif = time() - $birth;

				
				$age = floor($dif / 31556952);

				echo $age;

		}*/


		if (!isset($_POST['privacy'])) {
			$errors[] = 'Please check the privacy statement';
		}

		if (isset($_POST['gender'])) {
			$gender = $_POST['gender'];;

		}
		if (!isset($_POST['gender'])) {
			$errors[] = 'Please submit your gender';
		}
		echo $gender;

		if (empty($errors)) {
			

			$first_name = mysqli_real_escape_string($connection,$_POST['first_name']);
			$last_name = mysqli_real_escape_string($connection,$_POST['last_name']);
			$dob = mysqli_real_escape_string($connection,$_POST['dob']);
			$phone_num = mysqli_real_escape_string($connection,$_POST['phone_num']);
			$blood_group = mysqli_real_escape_string($connection,$_POST['blood_group']);
			$address1 = mysqli_real_escape_string($connection,$_POST['address1']);
			$address2 = mysqli_real_escape_string($connection,$_POST['address2']);
			$city = mysqli_real_escape_string($connection,$_POST['city']);
			$district = mysqli_real_escape_string($connection,$_POST['district']);

			

			$query = "INSERT INTO organs (first_name, last_name, age, gender, NIC, email, phone_num, blood_group, address1, address2, city, district) VALUES 
			('{$first_name}','{$last_name}','{$age}','{$gender}','{$NIC}','{$email}','{$phone_num}','{$blood_group}','{$address1}','{$address2}','{$city}','{$district}')";

			$result = mysqli_query($connection, $query);

			if ($result) {
				// query successfull
				
				header('Location: org-success.php');
			} else {
				$errors[] = 'Failed to register';
			}
		
		}


	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Be an organ donor</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<div class="infor"> <?= $_SESSION['message'] ?> </div>

<body>

	<header>
		
		

	</header>
	<main>
	
	<h2 style="color:purple;">Please register your details</h2>



		<?php 
			if (!empty($errors)) {

				echo '<div class = "errmsg">';
				echo '<b>There are errors in your form, please Try Again.</b><br><br>';
				foreach ($errors as $error) {
					$error = ucfirst(str_replace("_"," ",$error));
					echo $error . '<br>';
				}

				echo '</div>';
			}



		?>

		<form action="add-new-org.php" class="add-user" method="post">

			<p style="border-bottom-style: solid; border-bottom-width: 2px; padding-bottom: 10px; font-size: 20px;">About you</p>

		<p>

			
			<input type="text" name="first_name" placeholder="First Name"<?php echo 'value ="' . $first_name . '"'; ?>>

		</p>

		<p>
			
			<input type="text" name="last_name" placeholder = "Last Name"<?php echo 'value ="' . $last_name . '"'; ?>>

		</p>

		<p>
			<label for="">Date of birth:</label>
			<br>

			<input style="width:30%" type="Date" min="1900-01-01" name="dob" <?php echo 'value ="' . $dob . '"'; ?>>
		</p>
		Gender *
		<p class="gender">
			<label>Male</label>
			<input type="radio" name="gender" value="Male" style="">
			<br>
			<label>Female</label>
			<input type="radio" name="gender" value="Female">
		</p>

		<p>
			<label for="">Please select your Blood Group:</label>
			<br>
			<br>

			<select style="width:25%; height:30px;" id="List" name="blood_group" <?php echo 'value ="' . $blood_group . '"'; ?>>

				<option value="0">select</option>
				<option value="A+">A+</option>
				<option value="B+">B+</option>
				<option value="AB+">AB+</option>
				<option value="O+">O+</option>
				<option value="A-">A-</option>
				<option value="B-">B-</option>
				<option value="AB-">AB-</option>
				<option value="O-">O-</option>

			</select>

		</p>

<p style="border-bottom-style: solid; border-bottom-width: 2px; padding-bottom: 10px; font-size: 20px;">Your address</p>

		<p>
	
			<input style="width:30%" type="text" name="NIC" placeholder="NIC Number" <?php echo 'value ="' . $NIC . '"'; ?>>
		</p>

				<p>
	
			<input type="text" name="address1" placeholder="Address 1"<?php echo 'value ="' . $address1 . '"'; ?>>
		</p>

		<p>
			
			<input type="text" name="address2" placeholder="Address 2" <?php echo 'value ="' . $address2 . '"'; ?>>
		</p>

		<p>
			
			<input style="width:45%" type="text" name="city" placeholder="City"<?php echo 'value ="' . $city . '"'; ?>>
		</p>

		<p>
			<label for="">District:</label>
			<br>
			<br>
			

			<select style="width:25%; height:30px;" id="List" name="district">

				<option value="0">select</option>
				<option value="Ampara">Ampara</option>
				<option value="Anuradhapura">Anuradhapura</option>
				<option value="Badulla	">Badulla	</option>
				<option value="Batticaloa">Batticaloa</option>
				<option value="Colombo">Colombo</option>
				<option value="Galle">Galle</option>
				<option value="Gampaha">Gampaha</option>
				<option value="Hambantota">Hambantota</option>
				<option value="Jaffna">Jaffna</option>
				<option value="Kalutara">Kalutara</option>
				<option value="Kandy">Kandy</option>
				<option value="Kegalle">Kegalle</option>
				<option value="Kilinochchi">Kilinochchi</option>
				<option value="Kurunegala">Kurunegala</option>
				<option value="Mannar">Mannar</option>
				<option value="Matale">Matale</option>
				<option value="Matara">Matara</option>
				<option value="Moneragala">Moneragala</option>
				<option value="Mullaitivu">Mullaitivu</option>
				<option value="Nuwara Eliya">Nuwara Eliya</option>
				<option value="Polonnaruwa">Polonnaruwa</option>
				<option value="Puttalam">Puttalam</option>
				<option value="Ratnapura">Ratnapura</option>
				<option value="Trincomalee">Trincomalee</option>
				<option value="Vavuniya">Vavuniya</option>

			</select>
		<br>
	</p>
	

	<p style="border-bottom-style: solid; border-bottom-width: 2px; padding-bottom: 10px; font-size: 20px;">Your contact details</p>

		<p>
			
	<input style="width:40%" type="text" name="email" placeholder="Email Address"<?php echo 'value ="' . $email . '"'; ?>>
		</p>

		<p>
			
		<input style="width:40%" type="text" name="phone_num" placeholder="Phone Number" <?php echo 'value ="' . $phone_num . '"'; ?>>
		</p>

		<p style="border-bottom-style: solid; border-bottom-width: 2px; padding-bottom: 10px; font-size: 20px;">Confirmation</p>
		
		<input type="checkbox" name="privacy" value="value 1" class="check">

	
		&emsp;I have read the <a href="#">privacy statement</a> and give consent for the use of my information in accordance with the terms.

		<p>
			
			
			<button style="background-color: #44cc00; color: white;" type="submit" name="submit" onclick="return confirm('Click OK to Register');">Register</button>
			
			<button formaction="index.php">Cancel</button>
		</p>

		</form>
	</main>
	
</body>
</html>
<?php mysqli_close($connection);?> 