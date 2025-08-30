<?php
session_start();
include("../config/db.php");

if (!isset($_GET['id'])) {
    die("Brand ID not provided.");
}
$id = intval($_GET['id']);

// Delete brand
$stmt = $conn->prepare("DELETE FROM brands WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php"); // back to list
    exit;
} else {
    echo "Error deleting brand: " . $conn->error;
}
