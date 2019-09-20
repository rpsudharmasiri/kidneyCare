
<?php session_start(); ?>

<?php $_SESSION['message'] = ''; ?>

<?php require_once( 'inc/connection.php' );	 ?>
<?php require_once('inc/functions.php'); ?>
<?php

require 'inc/PHPMailer/PHPMailerAutoload.php';

if (isset($_POST['acceptpro'])){

		$pro_id = $_POST['pro_id'];
		$email = $_POST['email'];
		$first_name = $_POST['first_name'];


		$mail = new PHPMailer;

		//$mail->SMTPDebug = 3;                               // Enable verbose debug output

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'kidneycarencp@gmail.com';                 // SMTP username
		$mail->Password = '0776762783';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		$mail->setFrom('kidneycarencp@gmail.com', 'Kidney Care');
		$mail->addAddress($email, $first_name);     // Add a recipient
		//$mail->addAddress('ellen@example.com');               // Name is optional
		$mail->addReplyTo('kidneycarencp@gmail.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');
		//$mail->SMTPDebug = 4; 

		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Your request to register as a organ donor';
		$mail->Body    = '<b>Thank you for registering as a Professioner</b><br>your request has been accepted.you can now login as a professioner <a style="border-style: solid; background-color: blue;color: white; border-color: black; border-width:0.5px;" href="http://localhost/kidney/login2.php">Click here</a>';

		$mail->AltBody = 'Thank you for registering as a Professioner';

		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		   // echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    
		$query = "SELECT * FROM request WHERE pro_id = {$pro_id} LIMIT 1";
		//executing query
		$result_set = mysqli_query($connection, $query);

		//checking query
		if ($result_set) {
			if (mysqli_num_rows($result_set) == 1) {
				//valid user found

				$result = mysqli_fetch_assoc($result_set);

					$first_name = $result['first_name'];
					$last_name = $result['last_name'];
					$pro_for = $result['pro_for'];
					$email = $result['email'];
					$password = $result['password'];

			$query = "INSERT INTO pro (first_name, last_name, pro_for, email, password) VALUES 
			('{$first_name}','{$last_name}','{$pro_for}','{$email}','{$password}')";

				$result = mysqli_query($connection, $query);

			if ($result) {
					// query successfull
					//delete request from request table

						$query = " DELETE FROM request WHERE pro_id = {$pro_id} LIMIT 1";

							$result = mysqli_query($connection , $query);

								if ($results) {
									header('Location: view-request.php?msg=failed_to_delete');
									

									}else{
											$_SESSION['message'] = " Selected professioner removed from the database ";
												header('Location: view-pro.php?msg=post_deleted');
								}

					header('Location: view-requests.php');
					$_SESSION['message'] = "Professioner added";

							} else {
								$errors[] = 'Failed to register';
									}

										}else{
												//user not found
												header('Location: view-requests.php?err=user_not_found');
											}
			
						}else{


				}

			}
		}
?>
<?php mysqli_close($connection);?> 