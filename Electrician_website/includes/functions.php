<?php
// CSRF Protection
function generate_csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf_token($token) {
    if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
        return false;
    }
    return true;
}

function csrf_field() {
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars(generate_csrf_token()) . '">';
}

// Input Sanitization
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

// Auth checks
function is_admin_logged_in() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function require_admin() {
    if (!is_admin_logged_in()) {
        header("Location: login.php");
        exit();
    }
}
?>
