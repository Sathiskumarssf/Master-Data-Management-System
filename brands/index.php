<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brands | Dashboard</title>
    <link rel="stylesheet" href="../style/brands_index.css"> 
    <link rel="stylesheet" href="../style.css"> 
</head>
<body>

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
        <h2>Brands</h2>
        <a href="create.php" class="add-new-link">Add New Brand</a>
        
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include the database connection file
                include("../config/db.php");
                
                // SQL query to select all brands
                $sql = "SELECT id, name FROM brands";
                $result = $conn->query($sql);

                // Check if any rows were returned
                if ($result->num_rows > 0) {
                    // Loop through each row of the result set
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>";
                        echo "<a href='edit.php?id=" . $row["id"] . "' class='action-link edit'>Edit</a> | ";
                        echo "<a href='delete.php?id=" . $row["id"] . "' class='action-link delete'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    // Display a message if no brands are found
                    echo "<tr><td colspan='3'>No brands found.</td></tr>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </main>
</div>

</body>
</html>