<?php
include 'config.php';

if (!isset($_GET['parent_id'])) {
    die("Invalid parent category.");
}

$parent_id = $_GET['parent_id'];
$parent = $conn->query("SELECT * FROM parent_categories WHERE id = $parent_id")->fetch_assoc();
$childs = $conn->query("SELECT * FROM child_categories WHERE parent_id = $parent_id");

// Fetch Items
$items = $conn->query("SELECT items.*, items.image AS item_image, child_categories.name AS category_name, child_categories.image AS category_image, parent_categories.image AS parent_image
    FROM items 
    JOIN child_categories ON items.category_id = child_categories.id
    JOIN parent_categories ON child_categories.parent_id = parent_categories.id");
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
                    <a id="child_c" href="">
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
            </div>
        </main>
    </div>
    <script src="./old/script.js"></script>
</body>

</html>