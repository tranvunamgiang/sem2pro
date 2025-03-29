<?php
session_start();
require_once("./functions/db.php");

// Bật hiển thị lỗi để debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Kiểm tra phương thức POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid request method");
}

$email = $_POST["email"] ?? '';
$password = $_POST["password"] ?? '';

// Validate input
if (empty($email) || empty($password)) {
    die("Please fill all fields");
}

// Sử dụng prepared statement để tránh SQL Injection
$sql = "SELECT * FROM users WHERE email = ? LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Email or password is not correct!");
}

// Verify password
if (!password_verify($password, $user["password"])) {
    die("Email or password is not correct");
}

// Lưu thông tin user vào session
$_SESSION["user"] = [
    "id" => $user["id"],
    "full_name" => $user["full_name"],
    "email" => $user["email"],
    "role" => $user["role"]
];

// Chuyển hướng và dừng script ngay lập tức
if ($user["role"] === "ADMIN") {
    header("Location: /admin/index.php");
} else {
    header("Location: http://localhost:8888/");
}
exit(); // Quan trọng: phải có exit sau header