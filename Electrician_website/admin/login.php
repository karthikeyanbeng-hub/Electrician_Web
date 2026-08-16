<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

if (is_admin_logged_in()) {
    header("Location: index.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'])) {
        $error = "Invalid form submission.";
    } else {
        $username = sanitize_input($_POST['username']);
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_username'] = $user['username'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Balaji Electrician Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body class="bg-light">

<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-5 col-lg-4">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold"><i class="fa-solid fa-bolt text-primary"></i> Balaji <span>Electrician</span></h2>
                        <p class="text-muted">Admin Control Panel</p>
                    </div>
                    
                    <?php if ($error): ?>
                        <div class="alert alert-danger py-2"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    
                    <form method="POST" action="login.php">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Username</label>
                            <input type="text" name="username" class="form-control" required autofocus>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 fw-bold">Login</button>
                    </form>
                    
                    <div class="text-center mt-3">
                        <a href="../index.php" class="text-decoration-none text-muted small"><i class="fa-solid fa-arrow-left"></i> Back to Website</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
