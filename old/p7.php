<?php
include 'config.php';

if (!isset($_GET['child_id'])) {
    die("Invalid child category.");
}

$child_id = $_GET['child_id'];
$child = $conn->query("SELECT * FROM child_categories WHERE id = $child_id")->fetch_assoc();
$items = $conn->query("SELECT * FROM items WHERE category_id = $child_id");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - <?= $child['name'] ?></title>
    <link rel="stylesheet" href="./old/style.css">
</head>

<body>
    <div class="container">
        <aside class="sidebar">
            <a href="child_category.php?parent_id=<?= $child['parent_id'] ?>" class="back-button">← Back to Categories</a>
        </aside>
        <main class="content">
            <header>
                <h1>Products in <?= $child['name'] ?></h1>
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
</body>

</html>
