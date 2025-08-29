<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="../style/login.css">
    
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
session_start();
include("../config/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['is_admin'] = $user['is_admin'];
            header("Location: ../dashboard.php");
            exit;
        }
    }
    echo "Invalid email or password!";
}
?>

<form method="POST">
  <input type="email" name="email" placeholder="Email" required><br>
  <div class="password-container">
    <input type="password" name="password" id="password" placeholder="Password" required>
    <span class="toggle-password" id="togglePassword">👁️</span>
  </div>
  <button type="submit">Login</button>
  <p class="register-link">Don't have an account? <a href="register.php">Register here</a></p>
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