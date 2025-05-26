<?php
session_start();
include 'config.php';
$search_query = $_GET['search'] ?? '';
$category_filter = $_GET['category'] ?? '';

$categories = [];
$cat_result = $conn->query("SELECT * FROM categories");
while ($row = $cat_result->fetch_assoc()) {
    $categories[] = $row;
}

$sql = "SELECT products.*, categories.name AS category_name 
        FROM products 
        LEFT JOIN categories ON products.category_id = categories.id 
        WHERE 1";

if (!empty($search_query)) {
    $search_term = $conn->real_escape_string($search_query);
    $sql .= " AND (products.name LIKE '%$search_term%' OR products.description LIKE '%$search_term%')";
}

if (!empty($category_filter)) {
    $cat_term = $conn->real_escape_string($category_filter);
    $sql .= " AND categories.name = '$cat_term'";
}

$result = $conn->query($sql);
$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

$products_heading = "All Products";
if (!empty($category_filter)) {
    $products_heading = "Products in " . htmlspecialchars($category_filter);
}

$alert_message = $_GET['alert'] ?? '';
$category_galleries = [
    'Entertainment' => [
        'images/LEGO WEDO.png',
        'images/LEGO BOOSTT.png',
        'images/newborn_mittens_booties.jpeg',
        'images/newborn_hat.jpeg'
    ],
    'Education' => [
        'images/Aibo.jpeg',
        'images/Alpha Dog.jpeg',
        'images/toddler_hoodie.jpeg',
        'images/toddler_pajamas.jpeg'
    ],
    'Consumer' => [
        'images/kids_tshirt1.jpeg',
        'images/kids_jeans.jpeg',
        'images/kids_jacket.jpeg',
        'images/kids_sneakers.jpeg'
    ],
    'default' => [
        'images/LEGO WEDO.png',
        'images/LEGO BOOSTT.png',
        'images/NXT.png',
        'images/EV3.png'
    ]
];

$normalized_category = strtolower(trim($category_filter));
$gallery_images = $category_galleries[$normalized_category] ?? $category_galleries['default'];
$isLoggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Products - CRIBOTICS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
      .gallery-container {
            position: absolute;
            top: 5%;
            left: 40%;
            transform: translate(-50%, -50%);
            width: 300px;
            height: 300px;
            transform-style: preserve-3d;
            animation: rotate 15s infinite linear;
        }

        .gallery-image {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            border-radius: 1rem;
            box-shadow: 0 15px 25px rgba(79, 70, 229, 0.3); /* indigo-600 shadow */
        }
        .gallery-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .gallery-image:hover img {
            transform: scale(1.05);
        }
        .gallery-image:nth-child(1) { transform: rotateY(0deg); }
        .gallery-image:nth-child(2) { transform: rotateY(90deg); }
        .gallery-image:nth-child(3) { transform: rotateY(180deg); }
        .gallery-image:nth-child(4) { transform: rotateY(270deg); }
        @keyframes rotate {
            0% { transform: rotateY(0deg); }
            100% { transform: rotateY(360deg); }
        }
    </style>
</head>
<body class="bg-whitesmoke flex flex-col min-h-screen font-sans">
<?php include 'navbar.php'; ?>
<main class="container mx-auto px-6 md:px-10 py-10 flex-grow relative" style="min-height: 80vh;">
    <form method="get" class="mb-12 max-w-6xl mx-auto flex flex-col sm:flex-row items-center gap-6 relative z-10">
        <div class="relative flex-grow w-full sm:w-auto">
            <span class="absolute inset-y-0 left-4 flex items-center text-gray-400 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="7"/>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
            </span>
            <input type="text" name="search" value="<?= htmlspecialchars($search_query); ?>" placeholder="Search products..." class="w-full pl-12 pr-5 py-3 rounded-xl border border-gray-300 bg-white/80 text-gray-800 font-medium placeholder-gray-400 shadow-sm transition" autocomplete="off" />
        </div>
        <select name="category" class="w-full sm:w-56 px-5 py-3 rounded-xl border border-gray-300 bg-white/80 text-gray-800 font-medium shadow-sm transition">
            <option value="">All Categories</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= htmlspecialchars($category['name']); ?>" <?= $category_filter == $category['name'] ? 'selected' : ''; ?>>
                    <?= htmlspecialchars(ucfirst($category['name'])); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="w-full sm:w-auto px-8 py-3 rounded-xl bg-orange-500 text-white font-semibold shadow-md hover:bg-orange-600 transition">Search</button>
    </form>
    <section aria-label="Product category gallery" style="height: 200px; position: relative; margin-bottom: 10rem;">
        <div class="gallery-container" aria-hidden="true" tabindex="-1">
            <?php foreach ($gallery_images as $image): ?>
                <div class="gallery-image" tabindex="-1">
                    <img src="<?= htmlspecialchars($image); ?>" alt="Gallery Image" />
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <h2 class="text-4xl font-extrabold mb-12 text-center text-gray-900 tracking-tight relative z-10"><?= $products_heading ?></h2>
    <div class="grid grid-cols-[repeat(auto-fit,minmax(250px,1fr))] gap-10 max-w-7xl mx-auto relative z-10">
        <?php if (empty($products)): ?>
            <p class="col-span-full text-center text-gray-500 text-lg italic">No products found.</p>
        <?php else: ?>
            <?php foreach ($products as $product): ?>
                <a href="product_details.php?id=<?= $product['id']; ?>" tabindex="0" class="bg-white hover:bg-orange-50 border border-gray-200 rounded-2xl shadow-md hover:shadow-orange-200 transition-all duration-300 group">
                    <?php if (!empty($product['image'])): ?>
                        <img src="admin/uploads/<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>" class="w-full h-56 object-cover rounded-t-2xl transition-transform duration-300 group-hover:scale-105" loading="lazy" />
                    <?php else: ?>
                        <img src="assets/default-product.jpg" alt="No Image Available" class="w-full h-56 object-cover rounded-t-2xl" loading="lazy" />
                    <?php endif; ?>
                    <div class="p-5 flex flex-col flex-grow">
                        <?php if ($product['stock'] <= 0): ?>
                            <p class="text-red-600 font-semibold text-center mb-4 uppercase tracking-wide border border-red-400 rounded-lg py-1">Out of Stock</p>
                        <?php endif; ?>
                        <h3 class="text-lg font-semibold mb-2 text-gray-900 line-clamp-2" title="<?= htmlspecialchars($product['name']); ?>">
                            <?= htmlspecialchars($product['name']); ?>
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 flex-grow line-clamp-3" title="<?= htmlspecialchars($product['description']); ?>">
                            <?= htmlspecialchars($product['description']); ?>
                        </p>
                        <p class="text-orange-600 font-bold mb-2 text-lg">₱<?= number_format($product['price'], 2); ?></p>
                        <p class="text-gray-700 mb-2 font-medium">Stock: <?= $product['stock']; ?></p>
                    </div>
                    <div class="p-5 pt-0">
                        <form method="POST" action="add_to_cart.php" class="add-to-cart-form">
                            <input type="hidden" name="product_id" value="<?= $product['id']; ?>" />
                            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-xl font-semibold transition disabled:opacity-50 disabled:cursor-not-allowed" <?= $product['stock'] <= 0 ? 'disabled' : ''; ?>>
                                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-2 -mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m5-9v9m4-9v9m4-9l2 9" />
                                </svg>
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</main>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const isLoggedIn = <?= $isLoggedIn ? 'true' : 'false'; ?>;
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!isLoggedIn) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Login Required',
                    text: 'You must log in to add products to your cart.',
                    confirmButtonColor: '#fb923c'
                });
            }
        });
    });
    <?php if (!empty($alert_message)): ?>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: <?= json_encode($alert_message); ?>,
        timer: 2500,
        showConfirmButton: false
    });
    <?php endif; ?>
});
</script>
</body>
</html>
