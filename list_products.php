<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>

    <!-- Montserrat font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/list_products.css">
    <link rel="stylesheet" href="./css/dashboard.css">

    <style>
        .edit-form {
            display: none;
            margin-top: 20px;
        }
    </style>

    <script>
        function editProduct(id, productName, unitPrice, discountPercentage, productDesc, releaseDate) {
            document.getElementById('edit-product-id').value = id;
            document.getElementById('edit-product-name').value = productName;
            document.getElementById('edit-unit-price').value = unitPrice;
            document.getElementById('edit-discount-percentage').value = discountPercentage;
            //document.getElementById('edit-product-desc').value = productDesc;

            // Format product_desc for display in textarea
            if (productDesc) {
                var descArray = JSON.parse(productDesc);
                var formattedDesc = '';
                if (Array.isArray(descArray)) {
                    formattedDesc = descArray.join('\n');
                } else {
                    formattedDesc = productDesc; // Fallback in case it's not an array
                }
                document.getElementById('edit-product-desc').value = formattedDesc;
            } else {
                document.getElementById('edit-product-desc').value = '';
            }

            // Format releaseDate to yyyy-mm-dd for input type="date"
            if (releaseDate) {
                // Assuming releaseDate is in yyyy-mm-dd format
                document.getElementById('edit-release-date').value = releaseDate;
            }

            // Show the edit form
            document.getElementById('edit-form').style.display = 'block';

            // Scroll to the edit form section
            document.getElementById('edit-form').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        function submitEditForm() {
            var id = document.getElementById('edit-product-id').value;
            var productName = document.getElementById('edit-product-name').value;
            var unitPrice = document.getElementById('edit-unit-price').value;
            var discountPercentage = document.getElementById('edit-discount-percentage').value;
            var productDesc = document.getElementById('edit-product-desc').value;
            var releaseDate = document.getElementById('edit-release-date').value;

            // Prepare form data
            var formData = new FormData();
            formData.append('edit-product-id', id);
            formData.append('edit-product-name', productName);
            formData.append('edit-unit-price', unitPrice);
            formData.append('edit-discount-percentage', discountPercentage);
            formData.append('edit-product-desc', productDesc);
            formData.append('edit-release-date', releaseDate);

            // Make AJAX request
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'save_product.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log(xhr.responseText); // Log the response
                    // Optionally, handle UI updates or show success message
                } else {
                    console.error('Error occurred: ' + xhr.statusText); // Log error
                }
            };
            xhr.onerror = function() {
                console.error('Request failed.'); // Log request failure
            };
            xhr.send(formData); // Send form data
        }
    </script>
</head>
<body>
    <div class="grid-container">
        <?php include 'toast.php'; ?>
        <?php include 'dashboard_sidebar.php'; ?>

        <main class="main-container">
            <div class="container">
                <h2>Product List</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Unit Price</th>
                            <th>Discount Percentage</th>
                            <th>Description</th>
                            <th>Release Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $server = 'localhost';
                        $username = 'root';
                        $password = '';
                        $database = 'xshop_update';

                        $conn = new mysqli($server, $username, $password, $database);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT id, product_name, unit_price, discount_percentage, product_desc, DATE_FORMAT(release_date, '%Y-%m-%d') AS release_date FROM products";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                // Decode JSON string to PHP array
                                $productDescArray = json_decode($row["product_desc"]);

                                // Check if product_desc is a valid JSON array
                                if (is_array($productDescArray)) {
                                    // Format the description for display
                                    $formattedDescription = "<ul>";
                                    foreach ($productDescArray as $desc) {
                                        $formattedDescription .= "<li>" . htmlspecialchars($desc) . "</li>";
                                    }
                                    $formattedDescription .= "</ul>";
                                } else {
                                    // If product_desc is not a valid JSON array, display as is
                                    $formattedDescription = htmlspecialchars($row["product_desc"]);
                                }

                                // output in the html table
                                echo "<tr>
                                        <td>" . htmlspecialchars($row["product_name"]) . "</td>
                                        <td>" . htmlspecialchars($row["unit_price"]) . "</td>
                                        <td>" . htmlspecialchars($row["discount_percentage"]) . "</td>
                                        <td>" . $formattedDescription . "</td>
                                        <td>" . htmlspecialchars($row["release_date"]) . "</td>

                                        <td><button onclick='editProduct(" . $row["id"] . ", \"" . addslashes($row["product_name"]) . "\", " . $row["unit_price"] . ", " . $row["discount_percentage"] . ", \"" . addslashes($row["product_desc"]) . "\", \"" . addslashes($row["release_date"]) . "\")'>Edit</button></td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No products found</td></tr>";
                        }
                        $conn->close();
                    ?>

                    </tbody>
                </table>

                <!-- Edit Form -->
                <!-- Edit Form for Products -->
                <div id="edit-form" class="edit-form" style="display: none;">
                    <h3>Edit Product</h3>
                    <form id="editProductForm" action="save_product.php" method="POST">
                        <input type="hidden" id="edit-product-id" name="edit-product-id">
                        <div class="form-column">
                            <div>
                                <label for="edit-product-name">Product Name:</label>
                                <input type="text" id="edit-product-name" name="edit-product-name" required>
                            </div>
                            <div>
                                <label for="edit-unit-price">Unit Price:</label>
                                <input type="number" id="edit-unit-price" name="edit-unit-price" required>
                            </div>
                            <div>
                                <label for="edit-discount-percentage">Discount Percentage:</label>
                                <input type="number" id="edit-discount-percentage" name="edit-discount-percentage">
                            </div>
                        </div>
                        <div class="form-column">
                            <div>
                                <label for="edit-product-desc">Description:</label>
                                <textarea id="edit-product-desc" name="edit-product-desc" rows="4" required></textarea>
                            </div>
                            <div>
                                <label for="edit-release-date">Release Date:</label>
                                <input type="date" id="edit-release-date" name="edit-release-date" required>
                            </div>
                        </div>
                        <button type="button" onclick="submitEditForm()">Save Changes</button>
                    </form>
                </div>

            </div>
        </main>
    </div>
</body>
</html>
