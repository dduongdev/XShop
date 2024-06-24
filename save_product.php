<?php
    // Ensure form data is received
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Enable error reporting for debugging purposes (remove in production)
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
        $server = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'xshop';

        // Create connection
        $conn = new mysqli($server, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind parameters
        $stmt = $conn->prepare("UPDATE products SET product_name=?, unit_price=?, discount_percentage=?, product_desc=?, release_date=? WHERE id=?");
        
        // Set parameters from POST
        $id = $_POST['edit-product-id'];
        $productName = $_POST['edit-product-name'];
        $unitPrice = $_POST['edit-unit-price'];
        $discountPercentage = $_POST['edit-discount-percentage'];
        $productDesc = $_POST['edit-product-desc'];
        $releaseDate = $_POST['edit-release-date'];
        
        $stmt->bind_param("sddssi", $productName, $unitPrice, $discountPercentage, $productDesc, $releaseDate, $id);
        // Execute the update
        if ($stmt->execute()) {
            echo "Product updated successfully."; // Echo success message
        } else {
            echo "Error updating product: " . $stmt->error; // Echo error message
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Method not allowed."; // Echo error for incorrect method
    }
?>
