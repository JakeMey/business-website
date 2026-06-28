<?php
include 'config.php';
$pageTitle = "Home";
$activePage = "home";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> - <?php echo $pageTitle; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1>Welcome to <?php echo SITE_NAME; ?></h1>
                    <p class="lead">We provide exceptional business solutions tailored to your needs.</p>
                    <div>
                        <a href="services.php" class="btn btn-light btn-lg me-2">Our Services</a>
                        <a href="request.php" class="btn btn-outline-light btn-lg">Get Started</a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <i class="fas fa-building hero-icon"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3">
                    <div class="stat-card">
                        <i class="fas fa-users"></i>
                        <div class="counter" data-target="100">0</div>
                        <p>Happy Customers</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <i class="fas fa-project-diagram"></i>
                        <div class="counter" data-target="50">0</div>
                        <p>Projects Completed</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <i class="fas fa-trophy"></i>
                        <div class="counter" data-target="15">0</div>
                        <p>Awards Won</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <i class="fas fa-clock"></i>
                        <div class="counter" data-target="5">0</div>
                        <p>Years Experience</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <h2 class="text-center">Why Choose Us</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-rocket"></i>
                        <h4>Fast & Reliable</h4>
                        <p>We deliver high-quality solutions quickly without compromising on quality.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-users-cog"></i>
                        <h4>Expert Team</h4>
                        <p>Our skilled professionals bring years of experience to every project.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-headset"></i>
                        <h4>24/7 Support</h4>
                        <p>We're always here to help with dedicated customer support around the clock.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>