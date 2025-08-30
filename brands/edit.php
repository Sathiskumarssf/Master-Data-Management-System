<?php
session_start();
include("../config/db.php");

// Check if ID is provided
if (!isset($_GET['id'])) {
    die("Brand ID not provided.");
}
$id = intval($_GET['id']); 

// Fetch brand details
$stmt = $conn->prepare("SELECT * FROM brands WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$brand = $result->fetch_assoc();

if (!$brand) {
    die("Brand not found.");
}

// Handle update request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $code   = $_POST['code'];
    $name   = $_POST['name'];
    $status = $_POST['status'];

    $update = $conn->prepare("UPDATE brands SET code=?, name=?, status=? WHERE id=?");
    $update->bind_param("sssi", $code, $name, $status, $id);

    if ($update->execute()) {
        header("Location: index.php"); // go back to list
        exit;
    } else {
        echo "Error updating brand: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Brand</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
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
            animation: fadeIn 0.6s ease-in-out;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-weight: bold;
            display: block;
            margin: 12px 0 6px;
            color: #444;
        }

        input[type="text"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
            transition: 0.3s;
        }

        input[type="text"]:focus, select:focus {
            border-color: #2575fc;
            box-shadow: 0px 0px 6px rgba(37,117,252,0.6);
        }

        button {
            margin-top: 40px;
            width: 100%;
            background: linear-gradient(90deg, #6a11cb, #2575fc);
            border: none;
            color: white;
            padding: 12px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        a {
            display: inline-block;
            margin-top: 15px;
            text-align: center;
            width: 100%;
            color: #2575fc;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: scale(0.9);}
            to {opacity: 1; transform: scale(1);}
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Edit Brand</h2>
        <form method="POST">
            <label>Code:</label>
            <input type="text" name="code" value="<?= htmlspecialchars($brand['code']) ?>" required>

            <label>Name:</label>
            <input type="text" name="name" value="<?= htmlspecialchars($brand['name']) ?>" required>

            <label>Status:</label>
            <select name="status">
                <option value="Active" <?= $brand['status'] === 'Active' ? 'selected' : '' ?>>Active</option>
                <option value="Inactive" <?= $brand['status'] === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
            </select>

            <button type="submit">Update</button>
        </form>
        <a href="index.php">⬅ Back</a>
    </div>
</body>
</html>
