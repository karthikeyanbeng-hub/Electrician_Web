<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

require_admin();

$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Balaji Electrician Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="brand">
            <i class="fa-solid fa-bolt text-primary"></i> Balaji <span>Electrician</span>
        </div>
        <ul class="sidebar-nav">
            <li><a href="index.php" class="<?= $current_page == 'index.php' ? 'active' : '' ?>"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
            <li><a href="enquiries.php" class="<?= $current_page == 'enquiries.php' ? 'active' : '' ?>"><i class="fa-solid fa-envelope"></i> Enquiries</a></li>
            <li><a href="reviews.php" class="<?= $current_page == 'reviews.php' ? 'active' : '' ?>"><i class="fa-solid fa-star"></i> Reviews</a></li>
            <li><a href="settings.php" class="<?= $current_page == 'settings.php' ? 'active' : '' ?>"><i class="fa-solid fa-gear"></i> Settings</a></li>
            <li><a href="../index.php" target="_blank"><i class="fa-solid fa-globe"></i> View Website</a></li>
            <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Nav -->
        <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
            <h4 class="mb-0 fw-bold">Admin Panel</h4>
            <div class="d-flex align-items-center">
                <span class="me-3 text-muted">Welcome, <strong><?= htmlspecialchars($_SESSION['admin_username']) ?></strong></span>
                <a href="logout.php" class="btn btn-sm btn-outline-danger">Logout</a>
            </div>
        </div>
