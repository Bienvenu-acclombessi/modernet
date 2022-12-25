<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
include("database.php");
require 'vendor/autoload.php';
if(isset($_SESSION['id'])){ 
  header('location:index.php');
} 
if(isset($_POST['valid']))
{
    if(isset($_POST['email'],$_POST['password1'],$_POST['password2']) AND !empty($_POST['email'])  AND !empty($_POST['password1']) AND !empty($_POST['password2']))
    {
    if($_POST['password1']!=$_POST['password2'])
    {
      $error='Le mot de passe de confirmation est different de celui entrer';
     
    }
    else
     { 
      $email=htmlspecialchars($_POST['email']);
      $reqt=$db->prepare('SELECT * FROM User WHERE email=?');
      $reqt->execute(array($email));
      $verify=$reqt->rowCount();
      if($verify==1){
          $error="Cet  email existe deja";
      }else{
       $password=htmlspecialchars($_POST['password1']);
       $crypt=sha1($password);
                $req=$db->prepare('INSERT INTO user(nom,prenom,email,password1,image) VALUES(?,?,?,?,?)');
                $req=$req->execute(array($_POST['nom'],$_POST['prenom'],$email,$crypt,'1.png'));
                $reqt=$db->prepare('SELECT * FROM user WHERE email=? AND password1=?');
                $reqt->execute(array($email,$crypt));  
                $client=$reqt->fetch();


               
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'smtp.hostinger.fr';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'nebstan@expashoping.fr';
$mail->Password = '96989470Welcom@';
$mail->setFrom('nebstan@expashoping.fr', 'NEBSTAN COMPANY');
$mail->addReplyTo('nebstan@expashoping.fr', 'Nebstan Company');
 $mail->addAddress($email, 'nebstan');
 $mail->Subject = 'Confirmation d\'inscription ';
$mail->isHTML(true);
 $mail->Body = 'Bonjour '.$client['nom'].' '.$client['prenom'].' Toute l\'equipe de nebstan vous remercie Voici votre lien de confirmation <a href="expashoping.fr/bienvenu/confirmation.php?id="'.$client['id'].'""> <b>cliquer ici <b> </a>  <br> <img src="expashoping.fr/bienvenu/img/1.jpg" alt=""> ';
    if (!$mail->send()) {
        echo 'Erreur ';
    } else {
        echo 'Le message a été envoyé.';
          header("location:login.php?id=");
    }
     
              }         }
    }   
else
{
    $error="Remplir tous les champs";
}

} 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/nebstan.min.css">
    <link rel="stylesheet" href="assets/css/stat.css">
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    <title>Nebstan un reseau des genies</title>
    <style>
        .anim{
            height:700px; 
            opacity: 1;
            background: linear-gradient(#1a18188f, #14141493), url('assets/images/home1.jpg') center center fixed;
            background-size: cover;
        }
        
        .d-flexf .h1{
            margin-top: 250px;
            margin-left: 100px;
            font-size: 40px;
        }
        .b-card{
height: 500px;
width: 90%;
left: 5%;
right: 5%;
        }
       
    </style>
</head>
<body>
    <div class="star-animation">
        <div id="stars1"><i class="fas fa-heart"></i></div>
          <div id="stars2"><i class="fas fa-heart"></i></div>
          <div id="stars3"><i class="fas fa-heart"></i></div>
          <div id="stars4"><i class="fas fa-heart"></i></div>
          <div id="stars5"><i class="fas fa-heart"></i></div>
    </div>
    <div class="container-fluid w-100 anim">
          <div class="row">
              <div class="col-lg-6 d-flexf h-100">
    <h1 class="text-light h1">Nebstan</h1>
    <p class="p text-light" style="margin-left:100px;">  
        Qui cherches tu ?  <br>
        <a href="login.php" class="btn btn-outline-light">Se connecter</a>  </p>
        </p>
              </div>
              <div class="col-lg-6">
                  <form action="" method="post" id="forme">
                    <div class="card b-card bg-white mt-5">
                       <h1 class="h1 text-dark text-center mt-5" style="font-weight: bolder; font-size: 50px;"> Inscrivez-vous</h1>
                       <?php if(isset($error)){

?>
<div class="alert alert-dismissible alert-danger">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <strong>Oh Erreur </strong><?=$error?> and try submitting again.
</div>
<?php } ?>
                       <div class="row me-3 ms-3">
                           <div class="col-6">
                            <label for="nom">Nom</label>
                            <input type="text" name="nom" id="nom" class="form-control">
                            <span class=" text-danger" id="nom_error"></span>
                           </div>
                           <div class="col-6">
                            <label for="prenom">Prenom</label>
                            <input type="text" name="prenom" id="prenom" class="form-control">
                            <span class=" text-danger" id="prenom_error"></span>
                           </div>
                       </div>
                       <div class="row me-3 ms-3">
                        
                        <div class="col-12">
                            <label for="nom">Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                            <span class=" text-danger" id="email_error"></span>
                           </div>
                           <div class="col-12">
                         <label for="nom">Mot de passe</label>
                         <input type="password" name="password1" id="adresse" class="form-control">
                         <span class=" text-danger" id="adresse_error"></span>
                        </div>
                        <div class="col-12">
                         <label for="nom">Confirmer votre mott de passe</label>
                         <input type="password" name="password2" id="adresse" class="form-control">
                         <span class=" text-danger" id="adresse_error"></span>
                        </div>
                        <button class="btn btn-info mt-3 me-3" id="vali" name="valid"  type="submit">Valider</button>
                    <a href="login.php"> J'ai deja un compte</a>
                    </div>


                    </div>
                    </div>
                  </form>
              </div>
          </div>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.js"></script>
    
</body>
</html>