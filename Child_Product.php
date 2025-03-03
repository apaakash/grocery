<?php
include 'config.php';

if (!isset($_GET['parent_id'])) {
    die("Invalid parent category.");
}

$parent_id = $_GET['parent_id'];
$parent = $conn->query("SELECT * FROM parent_categories WHERE id = $parent_id")->fetch_assoc();
$childs = $conn->query("SELECT * FROM child_categories WHERE parent_id = $parent_id");

$child_id = isset($_GET['child_id']) ? $_GET['child_id'] : null;
$items = null;

if ($child_id) {
    $items = $conn->query("SELECT * FROM items WHERE category_id = $child_id");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rolling Paper Shop</title>
    <link rel="stylesheet" href="./old/style.css">
</head>

<body>
    <div class="container">
        <aside class="sidebar">
            <?php while ($child = $childs->fetch_assoc()) : ?>
                <div class="sidebar-item">
                    <a id="child_c" href="Child_product?parent_id=<?= $parent_id ?>&child_id=<?= $child['id'] ?>">
                        <img src="Child-item/<?= $child['image'] ?>" alt="<?= $child['name'] ?>">
                        <span><?= $child['name'] ?></span>
                    </a>
                </div>
            <?php endwhile; ?>
        </aside>
        <main class="content">
            <header>
                <h1>Buy Rolling Paper Online</h1>
                <div class="sort-dropdown">
                    <label for="sort">Sort By:</label>
                    <select id="sort">
                        <option value="relevance">Relevance</option>
                        <option value="price-low">Price (Low to high)</option>
                        <option value="price-high">Price (High to low)</option>
                        <option value="discount">Discount (High to low)</option>
                        <option value="name">Name (A to Z)</option>
                    </select>
                </div>
            </header>
            <div class="products">
                <?php if ($items && $items->num_rows > 0) : ?>
                    <?php while ($item = $items->fetch_assoc()) : ?>
                        <div class="product">
                            <div class="product-image">
                                <img src="./p-item/<?= $item['image'] ?>" alt="<?= $item['name'] ?>">
                                <span class="discount">48% OFF</span>
                            </div>
                            <div class="product-details">
                                <p><?= $item['name'] ?></p>
                                <p>1 pack</p>
                                <div class="price">
                                    <span>₹<?= $item['price'] ?></span>
                                    <span class="original-price">₹25</span>
                                </div>
                                <button class="add-button">ADD</button>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <p>No products found.</p>
                <?php endif; ?>
            </div>
        </main>
    </div>
    <script src="./old/script.js"></script>
</body>

</html>
