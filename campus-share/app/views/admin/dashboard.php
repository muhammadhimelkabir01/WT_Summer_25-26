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