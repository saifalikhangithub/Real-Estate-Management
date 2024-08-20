<!-- admin/edit_property.php -->
<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM properties WHERE id=$id";
$result = mysqli_query($conn, $sql);
$property = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $property_name = $_POST['property_name'];
    $owner_name = $_POST['owner_name'];
    $contact_number = $_POST['contact_number'];
    $address = $_POST['address'];
    $price = $_POST['price'];
    $area = $_POST['area'];
    $location = $_POST['location'];

    $photos = $property['photos']; // Keep existing photos
    if (!empty($_FILES['photos']['name'][0])) {
        $uploaded_photos = [];
        foreach ($_FILES['photos']['name'] as $key => $name) {
            $target_dir = "../uploads/photos/";
            $target_file = $target_dir . basename($name);
            move_uploaded_file($_FILES['photos']['tmp_name'][$key], $target_file);
            $uploaded_photos[] = $target_file;
        }
        $photos = json_encode($uploaded_photos);
    }

    $target_video = $property['video']; // Keep existing video
    if (!empty($_FILES['video']['name'])) {
        $target_video = "../uploads/videos/" . basename($_FILES['video']['name']);
        move_uploaded_file($_FILES['video']['tmp_name'], $target_video);
    }

    $sql = "UPDATE properties SET 
            property_name='$property_name',
            owner_name='$owner_name',
            contact_number='$contact_number',
            address='$address',
            price='$price',
            area='$area',
            location='$location',
            video='$target_video',
            photos='$photos'
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "Property updated successfully!";
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
    <title>Edit Property</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
    <style>
        /* styles/styles.css */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    background-color: #f4f4f4;
    color: #333;
}

h1 {
    font-size: 28px;
    color: #444;
    margin-bottom: 20px;
    text-align: center;
}

form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    margin: auto;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 10px;
    color: #555;
}

input[type="text"],
input[type="number"],
input[type="file"],
textarea,
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}

textarea {
    resize: vertical;
    height: 100px;
}

button {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #0056b3;
}

a {
    display: block;
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
        width: 100%;
        padding: 12px;
        font-size: 18px;
    }
}

    </style>
    <h1>Edit Property</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="property_name">Property Name:</label>
        <input type="text" id="property_name" name="property_name" value="<?php echo $property['property_name']; ?>" required>

        <label for="owner_name">Owner Name:</label>
        <input type="text" id="owner_name" name="owner_name" value="<?php echo $property['owner_name']; ?>" required>

        <label for="contact_number">Contact Number:</label>
        <input type="text" id="contact_number" name="contact_number" value="<?php echo $property['contact_number']; ?>">

        <label for="address">Address:</label>
        <textarea id="address" name="address" required><?php echo $property['address']; ?></textarea>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="<?php echo $property['price']; ?>" required>

        <label for="area">Area (sqft):</label>
        <input type="number" id="area" name="area" value="<?php echo $property['area']; ?>" required>

        <label for="location">Location:</label>
        <select id="location" name="location" required>
            <option value="Mumbai" <?php echo $property['location'] == 'Mumbai' ? 'selected' : ''; ?>>Mumbai</option>
            <option value="Thane" <?php echo $property['location'] == 'Thane' ? 'selected' : ''; ?>>Thane</option>
            <option value="Panvel" <?php echo $property['location'] == 'Panvel' ? 'selected' : ''; ?>>Panvel</option>
        </select>

        <label for="photos">Photos (Select multiple files):</label>
        <input type="file" id="photos" name="photos[]" multiple>

        <label for="video">Video: (Maximum 1min)</label>
        <input type="file" id="video" name="video">

        <button type="submit">Update Property</button>
    </form>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
