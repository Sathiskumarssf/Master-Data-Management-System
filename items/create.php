<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Item</title>
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="../style/items_create.css">
</head>
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
    </style>
<body>

<?php
include("../config/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST['code'];
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $status = $_POST['status'];

    $sql = "INSERT INTO items (code, name, category_id, status) VALUES ('$code', '$name', '$category_id', '$status')";
    if ($conn->query($sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch categories for dropdown
$categories = $conn->query("SELECT id, name FROM categories WHERE status='Active'");
?>

<div class="dashboard-container">
    <header class="main-header">
        <h1 class="header-title">Items Management</h1>
    </header>
    <nav class="main-nav">
        <ul>
            <li><a href="../brands/index.php">Brands</a></li>
            <li><a href="../categories/index.php">Categories</a></li>
            <li><a href="../items/index.php" class="active">Items</a></li>
            <li><a href="../dashboard.php">Admin Dashboard</a></li>
        </ul>
    </nav>
    <main class="content-area">
        <div class="form-container">
            <h2 class="form-title">Add New Item</h2>
            <form method="POST">
                <input type="text" name="code" placeholder="Item Code" required><br>
                <input type="text" name="name" placeholder="Item Name" required><br>
                <select name="category_id" required>
                    <option value="">Select Category</option>
                    <?php while($cat = $categories->fetch_assoc()): ?>
                        <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                    <?php endwhile; ?>
                </select><br>
                <select name="status" required>
                    <option value="Active" selected>Active</option>
                    <option value="Inactive">Inactive</option>
                </select><br>
                <button type="submit">Save</button>
            </form>
        </div>
    </main>
</div>

</body>
</html>
