<?php
/**
 * Admin Sidebar Component
 * Include this file at the top of the body in your admin pages
 * 
 * Usage: <?php include 'sidebar.php'; ?>
 */
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!-- Sidebar -->
<aside class="sidebar">
    <div class="logo-section">
        <h2>MR DESIGN</h2>
        <p style="font-size: 12px; opacity: 0.8;">Admin Panel</p>
    </div>
    <ul class="nav-menu">
        <li><a href="index.php" <?php echo $current_page === 'index.php' ? 'class="active"' : ''; ?>><i class="fas fa-dashboard"></i> Dashboard</a></li>
        <li><a href="categories.php" <?php echo in_array($current_page, ['categories.php', 'add_category.php', 'edit_category.php']) ? 'class="active"' : ''; ?>><i class="fas fa-list"></i> Categories</a></li>
        <li><a href="images.php" <?php echo in_array($current_page, ['images.php', 'upload_image.php']) ? 'class="active"' : ''; ?>><i class="fas fa-image"></i> Portfolio Images</a></li>
        <li><a href="../index.php" target="_blank"><i class="fas fa-globe"></i> View Website</a></li>
        <li><a href="logout.php" style="color: #ff6b6b;"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
</aside>

<!-- Mobile Sidebar Toggle Button -->
<button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
    <i class="fas fa-bars"></i>
</button>

<!-- Sidebar Overlay for Mobile -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>
