<?php
session_start();
require('database.php');
if(isset($_POST['valid'])) {
  if (isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['telephone'], $_POST['civilite'], $_POST['pays'], $_POST['adresse'], $_POST['ville'], $_POST['devise'], $_POST['password'],$_POST['password2']) and !empty(trim($_POST['nom'])) and !empty(trim($_POST['prenom'])) and !empty(trim($_POST['email']))  and !empty(trim($_POST['telephone'])) and !empty(trim($_POST['civilite'])) and !empty(trim($_POST['pays'])) and !empty(trim($_POST['adresse'])) and !empty(trim($_POST['ville'])) and !empty(trim($_POST['devise'])) and !empty(trim($_POST['password'])) and !empty(trim($_POST['password2']))) {
    //verification et mot de passe
    if($_POST['password']!=$_POST['password2']){

    }else{
      //verication de existente
  $existante=$db->prepare('SELECT * FROM CLIENTS WHERE email=?');
  $existante->execute(array($_POST['email']));
  $vexistante=$existante->rowCount();
  if($vexistante<=0){
    //verification de piece
    if (isset($_FILES['piece']) and !empty(trim($_FILES['piece']['name']))) {
      $temps_actuel = date("U");
      $taillemax = 2097152 * 10;
      $extentionsValides = array('jpg', 'jpeg', 'mp4', 'gif', 'png', 'jfif', 'pdf');
      $extentionUpload = strtolower(substr(strrchr($_FILES['piece']['name'], '.'), 1));
      if (in_array($extentionUpload, $extentionsValides)) {
        $chemin = 'pieces/' . $temps_actuel . trim($_FILES['piece']['name']);
        $resultat = move_uploaded_file($_FILES['piece']['tmp_name'], $chemin);
        if ($resultat) {
          $nom = htmlspecialchars($_POST['nom']);
          $prenom = htmlspecialchars($_POST['prenom']);
          $email = htmlspecialchars($_POST['email']);
          $telephone = htmlspecialchars($_POST['telephone']);
          $civilite = htmlspecialchars($_POST['civilite']);
          $pays = htmlspecialchars($_POST['pays']);
          $adresse = htmlspecialchars($_POST['adresse']);
          $ville = htmlspecialchars($_POST['ville']);
          $devise = htmlspecialchars($_POST['devise']);
          $password = sha1(htmlspecialchars($_POST['password']));
          $numero_compte=date('U');
          $code_guichet=rand(100, 1000);
          $code_bic=rand(100, 1000);
          $code_banque=rand(100, 1000);
          $req = $db->prepare('INSERT INTO clients(numero_compte,code_guichet,code_bic,code_banque ,nom,prenom,email,telephone,civilite,pays,adresse,ville,devise,piece,password,createdAt) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,CURDATE())');
          $req = $req->execute(array($numero_compte,$code_guichet,$code_bic,$code_banque,$nom, $prenom, $email, $telephone, $civilite, $pays, $adresse, $ville, $devise, $temps_actuel . trim($_FILES['piece']['name']), $password));
          $success = "Personne ajouté avec success";
          // envoie d'emeil
          ini_set('display_errors', 1);
          error_reporting(E_ALL);
          $from = "contact@brink-finance.com";
          $to = $email;
          $header = "MIME-Version: 1.0\r\n";
          $header .= 'From:"Brink Finance"<noreply@brink.com>' . "\n";
          $header .= 'Content-Type:text/html; charset="uft-8"' . "\n";
          $header .= 'Content-Transfer-Encoding: 8bit';
          $subject = "[BRINK FINANCE ] Activation de votre compte";
          $message = '
<html>
	<body>
		<div>
			<p>Pour activer votre compte veuillez cliquer sur le lien suivant</p>
      <p>https://brink-finance.com/account_activation.php?key='.$numero_compte.'</p>
		</div>
	</body>
</html>
';
          $headers = "De :" . $from;
          mail($to, $subject, $message, $header);



          // fin envoie
          $userinscript=$db->prepare('SELECT * FROM clients WHERE email=?');
          $userinscript->execute(array($email));
          $user=$userinscript->fetch();

         $_SESSION['verification']=$user['id_client'];
          header('location: validation-email.php');
        } else {
          $error = 'Il ya une erreur pendant l\'importation de votre pièce';
        }
      } else {
        $error = 'Le format de votre pièce  n\'est pas autorisée';
      }
    } else {
      $error = "Veuillez choisir un fichier";
    }

  }else{
    $error='Cet email ou username existe déjà';
  }
  }
    // fin
  } else {
    $error = "Veuillez remplir tous les champs";
  }
}
?>


<!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Register Basic - Pages | BRINK FINANCE</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <!-- Page CSS -->
  <!-- Page -->
  <link rel="stylesheet" href="assets/vendor/css/pages/page-auth.css" />
  <!-- Helpers -->
  <script src="assets/vendor/js/helpers.js"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="assets/js/config.js"></script>
</head>

<body>
  <!-- Content -->

  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register Card -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <a href="/" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                <img src="assets/img/logo.png" height="80" />
                  
                </span>
              </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Bienvenue sur Brink Finance! 👋</h4>
              <p class="mb-4">Votre banque toujours disponible pour vous</p>
             
           <?php
           if(isset($error)){
            ?>
            <div class="alert alert-danger my-3">
              <p class="text-center"><?=$error?></p>
            </div>
            <?php
           }
           
           
              ?>
            <form id="formAuthentication" class="mb-3" action=""  enctype="multipart/form-data" method="POST">
              <!-- nom et prenom -->
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" value="<?php if(isset($_POST['nom'])) echo $_POST['nom']; ?>" class="form-control" id="nom" name="nom" placeholder="Enter your nom" autofocus required />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="prenom" class="form-label">Prenom</label>
                    <input type="text" value="<?php if(isset($_POST['prenom'])) echo $_POST['prenom']; ?>" class="form-control" id="prenom" name="prenom" placeholder="Enter your prenom" autofocus required />
                  </div>
                </div>
              </div>
              <!-- mail et numero de telephone -->
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" class="form-control" id="email" required name="email" placeholder="Enter your email" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="telephone" class="form-label">Numero de telephone</label>
                    <input type="tel" value="<?php if(isset($_POST['telephone'])) echo $_POST['telephone']; ?>" class="form-control" required id="telephone" name="telephone" placeholder="Enter your phone number" />
                  </div>
                </div>
              </div>

              <!-- civilite et pays  -->
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="civilite" class="form-label">Civilité</label>
                    <select class="form-select" required id="civilite" name="civilite" aria-label="Default select example">
                      <option selected>Choisissez votre sexe </option>
                      <option value="Masculin">Masculin</option>
                      <option value="Féminin">Féminin</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="pays" class="form-label">Pays</label>
                    <select class="form-select" required id="pays" name="pays" aria-label="Default select example">
                      <option selected="selected" value="">Veuillez selectionner votre pays</option>
                      <?php include('pays.php')   ?>
                    </select>
                  </div>
                </div>
              </div>

              <!-- fin civilite -->

              <!-- adresse ville -->
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse</label>
                    <input type="text" value="<?php if(isset($_POST['adresse'])) echo $_POST['adresse']; ?>" class="form-control" id="adresse" name="adresse" placeholder="Enter your adresse" autofocus required />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="ville" class="form-label">Ville</label>
                    <input type="text" class="form-control" value="<?php if(isset($_POST['ville'])) echo $_POST['ville']; ?>" id="ville" name="ville" placeholder="Enter your ville" autofocus required />
                  </div>
                </div>
              </div>




              <!-- adresse ville  -->
              <!-- Devices et une piece d'identité -->
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="devise" class="form-label">Device</label>
                    <select class="form-select" required id="devise" name="devise" aria-label="Default select example">
                      <option selected>Choisissez votre device </option>
                      <option value="EUR">EUR</option>
                      <option value="Dollar">Dollar</option>
                      <option value="XOF">XOF</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="piece" class="form-label">Ajouter une pièce d'identité</label>
                    <input class="form-control" required type="file" name="piece" id="piece" />
                  </div>
                </div>
              </div>

              <!-- fin civilite -->
              <!-- fin device -->

              <!-- Password -->
              <!-- nom et prenom -->
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password">Mot de passe</label>
                    <div class="input-group input-group-merge">
                      <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required />
                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password2">Confirmation de votre mot de passe</label>
                    <div class="input-group input-group-merge">
                      <input type="password" id="password2" class="form-control" name="password2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password2" required />
                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                  </div>
                </div>
              </div>
              <!-- mail et numero de telephone -->






              <button class="btn btn-primary d-grid w-100" type="submit" name="valid">S'inscrire</button>
            </form>

            <p class="text-center">
              <span>Already have an account?</span>
              <a href="auth-login.php">
                <span>Se connecter</span>
              </a>
            </p>
          </div>
        </div>
        <!-- Register Card -->
      </div>
    </div>
  </div>



  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="assets/vendor/libs/jquery/jquery.js"></script>
  <script src="assets/vendor/libs/popper/popper.js"></script>
  <script src="assets/vendor/js/bootstrap.js"></script>
  <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

  <script src="assets/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->

  <!-- Main JS -->
  <script src="assets/js/main.js"></script>

  <!-- Page JS -->

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>