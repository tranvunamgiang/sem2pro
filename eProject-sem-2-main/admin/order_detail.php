<?php 
session_start();  
require_once("./../functions/user.php");
require_once("./../functions/order.php");
require_once("./../functions/dbp.php"); // Connect to DB

if(!is_admin()){
    header("Location: /404notfound.php");
    die();
}

$id = intval($_GET["id"]);
$info = order_detail($id);
$order = $info["order"];
$items = $info["items"];
?>

<!DOCTYPE html>
<html lang="en">
<?php include_once("./../html/head.php");?>
<body>
<main class="container-fluid mt-4">
    <div class="row">
        
        <!-- ASIDE MENU -->
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
                    <li class="list-group-item"><a href="#" class="text-decoration-none">Reviews</a></li>
                </ul>
            </div>
        </aside>
        
        <!-- MAIN CONTENT -->
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title">Order Information</h2>
                    <p><strong>Customer:</strong> <?php echo $order["customer_name"];?></p>
                    <p><strong>Phone Number:</strong> <?php echo $order["telephone"];?></p>
                    <p><strong>Shipping Address:</strong> <?php echo $order["shipping_address"];?></p>
                    <p><strong>Payment Method:</strong> <?php echo $order["payment_method"];?></p>
                    <p><strong>Paid:</strong> <?php echo $order["paid"] ? 'Yes' : 'No';?></p>
                    <p><strong>Total Amount:</strong> <?php echo $order["grand_total"];?></p>
                    <p><strong>Status:</strong> <?php echo status_label($order["status"]);?></p>
                </div>
            </div>

            <!-- PRODUCT TABLE -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Thumbnail</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($items as $item):?>
                            <tr>
                                <td><img src="<?php echo $item["thumbnail"] ?>" width="50"/></td>
                                <td><?php echo $item["name"] ?></td>
                                <td><?php echo $item["price"] ?></td>
                                <td><?php echo $item["buy_qty"] ?></td>
                                <td><?php echo $item["buy_qty"] * $item["price"]; ?></td>
                            </tr>
                        <?php endforeach;?>    
                    </tbody>
                </table>
            </div>

            <!-- ACTION BUTTONS BOX -->
            <div class="card text-center shadow w-100">
                <div class="card-body">
                    <h5 class="card-title">Order Actions</h5>
                    <div class="d-flex justify-content-center gap-3 mt-3 flex-wrap">
                        <?php if($order["status"] == PENDING): ?>
                            <form method="POST" action="update_order_status.php">
                                <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                <input type="hidden" name="new_status" value="<?php echo CONFIRM; ?>">
                                <button type="submit" class="btn btn-primary">Confirm</button>
                            </form>
                        <?php endif; ?>

                        <?php if($order["status"] == CONFIRM): ?>
                            <form method="POST" action="update_order_status.php">
                                <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                <input type="hidden" name="new_status" value="<?php echo SHIPPING; ?>">
                                <button type="submit" class="btn btn-secondary">Shipping</button>
                            </form>
                        <?php endif; ?>

                        <?php if($order["status"] == SHIPPING): ?>
                            <form method="POST" action="update_order_status.php">
                                <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                <input type="hidden" name="new_status" value="<?php echo SHIPPED; ?>">
                                <button type="submit" class="btn btn-info">Shipped</button>
                            </form>
                        <?php endif; ?>

                        <?php if($order["status"] == SHIPPED): ?>
                            <form method="POST" action="update_order_status.php">
                                <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                <input type="hidden" name="new_status" value="<?php echo COMPLETE; ?>">
                                <button type="submit" class="btn btn-success">Complete</button>
                            </form>
                        <?php endif; ?>

                        <?php if($order["status"] == PENDING || $order["status"] == CONFIRM): ?>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelModal">Cancel</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Modal Cancel Order -->
            <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="update_order_status.php">
                            <div class="modal-header">
                                <h5 class="modal-title" id="cancelModalLabel">Cancel Order</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <textarea name="note" class="form-control" placeholder="Enter cancellation reason..." required></textarea>
                                <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                <input type="hidden" name="new_status" value="<?php echo CANCEL; ?>">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Cancel Order</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</main>
</body>
</html>
<?php include_once("./../html/footer.php");?>
