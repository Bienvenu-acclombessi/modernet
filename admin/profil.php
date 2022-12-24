<?php
session_start();
require('database.php');
require('security.php');
if(isset($_POST['valid'])){
    if(isset($_POST['password_ancien'],$_POST['password_nouveau']) AND !empty(trim($_POST['password_ancien'])) AND !empty(trim($_POST['password_nouveau']))){
        $users = $db->prepare('SELECT * FROM admins WHERE id_admin=? AND motdepasse=?');
        $users->execute([$_SESSION['id_admin'], sha1($_POST['password_ancien'])]);
        $vusers = $users->rowCount();
        if($vusers>0){
            $req = $db->prepare('UPDATE admins SET motdepasse=? WHERE id_admin=?');
            $req = $req->execute(array(sha1($_POST['password_nouveau']),$_SESSION['id_admin'], ));
            $success = "mOT DE PASSE MODIFIÈ AVEC SUCCESS";
        
        }else{
            $error = "Mot de passe incorrect";
        }
              
    }else{
    $error = "Veuillez remplir tous les champs";
    }
}
$users = $db->prepare('SELECT * FROM admins WHERE id_admin=?');
$users->execute([$_SESSION['id_admin']]);
$user = $users->fetch();


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Profil administrateur | Modernet soft admin</title>
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
                   <h4 class="card-title">Modifier mon mot de passe</h4>
                  <form class="forms-sample"  action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Mot de passe ancien</label>
                      <input type="password" required class="form-control" name="password_ancien" id="exampleInputUsername1" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Mot de passe nouveau</label>
                      <input type="password" required class="form-control" name="password_nouveau" id="exampleInputUsername1" placeholder="Email">
                    </div>
                    <button type="submit" name="valid" class="btn btn-primary mr-2">Modifier mot de passe</button>
                  </form>
                </div>
              </div>
                </div>
                <div class="col-12">
                <div class="form-group">
                      <label for="exampleInputUsername1">Email</label>
                      <input type="email" readonly class="form-control" value="<?=$user['username'] ?>" >
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