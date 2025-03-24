<?php
require_once '../controllers/UserController.php';
require_once '../config/cors.php';

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    // Register user
    if (isset($data['username'], $data['email'], $data['password'])) {
        if (registerUser($data['username'], $data['email'], $data['password'])) {
            echo json_encode(["message" => "User registered successfully"]);
        } else {
            echo json_encode(["error" => "Registration failed"]);
        }
    }

    // Login user
    elseif (isset($data['email'], $data['password'])) {
        echo json_encode(loginUser($data['email'], $data['password']));
    } 

    // Invalid request
    else {
        echo json_encode(["error" => "Invalid input"]);
    }
}






// Logout user
if ($requestMethod === "GET" && isset($_GET['logout'])) {
    echo json_encode(logoutUser());
}
