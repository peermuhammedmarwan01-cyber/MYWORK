<?php
require_once '../config/db.php';

$message = '';
$error = '';

// Get all categories
$categories = $conn->query("SELECT * FROM categories ORDER BY name ASC");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $category_id = intval($_POST['category_id']);

    if (empty($title) || $category_id == 0) {
        $error = 'All fields are required.';
    } elseif (!isset($_FILES['image']) || $_FILES['image']['error'] != 0) {
        $error = 'Please select an image file.';
    } else {
        $file = $_FILES['image'];
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $max_size = 5 * 1024 * 1024; // 5MB

        if (!in_array($file['type'], $allowed_types)) {
            $error = 'Invalid file type. Only JPG, PNG, GIF, and WEBP are allowed.';
        } elseif ($file['size'] > $max_size) {
            $error = 'File size exceeds 5MB limit.';
        } else {
            // Create upload directory if not exists
            $upload_dir = '../assets/uploads/portfolio/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            // Generate unique filename
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $filename = time() . '_' . uniqid() . '.' . $ext;
            $file_path = $upload_dir . $filename;

            if (move_uploaded_file($file['tmp_name'], $file_path)) {
                $relative_path = 'uploads/portfolio/' . $filename;
                
                $stmt = $conn->prepare("INSERT INTO images (title, category_id, image_path) VALUES (?, ?, ?)");
                $stmt->bind_param("sis", $title, $category_id, $relative_path);
                
                if ($stmt->execute()) {
                    $message = 'Image uploaded successfully!';
                    $_POST = [];
                } else {
                    $error = 'Error saving image to database: ' . $stmt->error;
                    unlink($file_path);
                }
                $stmt->close();
            } else {
                $error = 'Error uploading file. Please try again.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image - Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="admin-style.css">
    <style>
        .file-input-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .file-input-wrapper input[type="file"] {
            display: none;
        }

        .file-input-label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            border: 2px dashed #667eea;
            border-radius: 8px;
            background: #f8f9ff;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .file-input-label:hover {
            background: #f0f2ff;
            border-color: #764ba2;
        }

        .file-input-label i {
            font-size: 36px;
            color: #667eea;
            margin-right: 15px;
        }

        .file-input-text h3 {
            color: #333;
            margin: 0;
            font-size: 16px;
        }

        .file-input-text p {
            color: #666;
            margin: 5px 0 0;
            font-size: 14px;
        }

        .preview-section {
            margin-top: 20px;
            display: none;
        }

        .preview-section.active {
            display: block;
        }

        .preview-image {
            max-width: 200px;
            border-radius: 8px;
            margin: 10px 0;
        }

        .file-name {
            padding: 10px;
            background: #e8f5e9;
            border-radius: 5px;
            color: #2e7d32;
            margin: 10px 0;
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
                <h1>Upload Portfolio Image</h1>
                <div class="topbar-right">
                    <a href="images.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>

            <!-- Content -->
            <div class="content">
                <?php if($message): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> <?php echo $message; ?>
                    </div>
                <?php endif; ?>
                
                <?php if($error): ?>
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <div class="form-wrapper">
                    <form method="POST" enctype="multipart/form-data" class="form">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category_id" required>
                                <option value="0">-- Select a Category --</option>
                                <?php while($cat = $categories->fetch_assoc()): ?>
                                    <option value="<?php echo $cat['id']; ?>" 
                                            <?php echo (isset($_POST['category_id']) && $_POST['category_id'] == $cat['id']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($cat['name']); ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                            <?php if($categories->num_rows == 0): ?>
                                <small style="color: #ff6b6b;">
                                    <i class="fas fa-warning"></i> No categories found. Please <a href="add_category.php">add a category first</a>.
                                </small>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="title">Image Title</label>
                            <input type="text" id="title" name="title" placeholder="e.g., 2D Vinyl Design" 
                                   value="<?php echo htmlspecialchars($_POST['title'] ?? ''); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Image File</label>
                            <div class="file-input-wrapper">
                                <input type="file" id="image" name="image" accept="image/*" required>
                                <label for="image" class="file-input-label">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <div class="file-input-text">
                                        <h3>Click to upload or drag and drop</h3>
                                        <p>PNG, JPG, GIF or WEBP (max 5MB)</p>
                                    </div>
                                </label>
                            </div>
                            <div class="preview-section" id="previewSection">
                                <img id="previewImage" class="preview-image" alt="Preview">
                                <div class="file-name" id="fileName"></div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-upload"></i> Upload Image
                            </button>
                            <a href="images.php" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const fileInput = document.getElementById('image');
        const fileLabel = document.querySelector('.file-input-label');
        const previewSection = document.getElementById('previewSection');
        const previewImage = document.getElementById('previewImage');
        const fileName = document.getElementById('fileName');

        // File input change event
        fileInput.addEventListener('change', function(e) {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    previewImage.src = event.target.result;
                    fileName.innerHTML = '<i class="fas fa-check"></i> ' + file.name;
                    previewSection.classList.add('active');
                };
                reader.readAsDataURL(file);
            }
        });

        // Drag and drop
        fileLabel.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.style.borderColor = '#764ba2';
            this.style.background = '#f0f2ff';
        });

        fileLabel.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.style.borderColor = '#667eea';
            this.style.background = '#f8f9ff';
        });

        fileLabel.addEventListener('drop', function(e) {
            e.preventDefault();
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                fileInput.dispatchEvent(new Event('change'));
            }
        });
    </script>
    <script src="sidebar-toggle.js"></script>
</body>
</html>
