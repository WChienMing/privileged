<?php
header("Content-Type: application/json");

$json = file_get_contents('php://input');
$obj = json_decode($json, true);

$correctPassword = "12345";
$password = $obj["password"];

if ($password === $correctPassword) {
  echo json_encode(["status" => "success", "code" => $correctPassword]);
} else {
  echo json_encode(["status" => "error"]);
}
?>
