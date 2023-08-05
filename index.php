<?php
session_start();
require('admin/database.php');

?>

<?php
if(isset($_POST['valid'])){
    if(isset($_POST['nom'],$_POST['email'],$_POST['service'],$_POST['message'])AND !empty(trim($_POST['nom'])) AND !empty(trim($_POST['email']))  AND !empty(trim($_POST['service'])) AND !empty(trim($_POST['message'])) ){
        $nom = htmlspecialchars($_POST['nom']);
        $email = htmlspecialchars($_POST['email']);
        $service = htmlspecialchars($_POST['service']);
        $message = htmlspecialchars($_POST['message']);
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $from = "contact@modernetsoft.com";
        $to = $_POST['email'];
        $header = "MIME-Version: 1.0\r\n";
        $header .= 'From:"Modernet soft"<contact@modernetsoft.com>' . "\n";
        $header .= 'Content-Type:text/html; charset="utf-8"' . "\n";
        $header .= 'Content-Transfer-Encoding: 8bit';
        $subject = "[Modernet Soft ] Devis";
        $message = '
<html>
  <body>
      <div>
      <h3>Nom</h3>
      <p>'.$nom.'</p>
      </div>
      
      <div>
      <h3>Email</h3>
      <p>'.$email.'</p>
      </div>
      
      <div>
      <h3>service</h3>
      <p>'.$service.'</p>
      </div>
      
      <div>
      <h3>Message</h3>
      <p>'.$message.'</p>
      </div>
      <div>
       <h3>Modernet soft</h3>
          <p>
          Pour une generation numerique nouvelle
          </p>
      </div>
  </body>
</html>
';
       
        mail($to, $subject, $message, $header);
        
            $to = "bienvenuacclombessi8@gmail.com";
            mail($to, $subject, $message, $header);
                $success = "Message envoyé avec success  ";
    }else{
        $error = "Veuillez remplir tous les champs";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Modernet Accueil</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
   <!-- Optimisation-->
   <link rel="canonical" href="https://modernetsoft.com/">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
  <?php
  include('nav.php');

?>

        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown">Conceptions & Innovations</h5>
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn">Solutions Créatives & Innovantes</h1>
                            <a href="quote.php" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Devis Gratuit</a>
                            <a href="/contact.php" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Contactez-nous</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown">Conceptions & Innovations</h5>
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn">Solutions Créatives & Innovantes</h1>
                            <a href="quote.php" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Devis Gratuit</a>
                            <a href="/contact.php" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Contactez-nous</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Navbar & Carousel End -->


    <!-- Full Screen Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: rgba(9, 30, 62, .7);">
                <div class="modal-header border-0">
                    <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="input-group" style="max-width: 600px;">
                        <input type="text" class="form-control bg-transparent border-primary p-3" placeholder="Type search keyword">
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Full Screen Search End -->


    <!-- Facts Start -->
    <div class="container-fluid facts py-5 pt-lg-0">
        <div class="container py-5 pt-lg-0">
            <div class="row gx-0">
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.1s">
                    <div class="bg-primary shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                        <div class="bg-white d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                            <i class="fa fa-users text-primary"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-white mb-0">Avis des Clients</h5>
                            <h1 class="text-white mb-0" data-toggle="counter-up">10</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.3s">
                    <div class="bg-light shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                            <i class="fa fa-check text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-primary mb-0">Projets Réalisés</h5>
                            <h1 class="mb-0" data-toggle="counter-up">15</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.6s">
                    <div class="bg-primary shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                        <div class="bg-white d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                            <i class="fa fa-award text-primary"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-white mb-0">Années d'expérience</h5>
                            <h1 class="text-white mb-0" data-toggle="counter-up">3</h1>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <!-- Facts Start -->


    <!-- About Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title position-relative pb-3 mb-5">
                        <h5 class="fw-bold text-primary text-uppercase">À propos de nous</h5>
                        <h1 class="mb-0">Les Meilleures solutions de dévoppement avec plusieurs années d'expérience</h1>
                    </div>
                    <p class="mb-4">Avec notre équipe expérimentée, nous mettons nos compétences au service de nos clients.
                      Que ce soit pour le développement d'applications web ou mobile, audit SEO et amélioration de référencement SEO, design et graphisme, nous proposons à nos clients une stratégie 
                      leur permettant d'atteindre leurs objectifs.
                    </p>
                    <div class="row g-0 mb-3">
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.2s">
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Travail de Qualité</h5>
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Équipe Professionnelle</h5>
                        </div>
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.4s">
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>24/7 Support</h5>
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Tarifs Intéressants</h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4 wow fadeIn" data-wow-delay="0.6s">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="mb-2">Appelez-nous pour plus d'informations</h5>
                            <h4 class="text-primary mb-0">+229 94513830</h4>
                        </div>
                    </div>
                    <a href="quote.php" class="btn btn-primary py-3 px-5 mt-3 wow zoomIn" data-wow-delay="0.9s">Demandez un Devis gratuit</a>
                </div>
                <div class="col-lg-5" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" src="img/about.jpg" style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


  


    <!-- Service Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Nos Services</h5>
                <h1 class="mb-0">Des Solutions Digitales Pour La Réalisation De Vos Objectifs</h1>
            </div>
            <div class="row g-5">
               
           
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.9s">
                    <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fa fa-code text-white"></i>
                        </div>
                        <h4 class="mb-3">Développement Web</h4>
                        <p class="m-0">Nous développons des sites web de haute qualité, adaptés aux utilisateurs 
                            et optimisés dans tous les langages de programmation</p>
                        <a class="btn btn-lg btn-primary rounded" href="/service.php">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                    <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fab fa-android text-white"></i>
                        </div>
                        <h4 class="mb-3">Développement mobile</h4>
                        <p class="m-0">Nous développons des applications mobile pour nos clients quel que soit leur domaine d'activité. 
                            Que ce soit des applications IOS ou Android, nous vous permettons de vous rapprocher de vos utilisateurs.
                        </p>
                        <a class="btn btn-lg btn-primary rounded" href="/service.php">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.6s">
                    <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fa fa-search text-white"></i>
                        </div>
                        <h4 class="mb-3">Optimisation SEO</h4>
                        <p class="m-0">Nous aidons nos clients propriétaires de site internet à améliorer leur positionnement au niveau des
                            moteurs de recherche et leur visibilité sur le net.
                        </p>
                        <a class="btn btn-lg btn-primary rounded" href="/service.php">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.6s">
                    <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fa fa-chart-pie text-white"></i>
                        </div>
                        <h4 class="mb-3">Design & Graphisme</h4>
                        <p class="m-0">Nous aidons nos clients à avoir une identité visuelle impeccable</p>
                        <a class="btn btn-lg btn-primary rounded" href="/service.php">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
    <!-- Service End -->


   

    <!-- Quote Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title position-relative pb-3 mb-5">
                        <h5 class="fw-bold text-primary text-uppercase">Demande de Devis</h5>
                        <h1 class="mb-0">Besoin de Devis? Sentez-vous libre de nous contacter</h1>
                    </div>
                    <div class="row gx-3">
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.2s">
                            <h5 class="mb-4"><i class="fa fa-reply text-primary me-3"></i>Réponse sous 24h</h5>
                        </div>
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.4s">
                            <h5 class="mb-4"><i class="fa fa-phone-alt text-primary me-3"></i>24 hrs support téléphonique</h5>
                        </div>
                    </div>
                    <p class="mb-4">Vous pouvez nous contacter à tout moment pour discuter de votre projet. Ensemble nous trouverons 
                        la solution idéale. 
                    </p>
                    <div class="d-flex align-items-center mt-2 wow zoomIn" data-wow-delay="0.6s">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="mb-2">Appelez-nous</h5>
                            <h4 class="text-primary mb-0">+22994513830</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="bg-primary rounded h-100 d-flex align-items-center p-5 wow zoomIn" data-wow-delay="0.9s">
                    <form action="" method="POST">
                            <div class="row g-3">
                                <div class="col-xl-12">
                                    <input type="text" name="nom" class="form-control bg-light border-0" placeholder="Votre nom" style="height: 55px;">
                                </div>
                                <div class="col-12">
                                    <input type="email" name="email" class="form-control bg-light border-0" placeholder="Votre mail" style="height: 55px;">
                                </div>
                                <div class="col-12">
                                    <select class="form-select bg-light border-0" name="service" style="height: 55px;">
                                        <option selected>Choisissez le service</option>
                                        <option value="1">Développement Web</option>
                                        <option value="2">Développement Mobile</option>
                                        <option value="3">Optimisation SEO</option>
                                        <option value="3">Design & Graphisme</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control bg-light border-0" name="message" rows="3" placeholder="Message"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-dark w-100 py-3" name="valid" type="submit">Demande de Devis</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quote End -->



  <?php include('team-container.php')  ?>
   

    <!-- Blog Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Blog</h5>
                <h1 class="mb-0">Articles Récemment Publiés</h1>
            </div>
            <div class="row g-5">
               
                <?php
                $blogs=$db->query('SELECT * FROM blogs LIMIT 3');
                $nblogs=$blogs->rowCount();
                if($nblogs>0){
                    while($blog=$blogs->fetch()){
                       ?>
                        <div class="col-md-4 wow slideInUp" data-wow-delay="0.1s">
                            <div class="blog-item bg-light rounded overflow-hidden">
                                <div class="blog-img position-relative overflow-hidden">
                                    <img class="img-fluid" src="admin/images/<?=$blog['image_descriptive']  ?>" alt="">
                                     </div>
                                <div class="p-4">
                                    <div class="d-flex mb-3">
                                        <small class="me-3"><i class="far fa-user text-primary me-2"></i>Modernet soft</small>
                                        <small><i class="far fa-calendar-alt text-primary me-2"></i><?=$blog['createdAt']  ?></small>
                                    </div>
                                    <h4 class="mb-3"><?=$blog['title']  ?></h4>
                                    <a class="text-uppercase" href="blog-detail.php?id_blog=<?=$blog['id_blog']  ?>">Lireplus <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                       
                       <?php 
                    }
                }
                ?>
                <div class="col-md-4">
                <a class="text-uppercase text-end mt-1" href="blog.php">Voir plus <i class="bi bi-arrow-right"></i></a>
            
                </div>
            </div>
                                
        </div>
    </div>
    <!-- Blog Start -->


    <!-- Vendor Start -->
    
    <!-- Vendor End -->

   <?php include('footer.php') ?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>