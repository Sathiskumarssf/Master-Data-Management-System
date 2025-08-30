<?php
session_start();
include("../config/db.php");

if (!isset($_GET['id'])) {
    die("Item ID not provided.");
}
$id = intval($_GET['id']);

// Fetch item details
$stmt = $conn->prepare("SELECT * FROM items WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$item = $result->fetch_assoc();

if (!$item) {
    die("Item not found.");
}

// Fetch categories for dropdown
$categories = $conn->query("SELECT id, name FROM categories WHERE status='Active'");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $code        = $_POST['code'];
    $name        = $_POST['name'];
    $category_id = $_POST['category_id'];
    $status      = $_POST['status'];

    $update = $conn->prepare("UPDATE items SET code=?, name=?, category_id=?, status=? WHERE id=?");
    $update->bind_param("ssisi", $code, $name, $category_id, $status, $id);

    if ($update->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error updating item: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Item</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .card {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 8px 20px rgba(0,0,0,0.2);
            width: 400px;
        }
        h2 { text-align: center; margin-bottom: 20px; color: #333; }
        label { display: block; margin: 10px 0 5px; font-weight: bold; }
        input, select {
            width: 100%; padding: 10px; border-radius: 8px;
            border: 1px solid #ddd; outline: none;
        }
        button {
            margin-top: 40px; width: 100%; padding: 12px;
            border: none; border-radius: 8px;
            background: linear-gradient(90deg, #6a11cb, #2575fc);
            color: #fff; font-size: 16px; font-weight: bold; cursor: pointer;
        }
        button:hover { opacity: 0.9; }
        a { display: block; text-align: center; margin-top: 15px; color: #2575fc; font-weight: bold; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Edit Item</h2>
        <form method="POST">
            <label>Code:</label>
            <input type="text" name="code" value="<?= htmlspecialchars($item['code']) ?>" required>

            <label>Name:</label>
            <input type="text" name="name" value="<?= htmlspecialchars($item['name']) ?>" required>

            <label>Category:</label>
            <select name="category_id" required>
                <?php while($cat = $categories->fetch_assoc()): ?>
                    <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $item['category_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['name']) ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label>Status:</label>
            <select name="status">
                <option value="Active" <?= $item['status'] === 'Active' ? 'selected' : '' ?>>Active</option>
                <option value="Inactive" <?= $item['status'] === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
            </select>

            <button type="submit">Update</button>
        </form>
        <a href="index.php">⬅ Back</a>
    </div>
</body>
</html>
