<?php

require_once __DIR__ . '/../layouts/header.php';
?>

<div style="display: grid; grid-template-columns: 2fr 1.3fr; gap: 25px;">
    <div class="panel">
        <span class="badge <?= $resource['sharing_type'] === 'rent' ? 'badge-rent' : 'badge-donate'; ?>">
            <?= strtoupper($resource['sharing_type']); ?>
        </span>
        <h2 style="color: #003366; margin-bottom: 8px;"><?= htmlspecialchars($resource['title']); ?></h2>
        <p style="font-size: 13px; color: #666;">Category: <strong><?= htmlspecialchars($resource['category_name']); ?></strong> | Condition: <strong><?= htmlspecialchars(ucfirst($resource['item_condition'])); ?></strong></p>
        <p style="font-size: 13px; color: #666; margin-top: 4px;">Owner: <strong><?= htmlspecialchars($resource['owner_name']); ?></strong> (<?= htmlspecialchars($resource['owner_email']); ?>)</p>
        
        <hr style="margin: 15px 0; border: none; border-top: 1px solid #eee;">
        
        <p style="line-height: 1.6; font-size: 14px; color: #444; margin-bottom: 20px;"><?= nl2br(htmlspecialchars($resource['description'])); ?></p>
        
        <div style="background: #f8f9fa; padding: 15px; border-radius: 4px; border-left: 4px solid #003366;">
            <?php if ($resource['sharing_type'] === 'rent'): ?>
                <p>Daily Rental Fee: <strong>৳<span id="daily_rate"><?= $resource['daily_rate']; ?></span></strong></p>
                <p style="margin-top: 4px;">Refundable Security Deposit: <strong>৳<span id="deposit_rate"><?= $resource['security_deposit']; ?></span></strong></p>
            <?php else: ?>
                <p style="color: #28a745; font-size: 16px; font-weight: bold;">Free Charitable Donation for Academic Use</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="panel">
        <?php if (!isset($_SESSION['user_id'])): ?>
            <h3 style="color: #003366; margin-bottom: 12px;">Login to Request</h3>
            <p style="font-size: 13px; color: #666; margin-bottom: 20px;">Please login with your university account to submit a request.</p>
            <a href="index.php?route=login" class="btn-primary" style="display: block; text-align: center; text-decoration: none;">Sign In Now</a>
        <?php elseif ($_SESSION['role'] === 'student'): ?>
            <?php if ($resource['sharing_type'] === 'rent'): ?>
                <h3 style="color: #003366; margin-bottom: 15px;">Book Rental Period</h3>
                <form action="index.php?route=student/request-rent" method="POST">
                    <input type="hidden" name="resource_id" value="<?= $resource['resource_id']; ?>">
                    <input type="hidden" name="daily_rate" value="<?= $resource['daily_rate']; ?>">
                    <input type="hidden" name="security_deposit" value="<?= $resource['security_deposit']; ?>">
                    
                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="date" name="start_date" id="start_date" min="<?= date('Y-m-d'); ?>" required onchange="calculateCost()">
                    </div>
                    <div class="form-group">
                        <label>End Date</label>
                        <input type="date" name="end_date" id="end_date" min="<?= date('Y-m-d'); ?>" required onchange="calculateCost()">
                    </div>

                    <div style="background: #eef5fb; padding: 14px; border-radius: 6px; margin-bottom: 15px; font-size: 13px;">
                        <p>Duration: <span id="days_count" style="font-weight: bold;">0</span> days</p>
                        <p>Total Rent: ৳<span id="total_rent_display" style="font-weight: bold;">0.00</span></p>
                        <p>Deposit: ৳<span><?= $resource['security_deposit']; ?></span></p>
                        <hr style="margin: 8px 0; border: none; border-top: 1px solid #ccc;">
                        <p style="font-size: 14px; color: #003366;"><strong>Estimated Total: ৳<span id="grand_total_display">0.00</span></strong></p>
                    </div>

                    <button type="submit" class="btn-primary" style="width: 100%;">Submit Rental Request</button>
                </form>
            <?php else: ?>
                <h3 style="color: #003366; margin-bottom: 15px;">Claim Free Donation</h3>
                <form action="index.php?route=student/request-donation" method="POST">
                    <input type="hidden" name="resource_id" value="<?= $resource['resource_id']; ?>">
                    <div class="form-group">
                        <label>Reason / Need Statement</label>
                        <textarea name="request_message" rows="4" required placeholder="Explain why you need this item..."></textarea>
                    </div>
                    <button type="submit" class="btn-primary" style="width: 100%; background-color: #28a745;">Submit Donation Request</button>
                </form>
            <?php endif; ?>
        <?php else: ?>
            <p style="color: #666; font-size: 14px;">You are currently signed in as an <strong><?= ucfirst($_SESSION['role']); ?></strong>. Switch to a Student account to book items.</p>
        <?php endif; ?>
    </div>
</div>

<script>
function calculateCost() {
    const start = document.getElementById('start_date').value;
    const end = document.getElementById('end_date').value;
    const dailyRate = parseFloat(document.getElementById('daily_rate')?.innerText || 0);
    const deposit = parseFloat(document.getElementById('deposit_rate')?.innerText || 0);

    if (start && end) {
        const d1 = new Date(start);
        const d2 = new Date(end);
        const diffTime = d2 - d1;
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;

        if (diffDays > 0) {
            const rentCost = diffDays * dailyRate;
            document.getElementById('days_count').innerText = diffDays;
            document.getElementById('total_rent_display').innerText = rentCost.toFixed(2);
            document.getElementById('grand_total_display').innerText = (rentCost + deposit).toFixed(2);
        } else {
            alert("End date must be on or after the Start date.");
            document.getElementById('end_date').value = '';
        }
    }
}
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>