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
	$req = $bdd ->prepare('DELETE FROM Inscrit WHERE id = :id');
	$req ->execute(array('id' => $_GET['id']));
	header('Location: changeIdentity.php');
	?>