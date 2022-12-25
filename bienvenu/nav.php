<style>
    .logo{
        width: 40px;
        height: 40px;
        border-top-left-radius:15px;
        border-bottom-right-radius: 5px;
      }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="img/1.jpg" alt="logo" class="logo"> Nebstan</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor03">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="index.php">Accueil
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="amis.php">Amis</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profil.php">Profil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="messages.php">Messages</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="deconnection.php">Deconnexion <?=$user['prenom']?></a>
        </li>
       
      </ul>
      
    </div>
  </div>
</nav>
<div class="mt-5 visibility-hidden " >juste l'espace de haut </div>