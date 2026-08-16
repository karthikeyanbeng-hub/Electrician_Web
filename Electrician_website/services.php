<?php
$page_title = "Our Services";
$page_desc = "Comprehensive electrical services including house wiring, repairs, lighting, inverter installation, and commercial electrical work.";
require_once 'includes/header.php';

// Service Data
$services = [
    ['icon' => 'fa-house-chimney-crack', 'title' => 'House Wiring', 'desc' => 'Complete residential wiring for new constructions, renovations, and extensions safely executed.'],
    ['icon' => 'fa-plug-circle-exclamation', 'title' => 'Electrical Repairs', 'desc' => 'Quick fault finding and repair for switches, sockets, short circuits, and loose connections.'],
    ['icon' => 'fa-toggle-on', 'title' => 'Switch Board Installation', 'desc' => 'Modern modular switchboard installation, replacement, and relocation.'],
    ['icon' => 'fa-fan', 'title' => 'Fan Installation', 'desc' => 'Ceiling fans, exhaust fans, and wall fans installed securely with optimal balance.'],
    ['icon' => 'fa-lightbulb', 'title' => 'Light Installation', 'desc' => 'Chandelier, tube lights, wall lights, and outdoor security lighting setup.'],
    ['icon' => 'fa-solar-panel', 'title' => 'LED Lighting', 'desc' => 'Energy-efficient LED lighting upgrades to reduce your electricity bills.'],
    ['icon' => 'fa-car-battery', 'title' => 'MCB Replacement', 'desc' => 'Faulty Miniature Circuit Breaker (MCB) detection and safe replacement.'],
    ['icon' => 'fa-triangle-exclamation', 'title' => 'Circuit Breaker Repair', 'desc' => 'Main distribution board repairs and upgrades to handle modern appliance loads.'],
    ['icon' => 'fa-battery-full', 'title' => 'Power Backup Installation', 'desc' => 'Integration of backup generators and manual/auto changeover switches.'],
    ['icon' => 'fa-plug-circle-bolt', 'title' => 'Inverter Wiring', 'desc' => 'Seamless inverter integration into your existing home wiring system.'],
    ['icon' => 'fa-server', 'title' => 'UPS Installation', 'desc' => 'Dedicated UPS wiring for sensitive computer systems and home offices.'],
    ['icon' => 'fa-земля', 'title' => 'Earthing', 'desc' => 'Proper earthing/grounding installation to protect your family and appliances from shocks.'],
    ['icon' => 'fa-toolbox', 'title' => 'Electrical Maintenance', 'desc' => 'Regular inspection and preventative maintenance for homes and offices.'],
    ['icon' => 'fa-network-wired', 'title' => 'Office Wiring', 'desc' => 'Structured cabling and electrical setup for workstations and office environments.'],
    ['icon' => 'fa-building', 'title' => 'Commercial Electrical Work', 'desc' => 'Heavy duty electrical work for shops, showrooms, and commercial buildings.'],
    ['icon' => 'fa-truck-medical', 'title' => 'Emergency Service', 'desc' => 'Rapid response to dangerous electrical faults and complete power blackouts.']
];
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container" data-aos="fade-up">
        <h1>Electrical Services</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mt-3">
                <li class="breadcrumb-item"><a href="index.php" class="text-white text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active text-primary" aria-current="page">Services</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5 bg-light-gray">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h6 class="text-primary fw-bold text-uppercase">What I Offer</h6>
            <h2 class="display-6 fw-bold">Comprehensive Electrical Solutions</h2>
            <p class="lead text-muted mt-3 max-w-700 mx-auto">From simple repairs to complex wiring installations, I provide professional, safe, and efficient electrical services for all your needs.</p>
        </div>
        
        <div class="row g-4">
            <?php foreach($services as $index => $srv): ?>
                <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="<?= ($index % 4) * 100 ?>">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fa-solid <?= $srv['icon'] ?>"></i>
                        </div>
                        <h5 class="fw-bold mb-3"><?= $srv['title'] ?></h5>
                        <p class="text-muted small mb-4"><?= $srv['desc'] ?></p>
                        <a href="contact.php?service=<?= urlencode($srv['title']) ?>" class="btn btn-outline-primary btn-sm">Book Service</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5 bg-secondary text-white text-center">
    <div class="container py-4" data-aos="zoom-in">
        <h3 class="fw-bold mb-3">Need a Custom Electrical Solution?</h3>
        <p class="mb-4">Contact me today to discuss your specific requirements and get a free quote.</p>
        <a href="contact.php" class="btn btn-primary btn-lg">Get in Touch</a>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
