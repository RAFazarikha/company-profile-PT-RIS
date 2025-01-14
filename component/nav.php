<?php
// Mendapatkan nama file aktif
$current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="nav-bar">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
            <a href="#" class="navbar-brand">MENU</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav mr-auto">
                    <a href="index.php" class="nav-item nav-link <?= ($current_page == 'index.php') ? 'active' : '' ?>">Home</a>
                    <a href="about.php" class="nav-item nav-link <?= ($current_page == 'about.php') ? 'active' : '' ?>">About</a>
                    <a href="product.php" class="nav-item nav-link <?= ($current_page == 'product.php') ? 'active' : '' ?>">Product</a>
                    <a href="team.php" class="nav-item nav-link <?= ($current_page == 'team.php') ? 'active' : '' ?>">Team</a>
                    <!-- <a href="portfolio.php" class="nav-item nav-link <?= ($current_page == 'portfolio.php') ? 'active' : '' ?>">Project</a> -->
                    <!-- <div class="nav-item dropdown <?= in_array($current_page, ['blog.php', 'single.php']) ? 'active' : '' ?>">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu">
                            <a href="blog.php" class="dropdown-item <?= ($current_page == 'blog.php') ? 'active' : '' ?>">Blog Page</a>
                            <a href="single.php" class="dropdown-item <?= ($current_page == 'single.php') ? 'active' : '' ?>">Single Page</a>
                        </div>
                    </div> -->
                    <a href="contact.php" class="nav-item nav-link <?= ($current_page == 'contact.php') ? 'active' : '' ?>">Contact</a>
                </div>
            </div>
        </nav>
    </div>
</div>