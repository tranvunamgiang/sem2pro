<?php
require_once("./../functions/order.php");

if (isset($_GET["id"]) && isset($_GET["status"])) {
    $order_id = $_GET["id"];
    $new_status = $_GET["status"];
    
    // Cập nhật trạng thái của đơn hàng
    update_status($order_id, $new_status);

    // Quay lại trang chi tiết đơn hàng sau khi cập nhật trạng thái
    header("Location: order_detail.php?id=" . $order_id);
    exit();
} else {
    echo "Invalid parameters.";
}
?>
