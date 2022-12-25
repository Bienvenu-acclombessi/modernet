<?php
session_start();
include("database.php");
 if(isset($_SESSION['id'])){ 
   header('location:index.php');
 }
if(isset($_POST['valid']))
{
    if(isset($_POST['email'],$_POST['password1']) AND !empty($_POST['email'])  AND !empty($_POST['password1']))
    {
      $password=htmlspecialchars($_POST['password1']);
      $crypt=sha1($password);
      $email=htmlspecialchars($_POST['email']);
      $reqt=$db->prepare('SELECT * FROM user WHERE email=? AND password1=?');
      $reqt->execute(array($email,$crypt));  
      $client=$reqt->fetch();   
      $verify=$reqt->rowCount();
      if($verify==1){ 
        $_SESSION['id']=$client['id'];
        setcookie('id',$_SESSION['id'] , time() + 7*24*3600, null, null,false, true);
        header('location:index.php');
      }else{
      $error='Mot de passe incorret';
               
              }
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
    <title>Nebstan se connecter</title>
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
        Qui cherches tu ?  <br>  <a href="signin.php" class="btn btn-light">Créer un compte</a>  </p>
              </div>
              <div class="col-lg-6">
                  <form action="" method="post" id="forme">
                    <div class="card b-card bg-white mt-5">
                       <h1 class="h1 text-dark text-center mt-5" style="font-weight: bolder; font-size: 50px;"> connectez-vous</h1>
                       <?php if(isset($error)){

?>
<div class="alert alert-dismissible alert-danger">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <strong>Oh Erreur</strong><?=$error?> try submitting again.
</div>
<?php } ?>          
                       <div class="row me-3 ms-3">
                       
                        <div class="col-12">
                            <label for="nom">Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                            <span class=" text-danger" id="email_error"></span>
                           </div>
                        <div class="col-12">
                         <label for="prenom">Mot de passe</label>
                         <input type="password" name="password1" id="email" class="form-control">
                           <span class=" text-danger" id="date_error"></span>
                        </div>
                        <button class="btn btn-info mt-3 me-3" id="valider" name="valid" type="submit">Valider</button>
                     <a href="signin.php">Creer un compte</a>
                     <a href="signin.php" class="nav-link">Mot de passe oublié ?</a>
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