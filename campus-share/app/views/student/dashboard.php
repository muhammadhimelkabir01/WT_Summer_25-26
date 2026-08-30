<?php
require_once __DIR__ . '/../layouts/header.php';
?>

<style>
    .dashboard-header {
        margin-bottom: 25px;
    }
    .dashboard-title {
        color: #0f172a;
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 6px;
    }
    .dashboard-subtitle {
        color: #64748b;
        font-size: 14px;
        margin: 0;
    }
    
    .custom-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
        padding: 24px;
        margin-bottom: 30px;
    }

    .card-title {
        color: #1e293b;
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 2px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }

    .dash-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin: 0;
    }

    .dash-table th {
        background-color: #f8fafc;
        color: #475569;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 14px 16px;
        text-align: left;
        border-bottom: 1px solid #cbd5e1;
        white-space: nowrap;
    }

    .dash-table td {
        padding: 16px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        font-size: 14px;
        white-space: nowrap;
    }

    .dash-table tbody tr:hover {
        background-color: #f8fafc;
        transition: background-color 0.2s ease;
    }

    .owner-info {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .owner-name {
        font-weight: 600;
        color: #0f172a;
    }
    .owner-email-chip {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background-color: #eff6ff;
        color: #1d4ed8;
        border: 1px solid #bfdbfe;
        padding: 3px 8px;
        border-radius: 6px;
        font-size: 11px;
        text-decoration: none;
        font-weight: 500;
        width: fit-content;
    }
    .owner-email-chip:hover {
        background-color: #dbeafe;
    }

    .badge-soft-success {
        background-color: #dcfce7;
        color: #15803d;
        border: 1px solid #bbf7d0;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }

    .badge-soft-warning {
        background-color: #fef3c7;
        color: #b45309;
        border: 1px solid #fde68a;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }

    .btn-pay-now {
        background: linear-gradient(135deg, #e2136e 0%, #c2105e 100%);
        color: white !important;
        padding: 6px 14px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        box-shadow: 0 2px 6px rgba(226, 19, 110, 0.25);
        display: inline-block;
    }
    .btn-pay-now:hover {
        opacity: 0.95;
    }

    .btn-cancel-link {
        color: #ef4444;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        padding: 4px 8px;
        border-radius: 4px;
    }
    .btn-cancel-link:hover {
        background-color: #fef2f2;
    }
</style>

<div class="dashboard-header">
    <h2 class="dashboard-title">Student Dashboard</h2>
    <p class="dashboard-subtitle">Track your active rental bookings, donation claims, and payment receipts.</p>
</div>

<?php if (isset($_GET['paid'])): ?>
    <div style="background-color: #dcfce7; color: #15803d; padding: 14px 18px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; border: 1px solid #bbf7d0;">
        ✓ Payment Successful! Your Simulated TXN-ID: <strong><?= htmlspecialchars($_GET['txnid'] ?? 'N/A'); ?></strong>
    </div>
<?php endif; ?>

<?php if (isset($_GET['cancelled'])): ?>
    <div style="background-color: #fef3c7; color: #b45309; padding: 14px 18px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; border: 1px solid #fde68a;">
        ⓘ Booking request cancelled successfully.
    </div>
<?php endif; ?>

<!-- Section 1: Rental Bookings -->
<div class="custom-card">
    <div class="card-title"> My Rental Bookings</div>
    
    <?php if (empty($rentals)): ?>
        <p style="color: #64748b; font-size: 14px; margin: 10px 0;">No active rental requests found. <a href="index.php?route=home" style="color: #2563eb; font-weight: 600;">Browse catalog</a> to rent academic items.</p>
    <?php else: ?>
        <div class="table-responsive">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>Item Title</th>
                        <th>Owner Contact</th>
                        <th>Rental Duration</th>
                        <th>Total Rent</th>
                        <th>Deposit</th>
                        <th>Payment Status</th>
                        <th>Booking Status</th>
                        <th style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rentals as $r): ?>
                        <tr>
                            <td>
                                <strong style="color: #0f172a; font-size: 15px;"><?= htmlspecialchars($r['title']); ?></strong>
                            </td>
                            <td>
                                <div class="owner-info">
                                    <span class="owner-name"><?= htmlspecialchars($r['owner_name']); ?></span>
                                    <a href="mailto:<?= htmlspecialchars($r['owner_email']); ?>" class="owner-email-chip">
                                        ✉ <?= htmlspecialchars($r['owner_email']); ?>
                                    </a>
                                </div>
                            </td>
                            <td style="color: #475569;">
                                <?= htmlspecialchars($r['start_date']); ?> <span style="color:#94a3b8;">to</span> <?= htmlspecialchars($r['end_date']); ?>
                            </td>
                            <td><strong style="color: #0f172a;">৳<?= number_format($r['total_rent'], 2); ?></strong></td>
                            <td style="color: #64748b;">৳<?= number_format($r['security_deposit'], 2); ?></td>
                            <td>
                                <?php if (!empty($r['payment_status']) && strtolower(trim($r['payment_status'])) === 'paid'): ?>
                                    <span class="badge-soft-success" title="TXN: <?= htmlspecialchars($r['transaction_id'] ?? ''); ?>">
                                        ✓ Paid (<?= htmlspecialchars($r['transaction_id'] ?? ''); ?>)
                                    </span>
                                <?php else: ?>
                                    <a href="index.php?route=student/checkout&rental_id=<?= $r['rental_id']; ?>" class="btn-pay-now">
                                        Pay Now
                                    </a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="badge-soft-warning">
                                    <?= strtoupper(htmlspecialchars($r['status'])); ?>
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <?php if ($r['status'] === 'pending'): ?>
                                    <a href="index.php?route=student/cancel-rental&id=<?= $r['rental_id']; ?>" 
                                       class="btn-cancel-link"
                                       onclick="return confirm('Are you sure you want to cancel this booking?');">
                                        Cancel
                                    </a>
                                <?php else: ?>
                                    <span style="color: #94a3b8; font-size: 13px;">Locked</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<!-- Section 2: Free Donation Claims -->
<div class="custom-card">
    <div class="card-title"> My Free Donation Claims</div>
    <?php if (empty($donations)): ?>
        <p style="color: #64748b; font-size: 14px; margin: 10px 0;">No donation requests submitted yet.</p>
    <?php else: ?>
        <div class="table-responsive">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>Item Title</th>
                        <th>Claimed From</th>
                        <th>Your Message / Reason</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($donations as $d): ?>
                        <tr>
                            <td><strong style="color: #0f172a;"><?= htmlspecialchars($d['title']); ?></strong></td>
                            <td><?= htmlspecialchars($d['owner_name']); ?></td>
                            <td style="color: #475569;"><?= htmlspecialchars($d['request_message']); ?></td>
                            <td>
                                <span class="badge-soft-warning">
                                    <?= strtoupper(htmlspecialchars($d['status'])); ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>