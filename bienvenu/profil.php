<?php
session_start();
include("database.php");
 if(!isset($_SESSION['id'])){
     header("location:login.php");
 }
     
      if(isset($_POST['valid'])){
          $insertPub=$db->prepare('INSERT INTO pub(content,id_user,img,createdAt) VALUES(?,?,?,CURDATE())');
          $insertPub=$insertPub->execute(array($_POST['content'],$_SESSION['id'],NULL));

      }
      if(isset($_POST['valide']))
      {
          if(isset($_POST['nom']) AND !empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['email']) )
      { 

      if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])){
          $temps_actuel = date("U");
          $taillemax = 2097152*10;
          $extentionsValides = array('jpg', 'jpeg' ,'gif' , 'png','jfif');
          if($_FILES['avatar']['size']<= $taillemax){
      
             $extentionUpload= strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
              if(in_array($extentionUpload,$extentionsValides)){ 
                  $chemin ='img/'.$temps_actuel.".".$extentionUpload;
                  $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'],$chemin);
                  if($resultat){
                    $nom=htmlspecialchars($_POST['nom']);
                    $prenom=htmlspecialchars($_POST['prenom']);
                    $email=htmlspecialchars($_POST['email']);
                    $req=$db->prepare('UPDATE user SET nom=?,prenom=?,email=?,image=? WHERE id=?');
                    $req=$req->execute(array($nom,$prenom,$email,$temps_actuel.".".$extentionUpload,$_SESSION['id']));              
                   $content="a changé sa photo de profil ";
                    $pub=$db->prepare('INSERT INTO pub(content,id_user,img,createdAt) VALUES(?,?,?,CURDATE())');
                    $pub=$pub->execute(array($content,$_SESSION['id'],$temps_actuel.".".$extentionUpload));              
                  
                    $succes="Votre article est modifier avec succès";
                  }else{
                      $error='Il ya un erreur pendant l\'importation de votre photo';
                      
                  }
      
               }else{
                  $error = 'Votre photo n\'est pas autorisé';
                  
              }
         
          }else{
              $error='Votre photo de profil ne doit pas depasser 2mo';
          }
        }else{
          $nom=htmlspecialchars($_POST['nom']);
          $prenom=htmlspecialchars($_POST['prenom']);
          $email=htmlspecialchars($_POST['email']);
          $req=$db->prepare('UPDATE user SET nom=?,prenom=?,email=? WHERE id=?');
          $req=$req->execute(array($nom,$prenom,$email,$_SESSION['id']));              
          $succes="Votre article est modifier avec succès";
      
        }
      }
      else
      {
          $error="Remplir tous les champs";
      }
      }
      $reqt=$db->prepare('SELECT * FROM user WHERE id=?');
      $reqt->execute(array($_SESSION['id']));  
      $user=$reqt->fetch();   
      $verify=$reqt->rowCount();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nebsatan exercices</title>
    <link rel="stylesheet" href="assets/css/nebstan.min.css">
    <link rel="icon" type="image/jpg" sizes="32x32" href="img/1jpg">

    <style>
      .img-user{
        width:100px;
        height: 100px;
      }
      .circle{
          width: 100px;
          height: 100px;
          border-radius: 100%;
          overflow: hidden;
      }
    </style>
    <link href="css/signin.css" rel="stylesheet">
</head>
<body><?php include("nav.php");  ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
        <div class="card border-primary mb-3 w-100 text-center">
  <div class="card-header">Mon profil</div>
 <div class="d-flex flex-column justify-content-center align-items-center">

 <?php if($user['image']!=NULL) {

?><div class="circle bg-dark">
<img src="img/<?=$user['image']?>" alt="" class="d-block user-select-none img-user">
</div>
<?php
} ?>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalDefault">
  <i class="fas fa-camera"></i>  Modifier mon profil
          </button>
          <?php if(isset($error)){

?>
<div class="alert alert-dismissible alert-danger">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <strong>Oh Erreur</strong><?=$error?> and try submitting again.
</div>
<?php } ?>
 </div>
  <div class="card-body">
    <h4 class="card-title"><?=$user['prenom']  ?> <?=$user['nom']  ?></h4>
    <p class="card-text"><?=$user['email']  ?></p>
  </div>
</div>
        </div>
    </div>
</div>
<div class="container">

<div class="row">
<?php
   $pub=$db->prepare('SELECT * FROM pub,user where pub.id_user=user.id AND user.id=? ORDER BY pub.id DESC');
   $pub->execute(array($_SESSION['id'])); 
   $verify=$pub->rowCount();
      if($verify>0){
          while($pub1=$pub->fetch()){
?>
<div class="col-12">
<div class="card border-primary mb-3">
<div class="card-header d-flex">
  <?php if($user['image']!=NULL) {

?>
<div class="circle bg-dark">
<img src="img/<?=$user['image']?>" alt="" class="d-block user-select-none img-user">
</div>
<?php
} ?>    
 <div> <?=$pub1['prenom'] ?> <?=$pub1['nom'] ?> </div></div>
   
  
  <div class="card-body">
    
    <p class="card-text"><?=$pub1['content'] ?></p>
    <?php if($pub1['image']!=NULL) {

?>
<img src="img/<?=$pub1['img']?>" alt="" class="d-block w-100">

<?php
} ?>
  </div>
</div>
</div>
<?php
          }
      }else{
          ?>
          
<div class="card text-white bg-danger mb-3" style="max-width: 20rem;">
  <div class="card-header">Pas de pub</div>
  <div class="card-body">
    <h4 class="card-title">Pas de pub</h4>
    <p class="card-text">Veillez ajouter une publication</p>
  </div>
</div>
          <?php
      }
      
?>
</div>
</div>

<form action="" method="post" enctype="multipart/form-data">      
<div class="modal fade" id="exampleModalDefault" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modifier mon profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
   <input type="file" name="avatar" class="form-control" id="">
   <input type="text" name="nom" placeholder="Nom" value="<?=$user['nom'] ?>" class="form-control">
   <input type="text" name="prenom" placeholder="prenom"  value="<?=$user['prenom'] ?>" class="form-control">
   <input type="text" name="email" placeholder="Email"  value="<?=$user['email'] ?>" class="form-control">
  
      </div>
      <div class="modal-footer">
      <button class="btn btn-primary"  type="submit" name="valide">Modifier</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
            </div>
        </div>
    </div>
    </form>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/signin.js"></script>
<script>
</script>
<script src="assets/js/jquery-3.6.0.min.js"></script>
</body>
</html>
