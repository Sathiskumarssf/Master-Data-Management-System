<?php
session_start();
include("../config/db.php");

if (!isset($_GET['id'])) {
    die("Category ID not provided.");
}

$id = intval($_GET['id']);

// Delete category
$stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php"); // Redirect back to list
    exit;
} else {
    echo "Error deleting category: " . $conn->error;
}
?>
