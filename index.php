<!-- index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Estate</title>
</head>
<body>
    <style>
        /* styles.css */
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
    font-size: 36px;
    margin-bottom: 40px;
}

a {
    display: inline-block;
    margin: 10px 20px;
    padding: 12px 25px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    font-size: 18px;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

a:hover {
    background-color: #0056b3;
}

/* Responsive Design */
@media (max-width: 768px) {
    h1 {
        font-size: 28px;
    }

    a {
        margin: 10px 10px;
        padding: 10px 20px;
        font-size: 16px;
    }
}

    </style>
    <h1>Welcome to Real Estate</h1>
    <a href="login.php">Admin</a>
    <a href="filter_properties.php">See Properties</a>
</body>
</html>
