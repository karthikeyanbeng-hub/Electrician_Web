<?php
require_once 'includes/admin_header.php';

// Fetch stats
$enq_count = $pdo->query("SELECT COUNT(*) FROM enquiries")->fetchColumn();
$rev_count = $pdo->query("SELECT COUNT(*) FROM reviews")->fetchColumn();
$new_enq = $pdo->query("SELECT COUNT(*) FROM enquiries WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)")->fetchColumn();

// Fetch latest enquiries
$recent_enquiries = $pdo->query("SELECT * FROM enquiries ORDER BY created_at DESC LIMIT 5")->fetchAll();
?>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon"><i class="fa-solid fa-envelope"></i></div>
            <div>
                <h6 class="text-muted mb-1">Total Enquiries</h6>
                <h3 class="fw-bold mb-0"><?= $enq_count ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon"><i class="fa-solid fa-star"></i></div>
            <div>
                <h6 class="text-muted mb-1">Total Reviews</h6>
                <h3 class="fw-bold mb-0"><?= $rev_count ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon"><i class="fa-solid fa-bell"></i></div>
            <div>
                <h6 class="text-muted mb-1">New This Week</h6>
                <h3 class="fw-bold mb-0"><?= $new_enq ?></h3>
            </div>
        </div>
    </div>
</div>

<h4 class="fw-bold mb-3">Recent Enquiries</h4>
<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3">Date</th>
                        <th class="py-3">Name</th>
                        <th class="py-3">Phone</th>
                        <th class="py-3">Service</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($recent_enquiries) > 0): ?>
                        <?php foreach($recent_enquiries as $enq): ?>
                        <tr>
                            <td class="ps-4"><?= date('M d, Y', strtotime($enq['created_at'])) ?></td>
                            <td class="fw-medium"><?= htmlspecialchars($enq['name']) ?></td>
                            <td><?= htmlspecialchars($enq['phone']) ?></td>
                            <td><span class="badge bg-secondary"><?= htmlspecialchars($enq['service']) ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4" class="text-center py-4 text-muted">No recent enquiries.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white text-center py-3">
        <a href="enquiries.php" class="btn btn-sm btn-outline-primary">View All Enquiries</a>
    </div>
</div>

<?php require_once 'includes/admin_footer.php'; ?>
