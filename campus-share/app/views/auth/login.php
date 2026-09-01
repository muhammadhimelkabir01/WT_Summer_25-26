<?php

require_once __DIR__ . '/../layouts/header.php';
?>

<div style="max-width: 420px; margin: 50px auto;" class="panel">
    <h2 style="color: #003366; text-align: center; margin-bottom: 20px;">CampusShare Login</h2>

    <?php if (!empty($error)): ?>
        <div style="background-color: #f8d7da; color: #721c24; padding: 12px; border-radius: 4px; margin-bottom: 18px; font-size: 13px;">
            <?= htmlspecialchars($error); ?>
        </div>