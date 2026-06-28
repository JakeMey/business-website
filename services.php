<?php
include 'config.php';
$pageTitle = "Services";
$activePage = "services";
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
        <h1 class="text-center mb-5">Our Services</h1>
        <div class="row">
            <?php
            $services = [
                ['Consulting', 'fa-handshake', 'Expert business strategy consulting to help you grow.'],
                ['Development', 'fa-code', 'Custom web and software development solutions.'],
                ['Marketing', 'fa-bullhorn', 'Digital marketing strategies to reach your audience.'],
                ['Support', 'fa-headset', '24/7 technical support and maintenance services.'],
                ['Training', 'fa-chalkboard-teacher', 'Professional training and workshops for your team.'],
                ['Analytics', 'fa-chart-line', 'Data-driven insights to optimize your business.']
            ];
            
            foreach ($services as $service) {
                echo '
                <div class="col-md-4 mb-4">
                    <div class="service-card text-center p-4 border rounded h-100">
                        <i class="fas ' . $service[1] . ' fa-3x text-primary mb-3"></i>
                        <h4>' . $service[0] . '</h4>
                        <p>' . $service[2] . '</p>
                        <a href="request.php" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>