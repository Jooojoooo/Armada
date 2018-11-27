<?php 
  session_start();
  if ($_SESSION['id'] == null) {
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
    <title>All Boats</title>

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
              <p class="text-muted">All Boats in Armada</p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white">More</h4>
              <ul class="list-unstyled">
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
                  $id=$_SESSION['id'];
                  // to get and read a cursor from a tabel selected
                  $reponse = $bdd->query('SELECT * FROM Inscrit');
                  while ($donnees = $reponse->fetch())
                  {   
                      $reponse = $bdd->query('SELECT * FROM Administrator');
                      while ($donnees = $reponse->fetch())
                      {
                        $id_admin = $donnees['idInscrit'];
                        if ($id== $id_admin) {
                          $admin = true;
                        }
                        else{
                          $admin = false;
                        }
                      }
                      // see if user is a responsible of boat
                      $reponse = $bdd->query('SELECT * FROM Responsable');
                      while ($donnees = $reponse->fetch())
                      {
                        $id_resp = $donnees['idInscrit'];
                        if ($id== $id_resp) {
                          $resp = true;
                        }
                        else{
                          $resp = false;
                        }
                      }
                      $reponse->closeCursor();
                  }
                  //if user corresponds to one identity in database
                  if ($admin == true) {
                    echo '<li><a href="changeIdentity.php" class="text-white">Return to configuration identities</a></li>';
                    echo '<li><a href="disconnect.php" class="text-white">Disconnect</a></li>';
                  }
                  else if ($resp == true) {
                    echo '<li><a href="gestionBoat.php" class="text-white">Edit Your Boats</a></li>
              </ul>';
                    echo '<li><a href="disconnect.php" class="text-white">Disconnect</a></li>';
                  }
                  
                  else{
                    echo '<li><a href="../index.php" class="text-white">Return to homepage</a></li>';
                    echo '<li><a href="disconnect.php" class="text-white">Disconnect</a></li>';
                  }
                 ?>
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
          <h1 class="jumbotron-heading">All Boats in Armada</h1>
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
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm ">
                <img class="card-img-top" src="../img/boat1.PNG" alt="Boat Image" style="height: 250px;width: 100%">
                <div class="card-body">
                  <p class="card-text"><strong>Name : </strong>Boat 1<br/>
                    <strong>Lanched : </strong>1900 <br/>
                    <strong>Type : </strong>One guided toile<br/>
                    <strong>Length : </strong>10m</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary"onclick="noFile()">Download</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                <img class="card-img-top" src="../img/boat2.PNG" style="height: 250px;width: 100%"alt="Card image cap">
                <div class="card-body">
                  <p class="card-text"><strong>Name : </strong>Boat 2<br/>
                    <strong>Lanched : </strong>1902 <br/>
                    <strong>Type : </strong>Two guided toile<br/>
                    <strong>Length : </strong>20m</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary"onclick="noFile()">Download</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
              <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                <img class="card-img-top" src="../img/boat3.PNG" style="height: 250px;"alt="Card image cap">
                <div class="card-body">
                  <p class="card-text"><strong>Name : </strong>Boat 3<br/>
                    <strong>Lanched : </strong>1903 <br/>
                    <strong>Type : </strong>Tree guided toile<br/>
                    <strong>Length : </strong>30m</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary"onclick="noFile()">Download</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php
            $reponse = $bdd->query('SELECT * FROM Boat');
            while ($donnees = $reponse->fetch())
            {
              $nomBoat=$donnees['nomBoat'];
              $type=$donnees['greement'];
              $length=$donnees['longueur'];
              $lanched=$donnees['lancement'];
              $image=$donnees['image'];
              $file=$donnees['file'];
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
                  <p class="card-text"><?php echo '<strong>Name : </strong>'.$nomBoat.'<br/><strong>Lanched</strong> : '.$lanched.'<br/><strong>Type : </strong>'.$type.'<br/><strong>Length : </strong>'.$length.'m<br/>'; ?> </p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <?php 
                      if ($file != null) {
                        echo '<button type="button" class="btn btn-sm btn-outline-secondary" onclick="location.href=\''.$file.'\'">Download</button>';
                      }
                      else{
                        echo '<button type="button" class="btn btn-sm btn-outline-secondary" onclick="noFile()">Download</button>';
                      }
                       ?>
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
    <script language="javascript">
      function noFile(){
        alert("No file available");
      }
    </script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/holder.min.js"></script>
  </body>
</html>
