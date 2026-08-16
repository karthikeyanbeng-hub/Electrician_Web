<?php
$page_title = "FAQ";
$page_desc = "Frequently asked questions about our electrical services, pricing, and emergency availability.";
require_once 'includes/header.php';

$faqs = [
    ["q" => "How much do electrical services cost?", "a" => "Costs vary depending on the type and complexity of the job. I offer a transparent pricing model and will always provide an upfront estimate before beginning any work."],
    ["q" => "Do you provide emergency services?", "a" => "Yes, I offer 24/7 emergency electrical services for critical situations like total power loss, sparking outlets, or severe short circuits."],
    ["q" => "Do you install inverters?", "a" => "Absolutely. I provide full installation and integration of inverters and battery backup systems into your home wiring."],
    ["q" => "Can you repair short circuits?", "a" => "Yes, I have specialized tools to trace and safely repair short circuits without unnecessary damage to your walls or property."],
    ["q" => "Do you install ceiling fans?", "a" => "Yes, I install all types of ceiling fans, exhaust fans, and wall-mounted fans safely and securely."],
    ["q" => "Do you work on commercial buildings?", "a" => "Yes, I handle electrical requirements for offices, retail shops, and commercial spaces, including structured wiring and panel upgrades."],
    ["q" => "Are you licensed and insured?", "a" => "Yes, I am a fully certified and licensed professional electrician, and I carry insurance for your peace of mind."],
    ["q" => "What should I do if my circuit breaker keeps tripping?", "a" => "A tripping breaker indicates an overload or a short circuit. Avoid constantly resetting it. Unplug heavy appliances and call me for a professional inspection."],
    ["q" => "Can you upgrade my old switchboards?", "a" => "Yes, I specialize in replacing old, outdated switchboards with modern, safe modular switches that meet current electrical standards."],
    ["q" => "Do you provide earthing services?", "a" => "Yes, proper earthing is crucial for safety. I provide complete earthing pit installations and testing for residential and commercial setups."],
    ["q" => "How quickly can you arrive for a standard service?", "a" => "For non-emergency calls, I typically schedule visits within 24-48 hours based on your convenience."],
    ["q" => "Do you provide a warranty on your work?", "a" => "Yes, I guarantee the quality of my workmanship. Any issues related to my installation will be addressed promptly."],
    ["q" => "Can you install LED profile lights?", "a" => "Yes, I handle all types of modern lighting, including LED strip lights, profile lights, and decorative chandeliers."],
    ["q" => "What payment methods do you accept?", "a" => "I accept cash, UPI (Google Pay, PhonePe, Paytm), and bank transfers."],
    ["q" => "Do I need to buy the materials, or do you provide them?", "a" => "I can procure high-quality, genuine materials for you at standard market rates, or you can purchase them yourself. I am flexible based on your preference."]
];
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container" data-aos="fade-up">
        <h1>Frequently Asked Questions</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mt-3">
                <li class="breadcrumb-item"><a href="index.php" class="text-white text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active text-primary" aria-current="page">FAQ</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="text-center mb-5" data-aos="fade-up">
                    <h6 class="text-primary fw-bold text-uppercase">Got Questions?</h6>
                    <h2 class="display-6 fw-bold">Common Queries Answered</h2>
                </div>
                
                <div class="accordion accordion-flush" id="faqAccordion" data-aos="fade-up" data-aos-delay="100">
                    <?php foreach($faqs as $index => $faq): ?>
                        <div class="accordion-item border mb-3 rounded-3 overflow-hidden shadow-sm">
                            <h2 class="accordion-header" id="flush-heading<?= $index ?>">
                                <button class="accordion-button collapsed fw-bold text-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $index ?>" aria-expanded="false" aria-controls="flush-collapse<?= $index ?>">
                                    <?= $faq['q'] ?>
                                </button>
                            </h2>
                            <div id="flush-collapse<?= $index ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?= $index ?>" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted">
                                    <?= $faq['a'] ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
