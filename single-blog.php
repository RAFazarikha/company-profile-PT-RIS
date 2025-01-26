<?php
    include 'config/database.php';
    include 'controllers/keyword.php';
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

        <?php
            try {
                $id = $_GET['id'];
                $query = $db->prepare("SELECT * FROM artikel WHERE id = :id");
                $query->bindParam(':id', $id, PDO::PARAM_INT);
                $query->execute();

                if ($query->rowCount() > 0) {
                    $row = $query->fetch(PDO::FETCH_ASSOC);
        ?> 

            <!-- Page Header Start -->
            <div class="page-header">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                        </div>
                        <div class="col-12">
                            <a href="index.php">Home</a>
                            <a href=""><?php echo htmlspecialchars($row['title']); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page Header End -->


            <!-- Single Post Start-->
            <div class="single">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="single-content wow fadeInUp">
                                <img src="images/<?php echo htmlspecialchars($row['namaGambar']); ?>" />
                                <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                                <p>
                                    <?php echo htmlspecialchars($row['content']); ?>
                                </p>
                            </div>
                            <div class="single-tags wow fadeInUp">
                                <?php
                                    $keywords = generateKeywords($row['content']);
                                    $keywords = explode(', ', $keywords);

                                    foreach ($keywords as $keyword) {
                                ?>
                                <a href=""><?php echo htmlspecialchars($keyword); ?></a>
                                <?php } ?>
                            </div>
                            <div class="single-bio wow fadeInUp">
                                <div class="single-bio-text">
                                    <h3><?php echo htmlspecialchars($row['namaAuthor']); ?></h3>
                                    <p>
                                        <?php echo htmlspecialchars($row['deskripsiAuthor']); ?>
                                    </p>
                                    <p style="font-style: italic;">
                                        Created At: <?php echo date('d F Y', strtotime($row['create_at'])); ?>
                                    </p>
                                    
                                    <!-- Tombol Love -->
                                    <form action="update-like.php" method="POST">
                                        <button type="submit" name="like" value="<?php echo $row['id']; ?>" class="like-btn">
                                            <i class="fa fa-heart"></i> Like
                                        </button>
                                    </form>

                                    <p>Total Like: <?php echo $row['likes']; ?></p>
                                </div>
                            </div>

                            <?php
                                }
                            } catch (PDOException $e) {
                                echo "Error: " . $e->getMessage();
                            }
                            ?>
                            <div class="single-comment wow fadeInUp">
                                <h2>Comments</h2>
                                <ul class="comment-list">
                                    <?php
                                        try {
                                            $id = $_GET['id'];
                                            $query = $db->prepare("SELECT * FROM coment WHERE idArtikel = :id");
                                            $query->bindParam(':id', $id, PDO::PARAM_INT);
                                            $query->execute();
                            
                                            if ($query->rowCount() > 0) {
                                                $row = $query->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    <li class="comment-item">
                                        <div class="comment-body">
                                            <div class="comment-text">
                                                <h3><a href=""><?php echo htmlspecialchars($row['nama']); ?></a></h3>
                                                <span><?php echo date('d F Y, H:i', strtotime($row['create_at'])); ?></span>
                                                <p>
                                                    <?php echo htmlspecialchars($row['komentar']); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                        } else {
                                            echo "<p>No comments yet.</p>";
                                        }
                                    } catch (PDOException $e) {
                                        echo "Error: " . $e->getMessage();
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="comment-form wow fadeInUp">
                                <h2>Leave a comment</h2>
                                <form action="add-comment.php" method="POST">
                                    <div class="form-group">
                                        <input type="hidden" name="idArtikel" value="<?php echo $_GET['id']; ?>">
                                        <label for="nama">Name *</label>
                                        <input type="text" class="form-control" name="nama" id="nama">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email *</label>
                                        <input type="email" class="form-control" name="email" id="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="komentar">Message *</label>
                                        <textarea id="komentar" cols="30" rows="5" name="komentar" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="submit" class="btn">Post Comment</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="sidebar">
                                <div class="sidebar-widget wow fadeInUp">
                                    <div class="search-widget">
                                        <form>
                                            <input class="form-control" type="text" placeholder="Search Keyword">
                                            <button class="btn"><i class="fa fa-search"></i></button>
                                        </form>
                                    </div>
                                </div>

                                <div class="sidebar-widget wow fadeInUp">
                                    <h2 class="widget-title">Recent Post</h2>
                                    <div class="recent-post">
                                        <?php
                                            $query = $db->query("SELECT * FROM artikel ORDER BY create_at DESC LIMIT 5");

                                            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                        <div class="post-item">
                                            <div class="post-img">
                                                <img src="images/<?php echo htmlspecialchars($row['namaGambar']); ?>" />
                                            </div>
                                            <div class="post-text">
                                                <a href="single-blog.php?id=<?php echo htmlspecialchars($row['id']); ?>"><?php echo htmlspecialchars($row['title']); ?></a>
                                                <div class="post-meta">
                                                    <p>By <?php echo htmlspecialchars($row['namaAuthor']); ?></p>
                                                    <p>In <?php echo date('d F Y', strtotime($row['create_at'])); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="sidebar-widget wow fadeInUp">
                                    <div class="tab-post">
                                        <ul class="nav nav-pills nav-justified">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="pill" href="#popular">Popular</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="pill" href="#latest">Latest</a>
                                            </li>
                                        </ul>

                                        <div class="tab-content">
                                            <div id="popular" class="container tab-pane active">
                                                <?php
                                                    $query = $db->query("SELECT * FROM artikel ORDER BY likes DESC LIMIT 5");

                                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <div class="post-item">
                                                    <div class="post-img">
                                                        <img src="images/<?php echo htmlspecialchars($row['namaGambar']); ?>" />
                                                    </div>
                                                    <div class="post-text">
                                                        <a href="single-blog.php?id=<?php echo htmlspecialchars($row['id']); ?>"><?php echo htmlspecialchars($row['title']); ?></a>
                                                        <div class="post-meta">
                                                            <p>By <?php echo htmlspecialchars($row['namaAuthor']); ?></p>
                                                            <p>In <?php echo date('d F Y', strtotime($row['create_at'])); ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div id="latest" class="container tab-pane fade">
                                                <?php
                                                    $query = $db->query("SELECT * FROM artikel ORDER BY create_at ASC LIMIT 5");

                                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <div class="post-item">
                                                    <div class="post-img">
                                                        <img src="images/<?php echo htmlspecialchars($row['namaGambar']); ?>" />
                                                    </div>
                                                    <div class="post-text">
                                                        <a href="single-blog.php?id=<?php echo htmlspecialchars($row['id']); ?>"><?php echo htmlspecialchars($row['title']); ?></a>
                                                        <div class="post-meta">
                                                            <p>By <?php echo htmlspecialchars($row['namaAuthor']); ?></p>
                                                            <p>In <?php echo date('d F Y', strtotime($row['create_at'])); ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="sidebar-widget wow fadeInUp">
                                    <div class="image-widget">
                                        <a href="#"><img src="img/blog-2.jpg" alt="Image"></a>
                                    </div>
                                </div> -->

                                <!-- <div class="sidebar-widget wow fadeInUp">
                                    <h2 class="widget-title">Categories</h2>
                                    <div class="category-widget">
                                        <ul>
                                            <li><a href="">National</a><span>(98)</span></li>
                                            <li><a href="">International</a><span>(87)</span></li>
                                            <li><a href="">Economics</a><span>(76)</span></li>
                                            <li><a href="">Politics</a><span>(65)</span></li>
                                            <li><a href="">Lifestyle</a><span>(54)</span></li>
                                            <li><a href="">Technology</a><span>(43)</span></li>
                                            <li><a href="">Trades</a><span>(32)</span></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="sidebar-widget wow fadeInUp">
                                    <div class="image-widget">
                                        <a href="#"><img src="img/blog-3.jpg" alt="Image"></a>
                                    </div>
                                </div>

                                <div class="sidebar-widget wow fadeInUp">
                                    <h2 class="widget-title">Tags Cloud</h2>
                                    <div class="tag-widget">
                                        <a href="">National</a>
                                        <a href="">International</a>
                                        <a href="">Economics</a>
                                        <a href="">Politics</a>
                                        <a href="">Lifestyle</a>
                                        <a href="">Technology</a>
                                        <a href="">Trades</a>
                                    </div>
                                </div>

                                <div class="sidebar-widget wow fadeInUp">
                                    <h2 class="widget-title">Text Widget</h2>
                                    <div class="text-widget">
                                        <p>
                                            Lorem ipsum dolor sit amet elit. Integer lorem augue purus mollis sapien, non eros leo in nunc. Donec a nulla vel turpis tempor ac vel justo. In hac platea nec eros. Nunc eu enim non turpis id augue.
                                        </p>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Single Post End-->   


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
