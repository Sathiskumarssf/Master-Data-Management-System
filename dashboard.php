<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        
        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            margin: 40px auto;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .form-title {
            font-size: 2em;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 25px;
            text-align: center;
        }

        .form-container input[type="text"],
        .form-container select {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-container input[type="text"]:focus,
        .form-container select:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 8px rgba(52, 152, 219, 0.2);
        }

        .form-container button[type="submit"] {
            width: 100%;
            padding: 15px;
            background-color: #2ecc71;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        .form-container button[type="submit"]:hover {
            background-color: #27ae60;
            transform: translateY(-2px);
        }

        .form-container button[type="submit"]:active {
            transform: translateY(0);
        }
        .content-area {
            flex: 1;
            padding: 40px;
        }
        .header-title {
            margin: 0;
          
            color: #ffffffff;
        }
        .cards {
            display: flex;
            gap: 20px;
            margin-top: 30px;
            flex-wrap: wrap;
        }
        .card {
            flex: 1 1 200px;
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.2s;
        }
        .card:hover { transform: translateY(-5px); }
        .card h3 {
            margin: 10px 0;
            font-size: 22px;
            color: #2c3e50;
        }
        .card p {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
            color: #27ae60;
        }
    </style>
</head>
<body>

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit;
}

include("config/db.php");

// Fetch counts
$brand_count = $conn->query("SELECT COUNT(*) AS total FROM brands")->fetch_assoc()['total'];
$category_count = $conn->query("SELECT COUNT(*) AS total FROM categories")->fetch_assoc()['total'];
$item_count = $conn->query("SELECT COUNT(*) AS total FROM items")->fetch_assoc()['total'];
?>

<div class="dashboard-container">
    <header class="main-header">
        <h1 class="header-title">Admin Dashboard</h1>
    </header>
    <nav class="main-nav">
        <ul>
            <li><a href="../brands/index.php">Brands</a></li>
            <li><a href="../categories/index.php">Categories</a></li>
            <li><a href="../items/index.php" class="active">Items</a></li>
            <li><a href="../auth/logout.php">Logout</a></li>
        </ul>
    </nav>

        <div class="cards">
            <div class="card">
                <h3>Total Brands</h3>
                <p><?= $brand_count ?></p>
            </div>
            <div class="card">
                <h3>Total Categories</h3>
                <p><?= $category_count ?></p>
            </div>
            <div class="card">
                <h3>Total Items</h3>
                <p><?= $item_count ?></p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
