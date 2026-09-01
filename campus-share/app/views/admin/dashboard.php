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