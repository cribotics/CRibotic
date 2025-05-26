<?php
session_start();

include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: shopnow.php?alert=" . urlencode("Please log in to add items to your cart."));
    exit();
}

// Check if product ID is valid
if (isset($_POST['product_id']) && is_numeric($_POST['product_id'])) {
    $product_id = (int) $_POST['product_id'];

    // Fetch product from database
    $stmt = $conn->prepare("SELECT id, name, price, stock FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();

    if ($product && $product['stock'] > 0) {
        // Deduct stock by 1
        $new_stock = $product['stock'] - 1;
        $update_stmt = $conn->prepare("UPDATE products SET stock = ? WHERE id = ?");
        $update_stmt->bind_param("ii", $new_stock, $product_id);
        $update_stmt->execute();
        $update_stmt->close();

        // Initialize cart if not set
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Add to cart or increase quantity
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] += 1;
        } else {
            $_SESSION['cart'][$product_id] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => 1
            ];
        }

        $product_name = $product['name'];
        header("Location: shopnow.php?alert=" . urlencode("Added '{$product_name}' to cart."));
        exit();
    } else {
        header("Location: shopnow.php?alert=" . urlencode("Product not available or out of stock."));
        exit();
    }
} else {
    header("Location: shopnow.php?alert=" . urlencode("Invalid product."));
    exit();
}
?>
