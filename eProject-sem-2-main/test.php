<?php
include 'db.php'; // Kết nối database

// Kiểm tra nếu có tham số ID sản phẩm được truyền vào
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("No product selected!");
}

$product_id = intval($_GET['id']); // Lọc dữ liệu để tránh SQL Injection

// Truy vấn sản phẩm theo ID
$stmt = $pdo->prepare("SELECT * FROM Products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// Kiểm tra nếu sản phẩm không tồn tại
if (!$product) {
    die("Product not found!");
}

// Hiển thị dữ liệu sản phẩm
echo "<h1>" . htmlspecialchars($product['NAME']) . "</h1>";
echo "<p>Price: $" . number_format($product['price'], 2) . "</p>";
echo "<img src='" . htmlspecialchars($product['thumbnail']) . "' alt='" . htmlspecialchars($product['NAME']) . "'>";
?>
