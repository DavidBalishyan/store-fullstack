<?php
require_once '../controllers/ProductController.php';
require_once '../middlewares/auth.php';

header("Content-Type: application/json");
$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod === "POST") {
    requireAuth(); // Protect the route
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['name'], $data['description'], $data['price'], $data['image'])) {
        if (addProduct($data['name'], $data['description'], $data['price'], $data['image'])) {
            echo json_encode(["message" => "Product added successfully"]);
        } else {
            echo json_encode(["error" => "Failed to add product"]);
        }
    } else {
        echo json_encode(["error" => "Invalid input"]);
    }
}

if ($requestMethod === "GET") {
    if (isset($_GET['id'])) {
        echo json_encode(getProduct($_GET['id']));
    } else {
        echo json_encode(getProducts());
    }
}
