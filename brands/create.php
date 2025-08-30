<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Brand</title>
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="../style/brands_create.css">
    <style>
        /* Paste the CSS from above here or link it as a separate file */
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

        .form-container input[type="text"] {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-container input[type="text"]:focus {
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
</head>
<body>

<?php
// Ensure the database connection file path is correct relative to the script
include("../config/db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST['code'];
    $name = $_POST['name'];
    $sql = "INSERT INTO brands (code, name) VALUES ('$code', '$name')";
    if ($conn->query($sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<div class="dashboard-container">
    <header class="main-header">
        <h1 class="header-title">Brands Management</h1>
    </header>
    <nav class="main-nav">
        <ul>
            <li><a href="../brands/index.php">Brands</a></li>
            <li><a href="../categories/index.php">Categories</a></li>
            <li><a href="../items/index.php">Items</a></li>
            <li><a href="../dashboard.php">Admin Dashboard</a></li>
        </ul>
    </nav>
    <main class="content-area">
        <div class="form-container">
            <h2 class="form-title">Add New Brand</h2>
            <form method="POST">
                <input type="text" name="code" placeholder="Brand Code" required><br>
                <input type="text" name="name" placeholder="Brand Name" required><br>
                <button type="submit">Save</button>
            </form>
        </div>
    </main>
</div>

</body>
</html>