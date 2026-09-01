<?php

require_once __DIR__ . '/../layouts/header.php';
?>

<div style="max-width: 420px; margin: 50px auto;" class="panel">
    <h2 style="color: #003366; text-align: center; margin-bottom: 20px;">CampusShare Login</h2>

    <?php if (!empty($error)): ?>
        <div style="background-color: #f8d7da; color: #721c24; padding: 12px; border-radius: 4px; margin-bottom: 18px; font-size: 13px;">
            <?= htmlspecialchars($error); ?>
        </div>

        <?php endif; ?>

    <?php if (isset($_GET['registered'])): ?>
        <div style="background-color: #d4edda; color: #155724; padding: 12px; border-radius: 4px; margin-bottom: 18px; font-size: 13px;">
            Registration successful! Please sign in.
        </div>
        <?php endif; ?>

    <form action="index.php?route=login" method="POST" autocomplete="off">
        <div class="form-group" style="margin-bottom: 16px;">
            <label style="display: block; font-weight: 600; font-size: 13px; color: #334155; margin-bottom: 6px;">Institutional Email / Student ID</label>
            <input type="text" name="email" class="auth-form-input" required autocomplete="off">
        </div>

        <div class="form-group" style="margin-bottom: 22px;">
            <label style="display: block; font-weight: 600; font-size: 13px; color: #334155; margin-bottom: 6px;">Password</label>
            <input type="password" name="password" class="auth-form-input" required autocomplete="new-password">
        </div>