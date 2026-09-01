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

<!-- Catalog Cards Grid -->
<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 20px; margin-bottom: 40px;">
    <?php if (empty($resources)): ?>
        <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #64748b; background: #ffffff; border-radius: 8px; border: 1px dashed #cbd5e1;">
            No resources currently listed matching your criteria.
        </div>
    <?php else: ?>
        <?php foreach ($resources as $res): ?>
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
                <div>
                    <span style="display: inline-block; padding: 3px 8px; border-radius: 4px; font-size: 11px; font-weight: 700; text-transform: uppercase; margin-bottom: 10px; color: #ffffff; background-color: <?= $res['sharing_type'] === 'rent' ? '#0284c7' : '#16a34a'; ?>;">
                        <?= strtoupper(htmlspecialchars($res['sharing_type'])); ?>
                    </span>
                    <h3 style="font-size: 15px; font-weight: 700; color: #003366; margin-bottom: 6px; min-height: 40px;">
                        <?= htmlspecialchars($res['title']); ?>
                    </h3>
                    <p style="font-size: 12px; color: #64748b; margin-bottom: 10px;">
                        <?= htmlspecialchars($res['category_name'] ?? 'Academic Equipment'); ?> • Condition: <?= ucfirst(htmlspecialchars(str_replace('_', ' ', $res['item_condition']))); ?>
                    </p>
                    <p style="font-size: 13px; color: #475569; margin-bottom: 16px; line-height: 1.4; min-height: 45px;">
                        <?= htmlspecialchars(mb_strimwidth($res['description'], 0, 85, '...')); ?>
                    </p>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #f1f5f9; padding-top: 12px;">
                    <div style="font-weight: 700; font-size: 14px; color: #0f172a;">
                        <?= $res['sharing_type'] === 'rent' ? '৳' . number_format($res['daily_rate'], 2) . ' / day' : '<span style="color:#16a34a;">FREE</span>'; ?>
                    </div>
                    <a href="index.php?route=details&id=<?= $res['resource_id']; ?>" class="btn-primary" style="padding: 6px 14px; font-size: 12px; text-decoration: none;">
                        View & Request
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
