<?php 
	session_start();
	if ($_SESSION['id']==null) {
		header('Location: ../index.php');
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Configuration Identity</title>
	<link rel="stylesheet" type="text/css" href="../css/changeIdentity.css">
</head>

<body>
	<header>
		<div class="menu_option">
			<p><a href="../index.php">Return to homepage</a></p>
			<p><a href="displayAllBoats.php">View Detailed Information</a></p>
			<p><a href="disconnect.php">Disconnect</a></p>
		</div>
		<div class="menu">Menu</div>
	</header>
	
	<section class="container">
		<div id="Inscrit" class="item">
			<div class="title">Inscrit</div>
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
			$req = $bdd->query('SELECT i.id AS id, i.nom AS nom, i.prenom AS prenom, i.unom AS unom FROM Inscrit i 
				LEFT JOIN Responsable r ON i.id = r.idInscrit
				LEFT JOIN Administrator a ON i.id = a.idInscrit
				WHERE a.idInscrit IS NULL AND r.idInscrit IS NULL; 
						');
			?>
			<form method="post" action="addAuthority.php">
			<table id="inscritTable"> 
				
				<tr><td></td><td>First Name</td><td>Last Name</td><td>Responsible</td><td>Administrator</td></tr>
			
			<?php
			while ($donnees = $req->fetch())
			{
			echo '<tr><td><div class="iconDelete"><a name="iconDelete" href="deleteInscrit.php?id='.htmlspecialchars($donnees['id']).'" >X</a></div></td>';
			echo '<td><strong>'.htmlspecialchars($donnees['nom']).'</strong></td>';
			echo '<td> '.htmlspecialchars($donnees['prenom']).'</td>';
			echo '<td><input type="radio" name="'.$donnees['unom'].'" value="Responsible"</td>';
			echo '<td><input type="radio" name="'.$donnees['unom'].'" value="Administrator" class="dbRadio"></td></tr>';
		
			}
			
			$req->closeCursor();
			?>
			</table>
			<div class="restSpaceItem">
				<input type="submit" name="change" value="Change Authority" class="button">
			</div>
			</form>
		</div>
		<div id="Responsible" class="item">
			<div class="title">Responsible</div>
			<?php
			$req = $bdd->query('SELECT i.id AS id, i.nom AS nom, i.prenom AS prenom FROM Inscrit i INNER JOIN Responsable r ON i.id = r.idInscrit');
			?>
				<table> 
					<tr><td>First Name</td><td>Last Name</td><td>Delete Authority</td></tr>
				
				<?php
			while ($donnees = $req->fetch())
			{
				echo '<tr data-href="gestion.php?id'.htmlspecialchars($donnees['id']).'">';
				echo '<td><strong>'.htmlspecialchars($donnees['nom']).'</strong></td>';
				echo '<td> '.htmlspecialchars($donnees['prenom']).'</td>';
				echo '<td><form method="post" action="deleteAuthority.php"><input type="hidden" name="deleteResp" value="'.$donnees['id'].'"/><input type="submit" name="responDelete" value="DELETE" class="deleteButton"/></form></td></tr>';		
			}
			$req->closeCursor();
			
			
		?>
			</table>
		</div>
		<div id="Administrator" class="item">
			<div class="title">Administrator</div>
			<?php
			$req = $bdd->query('SELECT i.id AS id,i.nom AS nom, i.prenom AS prenom FROM Inscrit i INNER JOIN Administrator a ON i.id = a.idInscrit');
			?>
				<table> 
					<tr><td>First Name</td><td>Last Name</td><td>Delete Authority</td></tr>
				
				<?php
			while ($donnees = $req->fetch())
			{
				echo '<tr><td><strong>'.htmlspecialchars($donnees['nom']).'</strong></td>';
				echo '<td> '.htmlspecialchars($donnees['prenom']).'</td>';
				echo '<td><form method="post" action="deleteAuthority.php"><input type="hidden" name="deleteAdmin" value="'.$donnees['id'].'"/><input type="submit" name="adminDelete" value="DELETE" class="deleteButton"/></form></td></tr>';		
			}
			$req->closeCursor();			
		?>
		</table>
		</div>
	</section>
	<footer>
		<!-- <form method="post" action="addResponsible.php">
			<input type="submit" name="addResponsible" value="Add a Responsible" class="button">
		</form>
		<form method="post" action="addAdministrator">
			<input type="submit" name="addAdministrator" value="Add an Administrator" class="button">
		</form>
		<form>
			<input type="submit" name="conditionWebsite" value="Condition of Website" class="button">
		</form> -->
	</footer>
	
</body>
</html>