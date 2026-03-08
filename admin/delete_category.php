<?php
require_once '../config/db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id == 0) {
    header("Location: categories.php");
    exit;
}

// Check if category has images
$images_check = $conn->query("SELECT COUNT(*) as count FROM images WHERE category_id = $id");
$images_count = $images_check->fetch_assoc()['count'];

if ($images_count > 0) {
    // Delete associated images first
    $images = $conn->query("SELECT image_path FROM images WHERE category_id = $id");
    while ($image = $images->fetch_assoc()) {
        $file_path = '../assets/' . $image['image_path'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }
    
    $conn->query("DELETE FROM images WHERE category_id = $id");
}

// Delete category
$stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: categories.php?message=deleted");
} else {
    header("Location: categories.php?error=delete_failed");
}

$stmt->close();
?>
