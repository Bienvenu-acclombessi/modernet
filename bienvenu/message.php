<?php
session_start();
include("database.php");
 if(!isset($_SESSION['id'])){
     header("location:login.php");
 }
 if(!isset($_GET['id'])){
    header("location:index.php");
}
      $reqt=$db->prepare('SELECT * FROM User WHERE id=?');
      $reqt->execute(array($_SESSION['id']));  
      $user=$reqt->fetch();   
      $verify=$reqt->rowCount();
      if(isset($_POST['valid'])){
        $messaget=htmlspecialchars($_POST['message']);
        $insertMessage=$db->prepare('INSERT INTO messagesn(message,id_exp,id_dest,img,createdAt) VALUES(?,?,?,?,CURDATE())');
        $insertMessage=$insertMessage->execute(array($messaget,$_SESSION['id'],$_GET['id'],NULL));              
        $del=$db->prepare('DELETE  FROM messagesv WHERE (id_exp=? AND id_dest=?) OR (id_exp=? AND id_dest=?)');
         $del->execute(array($_SESSION['id'],$_GET['id'],$_GET['id'],$_SESSION['id']));
         $me=$db->prepare('INSERT INTO messagesv(message,id_exp,id_dest,createdAt) VALUES(?,?,?,CURDATE())');
          $me=$me->execute(array($messaget,$_SESSION['id'],$_GET['id']));              
            
        header("location:#fin");
      }
      




      if(isset($_POST['valide']))
{
    if(isset($_POST['message']) )
{ 
  if(empty($_POST['message'])){
    $_POST['message']=' ';
    $messaget=$_POST['message'];
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
                $messaget=htmlspecialchars($_POST['message']);
                $req=$db->prepare('INSERT INTO messagesn(message,id_exp,id_dest,img,createdAt) VALUES(?,?,?,?,CURDATE())');
                $req=$req->execute(array($messaget,$_SESSION['id'],$_GET['id'],$temps_actuel.".".$extentionUpload));              
                $del=$db->prepare('DELETE  FROM messagesv WHERE (id_exp=? AND id_dest=?) OR (id_exp=? AND id_dest=?)');
                $del->execute(array($_SESSION['id'],$_GET['id'],$_GET['id'],$_SESSION['id']));
                $me=$db->prepare('INSERT INTO messagesv(message,id_exp,id_dest,createdAt) VALUES(?,?,?,CURDATE())');
                $me=$me->execute(array('A envoyer une image',$_SESSION['id'],$_GET['id']));              
            
                $succes="Votre article est modifier avec succès";
                header("location:#fin");
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
$user_ami=$db->prepare('SELECT * FROM user WHERE id=?');
$user_ami->execute(array($_GET['id']));     
$verifUser=$user_ami->rowCount();
$user_ami=$user_ami->fetch();
if($verifUser<0){
    header('location:index.php');
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
      .user-message{
          float: right;
          margin-bottom: 100px;
      }
    </style>
    <link href="css/signin.css" rel="stylesheet">
</head>
<body>
<?php include("nav.php");  ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-9">
         
        <div class="card border-primary mb-3">
      <div class="card-header d-flex">
      <?php if($user_ami['image']!=NULL) {

             ?>
      <div class="circle bg-dark">
       <img src="img/<?=$user_ami['image']?>" alt="" class="d-block user-select-none img-user">
</div>
<?php
} ?>    
 <div> <?=$user_ami['prenom'] ?> <?=$user_ami['nom'] ?> </div></div>
   
  <div class="card-body">
      <p>Bienvenue sur nebstan</p><br>
    <!-- Corp du message-->
      <div id="actual">
      <?php
  $messages=$db->prepare('SELECT * FROM messagesn WHERE (id_exp=? AND id_dest=?) OR (id_exp=? AND id_dest=?) ORDER BY id ASC  ');
  $messages->execute(array($_SESSION['id'],$_GET['id'],$_GET['id'],$_SESSION['id']));
  $nombreMessage=$messages->rowCount();
  if($nombreMessage>0){
    while($message=$messages->fetch()){
    ?>
      
             <?php if($message['id_exp']==$_SESSION['id']){ ?>

         <div class="row">
             <div class="col-6"></div>
             <div class="col-6">
             <div class="btn btn-primary user-message mb-3 overflow-hidden"><?=$message['message']?>
           <br>  <?php if($message['img']!=NULL) {?>
          <img src="img/<?=$message['img']?>" alt="" class="w-100">
          <?php } ?>
           </div>
             </div>
         </div>
         
        <?php } else {  ?>
       <div class="row">
           <div class="col-6">
           <div class="btn btn-light border-primary mb-2 overflow-hidden"><?=$message['message']?> <br>
        <?php if($message['img']!=NULL) {?>
        <img src="img/<?=$message['img']?>" alt="" class="w-100">
        <?php } ?></div>
           </div>
           <div class="col-6"></div>
       </div>
        <?php  } ?>


      <?php
    }
  }
  ?>
      </div>
      <div id="fin"></div>
    <form action="" method="post" class="bg-secondary mt-1 py-1">
    <div class="input-group mb-3">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalDefault">
  <i class="fas fa-camera"></i> 
          </button> <textarea class="form-control" name="message" required placeholder="Votre message ..." rows="3"></textarea>
      <button class="btn btn-primary"  type="submit" name="valid"><i class="fas fa-paper-plane"></i> </button>
    </div>
    </form>
  </div>
</div>
</div>
      
        <div class="col-md-3">
        <div class="card border-primary mb-3 w-100 text-center">
  <div class="card-header">Mon ami</div>
 <div class="d-flex flex-column justify-content-center align-items-center">

 <?php if($user_ami['image']!=NULL) {

?><div class="circle bg-dark">
<img src="img/<?=$user_ami['image']?>" alt="" class="d-block user-select-none img-user">
</div>
<?php
} ?>

          <?php if(isset($error)){

?>
<div class="alert alert-dismissible alert-danger">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <strong>Oh Erreur</strong><?=$error?> and try submitting again.
</div>
<?php } ?>
 </div>
  <div class="card-body">
    <h4 class="card-title"><?=$user_ami['prenom']  ?> <?=$user_ami['nom']  ?></h4>
    <p class="card-text"><?=$user_ami['email']  ?></p>
  </div>
</div>
        
        </div>
    </div>
</div>
<form action="" method="post" enctype="multipart/form-data">
        
<div class="modal fade" id="exampleModalDefault" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Choisir un fichier image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
          <input type="file" name="avatar" class="form-control" id="">
      
  <textarea class="form-control" name="message"  placeholder="Votre message" rows="3"></textarea>
      
 
      </div>
      <div class="modal-footer">
      <button class="btn btn-primary"  type="submit" name="valide">Envoyer</button>
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
<script>
    
setInterval('load_messages()',1000);
function load_messages(){
    $('#actual').load('message_actual.php?id=<?=$_GET['id']?>#fin');
}
</script>
</body>
</html>
