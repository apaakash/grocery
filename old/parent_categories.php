<?php
include 'config.php';

// Fetch Parent Categories
$parents = $conn->query("SELECT * FROM parent_categories");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Parent Categories</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Parent Categories</h1>
    <div class="category-container">
        <?php while ($parent = $parents->fetch_assoc()) : ?>
            <div class="category-box">
                <a href="child_categories.php?parent_id=<?= $parent['id'] ?>">
                    <img src="C-items/<?= $parent['image'] ?>" alt="<?= $parent['name'] ?>">
                    <p><?= $parent['name'] ?></p>
                </a>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
