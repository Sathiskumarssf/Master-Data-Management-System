<?php
include("../config/db.php");

if (!isset($_GET['id'])) die("Item ID not provided.");
$id = intval($_GET['id']);

$stmt = $conn->prepare("DELETE FROM items WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Error deleting item: " . $conn->error;
}
?>
