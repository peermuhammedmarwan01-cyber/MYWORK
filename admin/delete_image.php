<?php
require_once '../config/db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id == 0) {
    header("Location: images.php");
    exit;
}

// Get image
$image = $conn->query("SELECT * FROM images WHERE id = $id")->fetch_assoc();

if ($image) {
    // Delete file
    $file_path = '../assets/' . $image['image_path'];
    if (file_exists($file_path)) {
        unlink($file_path);
    }

    // Delete from database
    $stmt = $conn->prepare("DELETE FROM images WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

header("Location: images.php");
exit;
?>
