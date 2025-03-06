<?php
include '../config.php';

// Add Item
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $old_price = $_POST['old_price'];
    $offer = $_POST['offer'];
    $category_id = $_POST['category_id'];
    $image = $_FILES['image']['name'];
    $target = "../P-item/" . basename($image);

    // Convert offer percentage to numeric value (e.g., "10% OFF" → 10)
    $discountValue = (int) filter_var($offer, FILTER_SANITIZE_NUMBER_INT);

    // Calculate new price
    $price = $old_price - ($old_price * ($discountValue / 100));

    // Weight Handling
    $weights = isset($_POST['weight']) ? $_POST['weight'] : [];
    $customWeight = trim($_POST['custom_weight']);

    if (!empty($customWeight)) {
        $weights[] = $customWeight;
    }

    $weightsString = implode(', ', $weights);

    // Upload image and insert data
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $stmt = $conn->prepare("INSERT INTO items (name, description, price, old_price, offer, weight, category_id, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssddssss", $name, $description, $price, $old_price, $offer, $weightsString, $category_id, $image);
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
$itemResult = $conn->query("SELECT items.*, child_categories.name AS category_name FROM items JOIN child_categories ON items.category_id = child_categories.id");
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
    <script>
        function calculatePrice() {
            let oldPrice = parseFloat(document.getElementById("old_price").value) || 0;
            let offerText = document.getElementById("offer").value;
            let discount = parseFloat(offerText.replace(/[^0-9]/g, '')) || 0;
            let newPrice = oldPrice - (oldPrice * (discount / 100));

            if (!isNaN(newPrice)) {
                document.getElementById("price").value = newPrice.toFixed(2);
            }
        }
    </script>
</head>

<body>
    <h2>Add Item</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Item Name" required>
        <textarea name="description" placeholder="Description"></textarea>
        <input type="number" id="old_price" name="old_price" placeholder="Old Price" step="0.01" required oninput="calculatePrice()">
        <input type="text" id="offer" name="offer" placeholder="Offer (e.g., 10% OFF)" required oninput="calculatePrice()">
        <input type="number" id="price" name="price" placeholder="New Price" step="0.01" readonly>

        <label>Weight:</label>
        <div>
            <input type="checkbox" name="weight[]" value="100g"> 100g
            <input type="checkbox" name="weight[]" value="1 piece"> 1 piece
            <input type="checkbox" name="weight[]" value="100ml"> 100ml
            <input type="checkbox" name="weight[]" value="100g + 1 piece"> 100g + 1 piece
        </div>
        <input type="text" name="custom_weight" placeholder="Custom Weight (e.g., 500ml)">

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
                <?= $item['name'] ?> - ₹<?= $item['price'] ?> (Old: ₹<?= $item['old_price'] ?>) - <?= $item['category_name'] ?> - <?= $item['weight'] ?> - <?= $item['offer'] ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>
