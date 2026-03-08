<?php
require_once '../config/db.php';
session_start();

// Simple registration logic for admin user

if(isset($_POST['username'], $_POST['password'], $_POST['confirm_password'])) {
    $username = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $register_error = "Passwords do not match.";
    } else {
        // Check if username already exists
        $stmt = $conn->prepare("SELECT id FROM admin WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $register_error = "Username already exists.";
        } else {
            // Insert new admin user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO admin (email, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashed_password);
            
            if ($stmt->execute()) {
                $register_success = "Admin user registered successfully!";
            } else {
                $register_error = "Error registering user: " . $stmt->error;
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <style>
        body {
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .register-box {
            background: #fff;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            width: 340px;
        }
        .register-box h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .register-box input[type="text"],
        .register-box input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .register-box input[type="submit"] {
            width: 100%;
            padding: 10px;
            background: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .error {
            color: #d00;
            margin-bottom: 10px;
            text-align: center;
        }
        .success {
            color: #28a745;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="register-box">
        <h2>Admin Registration</h2>
     
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <input type="submit" name="register" value="Register">
        </form>
        <div style="text-align:center;margin-top:10px;">
            <a href="login.php">Back to Login</a>
        </div>
    </div>
</body>
</html>
