<?php 
session_start();
require_once("./functions/user.php");
require_once("./functions/db.php");
$user = currentUser();
$userId= $user['id'];
$stmt = $pdo->query("SELECT * FROM orders WHERE user_id= $userId");
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<html lang="en">
<head>
<?php include_once("./html/head.php");?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Account</title>
</head>
<body>
    <?php echo $userId ?>
    <div class="container">
        <h3>Account Information</h3>
        <div class="row">
            <div class="col-6">
                <img src="./images/post-img2.jpg" alt="Avatar">
            </div>
            <div class="col">
                <h4>Name: <?php echo $user['full_name']?></h4>
                <h4>Email: <?php echo $user['email']?></h4>
                <h4>Role: <?php echo $user['role']?></h4>
                <hr>
                <h4>Your Orders ID:</h4>
                <?php foreach ($orders as $order): ?>
                    <h4><?php echo $order['id']; ?></h4>
                    <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>