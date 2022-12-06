<?php
session_start();
require('admin/database.php');
if(isset($_GET['id_blog'] )){
$blogs=$db->prepare('SELECT * from blogs where id_blog=?');
$blogs->execute(array($_GET['id_blog']));
$nblog=$blogs->rowCount();
if($nblog>0){
        $blog = $blogs->fetch();
}else{
    header('location: /');
}
}else{
    header('location: /');
}
if(isset($_POST['valid'])){
    if(isset($_POST['nom'],$_POST['email'],$_POST['commentaire']) AND !empty(trim($_POST['nom'])) AND !empty(trim($_POST['email'])) AND !empty(trim($_POST['commentaire']))){
                $req = $db->prepare('INSERT INTO commentaire(nom,email,commentaire,blog,createdAt) VALUES(?,?,?,?,CURDATE())');
                $req = $req->execute(array(htmlspecialchars($_POST['nom']),htmlspecialchars($_POST['email']),htmlspecialchars($_POST['commentaire']),$_GET['id_blog'] ));
                $success = "Blog ajouté avec success";
             
    }else{
        $error = 'Veuillez remplir tous les champs';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?=$blog['title'] ?> | Modernet Soft</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="<?=$blog['title'] ?>" name="keywords">
    <meta content="<?=$blog['description'] ?>" name="description">

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
                    <h1 class="display-4 text-white animated zoomIn"><?=$blog['title'] ?></h1>
                    <a href="" class="h5 text-white">Home</a>
                    <i class="far fa-circle text-white px-2"></i>
                    <a href="" class="h5 text-white">Blog Detail</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    


    <!-- Blog Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-8">
                    <!-- Blog Detail Start -->
                    <div class="mb-5">
                        <img class="img-fluid w-100 rounded mb-5" src="admin/images/<?=$blog['image_descriptive'] ?>" alt="">
                        <h1 class="mb-4"><?=$blog['title'] ?></h1>
                        <p class="text-justify" style="text-align: justify; text-justify:inter-word"  >
                        <?=$blog['description'] ?>
                        </p>
                    </div>
                    <!-- Blog Detail End -->
    
                    <!-- Comment List Start -->
                    <div class="mb-5">
                    <?php
                    $commentaires=$db->prepare('SELECT * FROM commentaire WHERE blog=?');
                    $commentaires->execute(array($_GET['id_blog']));
                    $ncommentaire=$commentaires->rowCount();
                    
                    
                    ?>
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0"><?=$ncommentaire ?> Comments</h3>
                        </div>



                     <?php
                     
                     if($ncommentaire>0){
                        while($commentaire=$commentaires->fetch()){
                            ?>
                            
                        <div class="d-flex mb-4">
                            <img src="img/user.jpg" class="img-fluid rounded" style="width: 45px; height: 45px;">
                            <div class="ps-3">
                                <h6><a href="#"><?=$commentaire['nom']  ?></a> <small><i><?=$commentaire['createdAt']  ?></i></small></h6>
                                <p><?=$commentaire['commentaire']  ?></p>
                            </div>
                        </div>
                            <?php

                        }
                     }
                     
                     ?>
                        
                    </div>
                    <!-- Comment List End -->
    
                    <!-- Comment Form Start -->
                    <div class="bg-light rounded p-5">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">Laisser un commentaire</h3>
                        </div>
                        <form action="" method="POST">
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <input type="text" name="nom" class="form-control bg-white border-0" placeholder="Your Name" style="height: 55px;">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="email" name="email" class="form-control bg-white border-0" placeholder="Your Email" style="height: 55px;">
                                </div>
                                <div class="col-12">
                                    <textarea name="commentaire" class="form-control bg-white border-0" rows="5" placeholder="Comment"></textarea>
                                </div>
                                <div class="col-12">
                                    <button name="valid" class="btn btn-primary w-100 py-3" type="submit">Envoyer ton  commentaire</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Comment Form End -->
                </div>
    
                <!-- Sidebar Start -->
                <div class="col-lg-4">
                    <!-- Search Form Start -->
                    <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                        <div class="input-group">
                            <input type="text" class="form-control p-3" placeholder="Keyword">
                            <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                    <!-- Search Form End -->
    
                    <!-- Category Start -->
                    <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">Categories</h3>
                        </div>
                        <div class="link-animated d-flex flex-column justify-content-start">
                            <a class="h5 fw-semi-bold bg-light rounded py-2 px-3 mb-2" href="#"><i class="bi bi-arrow-right me-2"></i>Web Design</a>
                            <a class="h5 fw-semi-bold bg-light rounded py-2 px-3 mb-2" href="#"><i class="bi bi-arrow-right me-2"></i>Web Development</a>
                            <a class="h5 fw-semi-bold bg-light rounded py-2 px-3 mb-2" href="#"><i class="bi bi-arrow-right me-2"></i>Web Development</a>
                            <a class="h5 fw-semi-bold bg-light rounded py-2 px-3 mb-2" href="#"><i class="bi bi-arrow-right me-2"></i>Keyword Research</a>
                            <a class="h5 fw-semi-bold bg-light rounded py-2 px-3 mb-2" href="#"><i class="bi bi-arrow-right me-2"></i>Email Marketing</a>
                        </div>
                    </div>
                    <!-- Category End -->
    
                    <!-- Recent Post Start -->
                    <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">Recent Post</h3>
                        </div><?php
                $blogs=$db->query('SELECT * FROM blogs');
                $nblogs=$blogs->rowCount();
                if($nblogs>0){
                    while($blog=$blogs->fetch()){
                       ?>
                        <div class="d-flex rounded overflow-hidden mb-3">
                            <img class="img-fluid" src="admin/images/<?=$blog['image_descriptive'] ?>" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                            <a href="blog-detail.php?id_blog=<?=$blog['id_blog']  ?>" class="h5 fw-semi-bold d-flex align-items-center bg-light px-3 mb-0"><?=substr($blog['title'],0,50) ?>
                            </a>
                        </div>
                       
                       <?php 
                    }
                }
                ?>
                    </div>
                    <!-- Recent Post End -->
    
                    <!-- Image Start -->
                    <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                        <img src="img/blog-1.jpg" alt="" class="img-fluid rounded">
                    </div>
                    <!-- Image End -->
    
                    <!-- Tags Start -->
                    <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">Tag Cloud</h3>
                        </div>
                        <div class="d-flex flex-wrap m-n1">
                            <a href="" class="btn btn-light m-1">Design</a>
                            <a href="" class="btn btn-light m-1">Development</a>
                            <a href="" class="btn btn-light m-1">Marketing</a>
                            <a href="" class="btn btn-light m-1">SEO</a>
                            <a href="" class="btn btn-light m-1">Writing</a>
                            <a href="" class="btn btn-light m-1">Consulting</a>
                            <a href="" class="btn btn-light m-1">Design</a>
                            <a href="" class="btn btn-light m-1">Development</a>
                            <a href="" class="btn btn-light m-1">Marketing</a>
                            <a href="" class="btn btn-light m-1">SEO</a>
                            <a href="" class="btn btn-light m-1">Writing</a>
                            <a href="" class="btn btn-light m-1">Consulting</a>
                        </div>
                    </div>
                    <!-- Tags End -->
    
                    <!-- Plain Text Start -->
                    <div class="wow slideInUp" data-wow-delay="0.1s">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">Plain Text</h3>
                        </div>
                        <div class="bg-light text-center" style="padding: 30px;">
                            <p>Vero sea et accusam justo dolor accusam lorem consetetur, dolores sit amet sit dolor clita kasd justo, diam accusam no sea ut tempor magna takimata, amet sit et diam dolor ipsum amet diam</p>
                            <a href="" class="btn btn-primary py-2 px-4">Read More</a>
                        </div>
                    </div>
                    <!-- Plain Text End -->
                </div>
                <!-- Sidebar End -->
            </div>
        </div>
    </div>
    <!-- Blog End -->



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