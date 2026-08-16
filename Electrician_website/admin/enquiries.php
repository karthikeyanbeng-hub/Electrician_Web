<?php
require_once 'includes/admin_header.php';

// Handle deletion
if (isset($_GET['delete']) && isset($_GET['token'])) {
    if (verify_csrf_token($_GET['token'])) {
        $id = (int)$_GET['delete'];
        $stmt = $pdo->prepare("DELETE FROM enquiries WHERE id = ?");
        $stmt->execute([$id]);
        $msg = "Enquiry deleted successfully.";
    }
}

// Fetch all enquiries
$enquiries = $pdo->query("SELECT * FROM enquiries ORDER BY created_at DESC")->fetchAll();
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Manage Enquiries</h4>
</div>

<?php if (isset($msg)): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($msg) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3">Date</th>
                        <th class="py-3">Name</th>
                        <th class="py-3">Contact</th>
                        <th class="py-3">Service</th>
                        <th class="py-3">Message</th>
                        <th class="pe-4 py-3 text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($enquiries) > 0): ?>
                        <?php foreach($enquiries as $enq): ?>
                        <tr>
                            <td class="ps-4" style="white-space: nowrap;"><?= date('d M Y, h:i A', strtotime($enq['created_at'])) ?></td>
                            <td class="fw-medium"><?= htmlspecialchars($enq['name']) ?></td>
                            <td>
                                <div><i class="fa-solid fa-phone small text-muted"></i> <?= htmlspecialchars($enq['phone']) ?></div>
                                <?php if($enq['email']): ?>
                                <div><i class="fa-solid fa-envelope small text-muted"></i> <?= htmlspecialchars($enq['email']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td><span class="badge bg-secondary"><?= htmlspecialchars($enq['service']) ?></span></td>
                            <td style="max-width: 250px;">
                                <div class="text-truncate" title="<?= htmlspecialchars($enq['message']) ?>">
                                    <?= htmlspecialchars($enq['message']) ?>
                                </div>
                                <?php if($enq['address']): ?>
                                    <div class="small text-muted mt-1"><i class="fa-solid fa-location-dot"></i> <?= htmlspecialchars($enq['address']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td class="pe-4 text-end">
                                <a href="?delete=<?= $enq['id'] ?>&token=<?= generate_csrf_token() ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this enquiry?');">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="text-center py-5 text-muted">No enquiries found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once 'includes/admin_footer.php'; ?>
