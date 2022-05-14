<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a href="index.php" class="navbar-brand">Blog App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNavbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse text-center text-md-left" id="myNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                <li class="nav-item">
                    <a href="blogs.php" class="nav-link">Blogs</a>
                </li>
                <?php if (isAdmin()): ?>
                    <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Admin Panels
                </a>
                <ul class="dropdown-menu bg-dark shadow-lg" aria-labelledby="navbarDropdown">
                    <li class="dropdown-item">
                        <a href="admin-blogs.php" class="nav-link">Admin Blogs</a>
                    </li>
                    <li class="dropdown-item">
                        <a href="admin-categories.php" class="nav-link">Admin Categories</a>
                    </li>
                    <li class="dropdown-item">
                        <a href="admin-comments.php" class="nav-link">Admin Comments</a>
                    </li>
                    <li class="dropdown-item">
                        <a href="admin-slider.php" class="nav-link">Admin Slider</a>
                    </li>
                </ul>
                </li>
                    
                <?php endif; ?> 
              
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">

                <?php if (isLoggedin()): ?>
                    <li class="nav-item">
                        <a href="profile.php" class="nav-link">Hoş geldiniz, <?php echo $_SESSION["username"]?></a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">Çıkış Yap</a>
                    </li>
                    
                
                <?php else: ?>
                
                    <li class="nav-item">
                        <a href="login.php" class="nav-link">Giriş Yap</a>
                    </li>
                    <li class="nav-item">
                        <a href="register.php" class="nav-link">Kayıt Ol</a>
                    </li>

                <?php endif; ?>       


            </ul>
            <form class="d-flex" action="blogs.php" method="GET">
                <input type="text" name="q" class="form-control me-1 " placeholder="Search">
                <button class="btn btn-outline-light rounded-pill">Search</button>
            </form>
        </div>
    </div>
</nav>