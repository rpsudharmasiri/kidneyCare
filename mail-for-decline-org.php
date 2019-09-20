
<?php session_start(); ?>

<?php $_SESSION['message'] = ''; ?>

<?php require_once( 'inc/connection.php' );	 ?>
<?php require_once('inc/functions.php'); ?>
<?php

require 'inc/PHPMailer/PHPMailerAutoload.php';

if (isset($_POST['declineorg'])){

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
		$mail->Body    = '<b>Sorry..<br>your request has been declined.</b>';
		$mail->AltBody = 'Sorry..your request has been declined.';

		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		   // echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    
		$query = " DELETE FROM organs WHERE org_id = {$org_id} LIMIT 1";

		$result = mysqli_query($connection , $query);

		if ($results) {
			header('Location: view-org-admin.php?msg=failed_to_delete');
			

		}else{
			$_SESSION['message'] = " Selected request removed from the request list ";
			header('Location: view-org-admin.php?msg=post_deleted');
		}

		}
			
	}


?>
<?php mysqli_close($connection);?> 