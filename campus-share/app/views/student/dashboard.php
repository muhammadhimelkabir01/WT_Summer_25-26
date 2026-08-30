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
