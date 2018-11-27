<?php 
// Connection to database
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=bdd_7_12;charset=utf8', 'grp_7_12', 'ohfae5ioVi');
		// $bdd = new PDO('mysql:host=localhost;dbname=Armada;charset=utf8','root', 'root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
	catch(Exception $e)
	{
	        die('Erreur : '.$e->getMessage());
	}
	$req = $bdd->query('SELECT i.id AS id, i.nom AS nom, i.prenom AS prenom, i.unom AS unom FROM Inscrit i WHERE NOT EXISTS (
											SELECT *
											FROM Responsable r, Administrator a
											WHERE i.id = r.idInscrit OR i.id = a.idInscrit);');
	while ($donnees = $req->fetch())
	{	
		$idAdmin = $idResp = null;
		if (isset($_POST[$donnees['unom']])) {
			$authority = $_POST[$donnees['unom']];
			// echo $authority.'<br/>'.;
			if ($authority == "Responsible") {
				$idResp = $donnees['id'];
			}
			else if ($authority == "Administrator") {
				$idAdmin = $donnees['id'];			
			}
		}
		if (isset($idResp)) {
			$req1 = $bdd->prepare('INSERT INTO Responsable(idInscrit) VALUES(:idInscrit)');
			$req1 ->execute(array(
				'idInscrit' => $idResp));

		}
		else if (isset($idAdmin)) {
			$req2 = $bdd->prepare('INSERT INTO Administrator(idInscrit) VALUES(:idInscrit)');
			$req2 ->execute(array(
				'idInscrit' => $idAdmin));	
		}
	}
	$req->closeCursor();
	header('LOCATION: changeIdentity.php');


 ?>