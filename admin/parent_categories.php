<?php
include '../config.php';

// Add Parent Category
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $image = $_FILES['image']['name'];
    $target = "../C-items/" . basename($image);

    // Upload image
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $stmt = $conn->prepare("INSERT INTO parent_categories (name, image) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $image);
        $stmt->execute();
        $stmt->close();
    }
}

// Fetch Parent Categories
$result = $conn->query("SELECT * FROM parent_categories");
$parents = [];
while ($row = $result->fetch_assoc()) {
    $parents[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Parent Categories</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h2>Add Parent Category</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Parent Category Name" required>
        <input type="file" name="image" required>
        <button type="submit">Add Parent Category</button>
    </form>

    <h2>Parent Category List</h2>
    <ul>
        <?php foreach ($parents as $parent) : ?>
            <li>
                <img src="../C-items/<?= $parent['image'] ?>" width="50" height="50">
                <?= $parent['name'] ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
