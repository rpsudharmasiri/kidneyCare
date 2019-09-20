<?php 

$connection = mysqli_connect('localhost','root','','users');

//for check the connection
if (mysqli_connect_errno()) {
	die( 'Connection Failed'. mysqli_connect_error() );

}

 ?> 