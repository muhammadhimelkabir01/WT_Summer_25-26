<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusShare - Academic Equipment & Book Sharing</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, sans-serif;
        }
        body {
            background-color: #f1f5f9;
            color: #1e293b;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
            flex: 1;
            width: 100%;
        }

        /* Top Navigation */
        .navbar {
            background-color: #003366;
            padding: 14px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 51, 102, 0.15);
        }
        .navbar-brand {
            color: #ffffff;
            font-size: 20px;
            font-weight: 700;
            text-decoration: none;
            letter-spacing: 0.5px;
        }
        .navbar-links {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .navbar-links a {
            color: #e2e8f0;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
        }
        .navbar-links a:hover {
            color: #ffffff;
        }
        .user-greeting {
            color: #facc15;
            font-weight: 600;
            font-size: 13px;
        }
        .btn-logout {
            background-color: #dc2626;
            color: #ffffff !important;
            padding: 5px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
        }

        /* Generic Panels & Form Inputs */
        .panel {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
            border: 1px solid #e2e8f0;
            padding: 24px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: 600;
            font-size: 13px;
            color: #334155;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="email"], input[type="password"], input[type="number"], input[type="date"], select, textarea {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 13px;
            color: #1e293b;
            background-color: #ffffff;
            outline: none;
        }
        input:focus, select:focus, textarea:focus {
            border-color: #003366;
        }

        .btn-primary {
            background-color: #003366;
            color: #ffffff;
            padding: 9px 16px;
            border-radius: 5px;
            border: none;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary:hover {
            background-color: #002244;
        }

        /* Footer */
        .footer {
            background-color: #0f172a;
            color: #94a3b8;
            text-align: center;
            padding: 16px;
            font-size: 12px;
            margin-top: auto;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <a href="index.php?route=home" class="navbar-brand">CampusShare</a>
    <div class="navbar-links">
        <a href="index.php?route=home">Browse Items</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <a href="index.php?route=admin/dashboard">Admin Panel</a>
            <?php elseif ($_SESSION['role'] === 'owner'): ?>
                <a href="index.php?route=owner/dashboard">Owner Dashboard</a>
            <?php else: ?>
                <a href="index.php?route=student/dashboard">Student Dashboard</a>
            <?php endif; ?>
            <span class="user-greeting">Hi, <?= htmlspecialchars($_SESSION['full_name']); ?></span>
            <a href="index.php?route=logout" class="btn-logout">Logout</a>
        <?php else: ?>
            <a href="index.php?route=login">Login</a>
            <a href="index.php?route=register" style="background:#2563eb; color:#fff; padding:5px 12px; border-radius:4px;">Register</a>
        <?php endif; ?>
    </div>
</nav>

<div class="main-container">