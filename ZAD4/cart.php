<?php
session_start();

$products = [
    1 => ['name' => 'Plush Mouse Toy', 'price' => 5.99, 'img' => 'images/toy.png'],
    2 => ['name' => 'Throne Cat Bed', 'price' => 45.50, 'img' => 'images/bed.png'],
    3 => ['name' => 'Salmon in Gravy Can', 'price' => 2.40, 'img' => 'images/food.png'],
];

if (isset($_POST['clear_cart'])) {
    unset($_SESSION['cart']);
    header("Location: cart.php");
    exit();
}

$total_price = 0;
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
            <a href="products.php">Back to Shop</a>
        </nav>
    </div>
</header>

<main class="main-content">
    <div class="cart-wrapper">
        <h2>Your Selected Cat Essentials</h2>

        <?php if (!empty($_SESSION['cart'])): ?>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($_SESSION['cart'] as $id => $quantity): 
                        $item_total = $products[$id]['price'] * $quantity;
                        $total_price += $item_total;
                    ?>
                    <tr>
                        <td>
                            <img src="<?php echo $products[$id]['img']; ?>" alt="" class="cart-item-img">
                            <?php echo $products[$id]['name']; ?>
                        </td>
                        <td><?php echo $quantity; ?> pcs</td>
                        <td>$<?php echo number_format($products[$id]['price'], 2); ?></td>
                        <td>$<?php echo number_format($item_total, 2); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="total">Grand Total: $<?php echo number_format($total_price, 2); ?></div>

            <form method="POST">
                <button type="submit" name="clear_cart" class="btn-clear">Empty Cart</button>
            </form>
        <?php else: ?>
            <div class="empty-msg">Your cart is completely empty. Your cat is judging you.</div>
        <?php endif; ?>
    </div>
</main>

<footer>
    <p>&copy; 2026 Meow Market. All rights reserved.</p>
</footer>

</body>
</html>