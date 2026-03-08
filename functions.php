<?php
 
require_once 'config/db.php';


/**
 * Get all portfolio images grouped by category
 */
function getPortfolioItems($filter = 'all') {
    global $conn;
    
    if ($filter == 'all' || $filter == '') {
        $query = "SELECT i.*, c.slug as category 
                  FROM images i 
                  LEFT JOIN categories c ON i.category_id = c.id 
                  ORDER BY i.created_at DESC";
    } else {
        $query = "SELECT i.*, c.slug as category 
                  FROM images i 
                  LEFT JOIN categories c ON i.category_id = c.id 
                  WHERE c.slug = '$filter' 
                  ORDER BY i.created_at DESC";
    }
    
    return $conn->query($query);
}

/**
 * Get all categories
 */
function getCategories() {
    global $conn;
    return $conn->query("SELECT * FROM categories ORDER BY name ASC");
}

/**
 * Get portfolio items for AJAX filter
 */
if (isset($_GET['get_portfolio']) && $_GET['get_portfolio'] == '1') {
    header('Content-Type: application/json');
    
    $filter = $_GET['filter'] ?? 'all';
    $result = getPortfolioItems($filter);
    
    $items = [];
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
    
    echo json_encode($items);
    exit;
}

function isAdminLoggedIn() {
   
   
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header("Location: login.php");
        exit();
    }
}
?>
