<!-- admin/dashboard.php -->
<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}


// Fetch the admin's username
$admin_id = $_SESSION['admin_id'];
$sql = "SELECT username FROM admin WHERE id = $admin_id";
$result = mysqli_query($conn, $sql);
$admin = mysqli_fetch_assoc($result);
$admin_username = $admin['username'];


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM properties WHERE id=$id";
    mysqli_query($conn, $sql);
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styles.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <style>

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    background-color: #f4f4f4;
    color: #333;
}

#admin_name{
    font-family: 'Courier New', Courier, monospace;
    font-size: 20px;
    color: #007bff;
    font-weight: bold;
}

h1 {
    font-size: 36px;
    margin-bottom: 20px;
}

h2 {
    font-size: 28px;
    margin-top: 40px;
    margin-bottom: 20px;
}

a {
    display: inline-block;
    margin-right: 20px;
    margin-bottom: 20px;
    padding: 10px 15px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
}

a:hover {
    background-color: #0056b3;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 40px;
}

th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f8f8f8;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #e9e9e9;
}

td a {
    text-decoration: none;
}

/* Responsive Design */
@media (max-width: 768px) {
    body {
        padding: 10px;
    }

    h1 {
        font-size: 28px;
    }

    h2 {
        font-size: 24px;
    }

    table {
        font-size: 14px;
    }

    th, td {
        padding: 10px;
    }
}

    </style>
    <h1>Admin Dashboard</h1>
    <p id="admin_name" title="Admin Name"><?php echo $admin_username; ?></p>
    <a href="upload_property.php">Upload New Property</a>
    <a href="logout.php">Logout</a>
    <h2>Manage Properties</h2>
    <table>
        <tr>
            <th>Property Name</th>
            <th>Owner Name</th>
            <th>Price</th>
            <th>Area</th>
            <th>Location</th>
            <th>Actions</th>
        </tr>
        <?php
        $sql = "SELECT * FROM properties";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['property_name'] . "</td>";
            echo "<td>" . $row['owner_name'] . "</td>";
            echo "<td>₹" . number_format($row['price']) . "</td>";
            echo "<td>" . $row['area'] . " sqft</td>";
            echo "<td>" . $row['location'] . "</td>";
            echo "<td>
                    <a href='edit_property.php?id=" . $row['id'] . "'>Edit</a>
                    <a href='?delete=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                  </td>";
            echo "</tr>";
        }

        mysqli_close($conn);
        ?>
    </table>
</body>
</html>
