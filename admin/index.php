<?php
session_start();
require_once '../functions.php';
isAdminLoggedIn();
require_once '../config/db.php';

// Get statistics
$categories_result = $conn->query("SELECT COUNT(*) as count FROM categories");
$categories_count = $categories_result->fetch_assoc()['count'];

$images_result = $conn->query("SELECT COUNT(*) as count FROM images");
$images_count = $images_result->fetch_assoc()['count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - MR Design</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="admin-style.css">
</head>

<STyle>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .stat-card i {
        font-size: 30px;
        color: #007BFF;
        margin-bottom: 10px;
    }

    .stat-count {
        font-size: 24px;
        font-weight: bold;
        color: #333;
    }

    .stat-label {
        font-size: 14px;
        color: #777;
    }

    .action-buttons a {
        margin-right: 15px;
    }
</STyle>
<body>
    <div class="admin-container">
        <?php include 'sidebar.php'; ?>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Bar -->
            <div class="topbar">
                <h1>Dashboard</h1>
                <div class="topbar-right">
                    <span>Welcome to Admin Panel</span>
                </div>
            </div>

            <!-- Content -->
            <div class="content">
                <!-- Statistics -->
                <h2 style="margin-bottom: 20px;">Overview</h2>
                <div class="stats-grid">
                    <div class="stat-card">
                        <i class="fas fa-folder"></i>
                        <div class="stat-count"><?php echo $categories_count; ?></div>
                        <div class="stat-label">Categories</div>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-images"></i>
                        <div class="stat-count"><?php echo $images_count; ?></div>
                        <div class="stat-label">Portfolio Images</div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <h2 style="margin-bottom: 20px;">Quick Actions</h2>
                <div class="action-buttons">
                    <a href="add_category.php" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Category
                    </a>
                    <a href="upload_image.php" class="btn btn-primary">
                        <i class="fas fa-upload"></i> Upload Image
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="sidebar-toggle.js"></script>
</body>
</html>
