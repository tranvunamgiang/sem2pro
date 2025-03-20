<?php
require_once("./functions/db.php"); // Đảm bảo file dbp.php đã định nghĩa kết nối PDO

// Lấy dữ liệu từ form
$full_name = $_POST["full_name"];
$email = $_POST["email"];
$password = $_POST["password"];

// Hash mật khẩu
$password = password_hash($password, PASSWORD_BCRYPT);

// Chuẩn bị câu lệnh SQL
$sql = "INSERT INTO users (full_name, email, password) VALUES (:full_name, :email, :password)";

try {
    // Sử dụng PDO để thực thi câu lệnh SQL
    $stmt = $pdo->prepare($sql); // Giả sử $pdo là đối tượng kết nối PDO từ file dbp.php
    $stmt->bindParam(':full_name', $full_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    // Chuyển hướng về trang login sau khi đăng ký thành công
    header("Location: /login.php");
    exit(); // Luôn sử dụng exit() sau header() để đảm bảo không có code nào khác được thực thi
} catch (PDOException $e) {
    // Xử lý lỗi nếu có
    die("Error: " . $e->getMessage());
}
?>