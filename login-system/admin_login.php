<?php
session_start();

// Include the database connection
require 'db.php';

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $mysqli->escape_string($_POST['email']);
    $password = $_POST['password'];

    // Query to check if the admin exists
    $result = $mysqli->query("SELECT * FROM admins WHERE email = '$email' AND password = '$password'");

    // Validate login
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Set session variables
        $_SESSION['email'] = $user['email'];
        $_SESSION['UserName'] = $user['name'];
        $_SESSION['logged_in'] = true;

        // Redirect to admin dashboard
        header("location: ../source/admin_dashboard.php");
        exit();
    } else {
        // Invalid login alert
        echo "<script>alert('Invalid email or password. Please try again.');</script>";
        header("Refresh:0; url=admin_login.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        /* Basic styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .login-container label {
            font-size: 14px;
            color: #555;
            display: block;
            margin-bottom: 5px;
            text-align: left;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .login-container button {
            width: 100%;
            padding: 10px;
            background: #007BFF;
            border: none;
            color: #fff;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .login-container button:hover {
            background: #0056b3;
        }

        .login-container p {
            margin-top: 10px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form method="POST" action="">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            <button type="submit">Login</button>
        </form>
        <p>Need help? Contact your system administrator.</p>
    </div>
</body>
</html>
