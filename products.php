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
<html>
<head>
    <title>Products</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Products in <?= $child['name'] ?></h1>
    <div class="product-container">
        <?php while ($item = $items->fetch_assoc()) : ?>
            <div class="product-box">
                <img src="P-item/<?= $item['image'] ?>" alt="<?= $item['name'] ?>">
                <p><strong><?= $item['name'] ?></strong></p>
                <p>₹<?= $item['price'] ?></p>
            </div>
        <?php endwhile; ?>
    </div>
    <a href="child_categories.php?parent_id=<?= $child['parent_id'] ?>">Back to Child Categories</a>
</body>
</html>
