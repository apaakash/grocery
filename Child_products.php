<!-- Category Page (p6.php) -->
<?php
include 'config.php';
include './Nav/Manu.php';

if (!isset($_GET['parent_id'])) {
    die("Invalid parent category.");
}

$parent_id = $_GET['parent_id'];
$parent = $conn->query("SELECT * FROM parent_categories WHERE id = $parent_id")->fetch_assoc();
$childs = $conn->query("SELECT * FROM child_categories WHERE parent_id = $parent_id");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rolling Paper Shop</title>
    <link rel="stylesheet" href="./old/style.css">
</head>

<body>
    <div class="container_aside">
        <aside class="sidebar">
            <?php while ($child = $childs->fetch_assoc()) : ?>
                <div class="sidebar-item">
                    <a id="child_c" href="products.php?parent_id=<?= $parent_id ?>&child_id=<?= $child['id'] ?>">
                        <img src="Child-item/<?= $child['image'] ?>" alt="<?= $child['name'] ?>">
                        <span><?= $child['name'] ?></span>
                    </a>
                </div>
            <?php endwhile; ?>
        </aside>
    </div>
    <script src="./old/script.js"></script>
    <?php include "./Nav/footer.php"; ?>
</body>
</html>