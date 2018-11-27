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
	if (!isset($_SESSION['id'])) {
		echo '<script>alert("Account error, please reconnect");window.location.href="../index.php";</script>';
		exit();
	}
	//read from boat table in order to examine uploaded file and rename it
	$nomBoat=$_POST['boatName'];
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
				if ($_FILES['image']['type'] == 'image/jpeg') {
				$imageNewName = $nomBoat.'.jpeg';
				}
				else if($_FILES['image']['type'] == 'image/png'){
					$imageNewName = $nomBoat.'.png';
				}
				else{
					$imageNewName=$nomBoat.'.jpg';
				}
				rename($_FILES['image']['name'],$imageNewName);
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
	if ($_FILES['file']['name'] != NULL) {
		
		$fileFileType = $_FILES['file']['type'];
		$expensions= array("application/pdf");
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
				$fileNewName = $nomBoat.'.pdf';
				rename($_FILES['file']['name'],$fileNewName);
				$file_target = '../uploadPdf/'.$_SESSION['id'].'_'.$fileNewName;
				if (file_exists($file_target)) {
				echo '<script>alert("Image already exists");window.location.href="creationBoat.php";</script>';
				exit();
				}
				else{
					move_uploaded_file($_FILES['file']['tmp_name'],$file_target);
				}
			}
		}	
	}
			
	$req1 = $bdd->prepare('INSERT INTO Boat(nomBoat,greement,longueur,lancement,image,file,idResponsable) VALUES(:nomBoat,:greement,:longeur,:lancement,:image,:file,:idResponsable)');
			$req1 ->execute(array(
				'nomBoat' => $_POST['boatName'],
				'greement' => $_POST['type'],
				'longeur' => $_POST['length'],
				'lancement' => $_POST['lanched'],
				'image' => $image_target,
				'file' => $file_target,
				'idResponsable' => $_SESSION['id']));
	header('Location: gestionBoat.php');

 ?>


