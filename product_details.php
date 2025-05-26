<?php
session_start();
include 'config.php';

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($product_id <= 0) {
    header("Location: products.php?added=invalid");
    exit;
}

$stmt = $conn->prepare("
    SELECT p.*, c.name AS category_name 
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.id
    WHERE p.id = ?
");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: products.php?added=notfound");
    exit;
}

$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= htmlspecialchars($product['name']); ?> – CristineShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .product-image:hover {
            transform: scale(1.05);
            transition: transform 0.4s ease;
        }
        .fade-in {
            animation: fadeIn 0.8s ease forwards;
            opacity: 0;
        }
        @keyframes fadeIn {
            to { opacity: 1; }
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

<?php include 'navbar.php'; ?>

<main class="container mx-auto px-6 py-16 flex-grow max-w-6xl">
    <div class="bg-white rounded-3xl shadow-xl flex flex-col md:flex-row gap-12 p-10 fade-in">
        <div class="md:w-1/2 flex items-center justify-center overflow-hidden rounded-2xl shadow-lg">
            <?php if (!empty($product['image'])): ?>
                <img src="admin/uploads/<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>" 
                     class="product-image w-full max-h-[480px] object-cover rounded-2xl" />
            <?php else: ?>
                <img src="assets/default-product.jpg" alt="No Image Available" 
                     class="product-image w-full max-h-[480px] object-cover rounded-2xl" />
            <?php endif; ?>
        </div>
        <section class="md:w-1/2 flex flex-col justify-between">
            <div>
                <h1 class="text-4xl font-extrabold text-gray-900 mb-3 tracking-tight"><?= htmlspecialchars($product['name']); ?></h1>
                <p class="text-indigo-600 font-semibold text-lg mb-6 uppercase tracking-wider"><?= htmlspecialchars($product['category_name'] ?? 'Uncategorized'); ?></p>
                <p class="text-gray-700 leading-relaxed text-lg mb-8 whitespace-pre-line">
                    <?= htmlspecialchars($product['description']); ?>
                </p>
            </div>
            <div>
                <div class="flex items-center space-x-4 mb-6">
                    <p class="text-3xl font-bold text-indigo-700">₱<?= number_format($product['price'], 2); ?></p>
                    <?php if ($product['stock'] > 0): ?>
                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 font-semibold text-sm shadow-inner">
                            In Stock (<?= $product['stock']; ?>)
                        </span>
                    <?php else: ?>
                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 font-semibold text-sm shadow-inner">
                            Out of Stock
                        </span>
                    <?php endif; ?>
                </div>
                <form method="POST" action="add.php" class="w-full">
                    <input type="hidden" name="product_id" value="<?= $product['id']; ?>" />
                    <button type="submit" <?= $product['stock'] <= 0 ? 'disabled' : ''; ?>
                        class="w-full py-4 rounded-full bg-orange-600 text-white text-xl font-semibold shadow-lg hover:bg-orange-700 focus:outline-none focus:ring-4 focus:ring-orange-400
                        transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h11L17 13M7 13L5.4 7M17 13l1.6-6M6 21h12" />
                        </svg>
                        Add to Cart
                    </button>
                </form>
            </div>
        </section>
    </div>
    <div class="mt-12 text-center">
        <a href="products.php" class="inline-block text-indigo-600 font-semibold hover:underline text-lg">
            &larr; Back to all products
        </a>
    </div>
</main>

<?php if (isset($_GET['added'])): ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    <?php if ($_GET['added'] === 'success'): ?>
        Swal.fire({
            icon: 'success',
            title: 'Added to Cart',
            text: 'The product has been added to your cart.',
            confirmButtonColor: '#f97316'
        });
    <?php elseif ($_GET['added'] === 'outofstock'): ?>
        Swal.fire({
            icon: 'error',
            title: 'Out of Stock',
            text: 'Sorry, this product is currently out of stock.',
            confirmButtonColor: '#f97316'
        });
    <?php elseif ($_GET['added'] === 'notfound'): ?>
        Swal.fire({
            icon: 'error',
            title: 'Product Not Found',
            text: 'This product could not be found in the database.',
            confirmButtonColor: '#f97316'
        });
    <?php elseif ($_GET['added'] === 'invalid'): ?>
        Swal.fire({
            icon: 'error',
            title: 'Invalid Request',
            text: 'The product ID is invalid.',
            confirmButtonColor: '#f97316'
        });
    <?php elseif ($_GET['added'] === 'login_required'): ?>
        Swal.fire({
            icon: 'error',
            title: 'Login Required',
            text: 'Please log in first to add products to your cart.',
            confirmButtonColor: '#f97316'
        });
    <?php endif; ?>
});
</script>
<?php endif; ?>

</body>
</html>
