<?php
header("Content-Type: application/json");

$db_host = "localhost";
$db_user = "priviled";
$db_password = "7cw1Y=1{dmMt";
$db_name = "privileged";
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

$json = file_get_contents('php://input');
$obj = json_decode($json, true);
$codeFromClient = $obj["password"];

$stmt = $conn->prepare("SELECT * FROM private_code WHERE code = ?");
$stmt->bind_param("s", $codeFromClient);

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(["status" => "success", "message" => "验证成功"]);
} else {
    echo json_encode(["status" => "error", "message" => "代码错误"]);
}

$stmt->close();
$conn->close();
?>
