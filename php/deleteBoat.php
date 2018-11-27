<?php 
try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=bdd_7_12;charset=utf8', 'grp_7_12', 'ohfae5ioVi');
		// $bdd = new PDO('mysql:host=localhost;dbname=Armada;charset=utf8','root', 'root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
	catch(Exception $e)
	{
	        die('Erreur : '.$e->getMessage());
	} 
	$req = $bdd ->prepare('SELECT * FROM Boat WHERE id = :id');
	$req ->execute(array('id' => $_GET['idBoat']));
	while ($donnees = $req->fetch())
	{
		if ($donnees['image']!=null) {
			unlink($donnees['image']);
		}
		if ($donnees['file']!=null) {
			unlink($donnees['image']);
		}
	}
	$req ->closeCursor;
	$req = $bdd ->prepare('DELETE FROM Boat WHERE id = :id');
	$req ->execute(array('id' => $_GET['idBoat']));
	header('Location: gestionBoat.php');
 ?>