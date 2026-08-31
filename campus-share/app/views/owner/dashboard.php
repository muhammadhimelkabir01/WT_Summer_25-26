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
