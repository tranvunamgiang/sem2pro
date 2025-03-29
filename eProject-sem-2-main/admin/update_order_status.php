<?php
session_start();
require_once("./../functions/user.php");
require_once("./../functions/order.php");
require_once("./../functions/dbp.php"); // Kết nối tới database

if (!is_admin()) {
    header("Location: /404notfound.php");
    die();
}

// Kiểm tra nếu dữ liệu được gửi bằng POST
if (isset($_POST['order_id']) && isset($_POST['new_status'])) {
    $order_id = intval($_POST['order_id']);
    $new_status = intval($_POST['new_status']);
    $note = isset($_POST['note']) ? trim($_POST['note']) : null;

    if ($new_status === CANCEL && $note) {
        // Nếu trạng thái là CANCEL và có ghi chú -> Lưu ghi chú vào database
        $sql = "UPDATE orders SET status = ?, note = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isi", $new_status, $note, $order_id);
        $stmt->execute();
        $stmt->close();
        
        // Hoàn lại số lượng sản phẩm nếu đơn bị hủy
        $sql_items = "SELECT * FROM order_items WHERE order_id = $order_id";
        $items = select($sql_items);
        
        foreach ($items as $item) {
            $buy_qty = $item['buy_qty'];
            $product_id = $item["product_id"];
            $sql_p = "UPDATE products SET qty = qty + ? WHERE id = ?";
            $stmt = $conn->prepare($sql_p);
            $stmt->bind_param("ii", $buy_qty, $product_id);
            $stmt->execute();
            $stmt->close();
        }
    } else {
        // Cập nhật trạng thái bình thường nếu không phải là CANCEL
        update_status($order_id, $new_status);
    }

    // Quay lại trang chi tiết đơn hàng sau khi cập nhật
    header("Location: order_detail.php?id=$order_id");
    exit();
} else {
    // Nếu không có dữ liệu hợp lệ, chuyển hướng về trang quản lý đơn hàng
    header("Location: order_list.php");
    exit();
}
