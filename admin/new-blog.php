<?php
session_start();
require('database.php');
if(isset($_POST['valid'])){
    if(isset($_POST['title'],$_POST['description']) AND !empty(trim($_POST['title'])) AND !empty(trim($_POST['description']))){
        if (isset($_FILES['image']) and !empty(trim($_FILES['image']['name']))) {
            $temps_actuel = date("U");
            $taillemax = 2097152 * 10;
            $extentionsValides = array('jpg', 'jpeg', 'mp4', 'gif', 'png', 'jfif', 'pdf');
            $extentionUpload = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
            if (in_array($extentionUpload, $extentionsValides)) {
              $chemin = 'images/' . $temps_actuel . trim($_FILES['image']['name']);
              $resultat = move_uploaded_file($_FILES['image']['tmp_name'], $chemin);
              if ($resultat) {
                $req = $db->prepare('INSERT INTO blogs(title,image_descriptive,description,createdAt) VALUES(?,?,?,CURDATE())');
                $req = $req->execute(array($_POST['title'],$temps_actuel . trim($_FILES['image']['name']),$_POST['description'] ));
                $success = "Blog ajouté avec success";
              } else {
                $error = 'Il ya une erreur pendant l\'importation de votre pièce';
              }
            } else {
              $error = 'Le format de votre pièce  n\'est pas autorisée';
            }
          } else {
            $error = "Veuillez choisir un fichier";
          }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Nouveau blog | Modernet soft admin</title>
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
   
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />
  </head>
  <body>
    
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
<?php include('nav.php');    ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->
   
<?php include('aside.php');    ?>
        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->
      
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12">
                <div class="card">

                 <div class="card-body">
                 <?php
if(isset($error)){
    ?>
    <div class="alert alert-danger">
         <p class="text-center">
            <?=$error?>
         </p>
    </div>
    <?php
}                ?>
<?php
if(isset($success)){
    ?>
    <div class="alert alert-success">
         <p class="text-center">
            <?=$success?>
         </p>
    </div>
    <?php
}                ?>
                   <h4 class="card-title">Nouveau blog</h4>
                  <form class="forms-sample" action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Titre du blog(h1) </label>
                      <input type="text" class="form-control" name="title" id="exampleInputUsername1" placeholder="Titre du blog">
                    </div>
                    <div class="form-group">
                      <label>Image descriptive</label>
                      <input type="file" name="image" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleTextarea1">Corps de votre rédaction</label>
                      <textarea class="form-control" id="exampleTextarea1" name="description" rows="4"></textarea>
                    </div>
                    <button type="submit" name="valid" class="btn btn-primary mr-2">Soumettre</button>
                  </form>
                </div>
              </div>
                </div>
            </div>




          </div>
         
        </div>
       </div>
      </div>
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <script src="vendors/progressbar.js/progressbar.min.js"></script>
    <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="js/dashboard.js"></script>
    <script src="js/file-upload.js"></script>
  </body>
</html>