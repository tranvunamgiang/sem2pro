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
    <title><?php echo $product['name']; ?> - BookStore</title>

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="styles/bootstrap4/bootstrap.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/product.css?v=<?php echo time(); ?>">

    <style>
        html, body { height: 100%; }
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
            position: relative;
            overflow: hidden;
            cursor: zoom-in;
            transition: transform 0.3s;
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
            transition: all 0.3s ease;
            transform: translateY(0);
        }
        .btn-add-cart:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 0, 0, 0.3);
        }
        .main-content { flex: 1; padding: 30px 0; }
        [data-aos] { transition-duration: 800ms; }
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
                        <div class="col-md-6 product-image-container" data-aos="fade-right" data-aos-delay="200">
                            <img src="<?php echo $product['thumbnail']; ?>" class="product-image" alt="<?php echo $product['NAME']; ?>">
                        </div>
                        <div class="col-md-6 d-flex flex-column justify-content-center">
                            <h2 class="mb-3" data-aos="fade-left" data-aos-delay="300"><?php echo $product['NAME']; ?></h2>
                            <h4 class="text-danger" data-aos="fade-left" data-aos-delay="350">$<?php echo number_format($product['price'], 2); ?></h4>
                            <p data-aos="fade-left" data-aos-delay="400"><strong>In Stock:</strong> <?php echo $product['qty']; ?></p>
                            <p data-aos="fade-left" data-aos-delay="400"><strong>Tác giả:</strong> <?php echo $product['author']; ?></p>
                            <p data-aos="fade-left" data-aos-delay="450"><?php echo nl2br($product['description']); ?></p>

                            <!-- Add to Cart Form -->
                            <div data-aos="fade-up" data-aos-delay="500">
                                <form method="post" action="/add_to_cart.php">
                                    <input type="hidden" name="id" value="<?php echo $product["id"]; ?>"/>
                                    <div class="input-group mb-3">
                                        <input name="buy_qty" type="number" value="1" min="1" class="form-control" aria-label="Quantity">
                                        <button class=" btn-add-cart" type="submit">
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
    </div>

    <!-- Footer -->
    <?php include("html/footer.php"); ?>

</div>

<!-- JS Libraries -->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/medium-zoom@1.0.6/dist/medium-zoom.min.js"></script>

<script>
    // Initialize Animations
    AOS.init({ once: true, offset: 50 });

    // Initialize Image Zoom
    document.addEventListener('DOMContentLoaded', function() {
        const zoom = mediumZoom('.product-image', {
            margin: 24,
            background: 'rgba(0, 0, 0, 0.8)',
            scrollOffset: 40,
            container: { top: 50 }
        });

        // Hover Effect
        const imgContainer = document.querySelector('.product-image-container');
        imgContainer.addEventListener('mousemove', function(e) {
            if (window.innerWidth > 768) {
                const rect = imgContainer.getBoundingClientRect();
                const x = (e.clientX - rect.left) / rect.width * 100;
                const y = (e.clientY - rect.top) / rect.height * 100;
                imgContainer.style.transform = `scale(1.02)`;
            }
        });

        imgContainer.addEventListener('mouseleave', () => imgContainer.style.transform = 'scale(1)');

        // Smooth Scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    });
</script>

</body>
</html>