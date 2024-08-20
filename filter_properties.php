<!-- filter_properties.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filter Properties</title>
</head>
<body>
    <style>
       /* styles.css */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa;
}

h1 {
    text-align: center;
    color: #343a40;
    margin-top: 20px;
}

form {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #495057;
}

input[type="number"],
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    font-size: 16px;
}

button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #0056b3;
}

#properties {
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
}

.property-item {
    background: #ffffff;
    padding: 20px;
    margin: 20px 0;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.property-item h3 {
    margin-top: 0;
    color: #343a40;
}

.property-item p {
    margin: 8px 0;
    color: #495057;
}

.property-details {
    display: none;
    margin-top: 20px;
}

.property-details img,
.property-details video {
    display: inline-block;
    margin-right: 10px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    max-width: 100%;
    height: auto;
    vertical-align: top;
}

.property-details img {
    max-height: 150px;
    width: auto;
}

.property-details video {
    max-height: 200px;
    width: auto;
}

/* Responsive styles */
@media (max-width: 768px) {
    form,
    .property-item {
        padding: 15px;
    }

    button {
        width: 100%;
        margin-top: 10px;
    }

    .property-details img,
    .property-details video {
        width: 100%;
        height: auto;
    }
}

    </style>
    <h1>Filter Properties</h1>
    <form action="" method="get">
        <label for="min_price">Min Price:</label>
        <input type="number" id="min_price" name="min_price">

        <label for="max_price">Max Price:</label>
        <input type="number" id="max_price" name="max_price">

        <label for="min_area">Min Area (sqft):</label>
        <input type="number" id="min_area" name="min_area">

        <label for="max_area">Max Area (sqft):</label>
        <input type="number" id="max_area" name="max_area">

        <label for="location">Location:</label>
        <select id="location" name="location">
            <option value="">Select Location</option>
            <option value="Mumbai">Mumbai</option>
            <option value="Thane">Thane</option>
            <option value="Panvel">Panvel</option>
        </select>

        <button type="submit">Filter</button>
        <button type="reset">Clear</button>
        <a href="index.php"><button type="button">Home</button></a>
    </form>

    <div id="properties">
        <?php
        include 'db.php';

        $query = "SELECT * FROM properties WHERE 1=1";

        if (!empty($_GET['min_price'])) {
            $query .= " AND price >= " . $_GET['min_price'];
        }

        if (!empty($_GET['max_price'])) {
            $query .= " AND price <= " . $_GET['max_price'];
        }

        if (!empty($_GET['min_area'])) {
            $query .= " AND area >= " . $_GET['min_area'];
        }

        if (!empty($_GET['max_area'])) {
            $query .= " AND area <= " . $_GET['max_area'];
        }

        if (!empty($_GET['location'])) {
            $query .= " AND location = '" . $_GET['location'] . "'";
        }

        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='property-item'>";
            echo "<h3>" . $row['property_name'] . "</h3>";
            echo "<p>Owner: " . $row['owner_name'] . "</p>";
            echo "<p>Price: ₹" . number_format($row['price']) . "</p>";
            echo "<p>Area: " . $row['area'] . " sqft</p>";
            echo "<p>Location: " . $row['location'] . "</p>";
            echo "<p>Address: " . $row['address'] . "</p>";

            // Display photos
            $photos = json_decode($row['photos'], true);
            echo "<button onclick='showDetails(" . $row['id'] . ")'>View Details</button>";
            echo "<div id='details-" . $row['id'] . "' class='property-details'>";
            foreach ($photos as $photo) {
                echo "<img src='" . $photo . "' alt='Property Photo' height='150px' weight='200px'>";
            }
            echo "<video controls src='" . $row['video'] . "' height='200px' weight='300px'></video>";
            echo "<p>Contact Number: " . $row['contact_number'] . "</p>";
            echo "</div>";
            echo "</div>";
        }
        mysqli_close($conn);
        ?>
    </div>

    <script>
        function showDetails(id)
        {
            var details = document.getElementById('details-' + id);
            if (details.style.display === 'none' || details.style.display === '')
            {
                details.style.display = 'block';
            }
            else
            {
                details.style.display = 'none';
            }
        }
    </script>
</body>
</html>
