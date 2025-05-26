<?php
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

        .product-card {
            transition: box-shadow 0.3s ease, border-color 0.3s ease;
            border: 1px solid #e0e7ff;
            border-radius: 1rem;
            background: white;
        }

        .product-card:hover {
            border-color: #109fc3;
            box-shadow: 0 8px 24px  #ABD6EB;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans flex flex-col min-h-screen">

<?php include 'navbar.php'; ?>

<main class="container mx-auto px-6 py-10 flex-grow relative">

    <form method="get" class="mb-12 max-w-5xl mx-auto flex flex-col sm:flex-row items-center gap-6 px-4">
        <div class="relative flex-grow w-full sm:w-auto">
            <span class="absolute inset-y-0 left-4 flex items-center text-gray-400 pointer-events-none">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="7"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </span>
            <input
                type="text"
                name="search"
                value="<?= htmlspecialchars($search_query); ?>"
                placeholder="Search products..."
                class="w-full pl-12 pr-5 py-3 rounded-xl border border-indigo-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm text-gray-800 font-medium placeholder-gray-400 transition"
                autocomplete="off"
            />
        </div>
        <select
            name="category"
            class="w-full sm:w-56 px-5 py-3 rounded-xl border border-indigo-200 bg-white text-gray-800 font-medium focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition"
        >
            <option value="">All Categories</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= htmlspecialchars($category['name']); ?>" <?= $category_filter == $category['name'] ? 'selected' : ''; ?>>
                    <?= htmlspecialchars(ucfirst($category['name'])); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button
            type="submit"
            class="w-full sm:w-auto px-8 py-3 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 shadow-md transition"
        >
            Search
        </button>
    </form>

    <section class="mb-14 relative h-72">
        <div class="gallery-container">
            <?php foreach ($gallery_images as $image): ?>
                <div class="gallery-image">
                    <img src="<?= htmlspecialchars($image); ?>" alt="Gallery Image" />
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Products Heading -->
    <h2 class="text-4xl font-extrabold mb-12 text-center text-gray-900 relative z-10"><?= $products_heading ?></h2>

    <!-- Product Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10 max-w-7xl mx-auto relative z-10">
        <?php if (empty($products)): ?>
            <p class="col-span-full text-center text-gray-500 italic text-lg">No products found.</p>
        <?php else: ?>
            <?php foreach ($products as $product): ?>
                <a href="product_details1.php?id=<?= $product['id']; ?>" 
                   class="product-card shadow-md hover:shadow-xl transition-shadow duration-300 flex flex-col overflow-hidden group">

                    <div class="relative w-full h-60 overflow-hidden rounded-t-xl bg-gray-100">
                        <?php if (!empty($product['image'])): ?>
                            <img src="admin/uploads/<?= htmlspecialchars($product['image']); ?>" 
                                 alt="<?= htmlspecialchars($product['name']); ?>" 
                                 class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110" />
                        <?php else: ?>
                            <img src="assets/default-product.jpg" alt="No Image" class="w-full h-full object-cover" />
                        <?php endif; ?>

                        <?php if ($product['stock'] <= 0): ?>
                            <span class="absolute top-3 right-3 bg-red-600 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-lg">
                                Out of Stock
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="text-lg font-bold text-indigo-800 mb-2 line-clamp-2"><?= htmlspecialchars($product['name']); ?></h3>
                        <p class="text-gray-600 text-sm flex-grow line-clamp-3 mb-4"><?= htmlspecialchars($product['description']); ?></p>
                        <div class="flex items-center justify-between">
                            <p class="text-indigo-600 font-bold text-lg">₱<?= number_format($product['price'], 2); ?></p>
                            <p class="text-gray-500 font-medium text-sm">Stock: <?= $product['stock']; ?></p>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</main>

<?php if ($alert_message): ?>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: "<?= addslashes($alert_message); ?>",
        timer: 2500,
        showConfirmButton: false,
        timerProgressBar: true,
        confirmButtonColor: '#6366f1'
    });
</script>
<?php endif; ?>

</body>
</html>
