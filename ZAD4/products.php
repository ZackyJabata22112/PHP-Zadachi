<?php
session_start();

$products = [
    1 => ['name' => 'Plush Mouse Toy', 'price' => 5.99, 'img' => 'images/toy.png'],
    2 => ['name' => 'Throne Cat Bed', 'price' => 45.50, 'img' => 'images/bed.png'],
    3 => ['name' => 'Salmon in Gravy Can', 'price' => 2.40, 'img' => 'images/food.png'],
];

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]++;
    } else {
        $_SESSION['cart'][$product_id] = 1;
    }
    
    header("Location: products.php");
    exit();
}

$cart_count = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zadacha 4</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="header-container">
        <div class="logo-area">
            <h1>MeowMarket.com</h1>
        </div>
        <nav>
            <a href="cart.php">Shopping Cart (<?php echo $cart_count; ?>)</a>
        </nav>
    </div>
</header>

<main class="main-content">
    <div class="products-grid">
        <?php foreach ($products as $id => $product): ?>
            <div class="product-card">
                <img src="<?php echo $product['img']; ?>" alt="<?php echo $product['name']; ?>" class="product-img">
                <h3><?php echo $product['name']; ?></h3>
                <div class="price">$<?php echo number_format($product['price'], 2); ?></div>
                
                <form method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                    <button type="submit" name="add_to_cart" class="btn-add">Add to Cart</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<footer>
    <p>&copy; 2026 Meow Market. All rights reserved.</p>
</footer>

</body>
</html>