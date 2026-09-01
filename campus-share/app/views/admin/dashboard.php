<?php

require_once __DIR__ . '/../layouts/header.php';
?>

<style>
    .admin-header {
        margin-bottom: 25px;
    }
    .admin-header h2 {
        color: #003366;
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 4px;
    }
    .admin-header p {
        color: #64748b;
        font-size: 13px;
        margin: 0;
    }

    
    .metrics-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 25px;
    }

    .metric-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 16px 20px;
        border-left: 4px solid #0284c7;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
    }
    .metric-card.card-green { border-left-color: #10b981; }
    .metric-card.card-amber { border-left-color: #f59e0b; }
    .metric-card.card-pink { border-left-color: #ec4899; }

    .metric-title {
        color: #64748b;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }

    .metric-value {
        color: #0f172a;
        font-size: 24px;
        font-weight: 700;
    }

    .custom-panel {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 20px 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
        margin-bottom: 25px;
    }

    .panel-header-title {
        color: #003366;
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 16px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 8px;
    }

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
        padding: 12px 14px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
    }

    .clean-table tbody tr:hover {
        background-color: #f8fafc;
    }

   
    .badge-status {
        display: inline-block;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .badge-active { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
    .badge-suspended { background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }
    .badge-verified { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
    .badge-pending { background: #fef3c7; color: #b45309; border: 1px solid #fde68a; }
    .badge-role { background: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; }

   
    .btn-action-suspend {
        background-color: #ef4444;
        color: #ffffff !important;
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
    }
    .btn-action-suspend:hover { background-color: #dc2626; }

    .btn-action-activate {
        background-color: #10b981;
        color: #ffffff !important;
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
    }
    .btn-action-activate:hover { background-color: #059669; }

    .admin-grid {
        display: grid;
        grid-template-columns: 340px 1fr;
        gap: 22px;
        align-items: start;
    }
</style>

<div class="admin-header">
    <h2>Administrative Control Panel</h2>
    <p>Platform governance, student ID verifications, category control, and financial analytics.</p>
</div>

<!-- Metrics Overview -->
<div class="metrics-grid">
    <div class="metric-card">
        <div class="metric-title">Total Registered Users</div>
        <div class="metric-value"><?= htmlspecialchars($totalUsers ?? 0); ?></div>
    </div>
    <div class="metric-card card-green">
        <div class="metric-title">Listed Resources</div>
        <div class="metric-value"><?= htmlspecialchars($totalResources ?? 0); ?></div>
    </div>
    <div class="metric-card card-amber">
        <div class="metric-title">Rental Bookings</div>
        <div class="metric-value"><?= htmlspecialchars($totalBookings ?? 0); ?></div>
    </div>
    <div class="metric-card card-pink">
        <div class="metric-title">Simulated Escrow Volume</div>
        <div class="metric-value" style="color: #db2777;">৳<?= number_format($totalRevenue ?? 0, 2); ?></div>
    </div>
</div>

<!-- User Governance Section -->
<div class="custom-panel">
    <div class="panel-header-title">🛡️ User Account Governance & Verification</div>
    <div class="table-container">
        <table class="clean-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Student ID</th>
                    <th>Institutional Email</th>
                    <th>Role</th>
                    <th>Verification</th>
                    <th>Status</th>
                    <th style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="7" style="text-align: center; color: #94a3b8; padding: 20px;">No registered accounts found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($users as $u): ?>
                        <tr>
                            <td><strong style="color: #0f172a;"><?= htmlspecialchars($u['full_name']); ?></strong></td>
                            <td style="font-family: monospace; color: #475569;"><?= htmlspecialchars($u['student_id']); ?></td>
                            <td><?= htmlspecialchars($u['email']); ?></td>
                            <td><span class="badge-status badge-role"><?= strtoupper(htmlspecialchars($u['role'])); ?></span></td>
                            <td>
                                <span class="badge-status <?= $u['is_verified'] ? 'badge-verified' : 'badge-pending'; ?>">
                                    <?= $u['is_verified'] ? 'Verified' : 'Pending'; ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge-status <?= $u['status'] === 'active' ? 'badge-active' : 'badge-suspended'; ?>">
                                    <?= strtoupper(htmlspecialchars($u['status'])); ?>
                                </span>
                            </td>
                            <td style="text-align: center; white-space: nowrap;">
                                <?php if ($u['status'] === 'active'): ?>
                                    <a href="index.php?route=admin/update-user&id=<?= $u['user_id']; ?>&status=suspended" class="btn-action-suspend">
                                        Suspend
                                    </a>
                                <?php else: ?>
                                    <a href="index.php?route=admin/update-user&id=<?= $u['user_id']; ?>&status=active" class="btn-action-activate">
                                        Activate
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bottom Grid: Add Category & List Categories -->
<div class="admin-grid">
    <!-- Left: Add Category Form -->
    <div class="custom-panel">
        <div class="panel-header-title">➕ Create Category</div>
        <form action="index.php?route=admin/add-category" method="POST" autocomplete="off">
            <div class="form-group">
                <label>Category Name</label>
                <input type="text" name="category_name" placeholder="e.g. Robotics & IoT" required autocomplete="off">
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="3" placeholder="Academic field notes..."></textarea>
            </div>

            <button type="submit" class="btn-primary" style="width: 100%; padding: 10px; margin-top: 5px;">Add Category</button>
        </form>
    </div>

    <!-- Right: Existing Categories -->
    <div class="custom-panel">
        <div class="panel-header-title">📂 Platform Categories</div>
        <div class="table-container">
            <table class="clean-table">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Description</th>
                        <th style="text-align: center;">Listed Items</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($categories)): ?>
                        <tr>
                            <td colspan="3" style="text-align: center; color: #94a3b8; padding: 20px;">No categories added yet.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($categories as $cat): ?>
                            <tr>
                                <td><strong style="color: #0f172a;"><?= htmlspecialchars($cat['category_name']); ?></strong></td>
                                <td style="color: #64748b;"><?= htmlspecialchars($cat['description'] ?? '—'); ?></td>
                                <td style="text-align: center; font-weight: 700; color: #0284c7;"><?= htmlspecialchars($cat['item_count'] ?? 0); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>