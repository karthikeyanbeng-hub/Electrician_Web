<?php
$page_title = "Project Gallery";
$page_desc = "View our past electrical projects, installations, and repairs. High-quality workmanship guaranteed.";
require_once 'includes/header.php';

// Dummy Gallery Data (In a real app, this might come from DB)
$gallery = [
    ['img' => 'assets/images/image_1.jpeg', 'cat' => 'house-wiring', 'title' => 'House Wiring'],
    ['img' => 'assets/images/image_7.jpeg', 'cat' => 'lighting', 'title' => 'LED Installation'],
    ['img' => 'assets/images/image_6.jpeg', 'cat' => 'switch-boards', 'title' => 'Switch Board Setup'],
    ['img' => 'assets/images/image_2.jpeg', 'cat' => 'commercial', 'title' => 'Commercial Wiring'],
    ['img' => 'assets/images/image_3.jpeg', 'cat' => 'repairs', 'title' => 'Circuit Repair'],
    ['img' => 'assets/images/image_4.jpeg', 'cat' => 'before-after', 'title' => 'Panel Upgrade'],
    ['img' => 'assets/images/image_5.jpeg', 'cat' => 'before-after', 'title' => 'Panel Upgrade']
];
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container" data-aos="fade-up">
        <h1>Project Gallery</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mt-3">
                <li class="breadcrumb-item"><a href="index.php" class="text-white text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active text-primary" aria-current="page">Gallery</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container py-5">
        
        <!-- Filter Buttons (Frontend logic only for demo) -->
        <div class="text-center mb-5" data-aos="fade-up">
            <div class="btn-group flex-wrap gap-2" role="group">
                <button type="button" class="btn btn-outline-primary active" data-filter="all">All</button>
                <button type="button" class="btn btn-outline-primary" data-filter="house-wiring">House Wiring</button>
                <button type="button" class="btn btn-outline-primary" data-filter="lighting">Lighting</button>
                <button type="button" class="btn btn-outline-primary" data-filter="switch-boards">Switch Boards</button>
                <button type="button" class="btn btn-outline-primary" data-filter="commercial">Commercial</button>
                <button type="button" class="btn btn-outline-primary" data-filter="repairs">Repairs</button>
                <button type="button" class="btn btn-outline-primary" data-filter="before-after">Before & After</button>
            </div>
        </div>

        <div class="row g-4" id="gallery-container">
            <?php foreach($gallery as $index => $item): ?>
                <div class="col-lg-4 col-md-6 gallery-item" data-category="<?= $item['cat'] ?>" data-aos="zoom-in" data-aos-delay="<?= ($index % 3) * 100 ?>">
                    <div class="position-relative overflow-hidden rounded-4 shadow-sm h-100 group">
                        <img src="<?= $item['img'] ?>" alt="<?= $item['title'] ?>" class="img-fluid w-100 h-100 object-fit-cover transition-transform duration-500 hover-zoom">
                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-secondary bg-opacity-75 d-flex align-items-center justify-content-center opacity-0 transition-opacity duration-300 gallery-overlay">
                            <h4 class="text-white fw-bold mb-0"><?= $item['title'] ?></h4>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
.hover-zoom { transition: transform 0.5s ease; }
.gallery-item:hover .hover-zoom { transform: scale(1.1); }
.gallery-overlay { opacity: 0; transition: opacity 0.3s ease; cursor: pointer; }
.gallery-item:hover .gallery-overlay { opacity: 1; }
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const filterBtns = document.querySelectorAll('[data-filter]');
    const galleryItems = document.querySelectorAll('.gallery-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Remove active class
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filterValue = btn.getAttribute('data-filter');

            galleryItems.forEach(item => {
                if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                    item.style.display = 'block';
                    setTimeout(() => item.style.opacity = '1', 50);
                } else {
                    item.style.opacity = '0';
                    setTimeout(() => item.style.display = 'none', 300);
                }
            });
        });
    });
});
</script>

<?php require_once 'includes/footer.php'; ?>
