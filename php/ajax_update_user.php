<?php
header('Content-Type: application/json');

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'xshop_update';

$conn = new mysqli($server, $username, $password, $database);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

// Handle POST data
$id = $_POST['id'];
$user_name = $_POST['user_name'];
$email = $_POST['email'];
$user_password = $_POST['user_password'];
$phone = $_POST['phone'];
$fullname = $_POST['fullname'];
$user_role = $_POST['user_role'];

// Prepare and execute SQL update
$sql = "UPDATE users SET user_name=?, email=?, user_password=?, phone=?, fullname=?, user_role=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssi", $user_name, $email, $user_password, $phone, $fullname, $user_role, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
