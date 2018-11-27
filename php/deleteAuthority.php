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
	if (isset($_POST['deleteResp'])) {
		$req = $bdd -> query('SELECT COUNT(*) AS nbr FROM Responsable');
		while ($donnees = $req->fetch())
		{
			$count = $donnees['nbr'];
		}
		$req -> closeCursor();
		// if ($count > 1) {
			
			$req = $bdd ->prepare('DELETE FROM Responsable WHERE idInscrit = :idInscrit');
			$req ->execute(array('idInscrit' => $_POST['deleteResp']));
			header('LOCATION: changeIdentity.php');
		// }
		// else if ($count = 1) {
		// 	echo "<script>alert('Need to have at least one Responsible in the system');window.location.href='../register.html';</script>";
	 // 		return;
		// }
		
	}
	else if (isset($_POST['deleteAdmin'])) {
		$req = $bdd ->prepare('DELETE FROM Administrator WHERE idInscrit = :idInscrit');
		$req ->execute(array('idInscrit' => $_POST['deleteAdmin']));
		header('LOCATION: changeIdentity.php');
	}

 ?>