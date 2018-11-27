<?php 
session_start();
try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=bdd_7_12;charset=utf8', 'grp_7_12', 'ohfae5ioVi');
		// $bdd = new PDO('mysql:host=localhost;dbname=Armada;charset=utf8','root', 'root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
	catch(Exception $e)
	{
	        die('Erreur : '.$e->getMessage());
	} 
	$idBoat= $_POST['idBoat'];
	$nomBoat=$_POST['boatName'];
	$req = $bdd ->prepare('SELECT * FROM Boat WHERE id = :id');
	$req ->execute(array('id' => $idBoat));
	while ($donnees = $req->fetch())
	{
		if ($donnees['file']!=null) {
			$fileChange=$donnees['file'];
		}
		else{
			$fileChange=null;
		}
		if ($donnees['image']!=null) {
			$imageChange=$donnees['image'];
		}
		else{
			$imageChange=null;
		}
	}

	$req->closeCursor();
	if ($_FILES['image']['name'] != NULL) {
		$imageFileType = $_FILES['image']['type'];
		$expensions= array("image/jpeg","image/jpg","image/png","image/pjpeg");
		if (in_array($imageFileType,$expensions)== false) 
		{
			echo '<script>alert("Please upload a png or jpeg or jpg image'.$imageFileType.'");window.location.href="creationBoat.php";</script>';
			exit();
			
		}
		else{
			
			if($_FILES['image']['error']>0){
				echo 'Error : '.$_FILES['image']['error'];
				exit();
			}
			else{
				if ($imageChange!=null) {
					unlink($imageChange);
				}
				if ($_FILES['image']['type'] == 'image/jpeg') {
				$imageNewName = $nomBoat.'.jpeg';
				}
				else if($_FILES['image']['type'] == 'image/png'){
					$imageNewName = $nomBoat.'.png';
				}
				else{
					$imageNewName=$nomBoat.'.jpg';
				}
				$image_target = '../uploadImg/'.$_SESSION['id'].'_'.$imageNewName;
				if (file_exists($image_target)) {
				echo '<script>alert("Image already exists");window.location.href="creationBoat.php";</script>';
				exit();
				}
				else{
					move_uploaded_file($_FILES['image']['tmp_name'],$image_target);
				}
			}
		}
	}
	else{
		$image_target=null;
	}
	if ($_FILES['file']['name'] != NULL) {
		
		$fileFileType = $_FILES['file']['type'];
		$expensions= array("application/pdf");
		echo $_FILES['file']['name'];
		if (in_array($fileFileType,$expensions)== false) 
		{
			echo '<script>alert("Please upload a pdf document'.$fileFileType.'");window.location.href="creationBoat.php";</script>';
			exit();
			
		}
		else{
			if($_FILES['file']['error']>0){
				echo 'Error : '.$_FILES['file']['error'];
				exit();
			}
			else{
				if ($fileChange != null) {
					unlink($fileChange);
				}
				$fileNewName = $nomBoat.'.pdf';
				$file_target = '../uploadPdf/'.$_SESSION['id'].'_'.$fileNewName;
				move_uploaded_file($_FILES['file']['tmp_name'],$file_target);
				
			}
		}	
	}
	else{
		$file_target=null;
	}	
	$req1 = $bdd->prepare('UPDATE Boat SET nomBoat=:nomBoat,greement=:greement,longueur=:longeur,lancement=:lancement,image=:image,file=:file WHERE id=:id');
			$req1 ->execute(array(
				'nomBoat' => $_POST['boatName'],
				'greement' => $_POST['type'],
				'longeur' => $_POST['length'],
				'lancement' => $_POST['lanched'],
				'image' => $image_target,
				'file' => $file_target,
				'id' => $idBoat));
	header('Location: gestionBoat.php');
 ?>
