<?php
include 'config.php';
$pageTitle = "View Requests";

// Debug mode - show errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
$logged_in = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

// Handle login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    
    // Debug: Log login attempt
    error_log("Login attempt: username=$username");
    
    $sql = "SELECT * FROM admin_users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    
    if (!$result) {
        $login_error = "Database error: " . mysqli_error($conn);
    } else {
        $user = mysqli_fetch_assoc($result);
        
        if ($user) {
            // Debug: Check if password matches
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

if (!$logged_in):
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Admin Login</h4>
                    </div>
                    <div class="card-body">
                        <?php if (isset($login_error)): ?>
                            <div class="alert alert-danger"><?php echo htmlspecialchars($login_error); ?></div>
                        <?php endif; ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                        </form>
                        <p class="text-muted mt-3 small">Try: admin / admin123</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php else: ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Requests Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container-fluid">
        <nav class="navbar navbar-dark bg-dark mb-4">
            <div class="container">
                <span class="navbar-brand">
                    <i class="fas fa-dashboard"></i> Customer Requests Dashboard
                </span>
                <div>
                    <span class="text-white me-3">Welcome, <?php echo $_SESSION['admin_username']; ?></span>
                    <a href="?logout=1" class="btn btn-danger btn-sm">Logout</a>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5>Total Requests</h5>
                            <?php
                            $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM customer_requests");
                            $row = mysqli_fetch_assoc($result);
                            ?>
                            <h2><?php echo $row['total']; ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-dark">
                        <div class="card-body">
                            <h5>New</h5>
                            <?php
                            $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM customer_requests WHERE status = 'new'");
                            $row = mysqli_fetch_assoc($result);
                            ?>
                            <h2><?php echo $row['total']; ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h5>In Progress</h5>
                            <?php
                            $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM customer_requests WHERE status = 'in_progress'");
                            $row = mysqli_fetch_assoc($result);
                            ?>
                            <h2><?php echo $row['total']; ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5>Completed</h5>
                            <?php
                            $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM customer_requests WHERE status = 'completed'");
                            $row = mysqli_fetch_assoc($result);
                            ?>
                            <h2><?php echo $row['total']; ?></h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Service</th>
                                <th>Status</th>
                                <th>Submitted</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM customer_requests ORDER BY created_at DESC";
                            $result = mysqli_query($conn, $sql);
                            
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    $status_badge = [
                                        'new' => 'bg-warning',
                                        'in_progress' => 'bg-info',
                                        'completed' => 'bg-success'
                                    ];
                                    echo '<tr>';
                                    echo '<td>' . $row['id'] . '</td>';
                                    echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['service']) . '</td>';
                                    echo '<td><span class="badge ' . $status_badge[$row['status']] . '">' . $row['status'] . '</span></td>';
                                    echo '<td>' . date('d/m/Y h:i A', strtotime($row['created_at'])) . '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="6" class="text-center">No requests yet.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php endif; ?>