
<?php session_start(); ?>

<?php $_SESSION['message'] = ''; ?>

<?php require_once( 'inc/connection.php' );	 ?>
<?php require_once('inc/functions.php'); ?>
<?php

require 'inc/PHPMailer/PHPMailerAutoload.php';

if (isset($_POST['acceptorg'])){

		$org_id = $_POST['org_id'];
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
		$mail->Body    = '<b>Thank you for registering as a organ donor<br>your request has been accepted.</b>';
		$mail->AltBody = 'Thank you for registering as a organ donor';

		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		   // echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    
		$query = "SELECT * FROM organs WHERE org_id = {$org_id} LIMIT 1";
		//executing query
		$result_set = mysqli_query($connection, $query);

		//checking query
		if ($result_set) {
			if (mysqli_num_rows($result_set) == 1) {
				//valid user found

			$query = "UPDATE organs SET acc = 1 WHERE org_id = {$org_id} LIMIT 1";

				$result = mysqli_query($connection, $query);

			$_SESSION['message'] = " Selected request Accepted ";
			header('Location: view-org-admin.php?msg=Donor-added');

							} else {
								$errors[] = 'Failed to add';
									}

										}else{
												//user not found
												echo "user not found";;
											}
			
						}

		
}
?>
<?php mysqli_close($connection);?> 