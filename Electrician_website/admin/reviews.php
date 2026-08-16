<?php
require_once 'includes/admin_header.php';

// Handle delete
if (isset($_GET['delete']) && isset($_GET['token'])) {
    if (verify_csrf_token($_GET['token'])) {
        $id = (int)$_GET['delete'];
        $stmt = $pdo->prepare("DELETE FROM reviews WHERE id = ?");
        $stmt->execute([$id]);
        $msg = "Review deleted successfully.";
        $msg_type = "success";
    }
}

// Handle approve (set is_published = 1)
if (isset($_GET['approve']) && isset($_GET['token'])) {
    if (verify_csrf_token($_GET['token'])) {
        $id = (int)$_GET['approve'];
        $stmt = $pdo->prepare("UPDATE reviews SET is_published = 1 WHERE id = ?");
        $stmt->execute([$id]);
        $msg = "Review approved and published.";
        $msg_type = "success";
    }
}

// Handle reject (delete pending review)
if (isset($_GET['reject']) && isset($_GET['token'])) {
    if (verify_csrf_token($_GET['token'])) {
        $id = (int)$_GET['reject'];
        $stmt = $pdo->prepare("DELETE FROM reviews WHERE id = ? AND is_published = 0");
        $stmt->execute([$id]);
        $msg = "Review rejected and removed.";
        $msg_type = "danger";
    }
}

// Handle toggle publish
if (isset($_GET['toggle']) && isset($_GET['token'])) {
    if (verify_csrf_token($_GET['token'])) {
        $id = (int)$_GET['toggle'];
        $stmt = $pdo->prepare("UPDATE reviews SET is_published = NOT is_published WHERE id = ?");
        $stmt->execute([$id]);
        $msg = "Review visibility updated.";
        $msg_type = "info";
    }
}

// Handle Add New Review (admin manual add)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_review'])) {
    if (verify_csrf_token($_POST['csrf_token'])) {
        $name = sanitize_input($_POST['customer_name']);
        $rating = (int)$_POST['rating'];
        $text = sanitize_input($_POST['review_text']);
        
        $stmt = $pdo->prepare("INSERT INTO reviews (customer_name, rating, review_text, is_published) VALUES (?, ?, ?, 1)");
        $stmt->execute([$name, $rating, $text]);
        $msg = "Review added and published successfully.";
        $msg_type = "success";
    }
}

// Fetch pending reviews (customer-submitted, awaiting approval)
$pending_reviews = $pdo->query("SELECT * FROM reviews WHERE is_published = 0 ORDER BY created_at DESC")->fetchAll();

// Fetch all published/hidden reviews
$all_reviews = $pdo->query("SELECT * FROM reviews WHERE is_published = 1 ORDER BY created_at DESC")->fetchAll();

$pending_count = count($pending_reviews);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">
        Manage Reviews
        <?php if ($pending_count > 0): ?>
            <span class="badge bg-warning text-dark ms-2"><?= $pending_count ?> Pending</span>
        <?php endif; ?>
    </h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReviewModal">
        <i class="fa-solid fa-plus"></i> Add Review
    </button>
</div>

<?php if (isset($msg)): ?>
    <div class="alert alert-<?= $msg_type ?? 'success' ?> alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-<?= ($msg_type ?? 'success') === 'success' ? 'circle-check' : (($msg_type === 'danger') ? 'circle-xmark' : 'circle-info') ?> me-2"></i>
        <?= htmlspecialchars($msg) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Tabs -->
<ul class="nav nav-tabs mb-4" id="reviewTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link <?= $pending_count > 0 ? 'active' : '' ?>" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pendingTab" type="button" role="tab">
            <i class="fa-solid fa-clock me-1"></i> Pending Approval
            <?php if ($pending_count > 0): ?>
                <span class="badge bg-warning text-dark ms-1"><?= $pending_count ?></span>
            <?php endif; ?>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link <?= $pending_count === 0 ? 'active' : '' ?>" id="all-tab" data-bs-toggle="tab" data-bs-target="#allTab" type="button" role="tab">
            <i class="fa-solid fa-list me-1"></i> Published Reviews
            <span class="badge bg-secondary ms-1"><?= count($all_reviews) ?></span>
        </button>
    </li>
</ul>

<div class="tab-content" id="reviewTabsContent">

    <!-- Pending Reviews Tab -->
    <div class="tab-pane fade <?= $pending_count > 0 ? 'show active' : '' ?>" id="pendingTab" role="tabpanel">
        <?php if ($pending_count > 0): ?>
            <div class="row g-4">
                <?php foreach ($pending_reviews as $rev): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm h-100 rounded-3">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="flex-shrink-0 bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold fs-5" style="width:44px;height:44px;">
                                        <?= strtoupper(substr(htmlspecialchars($rev['customer_name']), 0, 1)) ?>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="fw-bold mb-0"><?= htmlspecialchars($rev['customer_name']) ?></h6>
                                        <div class="text-warning">
                                            <?php for($i=1;$i<=5;$i++): ?>
                                                <i class="fa-solid fa-star <?= $i <= $rev['rating'] ? '' : 'text-muted opacity-25' ?>"></i>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    <span class="badge bg-warning text-dark ms-auto">Pending</span>
                                </div>
                                <p class="text-muted mb-3 small" style="min-height:60px;">"<?= htmlspecialchars($rev['review_text']) ?>"</p>
                                <div class="text-muted small mb-3">
                                    <i class="fa-regular fa-clock me-1"></i> Submitted: <?= date('d M Y, h:i A', strtotime($rev['created_at'])) ?>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="?approve=<?= $rev['id'] ?>&token=<?= generate_csrf_token() ?>"
                                       class="btn btn-success btn-sm flex-fill"
                                       onclick="return confirm('Approve and publish this review?');">
                                        <i class="fa-solid fa-check me-1"></i> Approve
                                    </a>
                                    <a href="?reject=<?= $rev['id'] ?>&token=<?= generate_csrf_token() ?>"
                                       class="btn btn-outline-danger btn-sm flex-fill"
                                       onclick="return confirm('Reject and permanently delete this review?');">
                                        <i class="fa-solid fa-xmark me-1"></i> Reject
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="fa-solid fa-circle-check text-success fs-1 mb-3"></i>
                <p class="text-muted mb-0">No pending reviews. All caught up!</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Published Reviews Tab -->
    <div class="tab-pane fade <?= $pending_count === 0 ? 'show active' : '' ?>" id="allTab" role="tabpanel">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3">Customer</th>
                                <th class="py-3">Rating</th>
                                <th class="py-3">Review</th>
                                <th class="py-3">Date</th>
                                <th class="py-3 text-center">Status</th>
                                <th class="pe-4 py-3 text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($all_reviews) > 0): ?>
                                <?php foreach($all_reviews as $rev): ?>
                                <tr>
                                    <td class="ps-4 fw-medium"><?= htmlspecialchars($rev['customer_name']) ?></td>
                                    <td class="text-warning">
                                        <?php for($i=1; $i<=5; $i++): ?>
                                            <i class="fa-solid fa-star <?= $i <= $rev['rating'] ? '' : 'text-muted opacity-25' ?>"></i>
                                        <?php endfor; ?>
                                    </td>
                                    <td style="max-width: 280px;">
                                        <div class="text-truncate small" title="<?= htmlspecialchars($rev['review_text']) ?>">
                                            <?= htmlspecialchars($rev['review_text']) ?>
                                        </div>
                                    </td>
                                    <td class="text-muted small"><?= date('d M Y', strtotime($rev['created_at'])) ?></td>
                                    <td class="text-center">
                                        <span class="badge bg-success">Published</span>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <a href="?toggle=<?= $rev['id'] ?>&token=<?= generate_csrf_token() ?>" class="btn btn-sm btn-outline-secondary me-1" title="Hide Review">
                                            <i class="fa-solid fa-eye-slash"></i>
                                        </a>
                                        <a href="?delete=<?= $rev['id'] ?>&token=<?= generate_csrf_token() ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this review permanently?');" title="Delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="6" class="text-center py-5 text-muted">No published reviews found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Add Review Modal (Admin Manual Entry) -->
<div class="modal fade" id="addReviewModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content border-0 shadow">
      <form method="POST" action="">
          <div class="modal-header bg-light">
            <h5 class="modal-title fw-bold"><i class="fa-solid fa-pen me-2"></i>Add Manual Review</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <?= csrf_field() ?>
            <input type="hidden" name="add_review" value="1">
            <div class="mb-3">
                <label class="form-label">Customer Name</label>
                <input type="text" name="customer_name" class="form-control" placeholder="e.g. Ramesh Kumar" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Rating</label>
                <select name="rating" class="form-select">
                    <option value="5">⭐⭐⭐⭐⭐ 5 Stars</option>
                    <option value="4">⭐⭐⭐⭐ 4 Stars</option>
                    <option value="3">⭐⭐⭐ 3 Stars</option>
                    <option value="2">⭐⭐ 2 Stars</option>
                    <option value="1">⭐ 1 Star</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Review Text</label>
                <textarea name="review_text" class="form-control" rows="4" placeholder="Enter the customer's review..." required></textarea>
            </div>
            <div class="alert alert-info small mb-0 py-2">
                <i class="fa-solid fa-circle-info me-1"></i> Reviews added here are published immediately.
            </div>
          </div>
          <div class="modal-footer bg-light">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check me-1"></i>Save & Publish</button>
          </div>
      </form>
    </div>
  </div>
</div>

<?php require_once 'includes/admin_footer.php'; ?>
