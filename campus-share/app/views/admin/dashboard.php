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