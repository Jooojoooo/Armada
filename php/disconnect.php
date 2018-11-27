<?php 
	session_start();
	$_SESSION['id']=null;
	$_SESSION['unom']=null;
	session_destroy();
	header('Location: ../index.php');
 ?>