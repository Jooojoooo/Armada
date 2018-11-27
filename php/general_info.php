<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>General Information</title>
	<link rel="stylesheet" type="text/css" href="../css/general_info.css">
</head>
<body> 
	<header id="head">
		<img src="../img/Boats-Panoramic site.jpg" id="head_photo" alt="head photo"/>
	</header>
	<section class="container">
		<figure class="item">
			<img src="../img/boat1.PNG" class="boat" alt="boat1"/>
			<figcaption class="name_boat"> Boat 1 </figcaption>
			<p><strong>Type : </strong>Unknown</p>

		</figure>
		<figure class="item">
			<img src="../img/boat2.PNG" class="boat" alt="boat1"/>
			<figcaption class="name_boat"> Boat 2 </figcaption>
			<p><strong>Type : </strong>Unknown</p>
		</figure>
		<figure class="item">
			<img src="../img/boat3.PNG" class="boat" alt="boat1"/>
			<figcaption class="name_boat"> Boat 3 </figcaption>
			<p><strong>Type : </strong>Unknown</p>
		</figure>
		<?php 
        try
          {
            // $bdd = new PDO('mysql:host=localhost;dbname=Armada;charset=utf8', 'root', 'root');
            $bdd = new PDO('mysql:host=localhost;dbname=bdd_7_12;charset=utf8', 'grp_7_12', 'ohfae5ioVi');
          }
          catch(Exception $e)
          {
          	die('Erreur : '.$e->getMessage());
          }
          $reponse = $bdd->query('SELECT * FROM Boat');
          while ($donnees = $reponse->fetch())
          {   
      		$nomBoat=$donnees['nomBoat'];
			$type=$donnees['greement'];
			$length=$donnees['longueur'];
			$lanched=$donnees['lancement'];
			$image=$donnees['image'];
			echo '<figure class="item">';
			if ($image != null) {
				echo '<img src="'.$image.'" class="boat" alt="boat1"/>';
			}
			else{
				echo '<img class="card-img-top" data-src="holder.js/100px150?theme=thumb&bg=55595c&fg=eceeef&text=No Image" alt="Boat Image">';
			}
			echo '<figcaption class="name_boat">'.$nomBoat.'</figcaption>';
			echo '<p><strong>Type : </strong>'.$type.'</p>';
			echo '</figure>';
          }
          $reponse->closeCursor();
         ?>
	</section>
	<footer>
		<a href="../index.php">Download for detailed information</a>
		<script src="../js/bootstrap.min.js"></script>
    	<script src="../js/holder.min.js"></script>
	</footer>
</body>
</html>