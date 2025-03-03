<?php
include '../config.php';

// Add Item
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $image = $_FILES['image']['name'];
    $target = "../P-item/" . basename($image);

    // Upload image
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $stmt = $conn->prepare("INSERT INTO items (name, description, price, category_id, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdis", $name, $description, $price, $category_id, $image);
        $stmt->execute();
        $stmt->close();
    }
}

// Fetch Child Categories
$result = $conn->query("SELECT * FROM child_categories");
$categories = [];
while ($row = $result->fetch_assoc()) {
    $categories[] = $row;
}

// Fetch Items
$itemResult = $conn->query("SELECT items.*, child_categories.name AS category_name 
    FROM items 
    JOIN child_categories ON items.category_id = child_categories.id");
$items = [];
while ($row = $itemResult->fetch_assoc()) {
    $items[] = $row;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manage Items</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <h2>Add Item</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Item Name" required>
        <textarea name="description" placeholder="Description"></textarea>
        <input type="number" name="price" placeholder="Price" step="0.01" required>
        <select name="category_id" required>
            <option value="">-- Select Child Category --</option>
            <?php foreach ($categories as $cat) : ?>
                <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <input type="file" name="image" required>
        <button type="submit">Add Item</button>
    </form>

    <h2>Item List</h2>
    <ul>
        <?php foreach ($items as $item) : ?>
            <li>
                <img src="../P-item/<?= $item['image'] ?>" width="50" height="50">
                <?= $item['name'] ?> - ₹<?= $item['price'] ?> (<?= $item['category_name'] ?>)
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>