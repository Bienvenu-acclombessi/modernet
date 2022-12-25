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
<form action="" class="mt-5" method="post">
<div class="container mt-5">
   <div class="row">
       <div class="col-12">
       <div class="card text-white bg-secondary mb-3 w-100">
  <div class="card-header d-flex justify-content-between p-0"><span>Messages</span> 
 
</div>
</div>
       </div>
   </div>
</div>

<div class="container">

<div class="row">
<?php
  
  $messages=$db->prepare('SELECT * FROM messagesv WHERE id_exp=? OR id_dest=?  ORDER BY id DESC  ');
  $messages->execute(array($_SESSION['id'],$_SESSION['id']));
  $verify=$messages->rowCount();   
  if($verify>0){
          while($pub1=$messages->fetch()){
            if($pub1['id_exp']==$_SESSION['id']){
              $id=$pub1['id_dest'];
              
            }else{
              $id=$pub1['id_exp'];
            }
            $ami=$db->prepare('SELECT * FROM user WHERE id=?');
            $ami->execute(array($id));
            $amie=$ami->fetch();
?>
<a href="message.php?id=<?=$id?>#fin" class="nav-link">
<div class="col-12">
<div class="card border-primary mb-3">
<div class="card-header d-flex">
  <?php if($amie['image']!=NULL) {

?>
<div class="circle bg-dark">
<img src="img/<?=$amie['image']?>" alt="" class="d-block user-select-none img-user">
</div>
<?php
} ?>    
 <div class="d-flex flex-column"> <span><?=$amie['prenom'] ?> <?=$amie['nom'] ?></span><p> <?=substr($pub1['message'],0,20)?><p></div>
</div>
</div>
</div>
</a>
<?php
          }
      }else{
          ?>
          
<div class="card text-white bg-danger mb-3" style="max-width: 20rem;">
  <div class="card-header">Pas de messages</div>
  <div class="card-body">
    <h4 class="card-title">Desolé</h4>
    <p class="card-text">Veillez ajouter des amis</p>
  </div>
</div>
          <?php
      }
      
?>
</div>
</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/signin.js"></script>
<script>
</script>
<script src="assets/js/jquery-3.6.0.min.js"></script>
</body>
</html>
