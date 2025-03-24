<?php
header("Access-Control-Allow-Origin: "); // Allow all origins
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Allow methods
header("Access-Control-Allow-Headers: Content-Type"); // Allow headers

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit();
}
