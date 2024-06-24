<?php
require_once 'dbconnect.php';

$response = [
    'status' => false,
    'message' => ''
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uploadDir = '../images/products/';
    $fileName = basename($_FILES['file']['name']);
    $targetFilePath = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
        $relativePath = $targetFilePath;

        $product_name = $_POST['product_name'];
        $unit_price = $_POST['unit_price'];
        $discount_percentage = $_POST['discount_percentage'];
        $product_desc = $_POST['product_desc'];
        $slug = convertString($product_name);
        $main_img = $relativePath;
        $release_date = $_POST['release_date'];

        $sql = "INSERT INTO products(product_name, unit_price, discount_percentage, product_desc, slug, main_img, release_date)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $_conn->prepare($sql);
        $stmt->bind_param('sssssss', $product_name, $unit_price, $discount_percentage, $product_desc, $slug, $main_img, $release_date);

        try {
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                $response['status'] = true;
                $response['message'] = 'Thêm sản phẩm thành công';
            } else {
                $response['message'] = 'Không thể thêm sản phẩm vào cơ sở dữ liệu';
            }
        } catch (Exception $e) {
            $response['message'] = 'Lỗi: ' . $e->getMessage();
        }
    } else {
        $response['message'] = 'Lỗi khi tải lên tệp.';
    }

    echo json_encode($response);
}

function convertString($inputString) {
    $lowercaseString = strtolower($inputString);
    $normalizedString = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $lowercaseString);
    $normalizedString = preg_replace("/[^\w\s\-]/", "", $normalizedString);
    $dashedString = preg_replace("/\s+/", "-", $normalizedString);

    return $dashedString;
}
?>