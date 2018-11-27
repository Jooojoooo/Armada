<?php 
  session_start();
  if ($_SESSION['id'] ==null) {
    header('Location: ../index.php');
  }
 ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" href="../../../../favicon.ico"> -->

    <title>Boats Configuration</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/gestionBoat.css" rel="stylesheet">
  </head>

  <body>

    <header>
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4 class="text-white">About</h4>
              <p class="text-muted">Configuration about your boats</p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white">More</h4>
              <ul class="list-unstyled">
                <li><a href="creationBoat.php" class="text-white">Create a new Boat</a></li>
                <li><a href="displayAllBoats.php" class="text-white">View all boats</a></li>
                <li><a href="disconnect.php" class="text-white">Disconnect</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container d-flex justify-content-between">
          <a href="../index.php" class="navbar-brand d-flex align-items-center">
            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg> -->
            <strong>Armada</strong>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>

    <main role="main">

      <section class="jumbotron text-center">
        <!-- <div class="container"> -->
          <h1 class="jumbotron-heading">Your Boats</h1>
          <!-- <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
          <p>
            <a href="#" class="btn btn-primary my-2">Main call to action</a>
            <a href="#" class="btn btn-secondary my-2">Secondary action</a>
          </p> -->
        <!-- </div> -->
      </section>

      <div class="album py-5 bg-light">
        <div class="container">

          <div class="row">
            <?php

            try{
             $bdd = new PDO('mysql:host=localhost;dbname=bdd_7_12;charset=utf8','grp_7_12', 'ohfae5ioVi',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
               // $bdd = new PDO('mysql:host=localhost;dbname=Armada;charset=utf8', 'root', 'root');
            }
            catch(Exception $e){
              die('Erreur : '.$e->getMessage());
            }
            $reponse = $bdd->prepare('SELECT * FROM Boat WHERE idResponsable=?');
            $reponse->execute(array($_SESSION['id']));
            while ($donnees = $reponse->fetch())
            {
              $nomBoat=$donnees['nomBoat'];
              $type=$donnees['greement'];
              $length=$donnees['longueur'];
              $lanched=$donnees['lancement'];
              $image=$donnees['image'];
              $file=$donnees['file'];
              $id=$donnees['id'];
            ?>
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                <?php 
                  if ($image==null) {
                    echo '<img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=No Image" alt="Boat Image">';
                  }
                  else{
                    echo '<img class="card-img-top" src="'.$image.'" alt="Boat Image" style="height: 250px;width: 100%">';
                  }
                 ?>
                
                <div class="card-body">
                  <p class="card-text"><?php echo $nomBoat.'<br/><strong>Lanched</strong> : '.$lanched; ?> </p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <?php 
                      echo '<button type="button" class="btn btn-sm btn-outline-secondary" onclick="location.href=\'editBoat.php?idBoat='.$donnees['id'].'&nomBoat='.$donnees['nomBoat'].'&type='.$donnees['greement'].'&length='.$donnees['longueur'].'&lanched='.$donnees['lancement'].'&image='.$donnees['image'].'&file='.$donnees['file'].'\'">Edit</button>'; 
                      ?>
                      <?php 
                      echo '<button type="button" class="btn btn-sm btn-outline-secondary" onclick="location.href=\'deleteBoat.php?idBoat='.$donnees['id'].'\'">Delete</button>'; 
                      ?>
                      <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> -->
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
          <?php }
          $reponse->closeCursor();
            ?>
            
          </div>
        </div>
      </div>

    </main>

    <footer class="text-muted">
      <div class="container">
        <p class="float-right">
          <a href="#">Back to top</a>
        </p>
        <p>&copy; Armada</p>
        <!-- <p>New to Bootstrap? <a href="../../">Visit the homepage</a> or read our <a href="../../getting-started/">getting started guide</a>.</p> -->
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/holder.min.js"></script>
  </body>
</html>
