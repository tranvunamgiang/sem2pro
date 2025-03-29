<?php 
// Kết nối cơ sở dữ liệu
require_once("./functions/dbp.php");

// Kiểm tra và lấy order_id từ GET
if (isset($_GET["order_id"])) {
    $order_id = intval($_GET["order_id"]); // Đảm bảo order_id là số nguyên

    if ($order_id > 0) {
        // Cập nhật trạng thái đơn hàng thành đã thanh toán
        $sql = "UPDATE orders SET paid = 1 WHERE id = $order_id";
        insert($sql);

        // Chuyển hướng về trang cảm ơn
        header("Location: /thankyou.php?order_id=$order_id");
        exit();
    }
}

// Nếu không có order_id hợp lệ, có thể chuyển hướng hoặc hiển thị lỗi
header("Location: /failpaypal.php");
exit();
?>

