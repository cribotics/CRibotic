<?php
session_start();
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    header("Location: product_details.php?id=$product_id&added=login_required");
    exit;
}

// Ensure request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: products.php");
    exit;
}

$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
if ($product_id <= 0) {
    header("Location: product_details.php?id=$product_id&added=invalid");
    exit;
}

// Validate product and check stock
$stmt = $conn->prepare("SELECT id, name, stock, price FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();

if (!$product) {
    header("Location: product_details.php?id=$product_id&added=notfound");
    exit;
}

if ($product['stock'] <= 0) {
    header("Location: product_details.php?id=$product_id&added=outofstock");
    exit;
}

// Update stock
$new_stock = $product['stock'] - 1;
$update_stmt = $conn->prepare("UPDATE products SET stock = ? WHERE id = ?");
$update_stmt->bind_param("ii", $new_stock, $product_id);
$update_stmt->execute();
$update_stmt->close();

// Add to session cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id]['quantity'] += 1;
} else {
    $_SESSION['cart'][$product_id] = [
        'product_id' => $product_id,
        'name' => $product['name'],
        'price' => $product['price'],
        'quantity' => 1
    ];
}

// Redirect back with success
header("Location: product_details.php?id=$product_id&added=success");
exit;
?>
