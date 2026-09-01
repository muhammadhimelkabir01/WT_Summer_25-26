<?php

require_once __DIR__ . '/../layouts/header.php';
?>

<div style="max-width: 480px; margin: 40px auto;" class="panel">
    <h2 style="color: #003366; text-align: center; margin-bottom: 20px;">Create Institutional Account</h2>

    <?php if (!empty($error)): ?>
        <div style="background-color: #f8d7da; color: #721c24; padding: 12px; border-radius: 4px; margin-bottom: 18px; font-size: 13px;">
            <?= htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form action="index.php?route=register" method="POST" autocomplete="off">
        <div class="form-group" style="margin-bottom: 14px;">
            <label style="display: block; font-weight: 600; font-size: 13px; color: #334155; margin-bottom: 5px;">Full Name</label>
            <input type="text" name="full_name" class="auth-form-input" required autocomplete="off">
        </div>

        <div class="form-group" style="margin-bottom: 14px;">
            <label style="display: block; font-weight: 600; font-size: 13px; color: #334155; margin-bottom: 5px;">Institutional Email</label>
            <input type="email" name="email" class="auth-form-input" required autocomplete="off">
        </div>