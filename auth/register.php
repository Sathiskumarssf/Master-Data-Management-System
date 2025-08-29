<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="../style/register.css">
    <style>
        /* Add this to your register.css or in a style block */
        .password-container {
            position: relative;
            width: 100%;
            margin-bottom: 20px;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 35%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 1.2rem;
            color: #888;
            user-select: none; /* Prevents text selection */
        }
    </style>
</head>
<body>

<?php
 
include("../config/db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name','$email','$password')";
    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
        exit(); // Always use exit() after a header redirect
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form method="POST">
  <input type="text" name="name" placeholder="Name" required><br>
  <input type="email" name="email" placeholder="Email" required><br>
  <div class="password-container">
    <input type="password" name="password" id="password" placeholder="Password" required>
    <span class="toggle-password" id="togglePassword">👁️</span>
  </div>
  <button type="submit">Register</button>
  <p class="login-link"> Have an account? <a href="login.php">Login here</a></p>
</form>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    togglePassword.addEventListener('click', function (e) {
        // Toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        // Toggle the icon
        this.textContent = type === 'password' ? '👁️' : '🙈';
    });
</script>

</body>
</html>