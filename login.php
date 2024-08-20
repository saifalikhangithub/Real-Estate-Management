<!-- admin/login.php -->
<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $admin = mysqli_fetch_assoc($result);

    if ($admin && $password == $admin['password']) { // No password hashing
        $_SESSION['admin_id'] = $admin['id'];
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Invalid credentials!";
    }

    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
    text-align: center;
}

h1 {
    color: #333;
    font-size: 32px;
    margin-bottom: 20px;
}

form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 100%;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 8px;
    text-align: left;
}

input[type="text"],
input[type="password"] {
    width: calc(100% - 22px);
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    width: 100%;
}

button:hover {
    background-color: #0056b3;
}

a {
    display: inline-block;
    margin-top: 20px;
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

/* Responsive Design */
@media (max-width: 768px) {
    h1 {
        font-size: 28px;
    }

    form {
        padding: 15px;
    }

    button {
        font-size: 14px;
    }
}

    </style>
    <h1>Admin Login</h1>
    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>
<!--<a href="register.php">Don't have an account? Register</a>-->
    <a href="index.php">Home</a>
</body>
</html>
