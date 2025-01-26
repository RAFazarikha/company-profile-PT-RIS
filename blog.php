<?php
    include 'config/database.php';
    require 'controllers/visitor_counter.php';
?>


<!DOCTYPE html>
<html lang="en">
    <?php include 'component/head.php'; ?>

    <body>
        <div class="wrapper">
            <!-- Top Bar Start -->
            <?php include 'component/top-bar.php'; ?>
            <!-- Top Bar End -->

            <!-- Nav Bar Start -->
            <?php include 'component/nav.php'; ?>
            <!-- Nav Bar End -->
            
            
            <!-- Page Header Start -->
            <div class="page-header">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2>Our Blog</h2>
                        </div>
                        <div class="col-12">
                            <a href="">Home</a>
                            <a href="">Our Blog</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page Header End -->


            <!-- Blog Start -->
            <div class="blog">
                <div class="container">
                    <div class="section-header text-center">
                        <p>Latest Blog</p>
                        <h2>Latest From Our Blog</h2>
                    </div>
                    <div class="row blog-page">
                        <?php
                            $query = $db->query("SELECT * FROM artikel ORDER BY create_at DESC");

                            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="blog-item">
                                <div class="blog-img">
                                    <img src="images/<?php echo htmlspecialchars($row['namaGambar']) ?>" alt="Image">
                                </div>
                                <div class="blog-title">
                                    <h3><?php echo htmlspecialchars($row['title']) ?></h3>
                                    <a class="btn" href="single-blog.php?id=<?php echo htmlspecialchars($row['id']) ?>">+</a>
                                </div>
                                <div class="blog-meta">
                                    <p>By <?php echo htmlspecialchars($row['namaAuthor']); ?></p>
                                    <p>At <?php echo date('d F Y', strtotime($row['create_at'])); ?></p>
                                </div>
                                <div class="blog-text text-truncate">
                                    <?php echo htmlspecialchars($row['content']); ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul> 
                        </div>
                    </div>
                </div>
            </div>
            <!-- Blog End -->


            <!-- Footer Start -->
            <?php include 'component/footer.php'; ?>
            <!-- Footer End -->

            <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
        </div>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/wow/wow.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/isotope/isotope.pkgd.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/counterup/counterup.min.js"></script>
        <script src="lib/slick/slick.min.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>
