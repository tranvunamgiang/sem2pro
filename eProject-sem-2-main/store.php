<?php
include 'db.php'; // Kết nối database

$category_id = intval($_GET['category_id']); // Lọc dữ liệu

// Truy vấn sản phẩm theo danh mục
$stmt = $pdo->prepare("SELECT * FROM Products WHERE category_id = ?");
$stmt->execute([$category_id]);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Lấy tên danh mục
$category_stmt = $pdo->prepare("SELECT name FROM Categories WHERE id = ?");
$category_stmt->execute([$category_id]);
$category_name = $category_stmt->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<?php include("html/head.php"); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Categories - Bronx Luggage</title>
    
    <!-- Bootstrap & FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/product.css?v=<?php echo time(); ?>">
</head>

<body>

<div class="container mt-4">
    <!-- Header -->
    

    <!-- Tiêu đề danh mục -->
    <div class="text-center my-4">
        <h1 class="text-uppercase text-secondary fw-bold"><?php echo htmlspecialchars($category_name); ?></h1>
    </div>

    <!-- Danh sách sản phẩm -->
    <div class="row g-4">
        <?php if (empty($products)): ?>
            <div class="col-12 text-center">
                <p class="text-muted">No products found in this category.</p>
            </div>
        <?php else: ?>
            <?php foreach ($products as $product): ?>
                <div class="col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="<?php echo htmlspecialchars($product['thumbnail']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['NAME']); ?>">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['NAME']); ?></h5>
                            <p class="text-danger fw-bold">$<?php echo number_format($product['price'], 2); ?></p>
                            <a href="product.php?id=<?php echo urlencode($product['id']); ?>" class="btn btn-primary">
                                <i class="fas fa-shopping-cart"></i> View Product
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Footer -->
<?php include("html/footer.php"); ?>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
