<?php
session_start();
include 'db_conn.php'; // Kết nối MySQLi

// Truy vấn lịch sử mua hàng từ bảng order_items
$sql = "SELECT oi.order_id, p.NAME, oi.buy_qty, oi.price, oi.buy_qty * oi.price AS total_price
        FROM order_items oi 
        JOIN products p ON oi.product_id = p.id 
        ORDER BY oi.order_id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
        <link rel="stylesheet" href="./css/order_history.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
	<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
	<link rel="stylesheet" type="text/css" href="styles/responsive.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<?php include("html/head.php"); ?>
<div class="order">
<div class="container">
    <h1>Order History</h1>

    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['order_id']; ?></td>
                        <td><?php echo $row['NAME']; ?></td>
                        <td><?php echo $row['buy_qty']; ?></td>
                        <td><?php echo number_format($row['total_price'], 2); ?>$</td>
                        <td><?php echo date('Y-m-d'); ?></td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='5'>Không có lịch sử mua hàng.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</div>
		<?php include("html/footer.php"); ?>

</body>
</html>
