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
    <title>Modernet soft Devis</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

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
  include('nav2.php');
    ?>

        <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
            <div class="row py-5">
                <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-4 text-white animated zoomIn">Quote</h1>
                    <a href="" class="h5 text-white">Accueil</a>
                    <i class="far fa-circle text-white px-2"></i>
                    <a href="" class="h5 text-white">Quote</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Quote Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title position-relative pb-3 mb-5">
                        <h5 class="fw-bold text-primary text-uppercase">Request A Quote</h5>
                        <h1 class="mb-0">Need A Free Quote? Please Feel Free to Contact Us</h1>
                    </div>
                    <div class="row gx-3">
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.2s">
                            <h5 class="mb-4"><i class="fa fa-reply text-primary me-3"></i>Reply within 24 hours</h5>
                        </div>
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.4s">
                            <h5 class="mb-4"><i class="fa fa-phone-alt text-primary me-3"></i>24 hrs telephone support</h5>
                        </div>
                    </div>
                    <p class="mb-4">Eirmod sed tempor lorem ut dolores. Aliquyam sit sadipscing kasd ipsum. Dolor ea et dolore et at sea ea at dolor, justo ipsum duo rebum sea invidunt voluptua. Eos vero eos vero ea et dolore eirmod et. Dolores diam duo invidunt lorem. Elitr ut dolores magna sit. Sea dolore sanctus sed et. Takimata takimata sanctus sed.</p>
                    <div class="d-flex align-items-center mt-2 wow zoomIn" data-wow-delay="0.6s">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="mb-2">Call to ask any question</h5>
                            <h4 class="text-primary mb-0">+0229 94513830</h4>
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



    <?php include('footer.php') ?>    <!-- JavaScript Libraries -->
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