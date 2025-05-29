# Real Estate Management System

A simple web-based application built with PHP and MySQL for managing and showcasing real estate properties. This system provides an administrative interface for property management and a public-facing section for users to browse and filter properties.

## Features

### Admin Panel
* **Secure Login:** Administrators can log in to access the management dashboard.
* **Property Dashboard:** View a comprehensive list of all properties.
* **Add New Property:** Upload new property listings with details such as:
    * Property Name
    * Owner Name
    * Contact Number
    * Address
    * Price
    * Area (in sqft)
    * Location (Mumbai, Thane, Panvel)
    * Multiple Photos
    * A promotional Video (maximum 1 minute)
* **Edit Property:** Update existing property details, including changing photos and videos.
* **Delete Property:** Remove properties from the system, which also deletes associated files (photos and videos) from the server.
* **Admin Logout:** Securely end the admin session.

### Public User Interface
* **Property Listing:** Browse all available real estate properties.
* **Advanced Filtering:** Filter properties based on:
    * Minimum and Maximum Price
    * Minimum and Maximum Area
    * Specific Location (Mumbai, Thane, Panvel)
* **Detailed Property View:** Click to expand and view full details of a property, including all uploaded photos, the video, and contact information.

## Technologies Used

* **Backend:** PHP
* **Database:** MySQL
* **Frontend:** HTML, CSS (primarily inline/embedded in PHP files), JavaScript (for toggling property details)

## Setup and Installation

Follow these steps to get the Real Estate Management System up and running on your local machine.

### Prerequisites

* A web server with PHP support (e.g., Apache, Nginx)
* MySQL database server
* phpMyAdmin (optional, for easy database management)

### Steps

1.  **Clone the Repository:**
    ```bash
    git clone <your-repository-url>
    cd real-estate-management-system
    ```

2.  **Database Setup:**
    * Open your MySQL client or phpMyAdmin.
    * Create a new database named `real_estate_management`.
    * Import the `real_estate_management.sql` file into your newly created database. This will set up the `admin` and `properties` tables.

3.  **Configure Database Connection:**
    * Open `db.php`.
    * Ensure the database connection details are correct for your environment:
        ```php
        <?php
        $servername = "localhost"; // Your database server name
        $username = "root";     // Your database username
        $password = "";         // Your database password
        $dbname = "real_estate_management"; // The database name you created


        $conn = mysqli_connect($servername, $username, $password, $dbname);


        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        ?>
        ```

4.  **Create Upload Directories:**
    * Inside your project's root directory, create the following folders:
        * `uploads/`
        * `uploads/photos/`
        * `uploads/videos/`
    * Ensure your web server has write permissions to these directories.

5.  **Place Project Files:**
    * Move all the project files (the cloned directory contents) into your web server's document root (e.g., `htdocs` for Apache, `www` for Nginx).

6.  **Initial Admin Account:**
    * To log in as an admin, you'll need to create an admin user. You can do this by directly inserting a record into the `admin` table in your `real_estate_management` database (e.g., using phpMyAdmin):
        ```sql
        INSERT INTO `admin` (`id`, `username`, `password`) VALUES
        (1, 'admin', 'adminpassword'); -- Replace 'adminpassword' with your desired password
        ```
    * **Note:** Passwords are not hashed in this version. For a production environment, it is highly recommended to implement password hashing for security.

7.  **Access the Application:**
    * Open your web browser and navigate to:
        * `http://localhost/real-estate-management-system/` (or the appropriate URL if you renamed the project folder or are using a virtual host).

## Usage

### Public Access
* **Home Page:** Access the main landing page.
* **See Properties:** Click the "See Properties" button to view all available listings.
* **Filter Properties:** Use the filter form at the top of the "See Properties" page to narrow down results by price, area, and location.
* **View Details:** Click the "View Details" button on any property card to see its full address, contact number, photos, and video.

### Admin Access
1.  Go to the Admin login page: `http://localhost/real-estate-management-system/admin/login.php`
2.  Log in using your admin username and password (e.g., `admin` / `adminpassword` if you used the example above).
3.  From the Admin Dashboard:
    * **Upload New Property:** Click this button to add a new property with all its details and media.
    * **Edit:** Click the "Edit" link next to any property in the table to modify its information.
    * **Delete:** Click the "Delete" link next to any property to remove it from the system. Be cautious, as this action is irreversible and deletes associated files.
    * **Logout:** Click "Logout" to end your admin session.

## Project Structure
├── admin/                     # Admin panel files
│   ├── dashboard.php          # Admin dashboard to manage properties
│   ├── delete_property.php    # Handles property deletion logic
│   ├── edit_property.php      # Form and logic for editing properties
│   ├── login.php              # Admin login page
│   ├── logout.php             # Handles admin logout
│   └── register.php           # Admin registration page (not directly linked, but present)
├── db.php                     # Database connection configuration
├── filter_properties.php      # Public page for viewing and filtering properties
├── index.php                  # Main landing page for the application
├── real_estate_management.sql # SQL database schema
├── uploads/                   # Directory for uploaded property media
│   ├── photos/                # Stores property images
│   └── videos/                # Stores property videos
└── styles/                    # Placeholder for external stylesheets (currently most styles are inline)
└── styles.css

## Contributing
Contributions are welcome! If you'd like to improve this project, please consider:
* Adding password hashing for admin accounts.
* Implementing proper validation and sanitization for all user inputs to prevent SQL injection and XSS attacks.
* Improving the user interface and responsiveness.
* Adding more search/filter options.
* Creating separate CSS files instead of inline styles.
