<?php

require_once __DIR__ . '/../layouts/header.php';
?>

<div style="text-align: center; margin-bottom: 25px;">
    <h1 style="font-size: 26px; color: #003366; margin-bottom: 6px;">Intra-Campus Peer-to-Peer Resource Sharing</h1>
    <p style="color: #64748b; font-size: 14px;">Rent academic equipment, calculators, lab kits, or claim free donated books from peers.</p>
</div>

<!-- Search & Filter Bar -->
<div class="panel" style="margin-bottom: 30px; padding: 16px 20px; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px;">
    <form action="index.php" method="GET" style="display: flex; gap: 12px; align-items: center; width: 100%; flex-wrap: wrap;">
        <input type="hidden" name="route" value="home">
        
        <input type="text" name="search" placeholder="Search by title..." value="<?= htmlspecialchars($_GET['search'] ?? ''); ?>" style="flex: 2; min-width: 180px; height: 38px; padding: 0 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
        
        <select name="category" style="flex: 1.2; min-width: 140px; height: 38px; padding: 0 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
            <option value="">All Categories</option>
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['category_id']; ?>" <?= (isset($_GET['category']) && $_GET['category'] == $cat['category_id']) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($cat['category_name']); ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>

        <select name="type" style="flex: 1.2; min-width: 140px; height: 38px; padding: 0 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
            <option value="">All Types (Rent & Donate)</option>
            <option value="rent" <?= (isset($_GET['type']) && $_GET['type'] === 'rent') ? 'selected' : ''; ?>>For Rent</option>
            <option value="donate" <?= (isset($_GET['type']) && $_GET['type'] === 'donate') ? 'selected' : ''; ?>>Free Donation</option>
        </select>

        <button type="submit" class="btn-primary" style="flex: 0.8; min-width: 100px; height: 38px; display: flex; align-items: center; justify-content: center; font-weight: 600;">Search</button>
    </form>
</div>