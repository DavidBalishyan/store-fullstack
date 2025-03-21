<?php
require_once '../controllers/OrderController.php';
require_once '../middlewares/auth.php';

header("Content-Type: application/json");
$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod === "POST") {
    requireAuth();
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['product_id'], $data['quantity'])) {
        if (placeOrder($_SESSION['user_id'], $data['product_id'], $data['quantity'])) {
            echo json_encode(["message" => "Order placed successfully"]);
        } else {
            echo json_encode(["error" => "Order failed"]);
        }
    } else {
        echo json_encode(["error" => "Invalid input"]);
    }
}

if ($requestMethod === "GET") {
    requireAuth();
    echo json_encode(getUserOrders($_SESSION['user_id']));
}
