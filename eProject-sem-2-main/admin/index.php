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
    <title>Order Management</title>
    <style>
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <main class="container-fluid mt-4">
        <div class="row">
            <!-- Sidebar -->
            <aside class="col-md-2 p-0">
                <div class="card h-100 rounded-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Admin Menu</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="#" class="text-decoration-none">Orders</a></li>
                        <li class="list-group-item"><a href="#" class="text-decoration-none">Customers</a></li>
                        <li class="list-group-item"><a href="#" class="text-decoration-none">Products</a></li>
                        <li class="list-group-item"><a href="#" class="text-decoration-none">Categories</a></li>
                        <li class="list-group-item"><a href="#" class="text-decoration-none">Reports</a></li>
                    </ul>
                </div>
            </aside>

            <!-- Main Content -->
            <article class="col-md-10">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-primary text-white">
                        <h2 class="h5 mb-0 text-center">Order Management</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Telephone</th>
                                    <th>Grand Total</th>
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
                                                <span class="badge bg-danger">Unpaid</span> 
                                            <?php endif;?>
                                        </td>
                                        <td><?php echo status_label($item["status"]);?></td>
                                        <td>
                                            <a href="/admin/order_detail.php?id=<?php echo $item["id"];?>" class="btn btn-sm btn-primary order-detail-link">View</a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>    
                            </tbody>
                        </table>
                        
                        <!-- Pagination -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </article>
        </div>
    </main>
</body>
</html>
<?php include_once("./../html/footer.php");?>
