<?php
	session_start();
	$password = $_POST['mot_de_passe'];
	$confirm = $_POST['confirmation_mot_de_passe'];
	if (strcmp($password,$confirm)!=0) {
	 	echo "<script>alert('Please confirm your password');window.location.href='../register.html';</script>";
	 	exit();
	 } 
	else{
		//open database
		try{
			$bdd = new PDO('mysql:host=localhost;dbname=bdd_7_12;charset=utf8','grp_7_12', 'ohfae5ioVi',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			// $bdd = new PDO('mysql:host=localhost;dbname=Armada;charset=utf8', 'root', 'root');
		}
		catch(Exception $e){
			die('Erreur : '.$e->getMessage());
		}
		$reponse = $bdd->query('SELECT * FROM Inscrit');
		while ($donnees = $reponse->fetch())
		{
			if (strcmp($donnees['unom'],$_POST['nom_utilisateur'])==0) {
				echo "<script>alert('Please change a user name');window.location.href='../register.html';</script>";
				exit();
			}
			if (isset($_POST['email'])) {
				if (strcmp($_POST['email'],$donnees['email'])==0) {
					echo "<script>alert('Please check your email address');window.location.href='../register.html';</script>";
				}
			}
		}
		$reponse->closeCursor();
		// insert a new data
		$req = $bdd->prepare('INSERT INTO Inscrit(prenom, nom, unom, email, password) VALUES(:prenom, :nom, :unom, :email, :password)');
		$req -> execute(array(
			'prenom' =>$_POST['prenom'] ,
			'nom' => $_POST['nom'],
			'unom' => $_POST['nom_utilisateur'],
			'email' => $_POST['email'],
			'password'=>$_POST['mot_de_passe']));
			$_SESSION['unom'] = $_POST['nom_utilisateur'];
		
		// setcookie('unom',$_POST['nom_utilisateur'],time()+60,null,null,false,true);
		header('LOCATION: ../index.php');
		exit();
	}
 ?>
