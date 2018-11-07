<?php 
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=Armada;charset=utf8', 'root', 'root');
	}
	catch(Exception $e)
	{
	        die('Erreur : '.$e->getMessage());
	}
	$reponse = $bdd->query('SELECT * FROM Inscrit');
	while ($donnees = $reponse->fetch())
	{
		// user name and password in database
		$unom = $donnees['unom'];
		$password = $donnees['password'];
		// user name and password inserted on the login page
		$unom_page = $_POST['user_name'];
		$password_page = $_POST['password'];
		// see if user name and password are same in data base
		if ((strcmp($unom_page,$unom) == 0)&& (strcmp($password_page,$password) == 0)) {
			$judge = true;
			$id_inscrit = $donnees['id'];
		}
		else{
			$judge = false;
		}
	}
	// see if user is an administrator
	$reponse = $bdd->query('SELECT * FROM Administrator');
	while ($donnees = $reponse->fetch())
	{
		$id_admin = $donnees['idInscrit'];
		if ($id_inscrit == $id_admin) {
			$admin = true;
		}
		else{
			$admin = false;
		}
	}
	// see if user is a responsible of boat
	$reponse = $bdd->query('SELECT * FROM Responsable');
	while ($donnees = $reponse->fetch())
	{
		$id_resp = $donnees['idInscrit'];
		if ($id_inscrit== $id_resp) {
			$resp = true;
		}
		else{
			$resp = false;
		}
	}
	$reponse->closeCursor();

	//if user corresponds to one identity in database
	if ($admin == true) {
		header('Location: changeIdentity.php');
		exit();
	}
	else if ($resp == true) {
		header('Location: ../detailed_info.html');
		exit();
	}
	else if ($judge == true) {
		header('Location: ../general_info.html');
		exit();
	}
	else{
		echo "<script>alert('Identifiant or password incorrect');window.location.href='../register.html';</script>";
		header('Location: ../index.html');
		exit();
	}
 ?>