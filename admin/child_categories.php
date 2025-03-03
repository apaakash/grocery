<?php
include '../config.php';

// Add Child Category
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $parent_id = $_POST['parent_id'];
    $image = $_FILES['image']['name'];
    $target = "../Child-item/" . basename($image);

    // Upload image
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $stmt = $conn->prepare("INSERT INTO child_categories (name, parent_id, image) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $name, $parent_id, $image);
        $stmt->execute();
        $stmt->close();
    }
}

// Fetch Parent Categories
$parentResult = $conn->query("SELECT * FROM parent_categories");
$parents = [];
while ($row = $parentResult->fetch_assoc()) {
    $parents[] = $row;
}

// Fetch Child Categories
$childResult = $conn->query("SELECT child_categories.*, parent_categories.name AS parent_name 
    FROM child_categories 
    JOIN parent_categories ON child_categories.parent_id = parent_categories.id");
$childs = [];
while ($row = $childResult->fetch_assoc()) {
    $childs[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Child Categories</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h2>Add Child Category</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Child Category Name" required>
        <select name="parent_id" required>
            <option value="">-- Select Parent Category --</option>
            <?php foreach ($parents as $parent) : ?>
                <option value="<?= $parent['id'] ?>"><?= $parent['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <input type="file" name="image" required>
        <button type="submit">Add Child Category</button>
    </form>

    <h2>Child Category List</h2>
    <ul>
        <?php foreach ($childs as $child) : ?>
            <li>
                <img src="../Child-item/<?= $child['image'] ?>" width="50" height="50">
                <?= $child['name'] ?> (Parent: <?= $child['parent_name'] ?>)
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
