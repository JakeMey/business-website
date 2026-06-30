<?php
include 'config.php';
$pageTitle = "View Requests";
$activePage = "view_requests";

// Debug mode - show errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
$logged_in = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

// Handle login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    
    error_log("Login attempt: username=$username");
    
    $sql = "SELECT * FROM admin_users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    
    if (!$result) {
        $login_error = "Database error: " . mysqli_error($conn);
    } else {
        $user = mysqli_fetch_assoc($result);
        
        if ($user) {
            if (password_verify($password, $user['password_hash'])) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_username'] = $username;
                $logged_in = true;
                error_log("Login successful for: $username");
            } else {
                $login_error = "Password incorrect";
                error_log("Password verification failed for: $username");
            }
        } else {
            $login_error = "Username not found: $username";
            error_log("Username not found: $username");
        }
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: view_requests.php');
    exit;
}

// Handle status filter
$status_filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$where_clause = '';
if ($status_filter != 'all') {
    $where_clause = "WHERE status = '" . mysqli_real_escape_string($conn, $status_filter) . "'";
}

if (!$logged_in):
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="container py-5">
        <h1 class="text-center mb-5">Admin Login</h1>
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0">
                    <div class="card-body p-4">
                        <?php if (isset($login_error)): ?>
                            <div class="alert alert-danger"><?php echo htmlspecialchars($login_error); ?></div>
                        <?php endif; ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label"><i class="fas fa-user"></i> Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label"><i class="fas fa-key"></i> Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" name="login" class="btn btn-primary w-100">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </button>
                        </form>
                        <p class="text-muted mt-3 small text-center">Try: admin / password</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
<?php
else:
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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fas fa-dashboard text-primary"></i> Customer Requests Dashboard</h1>
            <div>
                <span class="text-muted me-3">
                    <i class="fas fa-user-circle"></i> <?php echo $_SESSION['admin_username']; ?>
                </span>
                <a href="?logout=1" class="btn btn-danger btn-sm">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>

        <!-- Stats Cards - Clickable (NO inline styling) -->
        <div class="row mb-4">
            <?php
            $stats = [
                ['Total Requests', 'fa-inbox', 'primary', "SELECT COUNT(*) as total FROM customer_requests", 'all'],
                ['New', 'fa-clock', 'warning', "SELECT COUNT(*) as total FROM customer_requests WHERE status = 'new'", 'new'],
                ['In Progress', 'fa-spinner', 'info', "SELECT COUNT(*) as total FROM customer_requests WHERE status = 'in_progress'", 'in_progress'],
                ['Completed', 'fa-check-circle', 'success', "SELECT COUNT(*) as total FROM customer_requests WHERE status = 'completed'", 'completed']
            ];
            
            foreach ($stats as $stat) {
                $result = mysqli_query($conn, $stat[3]);
                $row = mysqli_fetch_assoc($result);
                $is_active = ($status_filter == $stat[4]) ? 'active-filter' : '';
                echo '
                <div class="col-md-3 mb-3">
                    <div class="card shadow-sm h-100 stat-clickable stat-' . $stat[2] . ' ' . $is_active . '" data-filter="' . $stat[4] . '">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">' . $stat[0] . '</h6>
                                    <h2 class="mb-0">' . $row['total'] . '</h2>
                                </div>
                                <i class="fas ' . $stat[1] . ' fa-2x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>

        <!-- Active Filter Indicator -->
        <div class="mb-3">
            <?php if ($status_filter == 'all'): ?>
                <span class="badge filter-badge-all">Showing: All Requests</span>
            <?php else: ?>
                <span class="badge filter-badge-<?php echo $status_filter; ?>">Showing: <?php echo ucfirst(str_replace('_', ' ', $status_filter)); ?></span>
                <a href="?filter=all" class="btn btn-sm btn-outline-secondary ms-2">
                    <i class="fas fa-times"></i> Clear Filter
                </a>
            <?php endif; ?>
        </div>

        <!-- Table -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="fas fa-list"></i> All Requests</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Service</th>
                                <th>Request</th>
                                <th>Status</th>
                                <th>Submitted</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM customer_requests $where_clause ORDER BY 
                                    CASE status 
                                        WHEN 'new' THEN 1 
                                        WHEN 'in_progress' THEN 2 
                                        WHEN 'completed' THEN 3 
                                    END, 
                                    created_at DESC";
                            $result = mysqli_query($conn, $sql);
                            
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    $status_badge = [
                                        'new' => 'badge-warning',
                                        'in_progress' => 'badge-info',
                                        'completed' => 'badge-success'
                                    ];
                                    $status_label = [
                                        'new' => 'New',
                                        'in_progress' => 'In Progress',
                                        'completed' => 'Completed'
                                    ];
                                    
                                    // Truncate request for preview
                                    $request_preview = htmlspecialchars($row['request']);
                                    if (strlen($request_preview) > 60) {
                                        $request_preview = substr($request_preview, 0, 60) . '...';
                                    }
                                    
                                    // Format phone number or show N/A
                                    $phone_display = !empty($row['phone']) ? htmlspecialchars($row['phone']) : '—';
                                    ?>
                                    <tr>
                                        <td><strong><?php echo $row['id']; ?></strong></td>
                                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td><?php echo $phone_display; ?></td>
                                        <td><?php echo htmlspecialchars($row['service']); ?></td>
                                        <td>
                                            <span class="request-preview">
                                                <?php echo $request_preview; ?>
                                            </span>
                                            <button class="btn btn-link btn-sm p-0 ms-1 btn-view" 
                                                    type="button" 
                                                    data-bs-toggle="collapse" 
                                                    data-bs-target="#request<?php echo $row['id']; ?>"
                                                    onclick="this.querySelector('.expand-icon').classList.toggle('rotated')">
                                                <i class="fas fa-chevron-down expand-icon"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <span class="badge <?php echo $status_badge[$row['status']]; ?>">
                                                <?php echo $status_label[$row['status']]; ?>
                                            </span>
                                        </td>
                                        <td class="text-nowrap">
                                            <?php echo date('d/m/Y', strtotime($row['created_at'])); ?>
                                            <br>
                                            <small class="text-muted"><?php echo date('h:i A', strtotime($row['created_at'])); ?></small>
                                        </td>
                                    </tr>
                                    <!-- Expandable row with "Full Request" header -->
                                    <tr class="collapse request-detail-row" id="request<?php echo $row['id']; ?>">
                                        <td colspan="8" class="p-0">
                                            <div class="request-expanded">
                                                <div class="request-header">
                                                    <i class="fas fa-envelope text-primary"></i> Full Request:
                                                </div>
                                                <div class="request-body">
                                                    <?php echo nl2br(htmlspecialchars($row['request'])); ?>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo '<tr><td colspan="8" class="text-center text-muted py-3">No requests found.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
<?php
endif;
?>