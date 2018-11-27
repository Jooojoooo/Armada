<?php 
	session_start();
	if (isset($_SESSION['unom'])) {
		$unom=$_SESSION['unom'];
	}
	else{
		$unom=null;
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Page d'acceuil</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" media="all and (max-width: 1024px)" href="petite_resolution.css">

</head>
<body>
	<!-- The title in the page -->
	<h1>Armada</h1>
	<section id="container">
	<h2>Welcome ! </h2>
	<form method="post" action="php/login.php">
		<!-- A form to enter the information and then post it to cible php -->
		<div class="identifiant">
		<input type="text" name="user_name" placeholder="User Name" maxlength="10" style="width: 100%" <?php echo 'value="'.$unom.'"';?>/>
		</div>
		<div class="password">
			<input type="password" name="password" placeholder="Password" maxlength="10" style="width: 100%"/>
		</div>
		<input type="submit" name="login" value="Login" id="login" />
	</form>
		<!--Buttons in the welcome box  -->
	<form action="register.html">
		<input type="submit" name="register" value="Register" id="register" />
	</form>
	<p><a href="visitor.html">Enter as a visitor</a></p>
	</section>
	
</body>
</html>