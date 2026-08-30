<?php

require_once __DIR__ . '/../layouts/header.php';

$exactPayable = isset($rental['payable_amount']) ? number_format($rental['payable_amount'], 2, '.', '') : '0.00';
?>

<div style="max-width: 460px; margin: 30px auto;" class="panel">
    <h2 style="color: #003366; text-align: center; margin-bottom: 6px;">Simulated Payment Gateway</h2>
    <p style="text-align: center; color: #666; font-size: 13px; margin-bottom: 20px;">
        Item: <strong><?= htmlspecialchars($rental['title'] ?? 'Academic Equipment'); ?></strong>
    </p>

    <!-- Rental Breakdown Summary Box -->
    <div style="background: #f8fafc; padding: 14px 18px; border-radius: 8px; font-size: 13px; margin-bottom: 20px; border: 1px solid #e2e8f0;">
        <div style="display: flex; justify-content: space-between; margin-bottom: 6px;">
            <span style="color: #64748b;">Rental Duration Fee:</span>
            <strong style="color: #0f172a;">৳<?= number_format($rental['total_rent'] ?? 0, 2); ?></strong>
        </div>
        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
            <span style="color: #64748b;">Security Deposit (Refundable):</span>
            <strong style="color: #0f172a;">৳<?= number_format($rental['security_deposit'] ?? 0, 2); ?></strong>
        </div>
        <div style="display: flex; justify-content: space-between; border-top: 1px solid #e2e8f0; padding-top: 10px; font-size: 15px; color: #003366;">
            <strong>Total Payable Amount:</strong>
            <strong style="color: #003366;">৳<?= $exactPayable; ?></strong>
        </div>
    </div>

    <form action="index.php?route=student/process-payment" method="POST" autocomplete="off">
        <input type="hidden" name="rental_id" value="<?= htmlspecialchars($rental['rental_id'] ?? ''); ?>">
        
        <div class="form-group" style="margin-bottom: 16px;">
            <label style="display: block; font-weight: 600; font-size: 13px; color: #334155; margin-bottom: 6px;">Payment Method</label>
            <select name="method" required>
                <option value="bkash">bKash Mobile Wallet</option>
                <option value="nagad">Nagad Direct Pay</option>
                <option value="card">Debit / Credit Card</option>
            </select>
        </div>

        <div class="form-group" style="margin-bottom: 16px;">
            <label style="display: block; font-weight: 600; font-size: 13px; color: #334155; margin-bottom: 6px;">Fixed Payable Amount (৳)</label>
            <input type="text" name="amount" value="<?= $exactPayable; ?>" readonly style="background-color: #f1f5f9 !important; font-weight: bold; color: #003366 !important; cursor: not-allowed;">
        </div>

        <div class="form-group" style="margin-bottom: 16px;">
            <label style="display: block; font-weight: 600; font-size: 13px; color: #334155; margin-bottom: 6px;">Account / Card No.</label>
            <input type="text" name="account_number" required autocomplete="off">
        </div>

        <div class="form-group" style="margin-bottom: 22px;">
            <label style="display: block; font-weight: 600; font-size: 13px; color: #334155; margin-bottom: 6px;">PIN / OTP</label>
            <input type="password" name="pin_otp" maxlength="6" required autocomplete="new-password">
        </div>

        <button type="submit" class="btn-primary" style="width: 100%; background: #e2136e; padding: 12px; font-size: 15px; font-weight: 600; border-radius: 6px; border: none; cursor: pointer;">
            Authorize & Pay (৳<?= $exactPayable; ?>)
        </button>
    </form>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>