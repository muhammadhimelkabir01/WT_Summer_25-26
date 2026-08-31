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
