<?php
	$password = $_POST['mot_de_passe'];
	$confirm = $_POST['confirmation_mot_de_passe'];
	if (strcmp($password,$confirm)!=0) {
	 	echo "<script>alert('Please confirm your password');window.location.href='../register.html';</script>";
	 	exit();
	 } 
	else{
		//open database
		try{
			$bdd = new PDO('mysql:host=localhost;dbname=Armada;charset=utf8','root','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}
		catch(Exception $e){
			die('Erreur : '.$e->getMessage());
		}
		// insert a new data
		$req = $bdd->prepare('INSERT INTO Inscrit(prenom, nom, unom, email, password) VALUES(:prenom, :nom, :unom, :email, :password)');
		$req -> execute(array(
			'prenom' =>$_POST['prenom'] ,
			'nom' => $_POST['nom'],
			'unom' => $_POST['nom_utilisateur'],
			'email' => $_POST['email'],
			'password'=>$_POST['mot_de_passe']));
		// setcookie('unom',$_POST['nom_utilisateur'],time()+60,null,null,false,true);
		header('LOCATION: ../index.html');
		exit();
	}
 ?>
