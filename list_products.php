<?php
    require_once './php/dbconnect.php';
?>

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
     <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/list_products.css">
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="./css/toast.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <style>
        .edit-form {
            display: none;
            margin-top: 20px;
        }
    </style>

    <script src="./js/toast.js"></script>

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
            document.getElementById('variant_form').style.display = 'block';

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
            formData.append('edit-product-desc', JSON.stringify(productDesc.split('\n').map(line => line.trim())));
            formData.append('edit-release-date', releaseDate);

            // Make AJAX request
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'save_product.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log(xhr.responseText); // Log the response
                    // Optionally, handle UI updates or show success message
                    toast ({
                        title: "Thông báo",
                        message: "Sửa sản phẩm thành công!",
                        type: "success",
                        duration: 4000
                    })

                } else {
                    console.error('Error occurred: ' + xhr.statusText); // Log error
                    toast ({
                    title: "Thông báo",
                    message: "Sửa sản phẩm không thành công!",
                    type: "warning",
                    duration: 4000
                })
                }
            };
            xhr.onerror = function() {
                console.error('Request failed.'); // Log request failure
                toast ({
                    title: "Thông báo",
                    message: "Sửa sản phẩm không thành công!",
                    type: "warning",
                    duration: 4000
                })
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
                <a class="add_product_link" href="./add_product.php">Add Products</a>
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

                        $sql = "SELECT id, product_name, unit_price, discount_percentage, product_desc, DATE_FORMAT(release_date, '%Y-%m-%d') AS release_date FROM products";
                        $result = $_conn->query($sql);

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
                                        <td><button class='edit_button' onclick='editProduct(" . $row["id"] . ", \"" . addslashes($row["product_name"]) . "\", " . $row["unit_price"] . ", " . $row["discount_percentage"] . ", \"" . addslashes($row["product_desc"]) . "\", \"" . addslashes($row["release_date"]) . "\")'>Edit</button>
                                        <input type='hidden' class='product_id' value='".$row["id"]."'></td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No products found</td></tr>";
                        }
                        $_conn->close();
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
                        <button class="" type="button" onclick="submitEditForm()">Save Changes</button>
                    </form>
                </div>
                        
                <div id="variant_form">
                    <div class="ud_row">
                        <select name="" id="product_categories">

                        </select>

                        <button class="js-update-category">
                            Update category
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div class="modal modal--close">
        <div class="modal__overlay"></div>

        <div class="modal__body">
            <div class="modal__inner">
                <div class="update_category_modal modal__container modal--close">
                    <button class="modal__close-btn">
                        <i class="fa-solid fa-xmark"></i>
                    </button>

                    <div class="update_category_model__content">
                        <select name="" id="all_categories">

                        </select>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <script>
        var productId = $(this).siblings('.product_id').val();
        $(document).ready(function() {
            $('.edit_button').click(function(e){
                e.preventDefault();
                productId = $(this).siblings('.product_id').val();
                $.ajax({
                    url: './php/get_product_categories.php',
                    type: 'POST',
                    data: { product_id: productId }
                }).done(function(response){
                    var categories = JSON.parse(response);
                    $('#product_categories').empty();
                    categories.forEach(function(category) {
                        $('#product_categories').append(new Option(category.name, category.id));
                    })
                })
            })

            $('.js-update-category').click(function(e){
                e.preventDefault();

                $.ajax({
                    url: './php/ajax_get_all_categories.php',
                    type: 'POST'
                }).done(function(response){
                    var all_categories = JSON.parse(response);
                    $('#all_categories').empty();
                    all_categories.forEach(function(category){
                        $('#all_categories').append(new Option(category.name, category.id));
                    })
                })
            })

            $('.js-update-category').click(function(e){
                e.preventDefault();


            })
        });
    </script>
    <script>

    </script>
</body>
</html>
