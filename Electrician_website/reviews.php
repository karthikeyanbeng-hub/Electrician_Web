<?php
$page_title = "Customer Reviews";
$page_desc = "Read what our satisfied customers have to say about our professional electrical services.";
require_once 'includes/header.php';

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

$success_msg = '';
$error_msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_review'])) {
    if (!verify_csrf_token($_POST['csrf_token'])) {
        $error_msg = "Invalid form submission. Please try again.";
    } else {
        $name = sanitize_input($_POST['customer_name']);
        $rating = (int)$_POST['rating'];
        $text = sanitize_input($_POST['review_text']);
        
        if (empty($name) || empty($text) || $rating < 1 || $rating > 5) {
            $error_msg = "Please fill in all fields correctly.";
        } else {
            try {
                $stmt = $pdo->prepare("INSERT INTO reviews (customer_name, rating, review_text, is_published) VALUES (?, ?, ?, 1)");
                $stmt->execute([$name, $rating, $text]);
                $success_msg = "Thank you! Your review has been submitted successfully.";
            } catch (PDOException $e) {
                $error_msg = "Something went wrong. Please try again later.";
            }
        }
    }
}

// Fetch manual reviews from database
$stmt = $pdo->query("SELECT * FROM reviews WHERE is_published = 1 ORDER BY created_at DESC");
$reviews = $stmt ? $stmt->fetchAll() : [];
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container" data-aos="fade-up">
        <h1>Customer Reviews</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mt-3">
                <li class="breadcrumb-item"><a href="index.php" class="text-white text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active text-primary" aria-current="page">Reviews</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container mt-4">
    <?php if ($success_msg): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i> <?= htmlspecialchars($success_msg) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    
    <?php if ($error_msg): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-circle-xmark me-2"></i> <?= htmlspecialchars($error_msg) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
</div>



<!-- Published Reviews Grid -->
<section class="py-5 bg-light-gray">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-6 fw-bold mb-3">Don't Just Take My Word For It</h2>
            <p class="lead text-muted">Here is what my clients have to say about the quality of my work.</p>
        </div>
        
        <div class="row g-4">
            <?php if (count($reviews) > 0): ?>
                <?php foreach($reviews as $index => $review): ?>
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= ($index % 3) * 100 ?>">
                        <div class="review-card h-100 d-flex flex-column">
                            <div class="stars fs-5">
                                <?php for($i=1; $i<=5; $i++): ?>
                                    <?= $i <= $review['rating'] ? '&#9733;' : '&#9734;' ?>
                                <?php endfor; ?>
                            </div>
                            <div class="review-author"><?= htmlspecialchars($review['customer_name']) ?></div>
                            <div class="review-meta mb-3"><?= time_elapsed_string($review['created_at']) ?></div>
                            <p class="review-text flex-grow-1"><?= htmlspecialchars($review['review_text']) ?></p>
                            <div class="verified-badge">
                                <i class="fa-solid fa-check-circle me-1"></i> Verified Customer
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p class="text-muted fs-5">No customer reviews yet. Be the first to share your experience.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Leave a Review Section -->
<section class="py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">
                <div class="card shadow border-0 rounded-4 p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold">Leave a Review</h3>
                        <p class="text-muted">We value your feedback! Let us know how we did.</p>
                    </div>
                    <form method="POST" action="">
                        <?= csrf_field() ?>
                        <input type="hidden" name="submit_review" value="1">
                        
                        <div class="mb-3">
                            <label class="form-label fw-medium">Your Name <span class="text-danger">*</span></label>
                            <input type="text" name="customer_name" class="form-control form-control-lg" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-medium">Rating <span class="text-danger">*</span></label>
                            <div class="star-rating d-block">
                                <input type="radio" id="star5" name="rating" value="5" required />
                                <label for="star5" title="5 stars">&#9733;</label>
                                <input type="radio" id="star4" name="rating" value="4" />
                                <label for="star4" title="4 stars">&#9733;</label>
                                <input type="radio" id="star3" name="rating" value="3" />
                                <label for="star3" title="3 stars">&#9733;</label>
                                <input type="radio" id="star2" name="rating" value="2" />
                                <label for="star2" title="2 stars">&#9733;</label>
                                <input type="radio" id="star1" name="rating" value="1" />
                                <label for="star1" title="1 star">&#9733;</label>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-medium">Your Review <span class="text-danger">*</span></label>
                            <textarea name="review_text" class="form-control" rows="5" required maxlength="500" placeholder="Tell us about your experience..."></textarea>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Submit Review</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
