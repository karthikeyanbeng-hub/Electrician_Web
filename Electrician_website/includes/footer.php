<?php
$phone = get_setting($pdo, 'contact_phone');
$whatsapp = get_setting($pdo, 'contact_whatsapp');
$address = get_setting($pdo, 'contact_address');
$email = get_setting($pdo, 'contact_email');
$business_hours = get_setting($pdo, 'business_hours');
?>
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="footer-heading mb-4"><i class="fa-solid fa-bolt text-primary"></i>Balaji<span> Electrical Services</span></h3>
                    <p class="mb-4">Providing top-quality residential and commercial electrical services. Safety, reliability, and customer satisfaction are our top priorities.</p>
                    <div class="social-icons">
                        <a href="<?= htmlspecialchars(get_setting($pdo, 'facebook_url')) ?>"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="<?= htmlspecialchars(get_setting($pdo, 'twitter_url')) ?>"><i class="fa-brands fa-twitter"></i></a>
                        <a href="<?= htmlspecialchars(get_setting($pdo, 'instagram_url')) ?>"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <h4 class="footer-heading">Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="services.php">Our Services</a></li>
                        <li><a href="gallery.php">Project Gallery</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <h4 class="footer-heading">Our Services</h4>
                    <ul class="footer-links">
                        <li><a href="services.php">House Wiring</a></li>
                        <li><a href="services.php">Electrical Repairs</a></li>
                        <li><a href="services.php">Lighting Installation</a></li>
                        <li><a href="services.php">Inverter Setup</a></li>
                        <li><a href="services.php">Emergency Service</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <h4 class="footer-heading">Contact Info</h4>
                    <ul class="footer-links">
                        <li><i class="fa-solid fa-location-dot text-primary me-2"></i> <?= htmlspecialchars($address) ?></li>
                        <li><i class="fa-solid fa-phone text-primary me-2"></i> <a href="tel:<?= htmlspecialchars(str_replace(' ', '', $phone)) ?>"><?= htmlspecialchars($phone) ?></a></li>
                        <li><i class="fa-solid fa-envelope text-primary me-2"></i> <a href="mailto:<?= htmlspecialchars($email) ?>"><?= htmlspecialchars($email) ?></a></li>
                        <li><i class="fa-solid fa-clock text-primary me-2"></i> <?= htmlspecialchars($business_hours) ?></li>
                    </ul>
                </div>
            </div>
            
            <div class="row mt-5 pt-4 border-top border-secondary">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; <?= date('Y') ?>Balaji Electrician. All Rights Reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                    <a href="#" class="text-white text-decoration-none me-3">Privacy Policy</a>
                    <a href="admin/login.php" class="text-white text-decoration-none"><i class="fa-solid fa-lock"></i> Admin</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating Actions -->
    <div class="floating-actions">
        <a href="https://wa.me/<?= htmlspecialchars(str_replace('+', '', $whatsapp)) ?>" class="float-btn float-whatsapp" target="_blank" title="WhatsApp Us">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
        <a href="tel:<?= htmlspecialchars(str_replace(' ', '', $phone)) ?>" class="float-btn float-call" title="Call Us">
            <i class="fa-solid fa-phone"></i>
        </a>
        <a href="#" class="float-btn float-top" id="scrollTop" title="Go to top">
            <i class="fa-solid fa-arrow-up"></i>
        </a>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Custom JS -->
    <script src="assets/js/main.js"></script>
</body>
</html>
