<?php
session_start();
require('security.php');
require('database.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Nouveau blog | Modernet soft admin</title>
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">

    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />
    <link rel="stylesheet" href="summernote/dist/summernote.css">

</head>

<body>

    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php include('nav.php');    ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->

            <?php include('aside.php');    ?>
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->

            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">

                                <div class="card-body">

                                    <h4 class="card-title">Nos blog</h4>
                                   <div class="row">
                                    
                <?php
                $blogs=$db->query('SELECT * FROM blogs');
                $nblogs=$blogs->rowCount();
                if($nblogs>0){
                    while($blog=$blogs->fetch()){
                       ?>
                        <div class="col-md-4 wow slideInUp" data-wow-delay="0.1s">
                            <div class="blog-item bg-light rounded overflow-hidden">
                                <div class="blog-img position-relative overflow-hidden">
                                    <img class="img-fluid" src="images/<?=$blog['image_descriptive']  ?>" alt="">
                                     </div>
                                <div class="p-4">
                                    <div class="d-flex mb-3">
                                        <small class="me-3"><i class="far fa-user text-primary me-2"></i>Modernet soft</small>
                                        <small><i class="far fa-calendar-alt text-primary me-2"></i><?=$blog['createdAt']  ?></small>
                                    </div>
                                    <h4 class="mb-3"><?=$blog['title']  ?></h4>
                                    <a class="text-uppercase" href="/blog-detail.php?id_blog=<?=$blog['id_blog']  ?>">Read More <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                       
                       <?php 
                    }
                }
                ?>
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>




                </div>

            </div>
        </div>
    </div>
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <script src="vendors/progressbar.js/progressbar.min.js"></script>
    <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="js/dashboard.js"></script>
    <script src="js/file-upload.js"></script>


</body>

</html>