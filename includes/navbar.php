<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="fas fa-building"></i><?php echo SITE_NAME; ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($activePage == 'home') ? 'active' : ''; ?>" href="index.php">
                        <i class="fas fa-home"></i>Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($activePage == 'about') ? 'active' : ''; ?>" href="about.php">
                        <i class="fas fa-info-circle"></i>About
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($activePage == 'services') ? 'active' : ''; ?>" href="services.php">
                        <i class="fas fa-cogs"></i>Services
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($activePage == 'request') ? 'active' : ''; ?>" href="request.php">
                        <i class="fas fa-envelope"></i>Contact
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view_requests.php">
                        <i class="fas fa-lock"></i>Admin
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>