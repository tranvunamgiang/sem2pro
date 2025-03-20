<?php
require_once("./functions/dbp.php");
$id = $_GET["id"];
$sql = "SELECT * FROM products WHERE id = $id";
$product = findById($sql);
if ($product == null) {
    header("Location: 404notfound.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['name']; ?> - Bronx Luggage</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="styles/bootstrap4/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/product.css?v=<?php echo time(); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
        }
        .super_container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .product-card {
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            flex: 1;
        }
        .product-image-container {
            height: 70vh;
            min-height: 500px;
        }
        .product-image {
            height: 100%;
            width: 100%;
            object-fit: contain;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-add-cart {
            width: 100%;
            font-weight: bold;
        }
        .main-content {
            flex: 1;
            padding: 30px 0;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">

<div class="super_container">

    <!-- Header -->
    <?php include("html/head.php"); ?>

    <div class="container-fluid main-content">
        <div class="row justify-content-center h-100">
            <div class="col-12 col-lg-10">
                <div class="product-card h-100">
                    <div class="row h-100">
                        <div class="col-md-6 product-image-container">
                            <img src="<?php echo $product['thumbnail']; ?>" class="product-image" alt="<?php echo $product['NAME']; ?>">
                        </div>
                        <div class="col-md-6 d-flex flex-column justify-content-center">
                            <h2 class="mb-3"><?php echo $product['NAME']; ?></h2>
                            <h4 class="text-danger">$<?php echo number_format($product['price'], 2); ?></h4>
                            <p><strong>In Stock:</strong> <?php echo $product['qty']; ?></p>
                            <p><?php echo nl2br($product['description']); ?></p>

                            <!-- Add to Cart Form -->
                            <form method="post" action="/add_to_cart.php">
                                <input type="hidden" name="id" value="<?php echo $product["id"]; ?>"/>
                                <div class="input-group mb-3">
                                    <input name="buy_qty" type="number" value="1" min="1" class="form-control" aria-label="Quantity">
                                    <button class="btn btn-danger btn-add-cart" type="submit">
                                        <i class="fas fa-shopping-cart"></i> Add to cart
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include("html/footer.php"); ?>

</div>

<!-- JS Scripts -->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>

</body>
</html>