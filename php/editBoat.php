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

    <title>Create a Boat</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/creationBoat.css" rel="stylesheet">
  </head>

  <body class="bg-light">

    <div class="container">
      <div class="py-5 text-center">
        <h1>Armada</h1>
      </div>
      <div class="col-md-12 order-md-1">
          <h4 class="mb-3">Boat Information</h4>
          <form class="needs-validation" method="post" action="updateBoat.php" enctype = "multipart/form-data" novalidate>
            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="boatName">Boat name</label>
                <?php echo '<input type="text" class="form-control" id="boatName" name="boatName" placeholder="" value="'.$_GET['nomBoat'].'" required>';?>
                <div class="invalid-feedback">
                  Valid name is required.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="length">Length (m)</label>
              <?php echo '<input type="number" step=0.01 class="form-control" min=0 id="length" name="length" placeholder="3.20" value="'.$_GET['length'].'" required>';?>
              
              <div class="invalid-feedback">
                Please enter your boat length.
              </div>
            </div>

            <div class="mb-3">
              <label for="type">Type</label>
               <?php echo '<input type="text" class="form-control" id="type" name="type" placeholder="Guided Missile Frigate" value="'.$_GET['type'].'" required>';?>
              
              <div class="invalid-feedback">
                Please enter your boat type.
              </div>
            </div>

            <div class="mb-3">
              <label for="lanched">Lanched</label>
              <select class="custom-select d-block w-100" id="lanched" name="lanched" required>
                <option value="">Choose...</option>
                <?php 
                for ($i=1800; $i < 2017; $i++) { 
                  echo '<option>'.$i.'</option>';
                  if($i == $_GET['lanched']){
                    echo '<option selected>'.$i.'</option>';
                  }
                }
                 ?>
                
              </select>
            </div>
            <div class="invalid-feedback">
                  Please provide a valid lanched year.
                </div>

            <div class="mb-3">
              <label for="image">Upload an Image</label>
              <input type="file" class="form-control-file" accept="image/png,image/jpeg,image/jpg" id="image" name="image">              
            </div>

            <div class="mb-3">
              <label for="file">Upload a pdf about boat discription</label>
              <input type="file" class="form-control-file"  accept=".pdf" name="file" id="file" placeholder="">
              <div class="invalid-feedback">
                Please verify your upload pdf.
              </div>
            </div>

            <hr class="mb-4">
            <?php
            echo '<input type="hidden" name="idBoat" value="'.$_GET['idBoat'].'"/>';?>
            <button class="btn btn-primary btn-lg btn-block" type="submit">Update the boat</button>
          </form>
        </div>
      </div>

      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2017-2018 Armada</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#">Privacy</a></li>
          <li class="list-inline-item"><a href="#">Terms</a></li>
          <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
      </footer>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../js/vendor/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/vendor/holder.min.js"></script>
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
  </body>
</html>
