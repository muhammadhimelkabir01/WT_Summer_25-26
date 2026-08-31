<?php
// app/views/owner/dashboard.php
require_once __DIR__ . '/../layouts/header.php';
?>

<style>
    .owner-header {
        margin-bottom: 25px;
    }
    .owner-header h2 {
        color: #003366;
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 4px;
    }
    .owner-header p {
        color: #64748b;
        font-size: 13px;
        margin: 0;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: 360px 1fr;
        gap: 25px;
        align-items: start;
    }

    .custom-panel {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 22px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        margin-bottom: 25px;
    }

    .panel-header-title {
        color: #003366;
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 18px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 8px;
    }

     /* Table Styling */
    .table-container {
        width: 100%;
        overflow-x: auto;
    }

    .clean-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    .clean-table th {
        background-color: #f8fafc;
        color: #475569;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 12px 14px;
        text-align: left;
        border-bottom: 2px solid #e2e8f0;
        white-space: nowrap;
    }

    .clean-table td {
        padding: 14px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
    }

    .clean-table tbody tr:hover {
        background-color: #f8fafc;
    }

    /* Status Badges */
    .badge-status {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .badge-paid {
        background: #dcfce7;
        color: #15803d;
        border: 1px solid #bbf7d0;
    }

    .badge-unpaid {
        background: #fee2e2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }

    .badge-pending {
        background: #fef3c7;
        color: #b45309;
        border: 1px solid #fde68a;
    }

    .badge-accepted {
        background: #e0f2fe;
        color: #0369a1;
        border: 1px solid #bae6fd;
    }

    .badge-handed {
        background: #ede9fe;
        color: #6d28d9;
        border: 1px solid #ddd6fe;
    }

    .badge-returned {
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #cbd5e1;
    }

    /* Action Buttons */
    .btn-action-accept {
        background-color: #0284c7;
        color: #ffffff !important;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
    }
    .btn-action-accept:hover { background-color: #0369a1; }

    .btn-action-handover {
        background-color: #7c3aed;
        color: #ffffff !important;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
    }

     }
    .btn-action-handover:hover { background-color: #6d28d9; }

    .btn-action-return {
        background-color: #16a34a;
        color: #ffffff !important;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
    }
    .btn-action-return:hover { background-color: #15803d; }

    .student-chip {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }
    .student-chip strong {
        color: #0f172a;

         }
    .student-chip a {
        color: #0284c7;
        text-decoration: none;
        font-size: 11px;
    }
</style>

<div class="owner-header">
    <h2>Resource Owner Dashboard</h2>
    <p>Manage listings, accept student bookings, and update handover lifecycle.</p>
</div>

<!-- Section 1: Incoming Rental Requests -->
<div class="custom-panel">
    <div class="panel-header-title"> Incoming Rental Requests from Students</div>

    <?php if (empty($incomingRentals)): ?>
        <p style="color: #64748b; font-size: 13px; margin: 5px 0;">No student rental requests received yet.</p>
    <?php else: ?>
        <div class="table-container">
            <table class="clean-table">
                <thead>
                    <tr>

                     <th>Item</th>
                        <th>Requested By</th>
                        <th>Duration</th>
                        <th>Payment</th>
                        <th>Booking Status</th>
                        <th style="text-align: center;">Manage Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($incomingRentals as $req): ?>
                        <tr>
                            <td><strong style="color: #0f172a;"><?= htmlspecialchars($req['title']); ?></strong></td>
                            <td>
                                <div class="student-chip">
                                    <strong><?= htmlspecialchars($req['student_name']); ?></strong>
                                    <a href="mailto:<?= htmlspecialchars($req['student_email']); ?>">
                                        ✉ <?= htmlspecialchars($req['student_email']); ?>
                                    </a>
                                </div>
                            </td>
                            <td style="color: #475569; white-space: nowrap;">
                                <?= htmlspecialchars($req['start_date']); ?> <span style="color:#94a3b8;">to</span> <?= htmlspecialchars($req['end_date']); ?>
                            </td>
                            <td>

             <?php if (!empty($req['payment_status']) && strtolower($req['payment_status']) === 'paid'): ?>
                                    <span class="badge-status badge-paid">Paid</span>
                                <?php else: ?>
                                    <span class="badge-status badge-unpaid">Unpaid</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php 
                                    $st = strtolower($req['status']);
                                    $badgeClass = 'badge-pending';
                                    if ($st === 'accepted') $badgeClass = 'badge-accepted';
                                    elseif ($st === 'handed_over') $badgeClass = 'badge-handed';
                                    elseif ($st === 'returned') $badgeClass = 'badge-returned';
                                ?>
                                <span class="badge-status <?= $badgeClass; ?>">
                                    <?= strtoupper(str_replace('_', ' ', $req['status'])); ?>
                                </span>
                            </td>
                            <td style="text-align: center; white-space: nowrap;">
                                <?php if ($st === 'pending'): ?>
                                    <a href="index.php?route=owner/update-status&id=<?= $req['rental_id']; ?>&status=accepted" class="btn-action-accept">
                                        Accept Request
                                    </a>
   <?php elseif ($st === 'accepted'): ?>
                                    <a href="index.php?route=owner/update-status&id=<?= $req['rental_id']; ?>&status=handed_over" class="btn-action-handover">
                                        Mark Handed Over
                                    </a>
                                <?php elseif ($st === 'handed_over'): ?>
                                    <a href="index.php?route=owner/update-status&id=<?= $req['rental_id']; ?>&status=returned" class="btn-action-return">
                                        Confirm Return
                                    </a>
                                <?php else: ?>
                                    <span style="color: #94a3b8; font-weight: 600; font-size: 12px;">Completed</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<!-- Section 2: Split Layout (Post Resource & Listed Catalog) -->
<div class="dashboard-grid">
    
    <!-- Left: Post Resource Form -->
    <div class="custom-panel">
        <div class="panel-header-title">➕ Post New Resource</div>
        <form action="index.php?route=owner/post-item" method="POST" autocomplete="off">
            <div class="form-group">
                <label>Item Title</label>
                <input type="text" name="title" required autocomplete="off">
            </div>
             <div class="form-group">
                <label>Category</label>
                <select name="category_id" required>
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $c): ?>
                        <option value="<?= $c['category_id']; ?>"><?= htmlspecialchars($c['category_name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Item Condition</label>
                <select name="item_condition" required>
                    <option value="brand_new">Brand New</option>
                    <option value="like_new">Like New</option>
                    <option value="used">Used</option>
                    <option value="fair">Fair</option>
                </select>
            </div>

            <div class="form-group">
                <label>Sharing Type</label>
                <select name="sharing_type" required>
                    <option value="rent">For Rent</option>
                    <option value="donate">Free Donation</option>
                </select>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                <div class="form-group">
                    <label>Daily Rate (৳)</label>
                    <input type="number" step="0.01" name="daily_rate" value="0.00" required>
                </div>
                <div class="form-group">
                    <label>Deposit (৳)</label>
                    <input type="number" step="0.01" name="security_deposit" value="0.00" required>
                </div>
            </div>                                   
