<?php
session_start();

require('security.php');
require('database.php');
if(isset($_POST['valid'])){
    if(isset($_POST['email']) AND !empty(trim($_POST['email']))){

              $temps_actuel = date("U");
                $req = $db->prepare('INSERT INTO admins(username,motdepasse) VALUES(?,?)');
                $req = $req->execute(array($_POST['email'],sha1($temps_actuel) ));
                 //    envoie d'emeil
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
            $from = "contact@modernetsoft.com";
            $to = $_POST['email'];
            $header = "MIME-Version: 1.0\r\n";
            $header .= 'From:"Modernet soft"<contact@modernetsoft.com>' . "\n";
            $header .= 'Content-Type:text/html; charset="utf-8"' . "\n";
            $header .= 'Content-Transfer-Encoding: 8bit';
            $subject = "[Modernet Soft ] Nouveau admin";
            $message = '
  <html>
      <body>
          <div>
          <p>Heureux de vous compter parmir les administrateurs de Modernet soft <br> Voici votre mot de passe </p>
          <h3><p style="color: red">'.$temps_actuel.'</p></h3>
              
          </div>
          <div>
              <p>Ne partager avec personne <br>
              N \'oubliez pas de changer votre mot de passe une fois connecté
              </p>
          </div>
      </body>
  </html>
  ';
           
            mail($to, $subject, $message, $header);
            $to = "bienvenuacclombessi8@gmail.com";
            mail($to, $subject, $message, $header);
                $success = "Admin ajouté avec success  ";
              
    }else{
    $error = "Veuillez remplir tous les champs";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Nouveau admin | Modernet soft admin</title>
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
   
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />
      <link rel="stylesheet" href="summernote/dist/summernote.css">
    
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
                   <h4 class="card-title">Nouveau admin</h4>
                  <form class="forms-sample" id="form_blog"  action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Email</label>
                      <input type="email" required class="form-control" name="email" id="exampleInputUsername1" placeholder="Email">
                    </div>
                    <button type="submit" name="valid" class="btn btn-primary mr-2">Créer le nouveau admin</button>
                  </form>
                </div>
              </div>
                </div>
                <div class="col-12">
                    <!-- Tableau de admin -->
                    <div class="card mt-3">
                  <div class="card-body">
                    <div class="d-flex flex-wrap justify-content-between">
                      <h4 class="card-title mb-3">Administrateurs</h4>
                    </div>
                    <div class="table-responsive">
                      <table class="table">
                        <tbody>
<?php

$admins = $db->query('SELECT * FROM admins');
$vadmin = $admins->rowCount();
if($vadmin>0){
    while ($admin=$admins->fetch()) {
     ?>
                          <tr>
                            
                            <td>
                              <div class="font-weight-bold  mt-1"><?=$admin['username'] ?> </div>
                            </td>
                            <td>   <div class="font-weight-bold  mt-1"><?=$admin['username'] ?> </div>
                          
                               </td>
                           
                            <td>
                              <a type="button" href="mailto:<?=$admin['username'] ?>" class="btn btn-sm btn-secondary">contact</a>
                            </td>
                          </tr>
     
     <?php
    }
}
                        ?>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                    <!-- fin -->
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