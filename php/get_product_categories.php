<?php
require_once 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];

    $sql = "SELECT categories.id, categories.category_name
            FROM category_product
            JOIN categories ON category_product.category_id = categories.id
            JOIN products ON category_product.product_id = products.id
            WHERE products.id = ?";
    $stmt = $_conn->prepare($sql);
    $stmt->bind_param('s', $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $categories = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = [
                'id' => $row['id'],
                'name' => $row['category_name']
            ];
        }
    }

    echo json_encode($categories);
}
?>
