<?php
session_start();
include 'db.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin/login.php");
    exit();
}

// Check if the property ID is provided
if (isset($_GET['id'])) {
    $property_id = intval($_GET['id']);

    // Fetch the property to get the photos and video
    $sql = "SELECT photos, video FROM properties WHERE id = $property_id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $property = mysqli_fetch_assoc($result);

        // Delete associated files (photos and video)
        $photos = json_decode($property['photos'], true);
        foreach ($photos as $photo) {
            if (file_exists($photo)) {
                unlink($photo);
            }
        }
        if (file_exists($property['video'])) {
            unlink($property['video']);
        }

        // Delete the property record from the database
        $sql = "DELETE FROM properties WHERE id = $property_id";
        if (mysqli_query($conn, $sql)) {
            echo "Property deleted successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Property not found.";
    }
} else {
    echo "No property ID specified.";
}

mysqli_close($conn);

// Redirect to the dashboard after deletion
header("Location: dashboard.php");
exit();
?>
