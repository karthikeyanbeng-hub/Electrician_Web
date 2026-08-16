<?php
$page_title = "Home";
require_once 'includes/header.php';

if (!function_exists('time_elapsed_string')) {
    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}

// Fetch manual reviews from database
$stmt = $pdo->query("SELECT * FROM reviews WHERE is_published = 1 ORDER BY created_at DESC LIMIT 6");
$reviews = $stmt ? $stmt->fetchAll() : [];
?>

<!-- Hero Section -->
<section class="hero position-relative">
    <div class="container text-center text-md-start">
        <div class="row align-items-center">
            <div class="col-lg-8" data-aos="fade-right">
                <h1 class="display-4 fw-bolder mb-3">Professional Electrician You Can Trust</h1>
                <p class="lead mb-4 fw-light">Residential • Commercial • Emergency Electrical Services</p>
                <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-md-start">
                    <a href="tel:<?= htmlspecialchars(str_replace(' ', '', $phone)) ?>" class="btn btn-primary btn-lg"><i class="fa-solid fa-phone me-2"></i> Call Now</a>
                    <a href="contact.php" class="btn btn-outline-light btn-lg">Get Free Quote</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-5 bg-secondary text-white">
    <div class="container">
        <div class="row g-4">
            <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="100">
                <div class="stat-item">
                    <div class="stat-number">500+</div>
                    <div class="stat-text">Projects Completed</div>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="200">
                <div class="stat-item">
                    <div class="stat-number">30+</div>
                    <div class="stat-text">Years Experience</div>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="300">
                <div class="stat-item">
                    <div class="stat-number">1500+</div>
                    <div class="stat-text">Happy Clients</div>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="400">
                <div class="stat-item">
                    <div class="stat-number">24/7</div>
                    <div class="stat-text">Emergency Support</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Overview -->
<section class="py-5 bg-light-gray" id="services-section">
    <div class="container py-4">
        <div class="text-center mb-5" data-aos="fade-up">
            <h6 class="text-primary fw-bold text-uppercase tracking-wider">What We Do</h6>
            <h2 class="display-6 fw-bold">Premium Electrical Services</h2>
            <div class="mx-auto mt-3" style="width: 80px; height: 3px; background-color: var(--accent);"></div>
        </div>
        
        <div class="row g-4">
            <!-- Service 1 -->
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="service-card">
                    <div class="service-icon"><i class="fa-solid fa-house-chimney-crack"></i></div>
                    <h4 class="mb-3">House Wiring</h4>
                    <p class="text-muted">Complete residential wiring solutions for new homes and renovations with safety guaranteed.</p>
                    <a href="services.php" class="btn btn-outline-primary mt-2">Learn More</a>
                </div>
            </div>
            <!-- Service 2 -->
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="service-card">
                    <div class="service-icon"><i class="fa-solid fa-plug-circle-exclamation"></i></div>
                    <h4 class="mb-3">Electrical Repairs</h4>
                    <p class="text-muted">Fast and reliable repair services for short circuits, loose connections, and power failures.</p>
                    <a href="services.php" class="btn btn-outline-primary mt-2">Learn More</a>
                </div>
            </div>
            <!-- Service 3 -->
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="service-card">
                    <div class="service-icon"><i class="fa-solid fa-lightbulb"></i></div>
                    <h4 class="mb-3">Lighting Installation</h4>
                    <p class="text-muted">Expert installation of LED lights, chandeliers, outdoor lighting, and decorative fixtures.</p>
                    <a href="services.php" class="btn btn-outline-primary mt-2">Learn More</a>
                </div>
            </div>
        </div>
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="services.php" class="btn btn-secondary">View All Services</a>
        </div>
    </div>
</section>

<!-- About / Why Choose Me -->
<section class="py-5" id="about-section">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="position-relative">
                    <img src="assets/images/Elect_image.jpg" alt="Professional Electrician Working" class="img-fluid rounded-4 shadow-lg">
                    <div class="position-absolute bottom-0 end-0 bg-primary text-secondary p-4 rounded-4 shadow-lg" style="transform: translate(20px, 20px);">
                        <h4 class="fw-bold mb-0">100%</h4>
                        <p class="mb-0 fw-medium">Satisfaction Guaranteed</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <h6 class="text-primary fw-bold text-uppercase">Why Choose Me</h6>
                <h2 class="display-6 fw-bold mb-4">Your Trusted Local Electrical Expert</h2>
                <p class="lead text-muted mb-4">I provide top-tier electrical solutions tailored to your needs. With over a decade of experience, I ensure every job is done safely and correctly the first time.</p>
                
                <ul class="list-unstyled mb-4">
                    <li class="mb-3 d-flex align-items-center"><i class="fa-solid fa-circle-check text-primary fs-5 me-3"></i> <strong>Licensed & Insured Professional</strong></li>
                    <li class="mb-3 d-flex align-items-center"><i class="fa-solid fa-circle-check text-primary fs-5 me-3"></i> <strong>Transparent, Affordable Pricing</strong></li>
                    <li class="mb-3 d-flex align-items-center"><i class="fa-solid fa-circle-check text-primary fs-5 me-3"></i> <strong>Fast Emergency Response</strong></li>
                    <li class="mb-3 d-flex align-items-center"><i class="fa-solid fa-circle-check text-primary fs-5 me-3"></i> <strong>High-Quality Workmanship</strong></li>
                </ul>
                
                <a href="about.php" class="btn btn-primary">More About Me</a>
            </div>
        </div>
    </div>
</section>

<!-- Reviews Section -->
<section class="py-5 bg-light-gray">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h6 class="text-primary fw-bold text-uppercase">Testimonials</h6>
            <h2 class="display-6 fw-bold">What My Clients Say</h2>
        </div>
        
        <div id="reviewsCarousel" class="carousel slide" data-bs-ride="carousel" data-aos="zoom-in">
            <div class="carousel-inner">
                <?php if ($reviews): ?>
                    <?php foreach ($reviews as $index => $review): ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                            <div class="row justify-content-center">
                                <div class="col-md-8 col-lg-6">
                                    <div class="review-card text-center mx-auto" style="max-width: 500px;">
                                        <div class="stars fs-4">
                                            <?php for($i=1; $i<=5; $i++): ?>
                                                <?= $i <= $review['rating'] ? '&#9733;' : '&#9734;' ?>
                                            <?php endfor; ?>
                                        </div>
                                        <div class="review-author"><?= htmlspecialchars($review['customer_name']) ?></div>
                                        <div class="review-meta mb-3 text-center"><?= time_elapsed_string($review['created_at']) ?></div>
                                        <p class="review-text flex-grow-1">"<?= htmlspecialchars($review['review_text']) ?>"</p>
                                        <div class="verified-badge text-center">
                                            <i class="fa-solid fa-check-circle me-1"></i> Verified Customer
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="carousel-item active">
                        <div class="row justify-content-center">
                            <div class="col-md-8 col-lg-6">
                                <div class="review-card text-center">
                                    <p class="review-text fs-5 text-muted">No customer reviews yet. Be the first to share your experience.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#reviewsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: invert(1) grayscale(100); width:3rem; height:3rem;"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#reviewsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(1) grayscale(100); width:3rem; height:3rem;"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        
        <div class="text-center mt-4">
            <a href="reviews.php" class="btn btn-outline-primary">Read All Reviews</a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-primary text-secondary text-center">
    <div class="container py-4" data-aos="zoom-in">
        <h2 class="display-5 fw-bold mb-3">Facing an Electrical Emergency?</h2>
        <p class="lead mb-4">Don't wait! Call now for fast and reliable electrical support.</p>
        <a href="tel:<?= htmlspecialchars(str_replace(' ', '', $phone)) ?>" class="btn btn-secondary btn-lg fw-bold px-5 py-3 shadow-lg"><i class="fa-solid fa-phone-volume me-2"></i> <?= htmlspecialchars($phone) ?></a>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
