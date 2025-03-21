<?php
require_once '../controllers/UserController.php';

header("Content-Type: application/json");
$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (isset($data['username'], $data['email'], $data['password'])) {
        if (registerUser($data['username'], $data['email'], $data['password'])) {
            echo json_encode(["message" => "User registered successfully"]);
        } else {
            echo json_encode(["error" => "Registration failed"]);
        }
    } else {
        echo json_encode(["error" => "Invalid input"]);
    }
}
