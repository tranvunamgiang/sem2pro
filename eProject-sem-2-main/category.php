<?php
include 'db.php'; // Kết nối database

// Truy vấn danh mục sản phẩm
$stmt = $pdo->query("SELECT id, name, thumbnail FROM Categories");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    

    <!-- Banner -->
    <div class="text-center my-4">
        <h1 class="text-uppercase text-secondary">Categories</h1>
    </div>

    <!-- Danh mục sản phẩm -->
    <div class="row g-4">
        <?php foreach ($categories as $category): ?>
            <div class="col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm border-0">
                    <img src="<?php echo htmlspecialchars($category['thumbnail']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($category['name']); ?>">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo htmlspecialchars($category['name']); ?></h5>
                        <a href="store.php?category_id=<?php echo $category['id']; ?>" class="btn btn-primary">
                            <i class="fas fa-arrow-right"></i> View Category
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Footer -->
<?php include("html/footer.php"); ?>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
