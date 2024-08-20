<!-- admin/register.php -->
<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password']; // No hashing

    $sql = "INSERT INTO admin (username, password) VALUES ('$username', '$password')";
    
    if (mysqli_query($conn, $sql)) {
        echo "Registration successful!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
    <style>
        /* styles/styles.css */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    background-color: #f8f8f8;
    color: #333;
}

h1 {
    font-size: 28px;
    color: #444;
    text-align: center;
    margin-bottom: 20px;
}

form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    margin: 0 auto;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 10px;
    color: #555;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}

button {
    background-color: #28a745;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    width: 100%;
}

button:hover {
    background-color: #218838;
}

a {
    display: block;
    text-align: center;
    margin-top: 20px;
    color: #007bff;
    text-decoration: none;
    font-size: 16px;
}

a:hover {
    text-decoration: underline;
}

/* Responsive Design */
@media (max-width: 768px) {
    form {
        padding: 15px;
    }

    h1 {
        font-size: 24px;
    }

    button {
        padding: 12px;
        font-size: 18px;
    }
}

    </style>
    <h1>Admin Registration</h1>
    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Register</button>
    </form>
    <a href="login.php">Already have an account? Login</a>
</body>
</html>
