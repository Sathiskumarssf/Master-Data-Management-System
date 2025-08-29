<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit;
}
?>

<div class="dashboard-container">
    <header class="main-header">
        <h1 class="header-title">Admin Dashboard</h1>
    </header>
    <nav class="main-nav">
        <ul>
            <li><a href="brands/index.php">Brands</a></li>
            <li><a href="categories/index.php">Categories</a></li>
            <li><a href="items/index.php">Items</a></li>
            <li><a href="auth/logout.php">Logout</a></li>
        </ul>
    </nav>
     
</div>

</body>
</html>