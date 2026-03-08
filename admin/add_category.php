<?php
require_once '../config/db.php';

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $slug = trim($_POST['slug']);

    if (empty($name) || empty($slug)) {
        $error = 'All fields are required.';
    } else {
        // Check if slug already exists
        $check = $conn->query("SELECT id FROM categories WHERE slug = '$slug'");
        if ($check->num_rows > 0) {
            $error = 'Category slug already exists.';
        } else {
            $stmt = $conn->prepare("INSERT INTO categories (name, slug) VALUES (?, ?)");
            $stmt->bind_param("ss", $name, $slug);
            
            if ($stmt->execute()) {
                $message = 'Category added successfully!';
                $_POST = []; // Clear form
            } else {
                $error = 'Error adding category: ' . $stmt->error;
            }
            $stmt->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category - Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>
    <div class="admin-container">
        <?php include 'sidebar.php'; ?>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Bar -->
            <div class="topbar">
                <h1>Add New Category</h1>
                <div class="topbar-right">
                    <a href="categories.php" class="btn btn-secondary">
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
                    <form method="POST" class="form">
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" id="name" name="name" placeholder="e.g., Vector, Raster, UI/UX" 
                                   value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="slug">Category Slug</label>
                            <input type="text" id="slug" name="slug" placeholder="e.g., vector, raster, uiux"
                                   value="<?php echo htmlspecialchars($_POST['slug'] ?? ''); ?>" required>
                            <small>URL-friendly version of category name (no spaces)</small>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Add Category
                            </button>
                            <a href="categories.php" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="sidebar-toggle.js"></script>
</body>
</html>
