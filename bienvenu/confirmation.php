<?php
include("database.php");
if(!isset($_GET['id']))
{
    header("location:index.php");
}
$update=$db->prepare('UPDATE user SET token=? WHERE id=?');
$update->execute(array(1,$_GET['id']));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nebstan votre confirmation</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <h1>Votre compte est confirmé </h1>
    <div class="card text-white bg-success mb-3" style="max-width: 20rem;">
  <div class="card-header">Activation</div>
  <img src="expashoping.fr/bienvenu/img/1.jpg"  class="w-100" alt="">
  <div class="card-body">
    <h4 class="card-title">Votre compte est activé</h4>
    <p class="card-text"><a href="login.php">se connecter</a></p>
  </div>
</div>
</body>
</html>