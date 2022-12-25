<?php
session_start();
include("database.php");
 if(!isset($_SESSION['id'])){
     header("location:login.php");
 }
      $reqt=$db->prepare('SELECT * FROM User WHERE id=?');
      $reqt->execute(array($_SESSION['id']));  
      $user=$reqt->fetch();   
      $verify=$reqt->rowCount();
      if(isset($_POST['valid'])){
        $content=htmlspecialchars($_POST['content']);
          $insertPub=$db->prepare('INSERT INTO pub(content,id_user,img,createdAt) VALUES(?,?,?,CURDATE())');
          $insertPub=$insertPub->execute(array($content,$_SESSION['id'],NULL));

      }
      




      if(isset($_POST['valide']))
{
    if(isset($_POST['content']) )
{ 
  if(empty($_POST['content'])){
    $_POST['content']=' ';
  }
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
              $content=htmlspecialchars($_POST['content']);
                $req=$db->prepare('INSERT INTO pub(content,id_user,img,createdAt) VALUES(?,?,?,CURDATE())');
                $req=$req->execute(array($content,$_SESSION['id'],$temps_actuel.".".$extentionUpload));              
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nebsatan exercices</title>
    <link rel="stylesheet" href="assets/css/nebstan.min.css">
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    <link rel="icon" type="image/jpg" sizes="32x32" href="img/1.jpg">

    
    <style>
      .circle{
          width: 50px;
          height: 50px;
          border-radius: 100%;
          overflow: hidden;
      }
      .img-user{
        width:50px;
        height: 50px;
      }
      .logo{
        width: 40px;
        height: 40px;
        border-top-left-radius:15px;
        border-bottom-right-radius: 5px;
      }
    </style>
    <link href="css/signin.css" rel="stylesheet">
</head>
<body>
<?php include("nav.php");  ?>

<form action="" method="post">
<div class="container mt-5">
   <div class="row">
       <div class="col-12">
       <div class="card text-white bg-secondary mb-3 w-100">
  <div class="card-header d-flex justify-content-between p-0"><span>Publier</span> <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalDefault">
  <i class="fas fa-camera"></i>  Publier avec photo
          </button> </div>
  <div class="card-body">
  <div class="input-group mb-3">
  <textarea class="form-control" name="content" required placeholder="Votre publication" rows="3"></textarea>
      <button class="btn btn-primary"  type="submit" name="valid">Publier</button>
    </div>
</div>
</div>
       </div>
   </div>
</div>
</form>
<div class="container">

<div class="row">
<?php
   $pub=$db->query('SELECT * FROM pub,user where pub.id_user=user.id ORDER BY pub.id DESC');
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
 <div> <?=$pub1['prenom'] ?> <?=$pub1['nom'] ?></div></div>
   
  
  <div class="card-body">
    
    <p class="card-text"><?=$pub1['content'] ?></p>
    <?php if($pub1['img']!=NULL) {

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
                    <h5 class="modal-title" id="exampleModalLabel">Publier avec vos amis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
          <input type="file" name="avatar" class="form-control" id="">
      
  <textarea class="form-control" name="content"  placeholder="Votre publication" rows="3"></textarea>
      
 
      </div>
      <div class="modal-footer">
      <button class="btn btn-primary"  type="submit" name="valide">Publier</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
            </div>
        </div>
    </div>
    </form>
    <?php if(isset($error)){

?>
<div class="alert alert-dismissible alert-danger">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <strong>Oh Erreur</strong><?=$error?> and try submitting again.
</div>
<?php } ?>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/signin.js"></script>
<script>
</script>
<script src="assets/js/jquery-3.6.0.min.js"></script>
</body>
</html>
