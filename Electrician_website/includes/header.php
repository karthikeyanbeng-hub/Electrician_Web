<?php
require_once 'config.php';
require_once 'functions.php';

// Get page details for SEO
$page_title = isset($page_title) ? $page_title . " | Balaji Electrician Services" : "Balaji Electrician Services | Residential & Commercial Services";
$page_desc = isset($page_desc) ? $page_desc : "Expert electrical services for residential and commercial properties. Fast, reliable, and affordable emergency electrician.";
$page_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$phone = get_setting($pdo, 'contact_phone');
$whatsapp = get_setting($pdo, 'contact_whatsapp');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title) ?></title>
    <meta name="description" content="<?= htmlspecialchars($page_desc) ?>">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?= htmlspecialchars($page_title) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($page_desc) ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= htmlspecialchars($page_url) ?>">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- JSON-LD Local Business Schema -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "LocalBusiness",
      "name": "Balaji Electrician Services",
      "image": "",
      "@id": "",
      "url": "<?= htmlspecialchars($page_url) ?>",
      "telephone": "<?= htmlspecialchars($phone) ?>",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "<?= htmlspecialchars(get_setting($pdo, 'contact_address')) ?>",
        "addressCountry": "IN"
      }
    }
    </script>
</head>
<body>
    
    <!-- Loader -->
    <div id="loader">
        <div class="spinner"></div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fa-solid fa-bolt text-primary"></i> Balaji <span>Electrical Services</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : '' ?>" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'about.php') ? 'active' : '' ?>" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'services.php') ? 'active' : '' ?>" href="services.php">Services</a></li>
                    <li class="nav-item"><a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'gallery.php') ? 'active' : '' ?>" href="gallery.php">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'reviews.php') ? 'active' : '' ?>" href="reviews.php">Reviews</a></li>
                    <li class="nav-item"><a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'faq.php') ? 'active' : '' ?>" href="faq.php">FAQ</a></li>
                    <li class="nav-item"><a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'contact.php') ? 'active' : '' ?>" href="contact.php">Contact</a></li>
                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                        <a href="tel:<?= htmlspecialchars(str_replace(' ', '', $phone)) ?>" class="btn btn-primary shadow-sm"><i class="fa-solid fa-phone me-2"></i> Call Now</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
