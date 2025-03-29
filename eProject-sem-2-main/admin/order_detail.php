<?php 
session_start();  
require_once("./../functions/user.php");
require_once("./../functions/order.php");
require_once("./../functions/dbp.php"); // Kết nối DB

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
<main>
    <div class="row">
    <?php include_once("./../html/admin_aside.php");?>
    <article class="col">
        <h1><?php echo $order["customer_name"];?></h1>
        <h2><?php echo $order["telephone"];?></h2>
        <h2><?php echo $order["shipping_address"];?></h2>
        <h3><?php echo $order["payment_method"];?></h3>
        <h3><?php echo $order["paid"];?></h3>
        <h3><?php echo $order["grand_total"];?></h3>
        <h3><?php echo status_label($order["status"]);?></h3>
        
        <?php if ($order["status"] == CANCEL && !empty($order["note"])): ?>
            <div class="alert alert-danger">
                <strong>Cancel Note:</strong> <?php echo htmlspecialchars($order["note"]); ?>
            </div>
        <?php endif; ?>

        <table class="table">
            <thead>
                <th>Thumb</th>
                <th>Product</th>
                <th>Price</th>
                <th>Buy Qty</th>
                <th>Total</th>
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
        <div>
            <?php if($order["status"] == PENDING):?>
            <form method="POST" action="update_order_status.php" class="d-inline">
                <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                <input type="hidden" name="new_status" value="<?php echo CONFIRM; ?>">
                <button type="submit" class="btn btn-primary" onclick="return confirm('Change status to Confirm?')">Confirm</button>
            </form>
            <?php endif;?>

            <?php if($order["status"] == CONFIRM):?>
            <form method="POST" action="update_order_status.php" class="d-inline">
                <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                <input type="hidden" name="new_status" value="<?php echo SHIPPING; ?>">
                <button type="submit" class="btn btn-secondary" onclick="return confirm('Change status to Shipping?')">Shipping</button>
            </form>
            <?php endif;?>

            <?php if($order["status"] == SHIPPING):?>
            <form method="POST" action="update_order_status.php" class="d-inline">
                <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                <input type="hidden" name="new_status" value="<?php echo SHIPPED; ?>">
                <button type="submit" class="btn btn-info">Shipped</button>
            </form>
            <?php endif;?>

            <?php if($order["status"] == SHIPPED):?>
            <form method="POST" action="update_order_status.php" class="d-inline">
                <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                <input type="hidden" name="new_status" value="<?php echo COMPLETE; ?>">
                <button type="submit" class="btn btn-success">Complete</button>
            </form>
            <?php endif;?>

            <?php if($order["status"] == PENDING || $order["status"] == CONFIRM):?>
                <!-- Nút mở modal -->
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelModal">Cancel</button>
            <?php endif;?>
            
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
                      <textarea name="note" class="form-control" placeholder="Enter cancellation note..." required></textarea>
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
    </article>
    </div>
</main>
</body>
</html>
