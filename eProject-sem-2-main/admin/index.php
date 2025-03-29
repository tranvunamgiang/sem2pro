<?php 
    session_start();
    require_once("./../functions/user.php");
    if(!is_admin()){
        header("Location: /404notfound.php");
        die();
    }
    require_once("./../functions/order.php");
    $orders = order_list();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("./../html/head.php");?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Thêm sự kiện click xác nhận trước khi chuyển trang chi tiết đơn hàng
            document.querySelectorAll(".order-detail-link").forEach(link => {
                link.addEventListener("click", function(event) {
                    if (!confirm("Are you sure you want to view this order detail?")) {
                        event.preventDefault();
                    }
                });
            });
        });
    </script>
</head>

<body>
    <main class="container mt-4">
        <div class="row">
            <article class="col">
                <h1 class="mb-4 text-center">Orders Listing</h1>
                <table class="table table-bordered table-striped table-hover text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Telephone</th>
                            <th>Grand total</th>
                            <th>Created At</th>
                            <th>Payment</th>
                            <th>Paid</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($orders as $item):?>
                            <tr>
                                <td><?php echo $item["id"];?></td>
                                <td><?php echo $item["customer_name"];?></td>
                                <td><?php echo $item["telephone"];?></td>
                                <td>$<?php echo number_format($item["grand_total"], 2);?></td>
                                <td><?php echo date("d-m-Y", strtotime($item["created_at"]));?></td>
                                <td><?php echo $item["payment_method"];?></td>
                                <td>
                                    <?php if($item["paid"]): ?>
                                        <span class="badge bg-success">Paid</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">UnPaid</span> 
                                    <?php endif;?>
                                </td>
                                <td><?php echo status_label($item["status"]);?></td>
                                <td>
                                    <a href="/admin/order_detail.php?id=<?php echo $item["id"];?>"
                                       class="btn btn-primary btn-sm order-detail-link">
                                       View
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach;?>    
                    </tbody>
                </table>

                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </article>
        </div>
    </main>
</body>
</html>
<?php include_once("./../html/footer.php");?>
