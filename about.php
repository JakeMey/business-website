<?php
include 'config.php';
$pageTitle = "About Us";
$activePage = "about";
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

    <div class="container py-5">
        <h1 class="mb-4">About Our Business</h1>
        <div class="row">
            <div class="col-lg-8">
            <h3>Who We Are</h3>
            <p>Founded in 2020, <?php echo SITE_NAME; ?> has been at the forefront of providing innovative business solutions. Our mission is to help businesses grow through strategic guidance and cutting-edge technology.</p>
            
            <h4 class="mt-4">Our Mission</h4>
            <p>To empower businesses with the tools and strategies they need to succeed in today's competitive landscape.</p>
            
            <h4 class="mt-4">Our Values</h4>
            
            <!-- Values without bullet points -->
            <div class="values-list">
                <div><i class="fas fa-check-circle text-primary me-2"></i> Integrity and transparency</div>
                <div><i class="fas fa-check-circle text-primary me-2"></i> Excellence in everything we do</div>
                <div><i class="fas fa-check-circle text-primary me-2"></i> Customer-first approach</div>
                <div><i class="fas fa-check-circle text-primary me-2"></i> Continuous innovation</div>
            </div>
        </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5>Contact Information</h5>
                        <p><i class="fas fa-envelope"></i> <?php echo SITE_EMAIL; ?></p>
                        <p><i class="fas fa-phone"></i> <?php echo SITE_PHONE; ?></p>
                        <a href="request.php" class="btn btn-primary">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>