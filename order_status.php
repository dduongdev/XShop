<?php
    require_once './php/dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List</title>

    <!-- Montserrat font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/list_users.css">
    <link rel="stylesheet" href="./css/dashboard.css">

</head>
<body>
    <div class="grid-container">
        <?php include 'toast.php'; ?>
        <?php include 'dashboard_sidebar.php'; ?>

        <main class="main-container">
            <div class="container">
                <h2>Order List</h2>
                
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>User Name</th>
                            <th>Product Name</th>
                            <th>Unit Price</th>
                            <th>Discount Percentage</th>
                            <th>Order Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            // SQL query to fetch required data
                            $sql = "SELECT orders.id, users.fullname AS user_name, products.product_name, products.unit_price, products.discount_percentage, orders.order_status
                                    FROM orders
                                    JOIN users ON orders.user_id = users.id
                                    JOIN products_size ON orders.product_size_id = products_size.id
                                    JOIN products_color ON products_size.product_color_id = products_color.id
                                    JOIN products ON products_color.product_id = products.id";
                            
                            $result = $_conn->query($sql);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr data-id='" . $row["id"] . "'>";
                                    echo "<td>" . $row["id"] . "</td>";
                                    echo "<td>" . $row["user_name"] . "</td>";
                                    echo "<td>" . $row["product_name"] . "</td>";
                                    echo "<td>" . $row["unit_price"] . "</td>";
                                    echo "<td>" . $row["discount_percentage"] . "%</td>";
                                    echo "<td>
                                            <select name='order_status' onchange='updateOrderStatus(" . $row["id"] . ", this.value)'>
                                                <option value='1'" . ($row["order_status"] == 1 ? " selected" : "") . ">Pending</option>
                                                <option value='2'" . ($row["order_status"] == 2 ? " selected" : "") . ">Processing</option>
                                                <option value='3'" . ($row["order_status"] == 3 ? " selected" : "") . ">Completed</option>
                                            </select>
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No orders found</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./js/toast.js"></script> <!-- Include your toast.js file -->

    <script>
        function updateOrderStatus(orderId, status) {
            console.log(`Updating order ${orderId} to status ${status}`);
            
            fetch('php/ajax_update_order.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: orderId,
                    order_status: status
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data); // Log the response data
                if (data.success) {
                    toast({
                        title: 'Update Successful',
                        message: 'Order status has been updated.',
                        type: 'success'
                    });
                } else {
                    toast({
                        title: 'Update Failed',
                        message: 'Error: ' + data.message,
                        type: 'danger'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                toast({
                    title: 'Update Failed',
                    message: 'An unexpected error occurred.',
                    type: 'danger'
                });
            });
        }
    </script>
</body>
</html>
