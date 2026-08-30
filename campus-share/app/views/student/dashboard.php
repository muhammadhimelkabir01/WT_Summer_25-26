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