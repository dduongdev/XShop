<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'xshop_update';

$_conn = new mysqli($server, $username, $password, $database);

if ($_conn->connect_error) {
    die("Connection failed: " . $_conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT id, user_name, email, user_password, phone, fullname, user_role FROM users WHERE id=?";
$stmt = $_conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

$user = $result->fetch_assoc();

$_conn->close();

echo json_encode($user);
?>
