<?php
require_once 'dbconnect.php';
header('Content-Type: application/json');

// Get the JSON data from the request
$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'];
$order_status = $data['order_status'];

$response = ['success' => false];

// Prepare and execute SQL update
$sql = "UPDATE orders SET order_status=? WHERE id=?";
$stmt = $_conn->prepare($sql);
$stmt->bind_param("ii", $order_status, $id);

if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['message'] = $stmt->error;
}

$stmt->close();
$_conn->close();

echo json_encode($response);
?>
