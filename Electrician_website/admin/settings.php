<?php
require_once 'includes/admin_header.php';

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_settings'])) {
    if (verify_csrf_token($_POST['csrf_token'])) {
        $settings = [
            'contact_phone' => sanitize_input($_POST['contact_phone']),
            'contact_whatsapp' => sanitize_input($_POST['contact_whatsapp']),
            'contact_email' => sanitize_input($_POST['contact_email']),
            'contact_address' => sanitize_input($_POST['contact_address']),
            'business_hours' => sanitize_input($_POST['business_hours']),
            'facebook_url' => sanitize_input($_POST['facebook_url']),
            'twitter_url' => sanitize_input($_POST['twitter_url']),
            'instagram_url' => sanitize_input($_POST['instagram_url'])
        ];

        try {
            $stmt = $pdo->prepare("UPDATE settings SET setting_value = ? WHERE setting_key = ?");
            foreach ($settings as $key => $value) {
                $stmt->execute([$value, $key]);
            }
            $msg = "Settings updated successfully.";
        } catch (Exception $e) {
            $msg = "Error updating settings.";
        }
    }
}
?>

<div class="mb-4">
    <h4 class="fw-bold mb-0">Website Settings</h4>
</div>

<?php if ($msg): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($msg) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<form method="POST" action="">
    <?= csrf_field() ?>
    <input type="hidden" name="update_settings" value="1">
    
    <div class="row g-4">
        <!-- Contact Details -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white py-3 fw-bold">
                    Contact Details
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="contact_phone" class="form-control" value="<?= htmlspecialchars(get_setting($pdo, 'contact_phone')) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">WhatsApp Number (e.g., +919876543210)</label>
                        <input type="text" name="contact_whatsapp" class="form-control" value="<?= htmlspecialchars(get_setting($pdo, 'contact_whatsapp')) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="contact_email" class="form-control" value="<?= htmlspecialchars(get_setting($pdo, 'contact_email')) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Physical Address</label>
                        <textarea name="contact_address" class="form-control" rows="2" required><?= htmlspecialchars(get_setting($pdo, 'contact_address')) ?></textarea>
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Business Hours</label>
                        <input type="text" name="business_hours" class="form-control" value="<?= htmlspecialchars(get_setting($pdo, 'business_hours')) ?>" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Links -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white py-3 fw-bold">
                    Social Media Links
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label"><i class="fa-brands fa-facebook text-primary me-2"></i> Facebook URL</label>
                        <input type="text" name="facebook_url" class="form-control" value="<?= htmlspecialchars(get_setting($pdo, 'facebook_url')) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="fa-brands fa-twitter text-primary me-2"></i> Twitter URL</label>
                        <input type="text" name="twitter_url" class="form-control" value="<?= htmlspecialchars(get_setting($pdo, 'twitter_url')) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="fa-brands fa-instagram text-primary me-2"></i> Instagram URL</label>
                        <input type="text" name="instagram_url" class="form-control" value="<?= htmlspecialchars(get_setting($pdo, 'instagram_url')) ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-4 text-end">
        <button type="submit" class="btn btn-primary btn-lg px-5">Save Changes</button>
    </div>
</form>

<?php require_once 'includes/admin_footer.php'; ?>
