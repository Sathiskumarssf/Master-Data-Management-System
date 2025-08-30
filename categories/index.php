<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories | Dashboard</title>
    <link rel="stylesheet" href="../style/categories_index.css"> 
    <link rel="stylesheet" href="../style.css"> 
</head>
<body>

<div class="dashboard-container">
    <header class="main-header">
        <h1 class="header-title">Categories Management</h1>
    </header>
    <nav class="main-nav">
        <ul>
            <li><a href="../brands/index.php">Brands</a></li>
            <li><a href="../categories/index.php" class="active">Categories</a></li>
            <li><a href="../items/index.php">Items</a></li>
            <li><a href="../dashboard.php">Admin Dashboard</a></li>
        </ul>
    </nav>
    <main class="content-area">
        <h2>Categories</h2>
        <a href="create.php" class="add-new-link">Add New Category</a>
        
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include the database connection file
                include("../config/db.php");
                
                // SQL query to select all categories
                $sql = "SELECT id, code, name, status FROM categories";
                $result = $conn->query($sql);

                // Check if any rows were returned
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . htmlspecialchars($row["code"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["status"]) . "</td>";
                        echo "<td>";
                        echo "<a href='edit.php?id=" . $row["id"] . "' class='action-link edit'>Edit</a> | ";
                         echo "<a href='delete.php?id=" . $row["id"] . "' class='action-link delete'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No categories found.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </main>
</div>

</body>
</html>
