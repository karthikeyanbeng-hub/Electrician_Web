<?php
$page_title = "Contact Us";
$page_desc = "Get in touch for electrical services, free quotes, and emergency support. Available 24/7.";
require_once 'includes/header.php';

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'])) {
        $error = "Invalid form submission. Please try again.";
    } else {
        $name = sanitize_input($_POST['name']);
        $phone = sanitize_input($_POST['phone']);
        $email = sanitize_input($_POST['email']);
        $address = sanitize_input($_POST['address']);
        $service = sanitize_input($_POST['service']);
        $message = sanitize_input($_POST['message']);

        if (empty($name) || empty($phone)) {
            $error = "Name and Phone number are required.";
        } else {
            try {
                $stmt = $pdo->prepare("INSERT INTO enquiries (name, phone, email, address, service, message) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([$name, $phone, $email, $address, $service, $message]);
                $success = true;
            } catch (PDOException $e) {
                $error = "Something went wrong. Please try again later.";
            }
        }
    }
}

// Prefill service if passed via GET
$selected_service = isset($_GET['service']) ? sanitize_input($_GET['service']) : '';
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container" data-aos="fade-up">
        <h1>Contact Me</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mt-3">
                <li class="breadcrumb-item"><a href="index.php" class="text-white text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active text-primary" aria-current="page">Contact</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5 bg-light-gray">
    <div class="container py-5">
        <div class="row g-5">
            
            <div class="col-lg-5" data-aos="fade-right">
                <h6 class="text-primary fw-bold text-uppercase">Get In Touch</h6>
                <h2 class="display-6 fw-bold mb-4">Let's Discuss Your Electrical Needs</h2>
                <p class="text-muted mb-5">Whether you need an urgent repair, a complete wiring installation, or just a free estimate, I'm here to help. Reach out using the contact details below.</p>
                
                <div class="d-flex align-items-center mb-4">
                    <div class="flex-shrink-0 bg-primary text-secondary rounded-circle d-flex align-items-center justify-content-center fs-4" style="width: 60px; height: 60px;">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div class="ms-4">
                        <h5 class="fw-bold mb-1">Call Me</h5>
                        <p class="text-muted mb-0"><a href="tel:<?= htmlspecialchars(str_replace(' ', '', get_setting($pdo, 'contact_phone'))) ?>" class="text-decoration-none text-muted"><?= htmlspecialchars(get_setting($pdo, 'contact_phone')) ?></a></p>
                    </div>
                </div>
                
                <div class="d-flex align-items-center mb-4">
                    <div class="flex-shrink-0 bg-primary text-secondary rounded-circle d-flex align-items-center justify-content-center fs-4" style="width: 60px; height: 60px;">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <div class="ms-4">
                        <h5 class="fw-bold mb-1">WhatsApp</h5>
                        <p class="text-muted mb-0"><a href="https://wa.me/<?= htmlspecialchars(str_replace('+', '', get_setting($pdo, 'contact_whatsapp'))) ?>" target="_blank" class="text-decoration-none text-muted"><?= htmlspecialchars(get_setting($pdo, 'contact_whatsapp')) ?></a></p>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-4">
                    <div class="flex-shrink-0 bg-primary text-secondary rounded-circle d-flex align-items-center justify-content-center fs-4" style="width: 60px; height: 60px;">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="ms-4">
                        <h5 class="fw-bold mb-1">Email</h5>
                        <p class="text-muted mb-0"><a href="mailto:<?= htmlspecialchars(get_setting($pdo, 'contact_email')) ?>" class="text-decoration-none text-muted"><?= htmlspecialchars(get_setting($pdo, 'contact_email')) ?></a></p>
                    </div>
                </div>
                
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 bg-primary text-secondary rounded-circle d-flex align-items-center justify-content-center fs-4" style="width: 60px; height: 60px;">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div class="ms-4">
                        <h5 class="fw-bold mb-1">Location</h5>
                        <p class="text-muted mb-0"><?= htmlspecialchars(get_setting($pdo, 'contact_address')) ?></p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-7" data-aos="fade-left">
                <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm">
                    <h3 class="fw-bold mb-4">Request a Service</h3>
                    
                    <?php if ($success): ?>
                        <div class="alert alert-success">
                            <i class="fa-solid fa-circle-check me-2"></i> Thank you! Your request has been sent successfully. I will contact you shortly.
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($error): ?>
                        <div class="alert alert-danger">
                            <i class="fa-solid fa-circle-exclamation me-2"></i> <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>
                    
                    <form action="contact.php" method="POST">
                        <?= csrf_field() ?>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Full Name *</label>
                                <input type="text" name="name" class="form-control" required placeholder="John Doe">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Phone Number *</label>
                                <input type="text" name="phone" class="form-control" required placeholder="+91 9876543210">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Email Address</label>
                                <input type="email" name="email" class="form-control" placeholder="john@example.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Service Required</label>
                                <select name="service" class="form-select">
                                    <option value="General Inquiry">General Inquiry</option>
                                    <option value="House Wiring" <?= $selected_service == 'House Wiring' ? 'selected' : '' ?>>House Wiring</option>
                                    <option value="Electrical Repairs" <?= $selected_service == 'Electrical Repairs' ? 'selected' : '' ?>>Electrical Repairs</option>
                                    <option value="Lighting Installation" <?= $selected_service == 'Lighting Installation' ? 'selected' : '' ?>>Lighting Installation</option>
                                    <option value="Emergency Service" <?= $selected_service == 'Emergency Service' ? 'selected' : '' ?>>Emergency Service</option>
                                    <option value="Other" <?= $selected_service == 'Other' ? 'selected' : '' ?>>Other</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Service Address</label>
                                <input type="text" name="address" class="form-control" placeholder="House No, Street, City">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Message / Issue Details</label>
                                <textarea name="message" class="form-control" rows="4" placeholder="Describe your electrical issue or requirement..."></textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary w-100 py-3 fw-bold fs-5 shadow-sm">Send Request</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- Google Map (Placeholder iframe, can be replaced with real one) -->
<section class="border-top">
    <iframe src="https://www.google.com/maps?q=Urapakkam,Tamil%20Nadu&output=embed" width="100%" height="450" style="border:0; display:block;" allowfullscreen="" loading="lazy" title="Google Map Location"></iframe>
</section>

<?php require_once 'includes/footer.php'; ?>
