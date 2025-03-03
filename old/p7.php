<?php
include 'config.php';

if (!isset($_GET['parent_id'])) {
    die("Invalid parent category.");
}

$parent_id = $_GET['parent_id'];
$parent = $conn->query("SELECT * FROM parent_categories WHERE id = $parent_id")->fetch_assoc();
$childs = $conn->query("SELECT * FROM child_categories WHERE parent_id = $parent_id");
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
                    <a href="">
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
                <div class="product">
                    <div class="product-image">
                        <img src="./p-item/Amul Cheese Cubes.avif" alt="Thins Pre-Rolled Rolling Paper By LIT">
                        <span class="discount">48% OFF</span>
                    </div>
                    <div class="product-details">
                        <p>Thins Pre-Rolled Rolling Paper By LIT</p>
                        <p>1 pack</p>
                        <div class="price">
                            <span>₹13</span>
                            <span class="original-price">₹25</span>
                        </div>
                        <button class="add-button">ADD</button>
                    </div>
                </div>
                <div class="product">
                    <div class="product-image">
                        <img src="./p-item/Amul Cow Fresh Miilk.avif" alt="Pyramid Pink Rolling Paper by LIT">
                        <span class="discount">30% OFF</span>
                    </div>
                    <div class="product-details">
                        <p>Pyramid Pink Rolling Paper by LIT</p>
                        <p>1 pack</p>
                        <div class="price">
                            <span>₹14</span>
                            <span class="original-price">₹20</span>
                        </div>
                        <button class="add-button">ADD</button>
                    </div>
                </div>
                <div class="product">
                    <div class="product-image">
                        <img src="./p-item/Amul Gold Milk.avif" alt="Pyramid Hemp Pre Rolled Cones LIT">
                    </div>
                    <div class="product-details">
                        <p>Pyramid Hemp Pre Rolled Cones LIT</p>
                        <p>1 pack</p>
                        <div class="price">
                            <span>₹20</span>
                        </div>
                        <button class="add-button">ADD</button>
                    </div>
                </div>
                <div class="product">
                    <div class="product-image">
                        <img src="./p-item/amul-butter.avif" alt="Mozo without Filter (Natural) Rolling Paper...">
                        <span class="discount">40% OFF</span>
                    </div>
                    <div class="product-details">
                        <p>Mozo without Filter (Natural) Rolling Paper...</p>
                        <p>1 pack</p>
                        <div class="price">
                            <span>₹30</span>
                            <span class="original-price">₹50</span>
                        </div>
                        <button class="add-button">ADD</button>
                    </div>
                </div>
                <div class="product">
                    <div class="product-image">
                        <img src="./p-item/amul-curd-1kg.avif" alt="Rolling Paper (White) b...">
                    </div>
                    <div class="product-details">
                        <p>Rolling Paper (White) b...</p>
                        <p>1 pack</p>
                        <div class="price">
                            <span>₹30</span>
                            <span class="original-price">₹50</span>
                        </div>
                        <button class="add-button">ADD</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="./old/script.js"></script>
</body>

</html>