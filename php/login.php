<?php
	//start session
	session_start();
	//user name input in the index page
	$unom_page = $_POST['user_name'];
	$_SESSION['unom']=$unom_page;
	//connection to database
	try
	{
		// $bdd = new PDO('mysql:host=localhost;dbname=Armada;charset=utf8', 'root', 'root');
		$bdd = new PDO('mysql:host=localhost;dbname=bdd_7_12;charset=utf8', 'grp_7_12', 'ohfae5ioVi');
	}
	catch(Exception $e)
	{
	        die('Erreur : '.$e->getMessage());
	}
	// to get and read a cursor from a tabel selected
	$reponse = $bdd->query('SELECT * FROM Inscrit');
	while ($donnees = $reponse->fetch())
	{
		// user name and password in database
		$unom = $donnees['unom'];
		$password = $donnees['password'];
		//password inserted on the login page
		$password_page = $_POST['password'];
		// see if user name and password are same as which in data base
		if ((strcmp($unom_page,$unom) == 0)&& (strcmp($password_page,$password) == 0)) {
			$judge = true;
			$id_inscrit = $donnees['id'];
			$_SESSION['id']=$id_inscrit;
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
		}
		else{
			$id_inscrit = 0;
			$judge = false;
		}
	}
	
	
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
		header('Location: displayAllBoats.php');
		exit();
	}
	else{
		echo '<script>alert("Identifiant or password incorrect");window.location.href="../index.php";</script>';
		exit();
	}
	
 ?>