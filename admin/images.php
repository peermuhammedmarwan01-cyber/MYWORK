<?php
session_start();
require_once '../functions.php';
isAdminLoggedIn();
require_once '../config/db.php';

// Get all images with category names
$images = $conn->query("
    SELECT i.*, c.name as category_name 
    FROM images i 
    LEFT JOIN categories c ON i.category_id = c.id 
    ORDER BY i.id DESC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Images - Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="admin-style.css">
    <style>
        .image-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .image-item {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .image-item:hover {
            transform: translateY(-5px);
        }

        .image-item img {
            width: 100%;
            height: 120px;
            object-fit: cover;
        }

        .image-info {
            padding: 10px;
            font-size: 12px;
        }

        .image-title {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .image-category {
            color: #666;
            margin-bottom: 5px;
        }

        .image-actions {
            display: flex;
            gap: 5px;
            margin-top: 8px;
        }

        .image-actions a {
            flex: 1;
            padding: 4px;
            border-radius: 3px;
            font-size: 11px;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            color: white;
            transition: all 0.3s ease;
        }

        .image-actions .btn-edit {
            background: #667eea;
        }

        .image-actions .btn-delete {
            background: #ff6b6b;
        }

        .image-actions a:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <?php include 'sidebar.php'; ?>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Bar -->
            <div class="topbar">
                <h1>Portfolio Images</h1>
                <div class="topbar-right">
                    <a href="upload_image.php" class="btn btn-primary">
                        <i class="fas fa-upload"></i> Upload New Image
                    </a>
                </div>
            </div>

            <!-- Content -->
            <div class="content">
                <?php if($images->num_rows > 0): ?>
                    <p style="color: #666; margin-bottom: 20px;">Total Images: <strong><?php echo $images->num_rows; ?></strong></p>
                    
                    <div class="image-grid">
                        <?php while($image = $images->fetch_assoc()): ?>
                            <div class="image-item">
                                <img src="../assets/<?php echo htmlspecialchars($image['image_path']); ?>" 
                                     alt="<?php echo htmlspecialchars($image['title']); ?>"
                                     onerror="this.src='https://via.placeholder.com/150?text=Image+Not+Found'">
                                <div class="image-info">
                                    <div class="image-title" title="<?php echo htmlspecialchars($image['title']); ?>">
                                        <?php echo htmlspecialchars($image['title']); ?>
                                    </div>
                                    <div class="image-category">
                                        <?php echo htmlspecialchars($image['category_name'] ?? 'Uncategorized'); ?>
                                    </div>
                                    <div class="image-actions">
                                        <a href="delete_image.php?id=<?php echo $image['id']; ?>" 
                                           class="btn-delete" 
                                           onclick="return confirm('Delete this image?');">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> No images uploaded yet. <a href="upload_image.php">Upload one now</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="sidebar-toggle.js"></script>
</body>
</html>
