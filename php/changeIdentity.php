<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Configuration Identity</title>
	<link rel="stylesheet" type="text/css" href="../css/changeIdentity.css">
</head>
<body>
	<header>
		<div class="menu">Menu</div>
	</header>
	<aside>
		<p>Return to homepage</p>
		<p>Edit detailed information</p>
	</aside>
	<section class="container">
		<div id="Inscrit" class="item">
			<div class="title">Inscrit</div>
		<?php
		// Connection to database
			try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=Armada;charset=utf8', 'root', 'root');
			}
			catch(Exception $e)
			{
			        die('Erreur : '.$e->getMessage());
			}
			$req = $bdd->query('SELECT nom, prenom FROM Inscrit ORDER BY nom');
			?>
			<table> 
				<tr><td>First Name</td><td>Last Name</td></tr>
			
			<?php
			while ($donnees = $req->fetch())
			{
		?>
			<tr><td><strong><?php echo htmlspecialchars($donnees['nom']); ?></strong></td><td>  <?php echo htmlspecialchars($donnees['prenom']); ?></td></tr>
		<?php
			}
			$req->closeCursor();
		?>
		</table>
		</div>
		<div id="Responsible" class="item">
			<div class="title">Responsible</div>
			<?php
			$req = $bdd->query('SELECT * FROM Responsable');

			while ($donnees = $req->fetch())
			{
				$id_resp = $donnees['idInscrit'];
			}
			$req->closeCursor();
			$req = $bdd->prepare('SELECT nom, prenom FROM Inscrit WHERE id = ? ORDER BY nom');
			$req->execute(array($id_resp));
			?>
			<table> 
				<tr><td>First Name</td><td>Last Name</td></tr>
			
			<?php
			while ($donnees = $req->fetch())
			{
		?>
			<tr><td><strong><?php echo htmlspecialchars($donnees['nom']); ?></strong></td><td>  <?php echo htmlspecialchars($donnees['prenom']); ?></td></tr>
		<?php
			}
			$req->closeCursor();
		?>
			</table>
		</div>
		<div id="Administrator" class="item">
			<div class="title">Administrator</div>
			<?php
			$req = $bdd->query('SELECT * FROM Administrator');
			while ($donnees = $req->fetch())
			{
				$id_admin = $donnees['idInscrit'];
			}
			$req->closeCursor();
			$req = $bdd->prepare('SELECT nom, prenom FROM Inscrit WHERE id = ? ORDER BY nom');
			$req->execute(array($id_admin));
			?>
			<table> 
				<tr><td>First Name</td><td>Last Name</td></tr>
			
			<?php
			while ($donnees = $req->fetch())
			{
		?>
			<tr><td><strong><?php echo htmlspecialchars($donnees['nom']); ?></strong></td><td>  <?php echo htmlspecialchars($donnees['prenom']); ?></td></tr>
		<?php
			}
			$req->closeCursor();
		?>
		</table>
		</div>
	</section>
	<footer>
		<form>
			<input type="submit" name="addResponsible" value="Add a Responsible" class="button">
		</form>
		<form>
			<input type="submit" name="addAdministrator" value="Add an Administrator" class="button">
		</form>
		<form>
			<input type="submit" name="conditionWebsite" value="Condition of Website" class="button">
		</form>
	</footer>
</body>
</html>