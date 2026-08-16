<?php
$page_title = "About Us";
$page_desc = "Learn about our experience, mission, and why we are the best choice for all your electrical needs.";
require_once 'includes/header.php';
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container" data-aos="fade-up">
        <h1>About Me</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mt-3">
                <li class="breadcrumb-item"><a href="index.php" class="text-white text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active text-primary" aria-current="page">About</li>
            </ol>
        </nav>
    </div>
</div>

<!-- About Details -->
<section class="py-5">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-5" data-aos="fade-right">
                <img src="assets/images/electrician-profile.jpg?v=2" alt="Dedicated Professional Electrician" class="img-fluid rounded-4 shadow-lg" style="width:100%; max-height:520px; object-fit:contain; display:block; margin:0 auto;">
            </div>
            <div class="col-lg-7" data-aos="fade-left">
                <h6 class="text-primary fw-bold text-uppercase">Who I Am</h6>
                <h2 class="display-5 fw-bold mb-4">Dedicated Professional Electrician</h2>
                <p class="lead mb-4 text-muted">With over 35+ years of hands-on experience in residential and commercial electrical systems, I have built a reputation for delivering safe, reliable, and high-quality workmanship.</p>
                
                <p class="mb-4">My mission is to provide top-notch electrical services with complete transparency and honesty. Whether it's a minor wiring fix or a complete commercial electrical installation, I approach every project with the same level of dedication and attention to detail.</p>
                
                <div class="row g-4 mt-2">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0 text-primary fs-3 me-3">
                                <i class="fa-solid fa-bullseye"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold">My Mission</h5>
                                <p class="text-muted small mb-0">To ensure the safety and comfort of every home and business I serve.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0 text-primary fs-3 me-3">
                                <i class="fa-solid fa-gem"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold">Core Values</h5>
                                <p class="text-muted small mb-0">Integrity, Quality, Safety, and Customer Satisfaction.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Me Detailed -->
<section class="py-5 bg-light-gray">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h6 class="text-primary fw-bold text-uppercase">The Difference</h6>
            <h2 class="display-6 fw-bold">Why I'm the Right Choice</h2>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100 text-center border border-light">
                    <i class="fa-solid fa-id-card text-primary fs-1 mb-3"></i>
                    <h5 class="fw-bold">Licensed & Certified</h5>
                    <p class="text-muted mb-0">Fully licensed to handle all types of electrical work, ensuring compliance with local safety codes.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100 text-center border border-light">
                    <i class="fa-solid fa-indian-rupee-sign text-primary fs-1 mb-3"></i>
                    <h5 class="fw-bold">Affordable Pricing</h5>
                    <p class="text-muted mb-0">No hidden fees. I provide clear, upfront estimates before starting any work.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100 text-center border border-light">
                    <i class="fa-solid fa-truck-fast text-primary fs-1 mb-3"></i>
                    <h5 class="fw-bold">Fast Response Time</h5>
                    <p class="text-muted mb-0">Electrical issues can't wait. I offer prompt arrival and fast resolution to your problems.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100 text-center border border-light">
                    <i class="fa-solid fa-shield-halved text-primary fs-1 mb-3"></i>
                    <h5 class="fw-bold">Quality Workmanship</h5>
                    <p class="text-muted mb-0">Using only high-quality materials and best practices to ensure long-lasting results.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="500">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100 text-center border border-light">
                    <i class="fa-solid fa-face-smile text-primary fs-1 mb-3"></i>
                    <h5 class="fw-bold">Friendly Support</h5>
                    <p class="text-muted mb-0">I believe in polite, respectful, and helpful customer service at all times.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="600">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100 text-center border border-light">
                    <i class="fa-solid fa-bolt-lightning text-primary fs-1 mb-3"></i>
                    <h5 class="fw-bold">Emergency Service</h5>
                    <p class="text-muted mb-0">Available round the clock for critical electrical failures and dangerous situations.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
