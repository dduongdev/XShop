<?php
require_once 'dbconnect.php'; // Kết nối cơ sở dữ liệu

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Chuẩn bị câu lệnh SQL để lấy dữ liệu từ bảng categories
    $sql = "SELECT id, category_name FROM categories";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $categories = array();

        // Lấy dữ liệu từ kết quả truy vấn và thêm vào mảng categories
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }

        // Trả về dữ liệu dạng JSON
        echo json_encode($categories);
    } else {
        // Trả về lỗi nếu có
        echo json_encode(array('error' => 'Có lỗi xảy ra khi truy vấn cơ sở dữ liệu.'));
    }
}
?>